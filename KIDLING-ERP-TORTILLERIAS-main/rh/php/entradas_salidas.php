<?php
header("Content-Type: application/json; charset=UTF-8");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = "localhost";
$user = "root";
$pass = "";
$db   = "bd_tortilleria";

$response = ["success" => false, "data" => [], "message" => ""];

try {
    $conexion = new mysqli($host, $user, $pass, $db);
    $conexion->set_charset("utf8mb4");

    $data = json_decode(file_get_contents("php://input"), true);
    $action = $data["action"] ?? ($_POST["action"] ?? "listar");

    switch ($action) {
        case "listar":
            $sql = "SELECT r.id, e.nombre, e.apellidos, e.usuario, r.entrada, r.salida, r.area, r.observacion
                    FROM entradas_salidas r
                    INNER JOIN empleados e ON e.id = r.empleado_id
                    ORDER BY r.id DESC";
            $result = $conexion->query($sql);
            $registros = [];
            while ($row = $result->fetch_assoc()) {
                $registros[] = $row;
            }
            $response["success"] = true;
            $response["data"] = $registros;
            break;

        case "registrarEntrada":
            $empleado_id = $data["empleado_id"] ?? 0;
            $area        = $data["area"] ?? "Sin área";
            $observacion = $data["observacion"] ?? "A tiempo";

            if (!$empleado_id) throw new Exception("Empleado requerido");

            $stmt = $conexion->prepare("INSERT INTO entradas_salidas (empleado_id, entrada, area, observacion) VALUES (?, NOW(), ?, ?)");
            $stmt->bind_param("iss", $empleado_id, $area, $observacion);
            $stmt->execute();

            $response["success"] = true;
            $response["message"] = "Entrada registrada";
            break;

        case "registrarSalida":
            $empleado_id = $data["empleado_id"] ?? 0;
            if (!$empleado_id) throw new Exception("Empleado requerido");

            $stmt = $conexion->prepare("UPDATE entradas_salidas SET salida = NOW(), observacion='Finalizó turno'
                                        WHERE empleado_id=? AND salida IS NULL
                                        ORDER BY id DESC LIMIT 1");
            $stmt->bind_param("i", $empleado_id);
            $stmt->execute();

            $response["success"] = true;
            $response["message"] = "Salida registrada";
            break;

        default:
            $response["message"] = "Acción no válida";
    }
} catch (Exception $e) {
    $response["success"] = false;
    $response["message"] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
