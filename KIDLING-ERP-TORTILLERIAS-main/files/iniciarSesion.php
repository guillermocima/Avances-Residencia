<?php
require_once __DIR__ . "/../clases/Conexion.php"; // $conexion ya está definido

// Obtener datos del formulario y limpiar espacios
$usuario = trim($_POST["email"] ?? '');
$password = trim($_POST["password"] ?? '');
$recordarme = $_POST["recordarme"] ?? 0;

$jsondata = array();

// Consulta para verificar email y contraseña directamente
$sql = $conexion->prepare("SELECT hashUser FROM dash_usuarios WHERE email = ? AND password = ? LIMIT 1");

if ($sql) {
    $sql->bind_param("ss", $usuario, $password);
    $sql->execute();
    $result = $sql->get_result();

    if ($result && $result->num_rows > 0) {
        $usuario_datos = $result->fetch_assoc();

        // Manejo de cookies según recordarme
        if ($recordarme == 1) {
            setcookie("cDash", $usuario_datos['hashUser'], time() + (86400 * 365), "/");
            setcookie("cDashExpiration", time() + (86400 * 365), time() + (86400 * 365), "/");
        } else {
            setcookie("cDash", $usuario_datos['hashUser'], 0, "/");
            setcookie("cDashExpiration", 0, 0, "/");
        }

        $jsondata['success'] = true;
    } else {
        $jsondata = ["success" => false, "mensaje" => "Correo o contraseña incorrectos"];
    }

    $sql->close();
} else {
    $jsondata = ["success" => false, "mensaje" => "Error en la preparación de la consulta: " . $conexion->error];
}

// Cerrar conexión
$conexion->close();

// Devolver JSON
header('Content-Type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
?>

