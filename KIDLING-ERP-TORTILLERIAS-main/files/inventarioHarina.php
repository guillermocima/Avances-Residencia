<?php
include("../clases/Conexion.php");

$db = new Conexion();

// Obtener las variables del formulario
$opcionSeleccionada = htmlentities($_POST['opcionSeleccionada'], ENT_NOQUOTES, "UTF-8");
$fechaH = htmlentities($_POST['fechaH'], ENT_NOQUOTES, "UTF-8");
$inicial = htmlentities($_POST['inicial'], ENT_NOQUOTES, "UTF-8");
$entradas = htmlentities($_POST['entradas'], ENT_NOQUOTES, "UTF-8");
$salidas = htmlentities($_POST['salidas'], ENT_NOQUOTES, "UTF-8");
$traspasos = isset($_POST['traspasos']) ? htmlentities($_POST['traspasos'], ENT_NOQUOTES, "UTF-8") : NULL;
$listaSucursales = htmlentities($_POST['listaSucursales'], ENT_NOQUOTES, "UTF-8");

$db->beginTransaction();

try {
    // Preparar la consulta para insertar los datos
    $sql = $db->prepare("INSERT INTO inventario_harina (opcion_seleccionada, fecha_h, inicial, entradas, salidas, traspasos, lista_sucursales) VALUES (:opcionSeleccionada, :fechaH, :inicial, :entradas, :salidas, :traspasos, :listaSucursales)");
    $sql->bindParam(':opcionSeleccionada', $opcionSeleccionada, PDO::PARAM_STR);
    $sql->bindParam(':fechaH', $fechaH, PDO::PARAM_STR);
    $sql->bindParam(':inicial', $inicial, PDO::PARAM_STR);
    $sql->bindParam(':entradas', $entradas, PDO::PARAM_STR);
    $sql->bindParam(':salidas', $salidas, PDO::PARAM_STR);
    $sql->bindParam(':traspasos', $traspasos, PDO::PARAM_STR);
    $sql->bindParam(':listaSucursales', $listaSucursales, PDO::PARAM_STR);

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
