<?php
include '../conexion/conexion.php'; // Incluye el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generar código alfanumérico
    $codigo_generado = generarCodigo();

    // Obtener valores del formulario
    $fecha = $_POST["fecha_h"];
    $inicial = $_POST["inicial"];
    $entradas = $_POST["entradas"];
    $salidas = $_POST["salidas"];
    $sucursal_traspaso = $_POST["lista_sucursales"];

    // Consulta SQL para insertar datos en la tabla
    $query = "INSERT INTO inventario_gas (codigo, fecha, inicial, entradas, salidas) 
              VALUES ('$codigo_generado', '$fecha', $inicial, $entradas, $salidas)";

        // Ejecutar la consulta
        $result = mysqli_query($conn, $query);

        // Cerrar la conexión
        mysqli_close($conn);
    } else {
        echo "Acceso no autorizado.";
    }
// Función para generar código alfanumérico
function generarCodigo($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $codigo = '';
    for ($i = 0; $i < $length; $i++) {
        $codigo .= $characters[rand(0, $charactersLength - 1)];
    }
    return $codigo;
}
?>
