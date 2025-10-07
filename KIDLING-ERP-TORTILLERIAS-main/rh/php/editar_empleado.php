<?php
include __DIR__ . "/../conexion/conexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["id"] ?? 0;
$nombre = $data["nombre"] ?? '';
$apellidos = $data["apellidos"] ?? '';
$puesto = $data["puesto"] ?? '';
$usuario = $data["usuario"] ?? '';
$password = $data["password"] ?? '';

if (!$id || !$nombre || !$apellidos || !$puesto || !$usuario || !$password) {
    echo json_encode(["success"=>false,"message"=>"Todos los campos son obligatorios"]);
    exit;
}

$stmt = $conexion->prepare("UPDATE empleados SET nombre=?, apellidos=?, puesto=?, usuario=?, password=? WHERE id=?");
$stmt->bind_param("sssssi", $nombre, $apellidos, $puesto, $usuario, $password, $id);
if ($stmt->execute()) echo json_encode(["success"=>true]);
else echo json_encode(["success"=>false,"message"=>$conexion->error]);
$stmt->close();
$conexion->close();
