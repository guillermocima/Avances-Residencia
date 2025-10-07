<?php
// Archivo: prueba_hash.php

echo "<h1>Prueba de Integridad de Contraseña</h1>";

require_once 'clases/Conexion.php';

// --- DATOS QUE VAMOS A PROBAR ---
$email_a_probar = 'gcimap24@gmail.com';
$contrasena_a_probar = 'a1b2c3';
// ---------------------------------

echo "<strong>Probando para el email:</strong> " . htmlspecialchars($email_a_probar) . "<br>";
echo "<strong>Probando con la contraseña:</strong> " . htmlspecialchars($contrasena_a_probar) . "<br><hr>";

try {
    $db = new Conexion();
    $pdo = $db->conectar();
    echo "<p style='color:green;'>1. Conexión a la base de datos: ÉXITO.</p>";

    $sql = "SELECT contrasena_hash FROM usuarios WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email_a_probar, PDO::PARAM_STR);
    $stmt->execute();

    $usuario = $stmt->fetch();

    if ($usuario) {
        echo "<p style='color:green;'>2. Búsqueda de usuario: ÉXITO. Se encontró el usuario.</p>";

        $hash_de_la_bd = $usuario['contrasena_hash'];
        echo "<strong>Hash encontrado en la BD:</strong> " . htmlspecialchars($hash_de_la_bd) . "<br>";

        echo "<p>3. Verificando contraseña con password_verify()...</p>";
        $esValida = password_verify($contrasena_a_probar, $hash_de_la_bd);

        if ($esValida) {
            echo "<h2 style='color:blue;'>RESULTADO: ¡ÉXITO! La contraseña y el hash coinciden.</h2>";
            echo "<p><strong>Diagnóstico:</strong> Si ves esto, el problema NO está en tu base de datos. El problema está en cómo los datos llegan desde el formulario a tu script `validar_login.php`.</p>";
        } else {
            echo "<h2 style='color:red;'>RESULTADO: ¡FALLO! La contraseña y el hash NO coinciden.</h2>";
            echo "<p><strong>Diagnóstico:</strong> El hash que está guardado en tu base de datos es incorrecto para la contraseña 'a1b2c3'. Debes generar uno nuevo y actualizarlo.</p>";
        }

    } else {
        echo "<h2 style='color:red;'>RESULTADO: ¡FALLO! No se encontró ningún usuario con ese email.</h2>";
        echo "<p><strong>Diagnóstico:</strong> Revisa que el email en la base de datos sea exactamente 'gcimap24@gmail.com' sin espacios ni errores.</p>";
    }

} catch (PDOException $e) {
    echo "<h2 style='color:red;'>ERROR CRÍTICO: No se pudo conectar o consultar la base de datos.</h2>";
    echo "<p><strong>Mensaje:</strong> " . $e->getMessage() . "</p>";
}
?>