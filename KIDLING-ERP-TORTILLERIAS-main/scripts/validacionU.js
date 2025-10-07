const validarRegistroUsuario = () => {
    let nombre = document.getElementById('nombre').value;
    let apellidos = document.getElementById('apellidos').value;
    let email = document.getElementById('email').value;
    let password1 = document.getElementById('password1').value;
    let password2 = document.getElementById('password2').value;

    if (nombre.length == 0) {
        alertify.error('sssEscriba el nombre del usuario');
        return false;
    }
    if (apellidos.length == 0) {
        alertify.error('aEscriba los apellidos del usuario');
        return false;
    }
    // email
    if (email.length == 0) {
        alertify.error("Escriba el email del usuario");
        return false;
    }

    let validacionEmail = validarEmail(email);

    if(validacionEmail == false){
        alertify.error("Formato incorrecto");
        return false;
      
    }
    alert("Mensaje de prueba");

    // if (password1.length == 0) {
    //     alertify.error("Escriba la contraseña del usuario");
    //     return false;
    // }
    // if (password2.length == 0) {
    //     alertify.error("Repita la contraseña del usuario");
    //     return false;
    // }

    // if (password1 != password2) {
    //     alertify.error("Las contraseñas no coinciden");
    //     return false;
    // }

    let send = {
        nombre,
        apellidos,
        email,
        password1
    }
    let url = "files/registroUsuario.php";
    let mensaje = "Los datos se guardaron correctamente";
    let ejecutar = "verInicio()";

    ajaxPostControl(url, "registrando", send, mensaje, ejecutar);
}

const verInicio = () => {
    location.href = 'login.html';
}

function verIndex() {
    location.href = 'index.php';
}
// email
const validarEmail = valor => {
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(valor)) {
        return true;
    } else {
        return false;
    }
}

const iniciarSesion = () => {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let recordarme = 0;

    if (email.length == 0) {
        alertify.error("Escriba el email");
        return false;
    }
    if (password.length == 0) {
        alertify.error("Escriba la contraseña");
        return false;
    }
    if (document.getElementById('recordarmeCheck').checked == true) {
        recordarme = 1;
    }

    let send = {
        email,
        password,
        recordarme
    }
    
    let url = "files/validarInicio.php";
    
    let mensaje = "";
    let ejecutar = "verIndex()";
    

    console.table(send);
   

    ajaxPostControl(url, "iniciando", send, mensaje, ejecutar);
}


//investario arina
const validarInventarioHarina = () => {
    let opcionSeleccionada = document.getElementById('opcion_seleccionada').value;
    let fechaH = document.getElementById('fecha_h').value;
    let inicial = document.getElementById('inicial').value;
    let entradas = document.getElementById('entradas').value;
    let salidas = document.getElementById('salidas').value;
    let traspasos = document.getElementById('traspasos').value;
    let listaSucursales = document.getElementById('lista_sucursales').value;

    if (opcionSeleccionada.length == 0) {
        alertify.error('Por favor, seleccione una opción.');
        return false;
    }
    if (fechaH.length == 0) {
        alertify.error('Por favor, seleccione una fecha.');
        return false;
    }
    if (inicial.length == 0) {
        alertify.error('Por favor, ingrese el valor inicial.');
        return false;
    }
    if (entradas.length == 0) {
        alertify.error('Por favor, ingrese las entradas.');
        return false;
    }
    if (salidas.length == 0) {
        alertify.error('Por favor, ingrese las salidas.');
        return false;
    }
    if (listaSucursales.length == 0 || listaSucursales === 'SELECCIONAR') {
        alertify.error('Por favor, seleccione una sucursal de traspaso.');
        return false;
    }

    let send = {
        opcionSeleccionada,
        fechaH,
        inicial,
        entradas,
        salidas,
        traspasos,
        listaSucursales
    };

    let url = "files/inventarioHarina.php";
    let mensaje = "Los datos se guardaron correctamente";
    let ejecutar = "limpiarFormulario()";

    ajaxPostControl(url, "registrando2", send, mensaje, ejecutar);
}

const limpiarFormulario = () => {
    document.getElementById('opcion_seleccionada').value = '';
    document.getElementById('fecha_h').value = '';
    document.getElementById('inicial').value = '';
    document.getElementById('entradas').value = '';
    document.getElementById('salidas').value = '';
    document.getElementById('traspasos').value = '';
    document.getElementById('lista_sucursales').value = 'SELECCIONAR';

}

//inventario gas

