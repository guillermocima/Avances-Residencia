<?php
include __DIR__ . "/../../conexion/conexion.php";

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data["nombre"] ?? '';
$apellidos = $data["apellidos"] ?? '';
$puesto = $data["puesto"] ?? '';
$usuario = $data["usuario"] ?? '';
$password = $data["password"] ?? '';

// Validar campos vacíos
if (!$nombre || !$apellidos || !$puesto || !$usuario || !$password) {
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios"]);
    exit;
}

// Verificar si el usuario ya existe
$stmt = $conexion->prepare("SELECT id FROM empleados WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "El usuario ya existe"]);
    exit;
}
$stmt->close();

// Insertar empleado
$stmt = $conexion->prepare("INSERT INTO empleados (nombre, apellidos, puesto, usuario, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nombre, $apellidos, $puesto, $usuario, $password);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $conexion->error]);
}

$stmt->close();
$conexion->close();
?>



