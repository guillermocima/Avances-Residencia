<?php
include("../clases/Conexion.php");

$db = new Conexion();

// Obtener las variables del formulario y sanitizarlas
$sucursal = htmlentities($_POST['sucursal'], ENT_NOQUOTES, "UTF-8");
$ventaTotopos = htmlentities($_POST['venta_totopos'], ENT_NOQUOTES, "UTF-8");
$precio = htmlentities($_POST['precio'], ENT_NOQUOTES, "UTF-8");
$fecha = htmlentities($_POST['fecha'], ENT_NOQUOTES, "UTF-8");

// Verificación de datos incompletos
if (empty($sucursal) || empty($ventaTotopos) || empty($precio) || empty($fecha)) {
    $jsondata = array("success" => false, "mensaje" => "Datos incompletos");
    echo json_encode($jsondata);
    exit();
}

// Validar tipos de datos
if (!is_numeric($ventaTotopos) || !is_numeric($precio) || floatval($ventaTotopos) <= 0 || floatval($precio) <= 0) {
    $jsondata = array("success" => false, "mensaje" => "La cantidad de totopos y el precio deben ser números positivos.");
    echo json_encode($jsondata);
    exit();
}

$db->beginTransaction();

try {
    // Preparar la consulta para insertar los datos
    $sql = $db->prepare("INSERT INTO ventastotopos_dia (sucursal, bolsas, precio, fecha) VALUES (:sucursal, :ventaTotopos, :precio, :fecha)");
    $sql->bindParam(':sucursal', $sucursal, PDO::PARAM_STR);
    $sql->bindParam(':ventaTotopos', $ventaTotopos, PDO::PARAM_STR);
    $sql->bindParam(':precio', $precio, PDO::PARAM_STR);
    $sql->bindParam(':fecha', $fecha, PDO::PARAM_STR);

    $sql->execute();

    $db->commit();
    $jsondata = array("success" => true, "mensaje" => "Registro correcto");
} catch (Exception $e) {
    $db->rollBack();
    $jsondata = array("success" => false, "mensaje" => "Ocurrió un error al intentar guardar los datos: " . $e->getMessage());
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
?>
