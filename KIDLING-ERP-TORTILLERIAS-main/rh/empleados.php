<?php
// Archivo: rh/empleados.php (Con Layout Final)
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
    <title>Gestión de Empleados</title>
    
    <link rel="stylesheet" href="../estilos/dashboardRH.css?v=1.3"/>
    
    <link rel="stylesheet" href="../estilos/listaEmpleados.css?v=1.8">
    
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
            <h2>GESTIÓN DE EMPLEADOS</h2>
            <img src="../imagenes/user.png" class="user-pic">
        </div>
        
        <div class="content-body">
            <a href="../dashboard.php" class="btn-regresar">
                <i class="fas fa-arrow-left"></i> REGRESAR AL MENÚ
            </a>

            <div class="empleados-container">
                <div class="card">
                    <div class="card-content">
                        <div class="header-content"><span id="form_title" class="barraB">REGISTRAR NUEVO EMPLEADO</span></div>
                        <form id="empleadoForm">
                            <input type="hidden" id="usuario_id" name="usuario_id">
                            <div class="form-row"><label>NOMBRE:</label><input type="text" id="nombre" name="nombre" required></div>
                            <div class="form-row"><label>APELLIDOS:</label><input type="text" id="apellidos" name="apellidos" required></div>
                            <div class="form-row"><label>PUESTO:</label><input type="text" id="puesto" name="puesto" required></div>
                            <div class="form-row"><label>USUARIO (Email):</label><input type="email" id="email" name="email" required></div>
                            <div class="form-row">
                                <label>ROL:</label>
                                <select id="rol" name="rol" required>
                                    <option value="empleado" selected>Empleado</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <div class="form-row"><label>CONTRASEÑA:</label><input type="password" id="password" name="password" placeholder="ingresa una contraseña"></div>
                            <div class="button-group">
                                <button type="submit" id="btn_registrar" class="btn-submit">REGISTRAR</button>
                                <button type="submit" id="btn_actualizar" class="btn-submit" style="display:none;">ACTUALIZAR</button>
                                <button type="button" id="btn_cancelar" class="btn-cancel" style="display:none;">CANCELAR</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-wrapper">
                <h3>LISTA DE EMPLEADOS</h3>
                <table>
                    <thead>
                        <tr>
                            <th>NOMBRE(S)</th>
                            <th>APELLIDOS</th>
                            <th>PUESTO</th>
                            <th>USUARIO</th>
                            <th>ROL</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_empleados"></tbody>
                </table>
            </div>
            </div>
    </div>
    <script src="../js2/empleados.js?v=1.6"></script>
</body>
</html>