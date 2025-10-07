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

?>

<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>VENTAS</title>
        <link rel="stylesheet" href="./estilos/dashboard.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

          <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

        <link href="alertifyjs/css/alertify.css" rel="stylesheet"> -->

    </head>   
    <?php
      // Consulta para obtener las sucursales
      $sql = "SELECT * FROM sucursales";
      $result = $db->query($sql);
      ?>
    <body>
    <!--Menu plegable-->
        <div class="sidebar">
        <div class="fondologo"> <img class="logo" src="./imagenes/logo.jpg"></div>
            <ul class="menu">
                <li class="active">
                    <a href="./index.html">
                        <i class="fas fa-home icon"></i>
                        <span>INICIO</span>
                    </a>
                </li>
                <li>
                    <a href="./perfil.html">
                        <i class="fas fa-user"></i>
                    <span>PERFIL</span> 
                    </a>
                </li>
                <li>
                    <a href="./mensajes.html">
                        <i class="fas fa-envelope"></i>
                        <span>MENSAJES</span> 
                    </a>
                </li>
                
               
            </ul>
        </div>
    <!--Fin de menu-->

    <div class="main--content">
        <!--Header-->
        <div class="header--wrapper">
                <h2>VENTAS</h2>
            <a href="clases/cerrarSesion.php" class="btn-book btn btn-secondary btn-sm menu-absolute white-text">Cerrar sesión</a>

<style>
.white-text {
    color: white;
}
</style>

            <img src="./imagenes/user.png">
            
        </div>
        <!--Fin Header-->

        <!--Inicio de menu card-->
        <div class="card-container">

            <div class="ventasMenu">      
                <!--row-->
                <div class="row">
                    
                    <div class="card">

                        <div class="card-content">
                            
                            <div class="image-and-text">

                                <div class="card-image">

                                    <img src="./imagenes/ventasDia.png" alt="Imagen de la tarjeta">
                                </div>
                                <div class="text">
                                    <h3>VENTAS DEL DIA</h3>
                                </div>
                            </div>
                            <div class="card-actions">
                                <button onclick="openModalVentas()"><a>IR</a></button>
                            </div>
                        </div>
                    </div>
            
                    <div class="card">
                        <div class="card-content">
                            <div class="image-and-text">
                                <div class="card-image">
                                    <img src="./imagenes/tortillas.png" alt="Imagen de la tarjeta">
                                </div>
                                <div class="text">
                                    <h3>TORTILLAS ENTREGADAS A DISTRIBUCION</h3>
                                </div>
                            </div>
                            <div class="card-actions">
                                <button onclick="openModalTortillas()">IR</button>
                            </div>
         
                        </div>
                    </div>
            
                    <div class="card">
                        <div class="card-content">
                            <div class="image-and-text">
                                <div class="card-image">
                                    <img src="./imagenes/inventario.png" alt="Imagen de la tarjeta">
                                </div>
                                <div class="text">
                                    <h3>INVENTARIO</h3>
                                </div>
                            </div>
                            <div class="card-actions">
                                <button onclick="location.href='inventario.php';">IR</button>
                            </div>

                        </div>
                    </div>
                    
                </div> 
                <!--2 row-->
                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <div class="image-and-text">
                                <div class="card-image">
                                    <img src="./imagenes/corteCaja.png" alt="Imagen de la tarjeta">
                                </div>
                                <div class="text">
                                    <h3>CORTE DE CAJA</h3>
                                </div>
                            </div>
                            <div class="card-actions">
                                <button onclick="openModalCorte()">IR</button>
                            </div>
                        </div>
                    </div>
            
                    <div class="card">
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
                                <button onclick="irVentasDia()">IR</button>
                            </div>
                        </div>
                    </div> 

                    <div class="card">
                        <div class="card-content">
                            <div class="image-and-text">
                                <div class="card-image">
                                    <img src="./imagenes/gastos.png" alt="Imagen de la tarjeta">
                                </div>
                                <div class="text">
                                    <h3>GASTOS</h3>
                                </div>
                            </div>
                            <div class="card-actions">
                                <button onclick="openGastos()">IR</button>
                            </div>
                        </div>
                    </div>        
                </div> 
                <!--row-->

                <!--3 row-->
                <div class="row">
                    <div class="card">
                        <div class="card-content">
                            <div class="image-and-text">
                                <div class="card-image">
                                    <img src="./imagenes/prestamos.png" alt="Imagen de la tarjeta">
                                </div>
                                <div class="text">
                                    <h3>PRESTAMOS</h3>
                                </div>
                            </div>
                            <div class="card-actions">
                                <button onclick="">IR</button>
                            </div>
                        </div>
                    </div>
            
                    <div class="card">
                        <div class="card-content">
                            <div class="image-and-text">
                                <div class="card-image">
                                    <img src="./imagenes/traspasosT.png" alt="Imagen de la tarjeta">
                                </div>
                                <div class="text">
                                    <h3>TRASPASOS DE TORTILLAS</h3>
                                </div>
                            </div>
                            <div class="card-actions">
                                <button onclick="">IR</button>
                            </div>
                        </div>
                    </div> 

                    <div class="card">
                        <div class="card-content">
                            <div class="image-and-text">
                                <div class="card-image">
                                    <img src="./imagenes/totopos.png" alt="Imagen de la tarjeta">
                                </div>
                                <div class="text">
                                    <h3>VENTA DE TOTOPOS</h3>
                                </div>
                            </div>
                            <div class="card-actions">
                                <!-- <button onclick="location.href='ventaTotopos.php';">IR</button> -->
                                <button onclick="openVetatotopos()">IR</button>

                            </div>
                            
                        </div>
                    </div>        
                </div> 
                <!--row-->


            <!--Pie de pagina-->
                <div class="row2">
                    <div class="footer"> 
                        <span class="espacioInputs">TORTILLAS QUE QUEDARÓN DEL DÍA ANTERIOR:</span>
                        <input type="text" class="input-field">
                        <span>KG</span>
                        <button onclick="openModalFrias()">CUADRAR FRÍAS</button>
                    </div>
                </div>

                <div class="row">
                    <div class="footer"> 
                        <span class="espacioInputs">TORTILLAS CALIENTES DEL TURNO:</span>
                        <input type="text" class="input-field">
                        <span>KG</span>
                        <button onclick="openModalCalientes()">ACTUALIZAR</button>
                    </div>
                </div>

                <div class="row">
                    <div class="footer"> 
                        <span class="espacioInputs">TORTILLAS FRÍAS DEL DÍA:</span>
                        <input type="text" class="input-field">
                        <span>KG</span>
                        <button onclick="openModalFrias()">ACTUALIZAR</button>
                    </div>
                </div>
                    
            </div>      
        </div> 
        <!--Fin de menu card-->

        
    </div>
    <!--main content-->

    <!-- Aquí se carga el contenido del modal -->
    <div id="modalContainer"></div>
    
    
    <!--Librerias para los iconos-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="./js2/funciones.js"></script>





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
    <script src="scripts/validacionU.js" defer></script>
    <script src="alertifyjs/alertify.min.js"></script>
    </body>
</html>
