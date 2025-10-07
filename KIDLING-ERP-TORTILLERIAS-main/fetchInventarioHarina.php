<?php
include("clases/Conexion.php");

$db = new Conexion();

// Recuperar parámetros de búsqueda (si los hay)
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$codigo = isset($_GET['codigo']) ? $_GET['codigo'] : '';

// Construir la consulta SQL
$sql = "SELECT * FROM inventario_harina WHERE 1=1";
$params = [];

if (!empty($fecha)) {
    $sql .= " AND fecha_h = :fecha";
    $params[':fecha'] = $fecha;
}

if (!empty($codigo)) {
    $sql .= " AND opcion_seleccionada = :codigo";
    $params[':codigo'] = $codigo;
}

try {
    $stmt = $db->prepare($sql);
    
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($result) {
        echo '<div class="row">';
        echo '<table border="1">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>OPCIÓN SELECCIONADA</th>';
        echo '<th>FECHA</th>';
        echo '<th>INICIAL</th>';
        echo '<th>ENTRADAS</th>';
        echo '<th>SALIDAS</th>';
        echo '<th>TRASPASOS</th>';
        echo '<th>LISTA SUCURSALES</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($result as $row) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['id']) . '</td>';
            echo '<td>' . htmlspecialchars($row['opcion_seleccionada']) . '</td>';
            echo '<td>' . htmlspecialchars($row['fecha_h']) . '</td>';
            echo '<td>' . htmlspecialchars($row['inicial']) . '</td>';
            echo '<td>' . htmlspecialchars($row['entradas']) . '</td>';
            echo '<td>' . htmlspecialchars($row['salidas']) . '</td>';
            echo '<td>' . htmlspecialchars($row['traspasos']) . '</td>';
            echo '<td>' . htmlspecialchars($row['lista_sucursales']) . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '<div class="no-results">No se encontraron resultados para los parámetros proporcionados.</div>';
    }

} catch (Exception $e) {
    echo '<div class="error-message">Error al recuperar datos: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>
