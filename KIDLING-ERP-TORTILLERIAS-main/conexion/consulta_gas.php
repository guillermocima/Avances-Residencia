<?php
include '../conexion/conexion.php';

// Consulta SQL para obtener todos los registros de la tabla
$query = "SELECT * FROM inventario_gas";
$result = mysqli_query($conn, $query);

if ($result) {
    // Obtener los datos en formato de array asociativo
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Enviar los datos en formato JSON
    echo json_encode($data);
} else {
    echo "Error al obtener datos: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>
