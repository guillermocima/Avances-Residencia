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
    <link rel="stylesheet" href="./estilos/inventory.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <!--Alertas-->
    <link href="alertifyjs/css/alertify.css" rel="stylesheet">

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
    <style>
        .card {
            background: #48247D;
        }

        .input {
            background: #fff;
            color: #000;
            /* Texto negro dentro de los inputs */


        }

        .card .separator {
            border: 0;
            border-top: 2px solid #fff;
            /* Línea blanca */
            margin: 0;
            padding: 0;
            width: 100%;
        }
    </style>
    <!--Header-->
    <div class="main--content">
        <div class="header--wrapper">
            <h2>VENTA DE TOTOPOS</h2>
            <img src="./imagenes/user.png">
        </div>



        <!--Fin header-->
        <div class="inventory-container">
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
                                <h3>VENTA DE TOTOPOS</h3>

                            </div>


                        </div>

                    </div>
                    <hr class="separator">

                    <form>
                        <!-- Formulario con inputs -->
                        <div class="row">
                            <span class="col3">TOTOPO ANTERIOR:</span>
                            <input class="input" type="number" id="totopo_anterior" /> KG
                        </div>
                        <div class="row">
                            <span class="col3">PRODUCCIÓN:</span>
                            <input class="input" type="number" id="produccion" /> KG
                        </div>
                        <div class="row">
                            <span class="col3">VENTA DE TOTOPOS:</span>
                            <input class="input" type="number" id="venta_totopos" value="" /> $MXN
                        </div>
                        <div class="row">
                            <span class="col3">SALIDA DE TOTOPOS:</span>
                            <input class="input" type="number" id="salida_totopos" value="" /> KG
                        </div>
                        <div class="row">
                            <span class="col3">EXISTENCIA REAL:</span>
                            <input class="input" type="number" id="existencia_real" value="" /> KG
                        </div>
                        <?php                     
