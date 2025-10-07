function irAlDashboard(){
    window.location.href = "././index.php";
}

function irBuscarHarina(){
    window.location.href = "buscarHarina.php";
}

function irBuscarGas(){
    window.location.href = "././buscarGas.php";
}

function irInventario(){
    window.location.href = "././inventario.php";
}

//Mas adelante se agrega esto
function bloquearInputsGas() {
    const inputsGas = document.querySelectorAll('#gas input');
    inputsGas.forEach(input => {
      input.value = ''; // Eliminar el contenido del input
      input.disabled = true;
      input.classList.add('grayed-out');
    });

    var selectList = document.getElementById("lista_sucursales");
        selectList.disabled = false;
        selectList.classList.add('grayed-out');
  }

  function bloquearInputsHarina() {
    const inputsHarina = document.querySelectorAll('#harina input');
    inputsHarina.forEach(input => {
      input.value = ''; // Eliminar el contenido del input
      input.disabled = true;
      input.classList.add('grayed-out');
    });

    var selectList = document.getElementById("lista_sucursales");
        selectList.disabled = true;
        selectList.classList.add('grayed-out');
        selectList.selectedIndex = 0; //Regresar al index la selec list
  }

  function activarInputsGas() {
    const inputsGas = document.querySelectorAll('#gas input');
    inputsGas.forEach(input => {
      input.disabled = false;
      input.classList.remove('grayed-out');
    });
  }

  function activarInputsHarina() {
    const inputsHarina = document.querySelectorAll('#harina input');
    inputsHarina.forEach(input => {
      input.disabled = false;
      input.classList.remove('grayed-out');
    });
  }

  //invento
    // Función para obtener los parámetros de la URL
    function obtenerParametroURL(nombre) {
      const urlParams = new URLSearchParams(window.location.search);
      return urlParams.get(nombre);
  }

  // Verificar si hay un parámetro "exito" en la URL
  const exitoParametro = obtenerParametroURL('exito');
  if (exitoParametro === '1') {
      // Mostrar mensaje de éxito y limpiar formulario
      alert("Registro exitoso");
      $("#mensaje").html("Registro exitoso").show();
      $("#miFormulario")[0].reset();
  }

  //termnar invento

  function guardarYLimpiar() {
   // Generar código alfanumérico
   var codigoGenerado = generarCodigo();
        
   // Asignar código generado al campo y al campo oculto
   document.getElementById('codigo_h').value = codigoGenerado;
   document.getElementById('codigo_generado').value = codigoGenerado;

   $.ajax({
    type: "POST",
    url: "./conexion/inventario.php",
    data: $("formulario_harina").serialize(),
    success: function(response) {
        alert(response); // Mostrar mensaje de éxito
        $("#mensaje").html("Registro exitoso").show(); // Mostrar mensaje en el elemento "mensaje"
        $("formulario_harina")[0].reset(); // Limpiar formulario
    },
    error: function(xhr, status, error) {
        alert("Error al registrar datos: " + error);
    }
});

      }


// Función para generar código alfanumérico
function generarCodigo(length = 8) {
    var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var codigo = '';
    for (var i = 0; i < length; i++) {
        codigo += characters[Math.floor(Math.random() * characters.length)];
    }
    return codigo;
}




$(document).ready(function() {
  // Llamada AJAX para obtener los datos del servidor
  $.ajax({
      type: "GET",
      url: "./conexion/consulta_harina.php", // Archivo PHP para obtener los datos
      dataType: "json",
      success: function(data) {
          // Llenar la tabla con los datos recibidos
          llenarTabla(data);
      },
      error: function(xhr, status, error) {
          alert("Error al obtener datos: " + error);
      }
  });
});

function llenarTabla(data) {
  // Limpiar el contenido actual de la tabla
  $("#tabla_inventario").empty();

  // Recorrer los datos y agregar filas a la tabla
  for (var i = 0; i < data.length; i++) {
      var row = "<tr>" +
                  "<td>" + data[i].codigo + "</td>" +
                  "<td>" + data[i].fecha + "</td>" +
                  "<td>" + data[i].inicial + "</td>" +
                  "<td>" + data[i].entradas + "</td>" +
                  "<td>" + data[i].salidas + "</td>" +
                  "<td>" + data[i].traspasos + "</td>" +
                  "<td>" + data[i].sucursal_traspaso + "</td>" +
                "</tr>";
      $("#tabla_inventario").append(row);
  }
}

//openModal si hay inputs vacios()
function openModalInputsVacios() {
  var modalContainer = document.getElementById("modalContainer");
    // Cargar modal.html utilizando AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        modalContainer.innerHTML = this.responseText;
        document.getElementById("myModal").style.display = "block"; // Muestra el modal
        // Agregar eventos al modal una vez que se ha cargado
        var modal = document.getElementById("myModal");
        var closeBtn = modal.getElementsByClassName("closeModal")[0];
        closeBtn.onclick = function() {
          modal.style.display = "none";
        }
        // Cierra el modal al hacer clic fuera del contenido del modal
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      }
    };
    xhttp.open("GET", "../modalCamposVacios.html", true);
    xhttp.send();
}

//openModal registro Exitoso()
function openModalRegistroExitoso() {
  var modalContainer = document.getElementById("modalContainer");
    // Cargar modal.html utilizando AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        modalContainer.innerHTML = this.responseText;
        document.getElementById("myModal").style.display = "block"; // Muestra el modal
        // Agregar eventos al modal una vez que se ha cargado
        var modal = document.getElementById("myModal");
        var closeBtn = modal.getElementsByClassName("closeModal")[0];
        closeBtn.onclick = function() {
          modal.style.display = "none";
        }
        // Cierra el modal al hacer clic fuera del contenido del modal
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      }
    };
    xhttp.open("GET", "../modalRegistroExitoso.html", true);
    xhttp.send();
}

//openModal registro fallido()
function openModalRegistroFallido() {
  var modalContainer = document.getElementById("modalContainer");
    // Cargar modal.html utilizando AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        modalContainer.innerHTML = this.responseText;
        document.getElementById("myModal").style.display = "block"; // Muestra el modal
        // Agregar eventos al modal una vez que se ha cargado
        var modal = document.getElementById("myModal");
        var closeBtn = modal.getElementsByClassName("closeModal")[0];
        closeBtn.onclick = function() {
          modal.style.display = "none";
        }
        // Cierra el modal al hacer clic fuera del contenido del modal
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      }
    };
    xhttp.open("GET", "../modalRegistroFallo.html", true);
    xhttp.send();
}

//openModal valor fallido()
function openModalValorInvalido() {
  var modalContainer = document.getElementById("modalContainer");
    // Cargar modal.html utilizando AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        modalContainer.innerHTML = this.responseText;
        document.getElementById("myModal").style.display = "block"; // Muestra el modal
        // Agregar eventos al modal una vez que se ha cargado
        var modal = document.getElementById("myModal");
        var closeBtn = modal.getElementsByClassName("closeModal")[0];
        closeBtn.onclick = function() {
          modal.style.display = "none";
        }
        // Cierra el modal al hacer clic fuera del contenido del modal
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      }
    };
    xhttp.open("GET", "../modalValorInvalido.html", true);
    xhttp.send();
}