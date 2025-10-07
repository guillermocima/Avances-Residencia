<?php
// Archivo: dashboard.php (en la raíz del proyecto)

session_start();
// GUARDIÁN: Si no hay sesión, no se puede ver esta página.
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html?error=" . urlencode("Por favor, inicie sesión."));
    exit();
}

// Obtenemos el rol de la sesión para usarlo más adelante.
$rol = $_SESSION['usuario_rol'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>RECURSOS HUMANOS - Dashboard</title>
        <link rel="stylesheet" href="estilos/dashboardRH.css"/>
        <link rel="stylesheet" href="estilos/dashboard.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    </head>   
    <body>
        <div class="sidebar">
            <div class="fondologo"> <img class="logo" src="imagenes/logo.jpg"></div>
            <ul class="menu">
                <li class="active">
                    <a href="dashboard.php"><i class="fas fa-home icon"></i><span>INICIO</span></a>
                </li>
                <li>
                    <a href="perfil.php"><i class="fas fa-user"></i><span>PERFIL</span></a>
                </li>
                 <li>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>SALIR</span></a>
                </li>
            </ul>
        </div>
<div class="main--content">
    <div class="header--wrapper">
        <h2>RECURSOS HUMANOS</h2>
        <img src="imagenes/user.png" class="user-pic">
    </div>

    <div class="card-container">
        
        <?php if ($rol === 'admin'): ?>
        <div class="card">
            <div class="card-content">
                <div class="image-and-text">
                    <div class="card-image"><img src="imagenes/rh_lista_empleados.png"></div>
                    <div class="text"><h3>LISTA DE EMPLEADOS</h3></div>
                </div>
                <div class="card-actions">
                    <button onclick="location.href='rh/empleados.php'">IR</button>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="card">
           <div class="card-content">
                <div class="image-and-text">
                    <div class="card-image"><img src="imagenes/rh_entradas_salidas.png"></div>
                    <div class="text"><h3>ENTRADAS Y SALIDAS</h3></div>
                </div>
                <div class="card-actions">
                    <button onclick="location.href='rh/asistencias.php'">IR</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="image-and-text">
                    <div class="card-image"><img src="imagenes/prestamos.png"></div>
                    <div class="text"><h3>PRÉSTAMOS</h3></div>
                </div>
                <div class="card-actions">
                    <button onclick="location.href='rh/prestamos.php'">IR</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="image-and-text">
                    <div class="card-image"><img src="imagenes/rh_nominas.png"></div>
                    <div class="text"><h3>NÓMINAS</h3></div>
                </div>
                <div class="card-actions">
                    <button onclick="location.href='rh/nominas.php'">IR</button>
                </div>
            </div>
        </div>

    </div> 
</div>
        </div>
    </body>
</html>