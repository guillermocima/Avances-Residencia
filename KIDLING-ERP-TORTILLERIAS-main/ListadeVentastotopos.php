<?php
include("clases/Conexion.php");
include("files/iniciarSesion.php");
include("clases/Usuario.php");
include("clases/Funciones.php");

$funciones = new Funciones();

if(isset($_COOKIE["cDash"])){

    $hash = $_COOKIE["cDash"];

    $idUsuario = $funciones->obtenerIdUsuario($hash);

    if($idUsuario !=0 ){
        $usuario = new Usuario($idUsuario);
    }
    else{
        Header ("Location: login.html");
        exit;
    }
}
if(isset($_SESSION['usuario_id'])){
    $idUsuario = $_SESSION['usuario_id'];
    $usuario = new Usuario($idUsuario);
}

//2222

$db = new Conexion();
// $menu = $db->query("SELECT * FROM course");



// $menuInfo = $menu->fetch();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTARIO</title>

    <link rel="stylesheet" href="./estilos/buscarInventario2.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
</head>


<body>

    <div class="sidebar">
        <div class="fondologo"> <img class="logo" src="./imagenes/logo.jpg"></div>
        <ul class="menu">
            <li>
                <a href="././index.php">
                    <i class="fas fa-home icon"></i>
                    <span>INICIO</span>
                </a>
            </li>
            <li>
                <a href="././perfil.html">
                    <i class="fas fa-user"></i>
                    <span>PERFIL</span>
                </a>
            </li>
            <li>
                <a href="././mensajes.html">
                    <i class="fas fa-envelope"></i>
                    <span>MENSAJES</span>
                </a>
            </li>

        </ul>
    </div>
    <!--Fin de menu-->

    <!--Header-->
    <div class="main--content">
        <div class="header--wrapper">
            <h2>VENTA DE TOTOPOS</h2>
            <img src="./imagenes/user.png">
        </div>



        <!--Fin header-->
        <div class="cuadro-contenedor">
            <div class="row">
                <div class="regresarButton">
                    <!-- <button class="regresarBTN" onclick="irInventario()">REGRESAR</button> -->
                    <button class="regresar" onclick="location.href='ventaTotopos.php';">REGRESAR</button>

                </div>
            </div>
            <!-- Contenedor que agrupa el formulario y la lista de ventas -->
            <div class="content-wrapper">
                <!-- Formulario -->
                <div class="card" id="harina" onmouseover="bloquearInputsGas()" onmouseout="activarInputsGas()">
                    <div class="header-content">
                        <div class="image-and-text">
                            <div class="card-image">
                                <!-- <img src="./imagenes/bolsasUsadas.png" alt="Imagen de la tarjeta"> -->
                            </div>
                            <div class="text">
                                <h3>VENTAS DEL DÍA</h3>

                            </div>


                        </div>

                    </div>

                    <!-- <hr class="separator"> -->

                    <?php

date_default_timezone_set('America/Cancun');

// Obtener la fecha actual en formato YYYY-MM-DD
$fechaActual = date('Y-m-d');

// Consulta a la base de datos para obtener registros del día actual
$sql = "SELECT * FROM ventastotopos_dia WHERE fecha = :fechaActual";
$stmt = $db->prepare($sql);
$stmt->bindParam(':fechaActual', $fechaActual);
$stmt->execute();
$result = $stmt->fetchAll();
?>
   <div>
        <div class="row">
            <table>
                <thead>
                    <tr>
                        <th>FECHA</th>
                        <th>BOLSAS</th>
                        <th>PRECIO</th>
                        <th>EDITAR</th>
                        <th>ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($result as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($row['bolsas']); ?></td>
                            <td><?php echo htmlspecialchars($row['precio']); ?></td>
                            <td><a href="editar.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="icon-edit"><i class="fas fa-edit"></i></a></td>
                            <td><a href="eliminar.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="icon-delete"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
                </div>


            </div>





            <!-- Fin de la Lista de Ventas -->
        </div>
    </div>






    </div>

    </div>
    <!--main content-->

    <!-- Aquí se carga el contenido del modal -->
    <!-- <div id="modalContainer"></div> -->

    <!--Librerias para los iconos-->
    <!-- <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./js2/inventario.js"></script> -->

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <!-- <script>
        $(document).ready(function () {
            $("#fecha_h").datepicker();
        });
    </script> -->






    <!-- <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./js2/inventario.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> -->

    <!-- <script src="scripts/ajaxU.js"></script>
    <script src="scripts/validacionU.js"></script>
    <script src="alertifyjs/alertify.min.js"></script> -->

</body>

</html>