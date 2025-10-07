<?php
// Archivo: rh/asistencias.php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Asistencias</title>
    <link rel="stylesheet" href="../estilos/dashboardRH.css?v=1.3"/>
    <link rel="stylesheet" href="../estilos/listaEmpleados.css?v=1.8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
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
            <h2>ENTRADAS Y SALIDAS DE EMPLEADOS</h2>
            <img src="../imagenes/user.png" class="user-pic">
        </div>
        
        <div class="content-body">
            <a href="../dashboard.php" class="btn-regresar">
                <i class="fas fa-arrow-left"></i> REGRESAR AL MENÚ
            </a>

            <div class="table-wrapper">
                <h3>REGISTRO DE ASISTENCIAS</h3>
                <table>
                    <thead>
                        <tr>
                            <th>NOMBRE(S)</th>
                            <th>APELLIDOS</th>
                            <th>USUARIO</th>
                            <th>ENTRADA</th>
                            <th>SALIDA</th>
                            <th>ÁREA</th>
                            <th>OBSERVACIÓN</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_asistencias">
                        <tr><td colspan="7">Cargando...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="../js2/asistencias.js?v=1.2"></script>
</body>
</html>