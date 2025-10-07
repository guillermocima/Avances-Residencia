function verificarYResetear() {
 
    // Obtener el valor del input
    var user = document.getElementById("usernameInput").value;

    // Verificar si el input está vacío
    if (user.trim() !== "") { // Si el usuario no está vacío
        // Llamar a la función resetPassword
        resetPassword(user);
    } else {
        // Mostrar un mensaje de error o realizar otra acción si el input está vacío
        alert("Por favor, introduce tu nombre de usuario.");
    }
}

function resetPassword(user) {
    // Mostrar el mensaje de notificación
    var notificacion = document.getElementById("notificacion");
    notificacion.style.display = "block";
    notificacion.style.textAlign = "center";

    // Redirigir al index después de un cierto tiempo (por ejemplo, 5 segundos)
    setTimeout(function() {
        window.location.href = "../login.html"; // Cambiar a la página de destino apropiada
    }, 5000); // 5000 milisegundos = 5 segundos
}

function irAlDashboard(){
    window.location.href = "../index.php";
}

function irVentasDia(){
  window.location.href = "../modalListaVentas.html";
}

//Modal
// Función para cargar el contenido del modal ventas
function openModalVentas() {
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
    xhttp.open("GET", "./modalVentasDia.html", true);
    xhttp.send();
}
//Fin modal

// Función para cargar el contenido del modal tortillas
function openModalTortillas() {
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
    xhttp.open("GET", "./modales(formularios/modalTortillas.php", true);
    xhttp.send();
}
//Fin modal
                


//openModalBolsas()
function openModalBolsas() {
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
    xhttp.open("GET", "../modalBolsasUsadas.html", true);
    xhttp.send();
}
//Fin modal bolsas

//openModalCorte()
function openModalCorte() {
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
    xhttp.open("GET", "../modalCorteCaja.html", true);
    xhttp.send();
}
//Fin modal corte caja

//openModalFrias()
function openModalFrias() {
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
    xhttp.open("GET", "../modalFrias.html", true);
    xhttp.send();
}
//Fin modal frias

//openModalFrias()
function openModalCalientes() {
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
    xhttp.open("GET", "../modalCalientes.html", true);
    xhttp.send();
}
//Fin modal frias

//openModalFrias()
function openCerrarTurno() {
  var modalContainer = document.getElementById("modalContainer");
  
  // Cargar modal.html utilizando AJAX
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      modalContainer.innerHTML = this.responseText;
      var modal = document.getElementById("myModal");
      modal.style.display = "block"; // Muestra el modal
      
      // Agregar eventos al modal una vez que se ha cargado
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
  
  xhttp.open("GET", "../cerrarTurno.html", true);
  xhttp.send();
}

//openModalGastos()
function openGastos() {
  var modalContainer = document.getElementById("modalContainer");
  
  // Cargar modal.html utilizando AJAX
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      modalContainer.innerHTML = this.responseText;
      var modal = document.getElementById("myModal");
      modal.style.display = "block"; // Muestra el modal
      
      // Agregar eventos al modal una vez que se ha cargado
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
  
  xhttp.open("GET", "../modalGastos.html", true);
  xhttp.send();
}

function irInventario(){
  window.location.href = "inventario.php";
}



function openModalEntregasDistriucion() {
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
    xhttp.open("GET", "./modalVentasDia.html", true);
    xhttp.send();
}
//Fin modal

function openVetatotopos() {
  var modalContainer = document.getElementById("modalContainer");
  // Cargar ventaTotopos.php utilizando AJAX
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
  xhttp.open("GET", "./modales(formularios/registroVentaTotopos.php", true);
  xhttp.send();
}

// Asegúrate de que el botón tenga el evento onclick correcto
document.addEventListener('DOMContentLoaded', function() {
  var btn = document.querySelector('.card-actions button');
  if (btn) {
    btn.onclick = openVetatotopos;
  }
});


function openAdminPanel() {
  // Lógica para abrir el panel de administración
  // Esto puede ser abrir un nuevo modal, redirigir a una página de administración, etc.
  window.location.href = 'ventaTotopos.php'; // Redirige a una página de administración
}