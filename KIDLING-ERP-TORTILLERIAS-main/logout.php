<?php
// Archivo: logout.php (en la raíz del proyecto)

session_start();

// Verificamos si hay un usuario en la sesión antes de hacer nada
if (isset($_SESSION['usuario_id'])) {
    
    // Si el usuario es un 'empleado', registramos su salida
    if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'empleado') {
        
        require_once 'clases/Conexion.php';
        require_once 'clases/Asistencia.php';

        try {
            $db = new Conexion();
            $pdo = $db->conectar();
            Asistencia::registrarSalida($_SESSION['usuario_id'], $pdo);
        } catch (Exception $e) {
            // Guardamos el error pero no detenemos el logout
            error_log("Error al registrar salida durante el logout: " . $e->getMessage());
        }
    }
}

// ---- Proceso estándar de cierre de sesión ----

// Destruir todas las variables de sesión.
$_SESSION = array();

// Si se desea destruir la sesión completamente, borre también la cookie de sesión.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
session_destroy();

// Redirigir a la página de login.
header("Location: login.html");
exit();
?>