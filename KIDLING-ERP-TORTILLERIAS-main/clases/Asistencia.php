<?php
// Archivo: clases/Asistencia.php (Versión Final con Hora Unificada)

class Asistencia {
    
    /**
     * Registra la entrada usando la hora de PHP y calcula la puntualidad.
     */
    public static function registrarEntrada($usuarioId, PDO $pdo) {
        try {
            $sqlCheck = "SELECT id FROM asistencias WHERE usuario_id = :id AND DATE(hora_entrada) = CURDATE() AND hora_salida IS NULL";
            $stmtCheck = $pdo->prepare($sqlCheck);
            $stmtCheck->execute(['id' => $usuarioId]);

            if ($stmtCheck->rowCount() > 0) {
                return;
            }
            
            // Unificamos la zona horaria
            $zona_horaria = new DateTimeZone('America/Cancun');
            $hora_actual = new DateTime("now", $zona_horaria);
            
            // Lógica de observación de entrada
            $observacion_inicial = 'Puntual';
            $sqlTurno = "SELECT turno FROM usuarios WHERE id = :id";
            $stmtTurno = $pdo->prepare($sqlTurno);
            $stmtTurno->execute(['id' => $usuarioId]);
            $empleado = $stmtTurno->fetch();
            $turno = $empleado ? $empleado['turno'] : 'matutino';

            if ($turno === 'matutino') {
                $tolerancia_entrada = new DateTime($hora_actual->format('Y-m-d') . ' 06:05:00', $zona_horaria);
                if ($hora_actual > $tolerancia_entrada) {
                    $observacion_inicial = 'Retraso';
                }
            } else { // vespertino
                $tolerancia_entrada = new DateTime($hora_actual->format('Y-m-d') . ' 14:05:00', $zona_horaria);
                if ($hora_actual > $tolerancia_entrada) {
                    $observacion_inicial = 'Retraso';
                }
            }
            
            // Insertamos usando la hora de PHP, no la de MySQL
            $sql = "INSERT INTO asistencias (usuario_id, hora_entrada, observacion) VALUES (:id, :hora_entrada, :obs)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'id' => $usuarioId,
                'hora_entrada' => $hora_actual->format('Y-m-d H:i:s'), // Formato para MySQL
                'obs' => $observacion_inicial
            ]);

        } catch (PDOException $e) {
            error_log("Error al registrar entrada: " . $e->getMessage());
        }
    }

    /**
     * Registra la salida y calcula la observación final.
     */
    public static function registrarSalida($usuarioId, PDO $pdo) {
        try {
            $sqlInfo = "SELECT a.id AS asistencia_id, a.hora_entrada, a.observacion AS obs_entrada, u.turno
                        FROM asistencias a
                        JOIN usuarios u ON a.usuario_id = u.id
                        WHERE a.usuario_id = :id AND a.hora_salida IS NULL
                        ORDER BY a.id DESC LIMIT 1";
            $stmtInfo = $pdo->prepare($sqlInfo);
            $stmtInfo->execute(['id' => $usuarioId]);
            $registro = $stmtInfo->fetch();

            if (!$registro) return;

            $zona_horaria = new DateTimeZone('America/Cancun');
            $hora_entrada = new DateTime($registro['hora_entrada'], $zona_horaria);
            $hora_salida = new DateTime("now", $zona_horaria);
            $turno = $registro['turno'];
            $observaciones = [$registro['obs_entrada']]; // Empezamos con la observación de entrada ("Puntual" o "Retraso")

            $duracion_turno_requerida = 8 * 3600; 

            if ($turno === 'matutino') {
                $fin_oficial_turno = new DateTime($hora_entrada->format('Y-m-d') . ' 14:00:00', $zona_horaria);
            } else { // vespertino
                $fin_oficial_turno = new DateTime($hora_entrada->format('Y-m-d') . ' 22:00:00', $zona_horaria);
            }
            
            $intervalo_trabajado = $hora_salida->getTimestamp() - $hora_entrada->getTimestamp();
            
            if ($intervalo_trabajado >= $duracion_turno_requerida) {
                $observaciones[] = 'Turno completo';
            } else if ($hora_salida < $fin_oficial_turno) {
                $observaciones[] = 'Salida anticipada';
            } else {
                $observaciones[] = 'No cumplió 8 hrs';
            }

            $observacion_final = implode(', ', $observaciones);

            $sql = "UPDATE asistencias SET hora_salida = :hora_salida, observacion = :obs WHERE id = :asistencia_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'hora_salida' => $hora_salida->format('Y-m-d H:i:s'),
                'obs' => $observacion_final,
                'asistencia_id' => $registro['asistencia_id']
            ]);

        } catch (Exception $e) {
            error_log("Error al registrar salida: " . $e->getMessage());
        }
    }

    public static function obtenerRegistros(PDO $pdo) {
        $sql = "SELECT u.nombre, u.apellidos, u.email AS usuario, u.puesto AS area, a.hora_entrada, a.hora_salida, a.observacion 
                FROM asistencias a
                JOIN usuarios u ON a.usuario_id = u.id
                ORDER BY a.hora_entrada DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>