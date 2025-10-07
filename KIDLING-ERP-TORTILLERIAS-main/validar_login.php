<?php
/**
 * Archivo: validar_login.php
 * Ubicación: Raíz del proyecto (KIDLING-ERP-TORTILLERIAS-main/validar_login.php)
 * Propósito: Validar las credenciales del usuario, crear la sesión y redirigir al dashboard.
 */

// Requerimos las clases necesarias. 'require_once' es más estricto que 'include'.
require_once 'clases/Conexion.php';
require_once 'clases/Asistencia.php'; // Para registrar la entrada de los empleados

// session_start() debe ir al principio de todo para poder manipular sesiones.
session_start();

// 1. Verificación inicial: ¿Se enviaron los datos del formulario?
if (empty($_POST['email']) || empty($_POST['password'])) {
    header("Location: login.html?error=" . urlencode("Por favor, complete todos los campos."));
    exit();
}

try {
    // 2. Conexión a la BD a través de nuestra clase segura
    $db = new Conexion();
    $pdo = $db->conectar();

    // 3. Recibir y limpiar los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 4. Consulta segura usando Prepared Statements de PDO
    $sql = "SELECT id, contrasena_hash, rol FROM usuarios WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);

    // Vinculamos el email al parámetro de la consulta
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    
    // Obtenemos el resultado
    $usuario = $stmt->fetch();

    // 5. Verificación de la contraseña
    // Si $usuario existe Y la contraseña enviada coincide con el hash de la BD...
    if ($usuario && password_verify($password, $usuario['contrasena_hash'])) {
        
        // ¡Login exitoso!
        
        // Regeneramos el ID de la sesión por seguridad para prevenir ataques de fijación de sesión.
        session_regenerate_id(true);

        // 6. Guardamos los datos importantes del usuario en la sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_rol'] = $usuario['rol'];

        // 7. Lógica de negocio específica por rol
        if ($usuario['rol'] === 'empleado') {
            // Si el usuario es un empleado, registramos su hora de entrada.
            Asistencia::registrarEntrada($usuario['id'], $pdo);
        }

        // 8. Redirección al dashboard unificado para TODOS los usuarios
        header("Location: dashboard.php");
        exit();

    } else {
        // Si $usuario no existe o password_verify falló, las credenciales son incorrectas.
        header("Location: login.html?error=" . urlencode("Email o contraseña incorrectos."));
        exit();
    }

} catch (PDOException $e) {
    // Si algo falla a nivel de base de datos, guardamos el error y mostramos un mensaje genérico.
    error_log("Error de validación de login: " . $e->getMessage());
    header("Location: login.html?error=" . urlencode("Error del sistema. Por favor, intente más tarde."));
    exit();
}
?>