const validarInventarioGas = () => {
    let turno = document.getElementById('opcion_seleccionada_g').value;
    let fecha = document.getElementById('fecha_g').value;
    let inicial = document.getElementById('inicial_g').value;
    let entradas = document.getElementById('entradas_g').value;
    let salidas = document.getElementById('salidas_g').value;

    // Validación de campos
    if (turno.length === 0) {
        alertify.error('Por favor, seleccione una opción.');
        return false;
    }
    if (fecha.length === 0) {
        alertify.error('Por favor, seleccione una fecha.');
        return false;
    }
    if (inicial.length === 0) {
        alertify.error('Por favor, ingrese el valor inicial.');
        return false;
    }
    if (entradas.length === 0) {
        alertify.error('Por favor, ingrese las entradas.');
        return false;
    }
    if (salidas.length === 0) {
        alertify.error('Por favor, ingrese las salidas.');
        return false;
    }

    // Crear objeto con los datos del formulario
    let send = {
        turno,
        fecha,
        inicial,
        entradas,
        salidas
    };

    // Configurar la solicitud AJAX
    let url = "files/inventarioGas.php";
    let mensaje = "Los datos se guardaron correctamente";
    let ejecutar = "limpiarFormulario3()";

    // Llamada AJAX (asume que ajaxPostControl es una función definida en otro lugar)
    ajaxPostControl(url, "registrandoGas3", send, mensaje, ejecutar);
}

const limpiarFormulario3 = () => {
    document.getElementById('opcion_seleccionada_g').value = '';
    document.getElementById('fecha_g').value = '';
    document.getElementById('inicial_g').value = '';
    document.getElementById('entradas_g').value = '';
    document.getElementById('salidas_g').value = '';
}


const validarVentaTotopos = () => {
    event.preventDefault(); // Previene la recarga de la página

    let toposAnterior = document.getElementById('totopo_anterior').value;
    let produccion = document.getElementById('produccion').value;
    let ventaTotopos = document.getElementById('venta_totopos').value;
    let salidaTotopos = document.getElementById('salida_totopos').value;
    let existenciaReal = document.getElementById('existencia_real').value;
    let sucursal = document.getElementById('lista_sucursales').value;
    let fecha = document.getElementById('date').value;

    // Validación de campos
    if (toposAnterior.length === 0) {
        alertify.error('Por favor, ingrese el topos anterior.');
        return false;
    }
    if (produccion.length === 0) {
        alertify.error('Por favor, ingrese la producción.');
        return false;
    }
    if (ventaTotopos.length === 0) {
        alertify.error('Por favor, ingrese la venta de totopos.');
        return false;
    }
    if (salidaTotopos.length === 0) {
        alertify.error('Por favor, ingrese la salida de totopos.');
        return false;
    }
    if (existenciaReal.length === 0) {
        alertify.error('Por favor, ingrese la existencia real.');
        return false;
    }
    if (sucursal === "SELECCIONAR") {
        alertify.error('Por favor, seleccione una sucursal.');
        return false;
    }
    if (fecha.length === 0) {
        alertify.error('Por favor, seleccione una fecha.');
        return false;
    }

    // Crear objeto con los datos del formulario
    let send = {
        toposAnterior,
        produccion,
        ventaTotopos,
        salidaTotopos,
        existenciaReal,
        sucursal,
        fecha
    };

    // Configurar la solicitud AJAX
    let url = "files/ventaTotopos.php";
    let mensaje = "Los datos se guardaron correctamente";
    let ejecutar = "limpiarFormulario4()";

    // Llamada AJAX (asume que ajaxPostControl es una función definida en otro lugar)
    ajaxPostControl(url, "registrandoTotopos", send, mensaje, ejecutar);
}

// Función para limpiar las casillas del formulario
const limpiarFormulario4 = () => {
    document.getElementById('totopo_anterior').value = '';
    document.getElementById('produccion').value = '';
    document.getElementById('venta_totopos').value = '';
    document.getElementById('salida_totopos').value = '';
    document.getElementById('existencia_real').value = '';
    document.getElementById('lista_sucursales').value = 'SELECCIONAR';
    document.querySelector('input[type="date"]').value = '';
}

