<?php
include("../clases/Conexion.php");

$db = new Conexion();

// Obtener las variables del formulario y sanitizarlas
$fechaEntrega = htmlentities($_POST['fechaEntrega'], ENT_NOQUOTES, "UTF-8");
$repartidor = htmlentities($_POST['repartidor'], ENT_NOQUOTES, "UTF-8");
$sucursal = htmlentities($_POST['sucursal'], ENT_NOQUOTES, "UTF-8");
$subtotalFrias = htmlentities($_POST['subtotalFrias'], ENT_NOQUOTES, "UTF-8");
$cantidadReportadaFrias = htmlentities($_POST['cantidadReportadaFrias'], ENT_NOQUOTES, "UTF-8");
$diferenciaFrias = htmlentities($_POST['diferenciaFrias'], ENT_NOQUOTES, "UTF-8");
$tortillaCalienteSalidas = htmlentities($_POST['tortillaCalienteSalidas'], ENT_NOQUOTES, "UTF-8");
$devolucionCaliente = htmlentities($_POST['devolucionCaliente'], ENT_NOQUOTES, "UTF-8");
$cantidadReportadaCaliente = htmlentities($_POST['cantidadReportadaCaliente'], ENT_NOQUOTES, "UTF-8");
$diferenciaCaliente = htmlentities($_POST['diferenciaCaliente'], ENT_NOQUOTES, "UTF-8");

$db->beginTransaction();

try {
    // Preparar la consulta para insertar los datos
    $sql = $db->prepare("INSERT INTO entregas_distribucion (fecha_entrega, repartidor_id, sucursal_id, subtotal_frias, cantidad_reportada_frias, diferencia_frias, tortilla_caliente_salidas, devolucion_caliente, cantidad_reportada_caliente, diferencia_caliente) 
                         VALUES (:fechaEntrega, :repartidor, :sucursal, :subtotalFrias, :cantidadReportadaFrias, :diferenciaFrias, :tortillaCalienteSalidas, :devolucionCaliente, :cantidadReportadaCaliente, :diferenciaCaliente)");
    $sql->bindParam(':fechaEntrega', $fechaEntrega, PDO::PARAM_STR);
    $sql->bindParam(':repartidor', $repartidor, PDO::PARAM_INT);
    $sql->bindParam(':sucursal', $sucursal, PDO::PARAM_INT);
    $sql->bindParam(':subtotalFrias', $subtotalFrias, PDO::PARAM_STR);
    $sql->bindParam(':cantidadReportadaFrias', $cantidadReportadaFrias, PDO::PARAM_STR);
    $sql->bindParam(':diferenciaFrias', $diferenciaFrias, PDO::PARAM_STR);
    $sql->bindParam(':tortillaCalienteSalidas', $tortillaCalienteSalidas, PDO::PARAM_STR);
    $sql->bindParam(':devolucionCaliente', $devolucionCaliente, PDO::PARAM_STR);
    $sql->bindParam(':cantidadReportadaCaliente', $cantidadReportadaCaliente, PDO::PARAM_STR);
    $sql->bindParam(':diferenciaCaliente', $diferenciaCaliente, PDO::PARAM_STR);

    // Ejecutar la consulta
    $sql->execute();

    // Confirmar la transacción
    $db->commit();
    $jsondata = array("success" => true, "mensaje" => "Registro correcto");
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $db->rollBack();
    $jsondata = array("success" => false, "mensaje" => "Ocurrió un error al intentar guardar los datos: " . $e->getMessage());
}

// Configurar la respuesta en formato JSON
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
?>
