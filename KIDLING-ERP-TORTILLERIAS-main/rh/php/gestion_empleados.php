<?php
// Archivo: rh/php/gestion_empleados.php (Versión Final Corregida)

require_once __DIR__ . '/../../clases/Conexion.php';

session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(403);
    echo json_encode(["success" => false, "message" => "Acceso no autorizado."]);
    exit();
}

header('Content-Type: application/json; charset=UTF-8');

$response = ["success" => false, "message" => "Acción no reconocida."];

// LÍNEA CLAVE CORREGIDA:
// Ahora, la variable $action se llena con el valor de $_POST si existe,
// O con el valor de $_GET si no. Esto hace que el script sea flexible.
$action = $_POST["action"] ?? $_GET["action"] ?? '';

try {
    $db = new Conexion();
    $pdo = $db->conectar();

    switch ($action) {
        case 'listar':
            $stmt = $pdo->query("SELECT id, nombre, apellidos, email, puesto, rol FROM usuarios ORDER BY nombre");
            $response["success"] = true;
            $response["data"] = $stmt->fetchAll();
            break;

        case 'registrar':
            $rol = ($_POST['rol'] === 'admin' || $_POST['rol'] === 'empleado') ? $_POST['rol'] : 'empleado';
            if (empty($_POST['password'])) {
                throw new Exception("La contraseña es obligatoria para registrar un nuevo usuario.");
            }
            $contrasena_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, apellidos, email, puesto, contrasena_hash, rol) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['puesto'], $contrasena_hash, $rol
            ]);

            $response = ["success" => true, "message" => "Usuario registrado con éxito."];
            break;
        
        case 'actualizar':
            $id = $_POST['usuario_id'];
            $rol = ($_POST['rol'] === 'admin' || $_POST['rol'] === 'empleado') ? $_POST['rol'] : 'empleado';
            if (empty($id)) throw new Exception("ID de usuario no válido.");

            if (!empty($_POST['password'])) {
                $contrasena_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $sql = "UPDATE usuarios SET nombre=?, apellidos=?, email=?, puesto=?, rol=?, contrasena_hash=? WHERE id=?";
                $params = [$_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['puesto'], $rol, $contrasena_hash, $id];
            } else {
                $sql = "UPDATE usuarios SET nombre=?, apellidos=?, email=?, puesto=?, rol=? WHERE id=?";
                $params = [$_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['puesto'], $rol, $id];
            }
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $response = ["success" => true, "message" => "Usuario actualizado con éxito."];
            break;

        case 'eliminar':
            if (empty($_POST['id'])) throw new Exception("ID de usuario no válido.");
            $id = $_POST['id'];
            $sql = "DELETE FROM usuarios WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            $response = ["success" => true, "message" => "Usuario eliminado correctamente."];
            break;

        default:
            $response = ["success" => false, "message" => "Acción desconocida: " . htmlspecialchars($action)];
            break;
    }

} catch (PDOException $e) {
    http_response_code(500);
    error_log("PDO Error en gestion_empleados.php: " . $e->getMessage());
    if ($e->getCode() == 23000) {
        $response["message"] = "El email ya está registrado.";
    } else {
        $response["message"] = "Error de base de datos.";
    }
} catch (Exception $e) {
    http_response_code(400);
    $response["message"] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
exit();
?>