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

    <!--Header-->
    <div class="main--content">
        <div class="header--wrapper">
            <h2>GESTIÓN DE INVENTARIO</h2>
            <img src="./imagenes/user.png">
        </div>
        <!--Fin header-->

        <!--Inicio de inventario-->
        <div class="inventory-container">
            <!--HARINA-->
            <div class="card" id="harina" onmouseover="bloquearInputsGas()" onmouseout="activarInputsGas()">
                <div class="card-content">
                    <div class="header-content">
                        <div class="image-and-text">
                            <div class="card-image">
                                <img src="./imagenes/bolsasUsadas.png" alt="Imagen de la tarjeta">
                            </div>
                            <div class="text">
                                <h3>HARINA</h3>
                            </div>
                        </div>
                    </div>


                    <style>
                        .styled-select {
                            border: 1px solid #ccc;
                            padding: 5px;
                        }

                        .required {
                            color: red;
                        }

                        .error {
                            border-color: red;
                        }

                        .error-message {
                            color: red;
                            display: none;
                        }
                    </style>
                    <form>
                        <div class="row">
                            <span class="col3">TURNO:<a class="required">*</a></span>
                            <select class="col3 styled-select" id="opcion_seleccionada" name="opcion_seleccionada"
                                onchange="validateSelection()">
                                <option value="">Seleccione una opción</option>
                                <option value="harTURN1">harTURN1</option>
                                <option value="harTURN2">harTURN2</option>
                            </select>
                            <div id="error-message" class="error-message">Por favor, seleccione una opción.</div>
                        </div>
                        <div class="row">
                            <span class="col3">FECHA:<a class="requerido">*</a></span>
                            <input id="fecha_h" name="fecha_h" type="date">
                        </div>
                        <div class="row">
                            <span class="col3">INICIAL:<a class="requerido">*</a></span>
                            <input id="inicial" name="inicial" type="number" oninput="validateNumber(this)">
                        </div>
                        <div class="row">
                            <span class="col3">ENTRADAS:<a class="requerido">*</a></span>
                            <input id="entradas" name="entradas" type="number" oninput="validateNumber(this)">
                        </div>
                        <div class="row">
                            <span class="col3">SALIDAS:<a class="requerido">*</a></span>
                            <input id="salidas" name="salidas" type="number" oninput="validateNumber(this)">
                        </div>
                        <div class="row">
                            <span class="col3">TRASPASOS:</span>
                            <input id="traspasos" name="traspasos" type="number" oninput="validateNumber(this)">
                        </div>

                        <script>
                            function validateNumber(input) {
                                // Remove any non-numeric characters from the input value
                                input.value = input.value.replace(/[^0-9]/g, '');
                            }
                        </script>

                        <?php                     
// Consulta para obtener las sucursales
$sql = "SELECT * FROM sucursales";
$result = $db->query($sql);
?>
                        <div class="row">
                            <span class="col3">SUCURSAL DE TRASPASO:<a class="requerido">*</a></span>
                            <select id="lista_sucursales" name="lista_sucursales">
                                <option>SELECCIONAR</option>
                                <?php foreach($result as $sucursal): ?>
                                <option>
                                    <?php echo $sucursal["nombre"]; ?>
                                </option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="footerModal">
                            <!-- <input type="button" value="REGISTRAR" onclick="validarInventarioHarina()" class="btn btn-primary btn-user btn-block"> -->

                            <button type="button" onclick="validarInventarioHarina()">REGISTRAR</button>
                            <button type="button" onclick="location.href='buscarHarina.php';">VER INVENTARIO</button>
                        </div>
                    </form>
                    <div id="registrando2"></div>
                    <br>
                    <br>
                    <hr>
                </div>
            </div>

            <!--GAS-->
            <div class="card" id="gas" onmouseover="bloquearInputsHarina()" onmouseout="activarInputsHarina()">
                <div class="card-content">
                    <div class="header-content">
                        <div class="image-and-text">
                            <div class="card-image">
                                <img src="./imagenes/gas.png" alt="Imagen de la tarjeta">
                            </div>
                            <div class="text">
                                <h3>GAS</h3>
                            </div>
                        </div>
                    </div>

                    <form>
                        <div class="row">
                            <span class="col3">TURNO:<a class="required">*</a></span>
                            <select class="col3 styled-select" id="opcion_seleccionada_g" name="opcion_seleccionada_g"
                                onchange="validateSelection()">
                                <option value="">Seleccione una opción</option>
                                <option value="gasTURN1">gasTURN1</option>
                                <option value="gasTURN2">gasTURN2</option>
                            </select>
                            <div id="error-message_g" class="error-message">Por favor, seleccione una opción.</div>
                        </div>
                        <div class="row">
                            <span class="col3">FECHA:<a class="requerido">*</a></span>
                            <input id="fecha_g" name="fecha_g" type="date">
                        </div>
                        <div class="row">
                            <span class="col3">INICIAL:<a class="requerido">*</a></span>
                            <input id="inicial_g" name="inicial_g" type="number" oninput="validateNumber(this)">
                        </div>
                        <div class="row">
                            <span class="col3">ENTRADAS:<a class="requerido">*</a></span>
                            <input id="entradas_g" name="entradas_g" type="number" oninput="validateNumber(this)">
                        </div>
                        <div class="row">
                            <span class="col3">SALIDAS:<a class="requerido">*</a></span>
                            <input id="salidas_g" name="salidas_g" type="number" oninput="validateNumber(this)">
                        </div>

                        <div class="card-actions">
                            <button type="button" onclick="validarInventarioGas()">REGISTRAR</button>
                            <button type="button" onclick="irBuscarGas()">VER INVENTARIO</button>
                        </div>
                    </form>
                    <div id="registrandoGas3"></div>
                    <br>
                    <br>
                    <hr>

                    <script>
                        function validateNumber(input) {
                            // Remove any non-numeric characters from the input value
                            input.value = input.value.replace(/[^0-9]/g, '');
                        }
                    </script>




                </div>
            </div>

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