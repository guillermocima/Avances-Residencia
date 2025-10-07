<?php
// Archivo: crear_admin.php

echo "<h1>Asistente de Creación de Usuario Administrador</h1>";

require_once 'clases/Conexion.php';

// --- DATOS DEL NUEVO USUARIO DE PRUEBA ---
$nombre      = "Admin";
$apellidos   = "Test";
$email       = "admin@test.com";
$password    = "admin"; // Usaremos una contraseña simple para la prueba
$puesto      = "Super Administrador";
$rol         = "admin";
// -----------------------------------------

echo "<p>Intentando crear/actualizar el usuario: <strong>" . htmlspecialchars($email) . "</strong> con la contraseña: <strong>" . htmlspecialchars($password) . "</strong></p>";

try {
    // 1. Generar el hash SEGURO para la contraseña
    echo "<p>1. Generando hash con password_hash()...</p>";
    $contrasena_hash = password_hash($password, PASSWORD_DEFAULT);
    echo "<strong>Hash generado:</strong> " . htmlspecialchars($contrasena_hash) . "<br><hr>";

    // 2. Conectar a la base de datos
    $db = new Conexion();
    $pdo = $db->conectar();
    echo "<p>2. Conectado a la base de datos con éxito.</p>";

    // 3. Preparar la consulta SQL (INSERT ... ON DUPLICATE KEY UPDATE)
    // Esta consulta es especial: si el email no existe, lo crea. Si ya existe, lo actualiza.
    // Esto nos permite ejecutar el script varias veces sin que dé error.
    $sql = "INSERT INTO usuarios (nombre, apellidos, email, contrasena_hash, puesto, rol) 
            VALUES (:nombre, :apellidos, :email, :hash, :puesto, :rol)
            ON DUPLICATE KEY UPDATE 
                nombre = VALUES(nombre), 
                apellidos = VALUES(apellidos), 
                contrasena_hash = VALUES(contrasena_hash), 
                puesto = VALUES(puesto), 
                rol = VALUES(rol)";
    
    $stmt = $pdo->prepare($sql);
    echo "<p>3. Consulta SQL preparada.</p>";

    // 4. Ejecutar la consulta
    $stmt->execute([
        'nombre'    => $nombre,
        'apellidos' => $apellidos,
        'email'     => $email,
        'hash'      => $contrasena_hash,
        'puesto'    => $puesto,
        'rol'       => $rol
    ]);
    echo "<p>4. Consulta ejecutada.</p><hr>";

    echo "<h2 style='color:green;'>¡ÉXITO!</h2>";
    echo "<p>El usuario <strong>admin@test.com</strong> está listo en la base de datos con la contraseña <strong>admin</strong>.</p>";
    echo "<p>Ahora puedes ir a <strong>login.html</strong> e intentar iniciar sesión con estas nuevas credenciales.</p>";


} catch (Exception $e) {
    echo "<h2 style='color:red;'>¡ERROR CRÍTICO!</h2>";
    echo "<p>No se pudo crear el usuario. Mensaje de error:</p>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>