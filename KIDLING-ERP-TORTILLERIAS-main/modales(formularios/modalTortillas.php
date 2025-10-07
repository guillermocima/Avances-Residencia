

<?php
include("../clases/Conexion.php");
include("../files/iniciarSesion.php");
include("../clases/Usuario.php");
include("../clases/Funciones.php");


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
<!-- Modal correspondinete a Tortillas entregadas a distribución-->
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Entregas a distribución</title>  
  <!-- <link rel="stylesheet" href="./estilos/inventory.css" /> -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <!--Alertas-->
  <link href="alertifyjs/css/alertify.css" rel="stylesheet">

  <style>
    /* Estilos para el modal */
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

    .modal {
      display: none;
      /* Oculta el modal por defecto */
      position: fixed;
      /* Permite que el modal sea posicionado en relación al viewport */
      z-index: 1;
      /* Asegura que el modal esté por encima de otros elementos */
      left: 0;
      top: 0;
      width: 100%;
      /* Toma todo el ancho de la pantalla */
      height: 100%;
      /* Toma toda la altura de la pantalla */
      overflow: auto;
      /* Añade desplazamiento si el contenido del modal es demasiado grande */
      background-color: rgba(57, 4, 93, 0.4);
      /* Color de fondo semi-transparente */
    }

    /* Estilos para el contenido del modal */
    .modal-content {
      background-color: #252525;
      color: white;
      font-family: 'Roboto', sans-serif;
      margin: 5% auto;
      /* Centra vertical y horizontalmente */
      padding: 20px;
      width: 600px;
      /* Ancho del contenido del modal */
      height: 545px;
      border-radius: 20px;
    }

    .linea {
      border-top: 1px solid white;
      /* Estilo del borde */
      margin: 10px;
    }

    .rowModal {
      display: flex;
      margin-top: 15px;
      width: 100%;
      align-items: center;
    }

    .rowModal span {
      font-size: 17px;
      text-align: right;
      margin-left: 10px;
    }

    .rowModal input {
      width: 245px;
      height: 25px;
      font-size: 17px;
      border: none;
      border-radius: 5px;
      /* Bordes redondeados */
    }

    .botonModal {
      background-color: #1D6ACA;
      border: none;
      height: 35px;
      width: 100px;
      color: white;
      margin-top: 20px;
      cursor: pointer;
      border-radius: 10px;
      font-size: 14px;

    }


    /* Estilos para el botón de cierre */
    .closeModal {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .closeModal:hover {
      color: red;
    }

    .save:hover {
      background-color: rgb(82, 130, 35);
    }

    #lista_repartidores {
      background-color: #fff;
      color: #252525;
      border-radius: 5px;
      width: 245px;
      font-size: 17px;
    }

    #lista_sucursales {
      background-color: #fff;
      color: #252525;
      border-radius: 5px;
      width: 245px;
      font-size: 17px;
    }

    .col3 {
      width: 42%;
      margin-right: 10px;
    }

    .footerModal {
      display: flex;
      justify-content: center;
      justify-items: center;
      align-items: center;
    }
  </style>
</head>

<body>
  <!-- <button onclick="showModal()">Abrir Modal</button>

<script>
  function showModal() {
    modal.style.display = "block";
  }
</script> -->


<div id="myModal" class="modal">
  <div class="modal-content">
    <!-- Botón de cierre -->
    <span class="closeModal">&times;</span>
    <h2 style="text-align: center;">ENTREGAS A DISTRIBUCIÓN</h2>

    <div class="linea"></div>

    <form>
      <div class="rowModal">
        <span class="col3">FECHA:</span>
        <input class="col3" type="date" id="inputFechaEntrega" name="fecha_entrega">
      </div>

      <?php
      // Consulta para obtener los repartidores
      $sql = "SELECT * FROM dash_usuarios WHERE rol = 'repartidor'";
      $result = $db->query($sql);
      ?>

      <div class="rowModal">
        <span class="col3">REPARTIDOR:</span>
        <select id="lista_repartidores" name="repartidor">
          <option value="">SELECCIONAR</option>
          <?php foreach($result as $repartidor): ?>
          <option value="<?php echo $repartidor['id']; ?>">
              <?php echo $repartidor["nombre"]; ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>

      <?php
      // Consulta para obtener las sucursales
      $sql = "SELECT * FROM sucursales";
      $result = $db->query($sql);
      ?>
      <div class="rowModal">
        <span class="col3">SUCURSAL:</span>
        <select id="lista_sucursales" name="sucursal">
          <option value="">SELECCIONAR</option>
          <?php foreach($result as $sucursal): ?>
          <option value="<?php echo $sucursal['id']; ?>">
              <?php echo $sucursal["nombre"]; ?>
          </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="rowModal">
        <span class="col3">SUBTOTAL FRÍAS:</span>
        <input type="number" step="0.01" min="0" id="subtotal_frias" name="subtotal_frias" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
        <span>KG</span>
      </div>

      <div class="rowModal">
        <span class="col3">CANTIDAD QUE REPORTÓ:</span>
        <input type="number" step="0.01" min="0" id="cantidad_reportada_frias" name="cantidad_reportada_frias" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
        <span>KG</span>
      </div>

      <div class="rowModal">
        <span class="col3">DIFERENCIA FRÍAS:</span>
        <input type="number" step="0.01" id="diferencia_frias" name="diferencia_frias" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
        <span>KG</span>
      </div>

      <div class="rowModal">
        <span class="col3">TORTILLA CALIENTE SALIDAS:</span>
        <input type="number" step="0.01" min="0" id="tortilla_caliente_salidas" name="tortilla_caliente_salidas" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
        <span>KG</span>
      </div>

      <div class="rowModal">
        <span class="col3">DEVOLUCIÓN CALIENTE:</span>
        <input type="number" step="0.01" min="0" id="devolucion_caliente" name="devolucion_caliente" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
        <span>KG</span>
      </div>

      <div class="rowModal">
        <span class="col3">CANTIDAD REPORTADA CALIENTE:</span>
        <input type="number" step="0.01" min="0" id="cantidad_reportada_caliente" name="cantidad_reportada_caliente" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
        <span>KG</span>
      </div>

      <div class="rowModal">
        <span class="col3">DIFERENCIA CALIENTE:</span>
        <input type="number" step="0.01" id="diferencia_caliente" name="diferencia_caliente" oninput="this.value = this.value.replace(/[^0-9.]/g, '');">
        <span>KG</span>
      </div>

      <div class="footerModal">
        <button type="button" onclick="guardarEntrega()" class="botonModal save" id="guardarBtn">GUARDAR</button>
      </div>
    </form>
    <div id="guardando4"></div>
                    <br>
                    <br>
                    <hr>

  </div>
</div>

<script>
 
</script>


  <script>
    // JavaScript para cerrar el modal al hacer clic en la "X"
    var modal = document.getElementById("myModal");
    var closeBtn = document.getElementsByClassName("closeModal")[0];

    closeBtn.onclick = function () {
      modal.style.display = "none";
    }

    // Cierra el modal al hacer clic fuera del contenido del modal
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }



  </script>

<script src="../cripts/ajaxU.js"></script>
    <script src="../scripts/validacionU.js" defer></script>
    <script src="../alertifyjs/alertify.min.js"></script>
</body>

</html>