// Archivo: js2/prestamos.js (Versión Final y Corregida)

document.addEventListener("DOMContentLoaded", function() {
    // --- REFERENCIAS A ELEMENTOS DEL FORMULARIO ---
    const urlPHP = 'php/gestion_prestamos.php';
    const form = document.getElementById("prestamoForm");
    const selectEmpleado = document.getElementById("empleado");
    const tablaBody = document.getElementById("tabla_prestamos");
    const montoTotalInput = document.getElementById("monto_total");
    const numQuincenasSelect = document.getElementById("numero_quincenas");
    const descuentoInput = document.getElementById("monto_descuento_quincenal");

    // --- FUNCIONES ---

    /**
     * Calcula el descuento quincenal basado en el monto y el número de pagos.
     */
    function calcularDescuento() {
        const monto = parseFloat(montoTotalInput.value);
        const quincenas = parseInt(numQuincenasSelect.value);

        if (monto > 0 && quincenas > 0) {
            const descuento = monto / quincenas;
            descuentoInput.value = descuento.toFixed(2); // Muestra con 2 decimales
        } else {
            descuentoInput.value = "";
        }
    }

    /**
     * Carga la lista de empleados desde la base de datos y la pone en el <select>.
     */
    async function cargarEmpleados() {
        try {
            const response = await fetch(`${urlPHP}?action=listar_empleados`);
            const result = await response.json();
            if (result.success) {
                selectEmpleado.innerHTML = '<option value="">Seleccione un empleado</option>';
                result.data.forEach(emp => {
                    selectEmpleado.innerHTML += `<option value="${emp.id}">${emp.apellidos}, ${emp.nombre}</option>`;
                });
            }
        } catch (error) {
            console.error("Error al cargar empleados:", error);
            alertify.error("Error al cargar la lista de empleados.");
        }
    }

    /**
     * Carga la lista de préstamos existentes y la muestra en la tabla.
     */
    async function listarPrestamos() {
        try {
            const response = await fetch(`${urlPHP}?action=listar_prestamos`);
            const result = await response.json();
            tablaBody.innerHTML = ''; // Limpiar la tabla antes de llenarla
            
            if (result.success && result.data.length > 0) {
                result.data.forEach(p => {
                    tablaBody.innerHTML += `
                        <tr>
                            <td>${p.nombre_empleado}</td>
                            <td>${p.area || 'N/A'}</td>
                            <td>${p.fecha_solicitud}</td>
                            <td>$${parseFloat(p.monto_total).toFixed(2)}</td>
                            <td>$${parseFloat(p.monto_descuento_quincenal).toFixed(2)}</td>
                            <td>$${parseFloat(p.monto_restante).toFixed(2)}</td>
                            <td>${p.estado}</td>
                        </tr>
                    `;
                });
            } else if (result.success) {
                tablaBody.innerHTML = '<tr><td colspan="7">No hay préstamos activos.</td></tr>';
            } else {
                alertify.error(result.message || 'Error al cargar préstamos.');
            }
        } catch (error) {
            console.error("Error al listar préstamos:", error);
            alertify.error("Error de conexión al listar préstamos.");
        }
    }

    // --- EVENTOS ---

    // 1. Escuchar los cambios en los campos para recalcular el descuento
    montoTotalInput.addEventListener('input', calcularDescuento);
    numQuincenasSelect.addEventListener('change', calcularDescuento);

    // 2. Manejar el envío del formulario para registrar un nuevo préstamo
    form.addEventListener("submit", async function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        formData.append('action', 'registrar');

        try {
            const response = await fetch(urlPHP, { method: 'POST', body: formData });
            const result = await response.json();
            if (result.success) {
                alertify.success(result.message);
                form.reset();
                descuentoInput.value = ''; // Limpiar campo calculado
                listarPrestamos();
            } else {
                alertify.error(result.message || "Error al registrar.");
            }
        } catch (error) {
            console.error("Error al enviar formulario:", error);
            alertify.error("Error de conexión al guardar el préstamo.");
        }
    });

    // --- CARGA INICIAL DE DATOS ---
    // Se ejecuta cuando la página ha cargado por completo
    cargarEmpleados();
    listarPrestamos();
});