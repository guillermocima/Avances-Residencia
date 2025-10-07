<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>INVENTARIO HARINA</title>
        <link rel="stylesheet" href="./estilos/buscarInventario.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    </head>   

    <body>
            
    <div class="sidebar">
        <div class="fondologo"> <img class="logo" src="./imagenes/logo.jpg"></div>
        <ul class="menu">
            <li>
                <a onclick="location.href='inventario.php';">
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

    <!--Header-->
    <div class="main--content">
        <div class="header--wrapper">
            <h2>GESTIÓN DE INVENTARIO</h2>
            <img src="./imagenes/user.png">
        </div>
        <div class="row">
            <div class="regresarButton">
                <button class="regresarBTN" onclick="irInventario()">REGRESAR</button>
            </div>
        </div>
        <div class="inventory-container">
    <div class="card">
        <div class="card-content">
            <div class="header-content">
                <span class="barraB">BUSQUEDA INVENTARIO HARINA</span>
            </div>
            <div class="row">
                <span class="textContent centrarInputs">FECHA: </span>
                <input type="date" id="datepicker">
            </div>
            <div class="row">
                <span class="textContent centrarInputs">CÓDIGO:</span>
                <select id="lista_categoria">
                    <option value="">SELECCIONE UNA OPCIÓN</option>
                    <option value="harTURN1">harTURN1</option>
                    <option value="harTURN2">harTURN2</option>
                </select>
            </div>
            <div class="row">
                <button class="buscarBTN" id="eliminarBusqueda">ELIMINAR BÚSQUEDA</button>
                <button class="buscarBTN" id="registrarHarina">BUSCAR</button>
                <button class="buscarBTN" id="mostrarTodo">MOSTRAR TODO</button>
            </div>
        </div>
    </div>
</div>
<div id="result-container">
    <!-- Aquí se cargará el contenido generado por PHP -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const loadResults = (fecha = '', codigo = '') => {
            fetch(`fetchInventarioHarina.php?fecha=${encodeURIComponent(fecha)}&codigo=${encodeURIComponent(codigo)}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('result-container').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        };

        document.getElementById('registrarHarina').addEventListener('click', () => {
            const fecha = document.getElementById('datepicker').value;
            const codigo = document.getElementById('lista_categoria').value;
            loadResults(fecha, codigo);
        });

        document.getElementById('mostrarTodo').addEventListener('click', () => {
            loadResults();
        });

        document.getElementById('eliminarBusqueda').addEventListener('click', () => {
            document.getElementById('datepicker').value = '';
            document.getElementById('lista_categoria').value = '';
            loadResults();
        });
    });
</script>

    

    <!--Librerias para los iconos-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="./js2/inventario.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    </body>
</html>
