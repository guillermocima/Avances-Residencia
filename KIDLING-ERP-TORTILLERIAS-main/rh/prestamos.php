<?php
// Archivo: rh/prestamos.php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: ../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Préstamos</title>
    
    <link rel="stylesheet" href="../estilos/dashboardRH.css?v=1.3"/>
    <link rel="stylesheet" href="../estilos/prestamos.css?v=1.2">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <script src="../alertifyjs/alertify.min.js"></script>
    <link rel="stylesheet" href="../alertifyjs/css/alertify.min.css" />
    <link rel="stylesheet" href="../alertifyjs/css/themes/default.min.css" />
</head>
<body>
    <div class="sidebar">
        <div class="fondologo"> <img class="logo" src="../imagenes/logo.jpg"></div>
        <ul class="menu">
            <li><a href="../dashboard.php"><i class="fas fa-home icon"></i><span>INICIO</span></a></li>
            <li><a href="#"><i class="fas fa-user"></i><span>PERFIL</span></a></li>
            <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i><span>SALIR</span></a></li>
        </ul>
    </div>

    <div class="main--content">
        <div class="header--wrapper">
            <h2>GESTIÓN DE PRÉSTAMOS</h2>
            <img src="../imagenes/user.png" class="user-pic">
        </div>
        
        <div class="content-body">
            <a href="../dashboard.php" class="btn-regresar">
                <i class="fas fa-arrow-left"></i> REGRESAR AL MENÚ
            </a>

            <div class="form-wrapper">
                <div class="form-header"><h3>REGISTRAR NUEVO PRÉSTAMO</h3></div>
                <form id="prestamoForm">
                    <div class="form-group"><label for="empleado">EMPLEADO:</label><select id="empleado" name="usuario_id" required><option value="">Cargando empleados...</option></select></div>
                    <div class="form-group"><label for="fecha">FECHA:</label><input type="date" id="fecha" name="fecha_solicitud" required></div>
                    <div class="form-group"><label for="monto_total">MONTO DEL PRÉSTAMO ($):</label><input type="number" id="monto_total" name="monto_total" step="0.01" required></div>
                    <div class="form-group">
                        <label for="numero_quincenas">A PAGAR EN (QUINCENAS):</label>
                        <select id="numero_quincenas" name="numero_quincenas" required>
                            <option value="1">1 Quincena</option>
                            <option value="2">2 Quincenas</option>
                            <option value="3">3 Quincenas</option>
                            <option value="4">4 Quincenas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="monto_descuento_quincenal">DESCUENTO QUINCENAL ($):</label>
                        <input type="text" id="monto_descuento_quincenal" name="monto_descuento_quincenal" readonly style="background-color: #e9ecef; color: #495057;">
                    </div>
                    <div class="button-group"><button type="submit" class="btn-submit">GUARDAR PRÉSTAMO</button></div>
                </form>
            </div>

            <div class="table-wrapper">
                <div class="table-header"><h3>HISTORIAL DE PRÉSTAMOS ACTIVOS</h3></div>
                <table>
                    <thead>
                        <tr>
                            <th>EMPLEADO</th>
                            <th>ÁREA</th>
                            <th>FECHA SOLICITUD</th>
                            <th>MONTO TOTAL</th>
                            <th>DESC. QUINCENAL</th>
                            <th>MONTO RESTANTE</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_prestamos">
                         </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../js2/prestamos.js?v=1.2"></script>
</body>
</html>