<?php 
ini_set('display_errors', 0);
ini_set('log_errors', 1);

include("../clases/Conexion.php");
$db = new Conexion();

// Obtener las variables del formulario y sanitizarlas
$tortillasCalientes = intval($_POST['tortillasCalientes']);
$usuarioId = intval($_POST['usuarioId']);
$fecha = htmlentities($_POST['fecha'], ENT_NOQUOTES, "UTF-8");

try {
    // Preparar la consulta SQL para insertar o actualizar los datos
    $sqlGuardar = $db->prepare("INSERT INTO comprobaciones_tortillas_calientes 
        (fecha, usuario_id, tortillas_calientes) 
        VALUES (:fecha, :usuarioId, :tortillasCalientes)
        ON DUPLICATE KEY UPDATE
        tortillas_calientes = VALUES(tortillas_calientes)");

    // Bind parameters (asegúrate de usar los nombres de columnas correctos)
    $sqlGuardar->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $sqlGuardar->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
    $sqlGuardar->bindParam(':tortillasCalientes', $tortillasCalientes, PDO::PARAM_INT);

    // Ejecutar la consulta
    $sqlGuardar->execute();

    // Preparar el mensaje de respuesta
    $jsondata = [
        "success" => true,
        "mensaje" => "Los datos de tortillas calientes se han guardado correctamente."
    ];

} catch (Exception $e) {
    $jsondata = array(
        "success" => false,
        "tipo" => "error",
        "mensaje" => "Ocurrió un error al intentar guardar los datos: " . $e->getMessage()
    );
}

// Configurar la respuesta en formato JSON
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
?>
