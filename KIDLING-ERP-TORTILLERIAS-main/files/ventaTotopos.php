<?php
include("../clases/Conexion.php");

$db = new Conexion();

// Obtener las variables del formulario y sanitizarlas
$totopoAnterior = htmlentities($_POST['toposAnterior'], ENT_NOQUOTES, "UTF-8");
$produccion = htmlentities($_POST['produccion'], ENT_NOQUOTES, "UTF-8");
$ventaTotopos = htmlentities($_POST['ventaTotopos'], ENT_NOQUOTES, "UTF-8");
$salidaTotopos = htmlentities($_POST['salidaTotopos'], ENT_NOQUOTES, "UTF-8");
$existenciaReal = htmlentities($_POST['existenciaReal'], ENT_NOQUOTES, "UTF-8");
$listaSucursales = htmlentities($_POST['sucursal'], ENT_NOQUOTES, "UTF-8");
$fecha = htmlentities($_POST['fecha'], ENT_NOQUOTES, "UTF-8");
        
// Verificación de datos incompletos
if (empty($totopoAnterior) || empty($produccion) || empty($ventaTotopos) || empty($salidaTotopos) || empty($existenciaReal) || empty($listaSucursales) || empty($fecha)) {
    $jsondata = array("success" => false, "mensaje" => "Datos incompletos");
    echo json_encode($jsondata);
    exit();
}

$db->beginTransaction();

try {
    // Preparar la consulta para insertar los datos
    $sql = $db->prepare("INSERT INTO inventario_totopos (topos_anterior, produccion, venta_totopos, salida_totopos, existencia_real, lista_sucursales, fecha) VALUES (:totopoAnterior, :produccion, :ventaTotopos, :salidaTotopos, :existenciaReal, :listaSucursales, :fecha)");
    $sql->bindParam(':totopoAnterior', $totopoAnterior, PDO::PARAM_STR);
    $sql->bindParam(':produccion', $produccion, PDO::PARAM_STR);
    $sql->bindParam(':ventaTotopos', $ventaTotopos, PDO::PARAM_STR);
    $sql->bindParam(':salidaTotopos', $salidaTotopos, PDO::PARAM_STR);
    $sql->bindParam(':existenciaReal', $existenciaReal, PDO::PARAM_STR);
    $sql->bindParam(':listaSucursales', $listaSucursales, PDO::PARAM_STR);
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