// modal torillas
const guardarEntrega = () => {
    let fechaEntrega = document.getElementById('inputFechaEntrega').value;
    let repartidor = document.getElementById('lista_repartidores').value;
    let sucursal = document.getElementById('lista_sucursales').value;
    let subtotalFrias = document.getElementById('subtotal_frias').value;
    let cantidadReportadaFrias = document.getElementById('cantidad_reportada_frias').value;
    let diferenciaFrias = document.getElementById('diferencia_frias').value;
    let tortillaCalienteSalidas = document.getElementById('tortilla_caliente_salidas').value;
    let devolucionCaliente = document.getElementById('devolucion_caliente').value;
    let cantidadReportadaCaliente = document.getElementById('cantidad_reportada_caliente').value;
    let diferenciaCaliente = document.getElementById('diferencia_caliente').value;
    
    // Validaciones básicas
    if (!fechaEntrega) {
        alertify.error("Seleccione una fecha de entrega.");
        return false;
    }
    if (!repartidor) {
        alertify.error("Seleccione un repartidor.");
        return false;
    }
    if (!sucursal) {
        alertify.error("Seleccione una sucursal.");
        return false;
    }
    if (!subtotalFrias) {
        alertify.error("Ingrese el subtotal de tortillas frías.");
        return false;
    }
    if (!cantidadReportadaFrias) {
        alertify.error("Ingrese la cantidad reportada de tortillas frías.");
        return false;
    }
    if (!diferenciaFrias) {
        alertify.error("Ingrese la diferencia de tortillas frías.");
        return false;
    }
    if (!tortillaCalienteSalidas) {
        alertify.error("Ingrese las salidas de tortillas calientes.");
        return false;
    }
    if (!devolucionCaliente) {
        alertify.error("Ingrese la devolución de tortillas calientes.");
        return false;
    }
    if (!cantidadReportadaCaliente) {
        alertify.error("Ingrese la cantidad reportada de tortillas calientes.");
        return false;
    }
    if (!diferenciaCaliente) {
        alertify.error("Ingrese la diferencia de tortillas calientes.");
        return false;
    }
    

    

    let send = {
      fechaEntrega,
      repartidor,
      sucursal,
      subtotalFrias,
      cantidadReportadaFrias,
      diferenciaFrias,
      tortillaCalienteSalidas,
      devolucionCaliente,
      cantidadReportadaCaliente,
      diferenciaCaliente
    };

    let url = "files/modalTortillas.php"; // Cambia 'ruta_a_tu_script_php.php' por la ruta correcta

    let mensaje = "Los datos se guardaron correctamente";
    let ejecutar = "verIndex()";

    console.table(send);

    ajaxPostControl(url, "guardando4", send, mensaje, ejecutar);
  }

//   ajaxPostControl(url, "registrandoTotopos", send, mensaje, ejecutar);


const cuadrarFrias = (event) => {

    // Retrieve form values
    let tortillasFrias = document.getElementById('tortillas-frias').value.trim();
    let usuarioId = document.getElementById('usuario_id').value.trim();
    let fecha = document.getElementById('fecha').value.trim();

    // Validate fields
    if (!tortillasFrias) {
        alertify.error('Por favor, ingrese la cantidad de tortillas frías.');
        return false;
    }
    // if (isNaN(tortillasFrias) || parseFloat(tortillasFrias) <= 0) {
    //     alertify.error('La cantidad de tortillas frías debe ser un número positivo.');
    //     return false;
    // }
    if (!usuarioId) {
        alertify.error('No se ha encontrado el ID del usuario.');
        return false;
    }
    if (!fecha) {
        alertify.error('No se ha encontrado la fecha.');
        return false;
    }

    // Create object with form data
    let send = {
        tortillasFrias,
        usuarioId,
        fecha
    };

    // Configure AJAX request
    let url = "files/cuadrarFrias.php"; // Change to your PHP file path
    let mensaje = "Las tortillas frías se cuadraron correctamente.";
    let ejecutar = "limpiarFormulario2();"; // Function to clean the form after submission

    // AJAX request (assumes ajaxPostControl is defined elsewhere)
    ajaxPostControl(url, "guardando5", send, mensaje, ejecutar, (response) => {
        // Procesar la respuesta JSON
        if (response.success) {
            alertify.success(response.mensaje);
        } else {
            alertify.error(response.mensaje);
        }
    });
}

// Function to clear the form fields
const limpiarFormulario2 = () => {
    document.getElementById('tortillas-frias').value = ''; // Reset to default value
    // No need to clear hidden inputs since they are not user-editable
}


// const cuadrarFrias = (event) => {
//     // Retrieve form values
//     let tortillasFrias = document.getElementById('tortillas-frias').value.trim();
//     let usuarioId = document.getElementById('usuario_id').value.trim();
//     let fecha = document.getElementById('fecha').value.trim();

//     // Validate fields
//     if (!tortillasFrias) {
//         alertify.error('Por favor, ingrese la cantidad de tortillas frías.');
//         return false;
//     }
//     if (isNaN(tortillasFrias) || parseFloat(tortillasFrias) <= 0) {
//         alertify.error('La cantidad de tortillas frías debe ser un número positivo.');
//         return false;
//     }
//     if (!usuarioId) {
//         alertify.error('No se ha encontrado el ID del usuario.');
//         return false;
//     }
//     if (!fecha) {
//         alertify.error('No se ha encontrado la fecha.');
//         return false;
//     }

//     // Create object with form data
//     let send = {
//         tortillasFrias,
//         usuarioId,
//         fecha
//     };

