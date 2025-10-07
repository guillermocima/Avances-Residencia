<?php
include __DIR__ . "/../conexion/conexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);
$id = $data["id"] ?? 0;

if (!$id) {
    echo json_encode(["success"=>false,"message"=>"ID inválido"]);
    exit;
}

$stmt = $conexion->prepare("DELETE FROM empleados WHERE id=?");
$stmt->bind_param("i", $id);
if ($stmt->execute()) echo json_encode(["success"=>true]);
else echo json_encode(["success"=>false,"message"=>$conexion->error]);
$stmt->close();
$conexion->close();
