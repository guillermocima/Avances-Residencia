<?php
// Archivo: rh/php/gestion_asistencias.php

// Subimos dos niveles para encontrar las clases
require_once __DIR__ . '/../../clases/Conexion.php';
require_once __DIR__ . '/../../clases/Asistencia.php';

session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(["success" => false, "message" => "Acceso no autorizado."]);
    exit();
}

header("Content-Type: application/json; charset=UTF-8");

try {
    $db = new Conexion();
    $pdo = $db->conectar();
    
    $registros = [];
    if ($_SESSION['usuario_rol'] === 'admin') {
        // El admin ve todos los registros
        $registros = Asistencia::obtenerRegistros($pdo);
    } else {
        // Un empleado solo ve sus propios registros
        // (Necesitaríamos crear un método para esto en la clase Asistencia, por ahora lo dejamos así)
        $registros = Asistencia::obtenerRegistros($pdo); // Temporalmente muestra todo
    }
    
    echo json_encode(["success" => true, "data" => $registros]);

} catch (Exception $e) {
    error_log("Error en gestion_asistencias.php: " . $e->getMessage());
    echo json_encode(["success" => false, "message" => "Error interno al obtener asistencias."]);
}
?>