// Consulta para obtener las sucursales
$sql = "SELECT * FROM sucursales";
$result = $db->query($sql);
?>

                        <div class="row">
                            <span class="col3">SUCURSAL:<a class="requerido">*</a></span>
                            <select id="lista_sucursales" name="lista_sucursales">
                                <option>SELECCIONAR</option>
                                <?php foreach($result as $sucursal): ?>
                                <option>
                                    <?php echo $sucursal["nombre"]; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="row">
                            <span class="col3">FECHA:</span>
                            <input id="date" name="date" type="date">
                        </div>
                        <div class="form-button-container">
                            <button class="btn3" onclick="validarVentaTotopos()">GUARDAR</button>
                        </div>
                    </form>
                    <div id="registrandoTotopos"></div>
                    <br>
                    <br>
                    <hr>

                    <script>
                        document.querySelectorAll('input[type="number"]').forEach(function (input) {
                            input.addEventListener('input', function () {
                                this.value = this.value.replace(/[^0-9.]/g, '');
                            });
                        });
                    </script>


                </div>

                <style>
                    /* Estilo para centrar el botón dentro del contenedor */
                    .form-button-container {
                        display: flex;
                        justify-content: center;
                            /* width: 50px; */
                        
                        /* Centra el botón horizontalmente */
                    }

                    /* Estilos para el botón */
                    .btn3 {
                        background-color: #3464dd;
                        /* Cambia el color de fondo del botón */
                        color: white;
                        /* Cambia el color del texto del botón */
                        border: none;
                        /* Elimina el borde del botón */
                        padding: 10px 20px;
                        /* Ajusta el relleno del botón */
                        text-align: center;
                        /* Centra el texto dentro del botón */
                        text-decoration: none;
                        /* Elimina el subrayado del texto (si es necesario) */
                        display: inline-block;
                        /* Asegura que el botón se muestre en línea */
                        font-size: 16px;
                        /* Ajusta el tamaño del texto */
                        margin: 20px 2px;
                        /* Agrega margen opcional alrededor del botón */
                        cursor: pointer;
                        /* Cambia el cursor a una mano al pasar sobre el botón */
                        border-radius: 4px;
                        /* Redondea las esquinas del botón */
                    }
                </style>
                <!-- Fin del formulario -->

                <style>
                    /* .inventory-container {
                        display: flex;
                        justify-content: space-between;
                        align-items: flex-start;
                        
                    } */

                    .content-wrapper {
                        display: flex;
                        width: 80%;
                        /* Asegura que el contenedor ocupe todo el ancho disponible */

                        box-sizing: border-box;

                    }

                    .ventasMenu {
                        width: 38%;
                        /* Ajusta el ancho de la "Lista de Ventas" si es necesario */
                        margin-left: 10px;
                        /* Reduce el espacio entre el formulario y la lista */
                        margin-top: 40px;
                        /* Ajusta el espacio arriba de la lista de ventas para bajarla más */
                        height: 220px;
                        /* Ajusta la altura de la lista de ventas */
                        box-sizing: border-box;
                        padding: 20px;
                        /* Ajusta el espacio interno */
                        overflow: hidden;
                        /* Asegura que no aparezca scroll */
                        background: #48247D;
                        border: 2px solid #333;
                        /* Agrega un borde delgado alrededor del cuadro */
                        border-radius: 15px;
                        /* Redondea las esquinas del borde */
                    }



                    .ventasMenu .card2 {

                        margin-bottom: 5px;
                        /* Reduce el espacio entre tarjetas */
                        font-size: 0.9em;
                        /* Ajusta el tamaño de fuente para mayor compacidad */
                    }

                    .btn2 {
                        background-color: #666a6f;
                        /* Cambia el color del botón */
                        color: white;
                        /* Cambia el color del texto del botón */
                        width: 60px;
                    }
                </style>




                <!-- Lista de Ventas -->
                <div class="ventasMenu">

                    <div class="card2">
                        <div class="card-content">
                            <div class="image-and-text">
                                <div class="card-image">
                                    <img src="./imagenes/listasVenta.png" alt="Imagen de la tarjeta">
                                </div>
                                <div class="text">
                                    <h3>LISTA DE VENTAS</h3>
                                </div>
                            </div>
                            <div class="card-actions">
                                <button class="btn2" onclick="location.href='ListadeVentastotopos.php';">IR</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin de la Lista de Ventas -->
            </div>
        </div>


        <form>
            <div class="row" style="display: flex; align-items: right;">
                <!-- <label for="tortillas-frias" style="color: black; margin-right: 10px;">TORTILLAS FRÍAS DEL DÍA ANTERIOR:</label> -->
                <span class="col3" style="color: black;">TORTILLAS FRÍAS DEL DÍA ANTERIOR:</span>

                <input class="input" type="number" id="tortillas-frias" name="tortillas_frias" value="" style="width: 50px; margin-right: 5px;" />
                <span style="color: black; margin-right: 10px;">kG</span>
                <input type="hidden" id="usuario_id" value="<?php echo htmlspecialchars($_SESSION['usuario_id']); ?>" />
                <?php
                // Configura la zona horaria correcta para tu ubicación
                date_default_timezone_set('America/Cancun');
                // Obtiene la fecha actual
                $fecha_actual = date('Y-m-d');
                ?>
                <input type="hidden" id="fecha" value="<?php echo htmlspecialchars($fecha_actual); ?>" />
                <button type="button" onclick="cuadrarFrias()" class="btn" style="color: black;">CUADRAR FRIAS</button>
            </div>
        </form>
        <div id="guardando5"></div>
  
        <form id="formTortillasCalientes">
            <div class="row" style="display: flex; align-items: right;">
                <span class="col3" style="color: black;">TORTILLAS CALIENTES DEL TURNO:</span>
                <input class="input" type="number" id="tortillas_calientes" value="" style="width: 50px; margin-right: 5px;" />
                <span style="color: black; margin-right: 10px;">KG</span>
                <input type="hidden" id="usuario_id" value="<?php echo htmlspecialchars($_SESSION['usuario_id']); ?>" />
                <input type="hidden" id="fecha" value="<?php echo htmlspecialchars(date('Y-m-d')); ?>" />
                <button type="button" onclick="cuadrarCalientes()" class="btn" style="color: black;">ACTUALIZAR</button>
            </div>
        </form>

        <div id="registrandoCalientesdeturno"></div>


    </div>

    </div>
    <!--main content-->

    <!-- Aquí se carga el contenido del modal -->
    <div id="modalContainer"></div>

    <!--Librerias para los iconos-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./js2/inventario.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#fecha_h").datepicker();
        });
    </script>






    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/custom.js"></script>

    <script src="scripts/ajaxU.js"></script>
    <script src="scripts/validacionU.js"></script>
    <script src="alertifyjs/alertify.min.js"></script>

</body>

</html>