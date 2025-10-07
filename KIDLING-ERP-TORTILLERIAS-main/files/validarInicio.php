<?php
// Incluir la conexión a la base de datos (solo una vez)
require_once __DIR__ . "/../clases/Conexion.php"; // $conexion está definido aquí

// Obtener datos del formulario
$usuario = $_POST["email"] ?? '';
$password = $_POST["password"] ?? '';
$recordarme = $_POST["recordarme"] ?? 0;

$jsondata = array();

// Preparar la consulta segura
$sql = $conexion->prepare("SELECT hashUser 
                           FROM dash_usuarios 
                           WHERE email = ? AND password = ? LIMIT 1");

if ($sql === false) {
    $jsondata['success'] = false;
    $jsondata['mensaje'] = "Error en la preparación de la consulta: " . $conexion->error;
} else {
    $sql->bind_param("ss", $usuario, $password);
    $sql->execute();
    $result = $sql->get_result();

    if ($result && $result->num_rows > 0) {
        $usuario_datos = $result->fetch_assoc();

        // Manejo de cookies
        if ($recordarme == 1) {
            setcookie("cDash", $usuario_datos['hashUser'], time() + (86400 * 365), "/");
            setcookie("cDashExpiration", time() + (86400 * 365), time() + (86400 * 365), "/");
        } else {
            setcookie("cDash", $usuario_datos['hashUser'], 0, "/");
            setcookie("cDashExpiration", 0, 0, "/");
        }

        $jsondata['success'] = true;
    } else {
        $jsondata = array(
            "success" => false,
            "mensaje" => "El correo electrónico o contraseña son incorrectos"
        );
    }

    $sql->close();
}

// Cerrar conexión (opcional)
$conexion->close();

// Devolver JSON
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
?>
