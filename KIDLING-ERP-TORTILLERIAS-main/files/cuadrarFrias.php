<?php 
ini_set('display_errors', 0);
ini_set('log_errors', 1);

include("../clases/Conexion.php");
$db = new Conexion();

// Obtener las variables del formulario y sanitizarlas
$tortillasFrias = intval($_POST['tortillasFrias']);
$usuarioId = intval($_POST['usuarioId']);
$fecha = htmlentities($_POST['fecha'], ENT_NOQUOTES, "UTF-8");

// Calcular la fecha del día anterior
$fechaAnterior = date('Y-m-d', strtotime($fecha . ' -1 day'));

try {
    // Verificar la cantidad reportada para el día anterior
    $sqlAnterior = $db->prepare("SELECT cantidad_reportada_frias FROM entregas_distribucion WHERE fecha_entrega = :fechaAnterior");
    $sqlAnterior->bindParam(':fechaAnterior', $fechaAnterior, PDO::PARAM_STR);
    $sqlAnterior->execute();
    $resultadoAnterior = $sqlAnterior->fetch(PDO::FETCH_ASSOC);

    if (!$resultadoAnterior) {
        throw new Exception("No se encontró un registro para la fecha del día anterior.");
    }

    $cantidadReportadaAnterior = intval($resultadoAnterior['cantidad_reportada_frias']);

    // Calcular la diferencia y el valor de 'cuadrado'
    $diferencia = $tortillasFrias - $cantidadReportadaAnterior;
    $cuadrado = $diferencia == 0 ? 0 : $diferencia;

    // Preparar la consulta SQL para insertar o actualizar los datos
    $sqlGuardar = $db->prepare("INSERT INTO comprobaciones_tortillas_frias 
        (fecha, usuario_id, tortillas_frias, tortillas_frias_dia_anterior, cuadrado, contador_comparaciones) 
        VALUES (:fecha, :usuarioId, :tortillasFrias, :tortillasFriasDiaAnterior, :cuadrado, 1)
        ON DUPLICATE KEY UPDATE
        tortillas_frias = VALUES(tortillas_frias), 
        tortillas_frias_dia_anterior = VALUES(tortillas_frias_dia_anterior),
        cuadrado = VALUES(cuadrado), 
        contador_comparaciones = contador_comparaciones + 1");

    // Bind parameters (asegúrate de usar los nombres de columnas correctos)
    $sqlGuardar->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $sqlGuardar->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
    $sqlGuardar->bindParam(':tortillasFrias', $tortillasFrias, PDO::PARAM_INT);
    $sqlGuardar->bindParam(':tortillasFriasDiaAnterior', $cantidadReportadaAnterior, PDO::PARAM_INT);
    $sqlGuardar->bindParam(':cuadrado', $cuadrado, PDO::PARAM_INT);

    // Ejecutar la consulta
    $sqlGuardar->execute();

    // Preparar el mensaje de respuesta
    if ($diferencia === 0) {
        $jsondata = [
            "success" => true,
            "mensaje" => "Las tortillas frías se cuadraron correctamente."
        ];
    } else if ($diferencia > 0) {
        $jsondata = [
            "success" => false,
            "mensaje" => "Se han pasado {$diferencia} KG de tortillas con respecto a la cantidad reportada del día anterior."
        ];
    } else {
        $jsondata = [
            "success" => false,
            "mensaje" => "Faltan " . abs($diferencia) . " KG de tortillas para igualar la cantidad reportada del día anterior."
        ];
    }

} catch (Exception $e) {
    $jsondata = array(
        "success" => false,
        "tipo" => "error",
        "mensaje" => "Ocurrió un error al intentar verificar o guardar los datos: " . $e->getMessage()
    );
}

// Configurar la respuesta en formato JSON
header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
?>
