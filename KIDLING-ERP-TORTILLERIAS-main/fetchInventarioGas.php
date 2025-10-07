<?php
include("clases/Conexion.php");

$db = new Conexion();

// Recuperar parámetros de búsqueda (si los hay)
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$turno = isset($_GET['turno']) ? $_GET['turno'] : '';

// Construir la consulta SQL
$sql = "SELECT * FROM inventario_gas WHERE 1=1";
$params = [];

if (!empty($fecha)) {
    $sql .= " AND fecha = :fecha";
    $params[':fecha'] = $fecha;
}

if (!empty($turno)) {
    $sql .= " AND turno = :turno";
    $params[':turno'] = $turno;
}

try {
    $stmt = $db->prepare($sql);
    
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Incluir el HTML directamente para el renderizado
    // echo '<div class="inventory-container">';
    echo '<div class="row">';
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>CÓDIGO</th>';
    echo '<th>FECHA</th>';
    echo '<th>INICIAL</th>';
    echo '<th>ENTRADAS</th>';
    echo '<th>SALIDAS</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($result as $row) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row['turno']) . '</td>';
        echo '<td>' . htmlspecialchars($row['fecha']) . '</td>';
        echo '<td>' . htmlspecialchars($row['inicial']) . '</td>';
        echo '<td>' . htmlspecialchars($row['entradas']) . '</td>';
        echo '<td>' . htmlspecialchars($row['salidas']) . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';

} catch (Exception $e) {
    echo '<div class="error-message">Error al recuperar datos: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>