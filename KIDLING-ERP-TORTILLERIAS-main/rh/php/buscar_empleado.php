<?php
include "conexion.php";

$usuario = $_GET["usuario"] ?? "";

if (!$usuario) {
    echo json_encode(["success" => false, "message" => "Usuario no enviado"]);
    exit;
}

$stmt = $conexion->prepare("SELECT id, nombre, apellidos, puesto, usuario, password FROM empleados WHERE usuario=?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(["success" => true, "empleado" => $row]);
} else {
    echo json_encode(["success" => false, "message" => "Empleado no encontrado"]);
}

$stmt->close();
$conexion->close();
?>
