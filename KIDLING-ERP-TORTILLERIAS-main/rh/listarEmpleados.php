<?php
include __DIR__ . "/../conexion/conexion.php"; 

header('Content-Type: application/json');  // Muy importante
error_reporting(E_ALL);
ini_set('display_errors', 1);

$result = $conexion->query("SELECT id, nombre, apellidos, puesto, usuario, password FROM empleados");

$empleados = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $empleados[] = $row;
    }
}

echo json_encode($empleados);

$conexion->close();
