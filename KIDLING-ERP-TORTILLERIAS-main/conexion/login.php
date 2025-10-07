<?php
include '../conexion/conexion.php'; // Incluye el archivo de conexión

// Obtener datos del formulario
$email = $_POST["email"];
$pass = $_POST["password"];

// Consulta SQL para verificar las credenciales del usuario
$query = mysqli_query($conn, "SELECT * FROM login_users WHERE email = '" . $email . "' AND password = '" . $pass . "'");
$nr = mysqli_num_rows($query);

// Verificar el resultado de la consulta
if ($nr == 1) {
    // Usuario correcto → redirigir al index real
    header("Location: rh/index.html");
    exit();
} else {
    // Usuario incorrecto → mensaje de error
    $error_message = "Usuario o contraseña incorrecta";
    header("Location: ../rh/login.html?error=1&message=" . urlencode($error_message));
    exit();
}
?>
