<?php
include("../clases/Conexion.php");

$db = new Conexion();

// Obtener las variables del formulario
$turno = htmlentities($_POST['turno'], ENT_NOQUOTES, "UTF-8");
$fecha = htmlentities($_POST['fecha'], ENT_NOQUOTES, "UTF-8");
$inicial = htmlentities($_POST['inicial'], ENT_NOQUOTES, "UTF-8");
$entradas = htmlentities($_POST['entradas'], ENT_NOQUOTES, "UTF-8");
$salidas = htmlentities($_POST['salidas'], ENT_NOQUOTES, "UTF-8");

$db->beginTransaction();

try {
    // Preparar la consulta para insertar los datos
    $sql = $db->prepare("INSERT INTO inventario_gas (turno, fecha, inicial, entradas, salidas) VALUES (:turno, :fecha, :inicial, :entradas, :salidas)");
    $sql->bindParam(':turno', $turno, PDO::PARAM_STR);
    $sql->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $sql->bindParam(':inicial', $inicial, PDO::PARAM_INT);
    $sql->bindParam(':entradas', $entradas, PDO::PARAM_INT);
    $sql->bindParam(':salidas', $salidas, PDO::PARAM_INT);

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