//     // Configure AJAX request
//     let url = "files/cuadrarFrias.php"; // Change to your PHP file path

//     // AJAX request (assumes ajaxPostControl is defined elsewhere)
//     ajaxPostControl(url, "guardando5", send, null, (response) => {
//         if (response.success) {
//             if (response.tipo === "success") {
//                 alertify.success(response.mensaje);
//             } else {
//                 alertify.error(response.mensaje);
//             }
//         } else {
//             alertify.error(response.mensaje);
//         }
//         limpiarFormulario2();
//     });
// }

// // Function to clear the form fields
// const limpiarFormulario2 = () => {
//     document.getElementById('tortillas-frias').value = '1'; // Reset to default value
//     // No need to clear hidden inputs since they are not user-editable
// }


const cuadrarCalientes = (event) => {

    // Retrieve form values
    let tortillasCalientes = document.getElementById('tortillas_calientes').value.trim();
    let usuarioId = document.getElementById('usuario_id').value.trim();
    let fecha = document.getElementById('fecha').value.trim();

    // Validate fields
    if (!tortillasCalientes) {
        alertify.error('Por favor, ingrese la cantidad de tortillas calientes.');
        return false;
    }
    // if (isNaN(tortillasCalientes) || parseFloat(tortillasCalientes) <= 0) {
    //     alertify.error('La cantidad de tortillas calientes debe ser un número positivo.');
    //     return false;
    // }
    if (!usuarioId) {
        alertify.error('No se ha encontrado el ID del usuario.');
        return false;
    }
    if (!fecha) {
        alertify.error('No se ha encontrado la fecha.');
        return false;
    }

    // Create object with form data
    let send = {
        tortillasCalientes,
        usuarioId,
        fecha
    };

    // Configure AJAX request
    let url = "files/cuadrarCalientes.php"; // Change to your PHP file path
    let mensaje = "Las tortillas calientes se guardaron correctamente.";
    let ejecutar = "limpiarFormulario7();"; // Function to clean the form after submission

    // AJAX request (assumes ajaxPostControl is defined elsewhere)
    ajaxPostControl(url, "registrandoCalientesdeturno", send, mensaje, ejecutar, (response) => {
        // Process the JSON response
        if (response.success) {
            alertify.success(response.mensaje);
        } else {
            alertify.error(response.mensaje);
        }
    });
}

// Function to clear the form fields
const limpiarFormulario7 = () => {
    document.getElementById('tortillas_calientes').value = ''; // Reset to default value
    // No need to clear hidden inputs since they are not user-editable
}


const guardarVentatotopos = (event) => {
    // Obtener los valores del formulario
    let sucursal = document.getElementById('lista_sucursales').value.trim();
    let ventaTotopos = document.getElementById('venta_totopos').value.trim();
    let precio = document.getElementById('precio').value.trim();
    let fecha = document.getElementById('fecha').value.trim();

    // Validar campos
    if (!sucursal) {
        alertify.error('Por favor, seleccione una sucursal.');
        return false;
    }
    if (!ventaTotopos || isNaN(ventaTotopos) || parseFloat(ventaTotopos) <= 0) {
        alertify.error('La cantidad de totopos debe ser un número positivo.');
        return false;
    }
    if (!precio || isNaN(precio) || parseFloat(precio) <= 0) {
        alertify.error('El precio debe ser un número positivo.');
        return false;
    }
    if (!fecha) {
        alertify.error('No se ha encontrado la fecha.');
        return false;
    }

    // Crear objeto con los datos del formulario
    let send = {
        sucursal,
        venta_totopos: ventaTotopos,
        precio,
        fecha
    };

    // Configurar solicitud AJAX
    let url = "files/ventaTotoposDiario.php"; // Cambia a la ruta real de tu archivo PHP
    let mensaje = "La venta de totopos se guardó correctamente.";
    let ejecutar = "limpiarFormularioVentaTotopos();"; // Función para limpiar el formulario después del envío

    // Solicitud AJAX (asume que ajaxPostControl está definido en otro lugar)
    ajaxPostControl(url, "guardand6", send, mensaje, ejecutar, (response) => {
        // Procesar la respuesta JSON
        if (response.success) {
            alertify.success(response.mensaje);
        } else {
            alertify.error(response.mensaje);
        }
    });
}

// Función para limpiar los campos del formulario
const limpiarFormularioVentaTotopos = () => {
    document.getElementById('lista_sucursales').value = ''; // Restablecer a valor predeterminado
    document.getElementById('venta_totopos').value = ''; // Restablecer a valor predeterminado
    document.getElementById('precio').value = ''; // Restablecer a valor predeterminado
    document.getElementById('fecha').value = ''; // Restablecer a valor predeterminado
}
