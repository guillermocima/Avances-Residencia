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

    // Leer datos JSON si los envía fetch
    $data = json_decode(file_get_contents("php://input"), true);

    // Acción a ejecutar
    $action = $data["action"] ?? ($_POST["action"] ?? "listar");

    switch ($action) {
        case "listar":
            $sql = "SELECT id, nombre, apellidos, puesto, usuario, password FROM empleados";
            $result = $conexion->query($sql);
            $empleados = [];
            while ($row = $result->fetch_assoc()) {
                $empleados[] = $row;
            }
            $response["success"] = true;
            $response["data"] = $empleados;
            break;

        case "registrar":
            $nombre    = trim($data["nombre"] ?? '');
            $apellidos = trim($data["apellidos"] ?? '');
            $puesto    = trim($data["puesto"] ?? '');
            $usuario   = trim($data["usuario"] ?? '');
            $password  = trim($data["password"] ?? '');

            // Validaciones
            if (!$nombre || strlen($nombre) < 3 || !preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $nombre)) throw new Exception("Nombre inválido");
            if (!$apellidos || strlen($apellidos) < 3 || !preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $apellidos)) throw new Exception("Apellidos inválidos");
            if (!$puesto || strlen($puesto) < 3) throw new Exception("Puesto inválido");
            if (!$usuario || !filter_var($usuario, FILTER_VALIDATE_EMAIL)) throw new Exception("Usuario debe ser un correo válido");
            if (!$password || strlen($password) < 6) throw new Exception("Contraseña mínima 6 caracteres");

            // Verificar duplicado
            $stmt = $conexion->prepare("SELECT id FROM empleados WHERE usuario=?");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) throw new Exception("Usuario ya existe");

            $stmt = $conexion->prepare("INSERT INTO empleados(nombre,apellidos,puesto,usuario,password) VALUES(?,?,?,?,?)");
            $stmt->bind_param("sssss", $nombre, $apellidos, $puesto, $usuario, $password);
            $stmt->execute();

            $response["success"] = true;
            $response["message"] = "Empleado registrado correctamente";
            break;

        case "editar":
            $id        = $data["id"] ?? 0;
            if (!$id) throw new Exception("ID requerido");

            $nombre    = trim($data["nombre"] ?? '');
            $apellidos = trim($data["apellidos"] ?? '');
            $puesto    = trim($data["puesto"] ?? '');
            $usuario   = trim($data["usuario"] ?? '');
            $password  = trim($data["password"] ?? '');

            // Validaciones
            if (!$nombre || strlen($nombre) < 3 || !preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $nombre)) throw new Exception("Nombre inválido");
            if (!$apellidos || strlen($apellidos) < 3 || !preg_match("/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/", $apellidos)) throw new Exception("Apellidos inválidos");
            if (!$puesto || strlen($puesto) < 3) throw new Exception("Puesto inválido");
            if (!$usuario || !filter_var($usuario, FILTER_VALIDATE_EMAIL)) throw new Exception("Usuario debe ser un correo válido");
            if (!$password || strlen($password) < 6) throw new Exception("Contraseña mínima 6 caracteres");

            $stmt = $conexion->prepare("UPDATE empleados SET nombre=?, apellidos=?, puesto=?, usuario=?, password=? WHERE id=?");
            $stmt->bind_param("sssssi", $nombre, $apellidos, $puesto, $usuario, $password, $id);
            $stmt->execute();

            $response["success"] = true;
            $response["message"] = "Empleado editado correctamente";
            break;


        case "eliminar":
            $id = $data["id"] ?? 0;
            if (!$id) throw new Exception("ID requerido");

            $stmt = $conexion->prepare("DELETE FROM empleados WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();

            $response["success"] = true;
            $response["message"] = "Empleado eliminado correctamente";
            break;

        default:
            $response["message"] = "Acción no válida";
            break;
    }
} catch (Exception $e) {
    $response["success"] = false;
    $response["message"] = $e->getMessage();
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
