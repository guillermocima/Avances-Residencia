<?php
// Archivo: rh/php/gestion_prestamos.php (Versión Verificada)
require_once __DIR__ . '/../../clases/Conexion.php';

session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Acceso no autorizado."]);
    exit();
}

header('Content-Type: application/json; charset=UTF-8');
$response = ["success" => false, "message" => "Acción no reconocida"];

try {
    $db = new Conexion();
    $pdo = $db->conectar();
    $action = $_GET['action'] ?? $_POST['action'] ?? '';

    switch ($action) {
        case 'listar_empleados':
            $stmt = $pdo->query("SELECT id, nombre, apellidos FROM usuarios WHERE rol = 'empleado' ORDER BY apellidos");
            $response['data'] = $stmt->fetchAll();
            $response['success'] = true;
            break;

        case 'listar_prestamos':
            $sql = "SELECT p.*, CONCAT(u.nombre, ' ', u.apellidos) AS nombre_empleado, u.puesto AS area 
                    FROM prestamos p
                    JOIN usuarios u ON p.usuario_id = u.id
                    WHERE p.estado = 'activo'
                    ORDER BY p.fecha_solicitud DESC";
            $stmt = $pdo->query($sql);
            $response['data'] = $stmt->fetchAll();
            $response['success'] = true;
            break;

        case 'registrar':
            if (empty($_POST['usuario_id']) || empty($_POST['monto_total']) || empty($_POST['numero_quincenas'])) {
                throw new Exception("Todos los campos son obligatorios.");
            }
            $monto_total = (float)$_POST['monto_total'];
            $numero_quincenas = (int)$_POST['numero_quincenas'];
            
            if ($numero_quincenas <= 0) $numero_quincenas = 1;
            $descuento_quincenal = round($monto_total / $numero_quincenas, 2);

            $sql = "INSERT INTO prestamos (usuario_id, fecha_solicitud, monto_total, monto_descuento_quincenal, monto_restante, numero_quincenas) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $_POST['usuario_id'],
                $_POST['fecha_solicitud'],
                $monto_total,
                $descuento_quincenal,
                $monto_total,
                $numero_quincenas
            ]);
            $response = ["success" => true, "message" => "Préstamo registrado con éxito."];
            break;
        
        default:
            $response['message'] = 'Acción no especificada o desconocida.';
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    $response["message"] = "Error del servidor: " . $e->getMessage();
    error_log("Error en gestion_prestamos.php: " . $e->getMessage());
}

echo json_encode($response);
?>