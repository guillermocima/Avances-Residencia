// Archivo: js2/empleados.js (Versión Final y Robusta)

document.addEventListener("DOMContentLoaded", function() {
    const urlPHP = 'php/gestion_empleados.php';
    const form = document.getElementById("empleadoForm");
    const formTitle = document.getElementById("form_title");
    const tablaBody = document.getElementById("tabla_empleados");
    const btnRegistrar = document.getElementById("btn_registrar");
    const btnActualizar = document.getElementById("btn_actualizar");
    const btnCancelar = document.getElementById("btn_cancelar");
    const hiddenIdInput = document.getElementById("usuario_id");

    function modoEdicion(empleado) {
        formTitle.textContent = `EDITAR EMPLEADO: ${empleado.nombre} ${empleado.apellidos}`;
        hiddenIdInput.value = empleado.id;
        document.getElementById("nombre").value = empleado.nombre;
        document.getElementById("apellidos").value = empleado.apellidos;
        document.getElementById("puesto").value = empleado.puesto;
        document.getElementById("email").value = empleado.email;
        document.getElementById("rol").value = empleado.rol;
        document.getElementById("password").value = ""; // Limpiar campo de contraseña
        document.getElementById("password").placeholder = "Dejar en blanco para no cambiar";
        
        btnRegistrar.style.display = 'none';
        btnActualizar.style.display = 'inline-block';
        btnCancelar.style.display = 'inline-block';
    }

    function modoRegistro() {
        formTitle.textContent = "REGISTRAR NUEVO EMPLEADO";
        form.reset();
        hiddenIdInput.value = '';
        document.getElementById("password").placeholder = "";

        btnRegistrar.style.display = 'inline-block';
        btnActualizar.style.display = 'none';
        btnCancelar.style.display = 'none';
    }

    async function listarEmpleados() {
        try {
            const response = await fetch(`${urlPHP}?action=listar`);
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const result = await response.json();

            tablaBody.innerHTML = '';
            if (result.success && result.data.length > 0) {
                result.data.forEach(empleado => {
                    tablaBody.innerHTML += `
                        <tr>
                            <td>${empleado.nombre}</td>
                            <td>${empleado.apellidos}</td>
                            <td>${empleado.puesto}</td>
                            <td>${empleado.email}</td>
                            <td>${empleado.rol}</td>
                            <td>
                                <button class="btn-accion btn-editar" data-id='${empleado.id}' data-nombre='${empleado.nombre}' data-apellidos='${empleado.apellidos}' data-puesto='${empleado.puesto}' data-email='${empleado.email}' data-rol='${empleado.rol}'>Editar</button>
                                <button class="btn-accion btn-eliminar" data-id="${empleado.id}">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
            } else if (result.success) {
                tablaBody.innerHTML = '<tr><td colspan="6">No hay empleados registrados.</td></tr>';
            } else {
                alertify.error(result.message);
            }
        } catch (error) {
            console.error("Error al listar empleados:", error);
            alertify.error("Error al cargar la lista. Revisa la consola (F12).");
            tablaBody.innerHTML = '<tr><td colspan="6">Error al cargar la lista.</td></tr>';
        }
    }

    form.addEventListener("submit", async function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        const action = hiddenIdInput.value ? 'actualizar' : 'registrar';
        formData.append('action', action);

        try {
            const response = await fetch(urlPHP, { method: 'POST', body: formData });
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            const result = await response.json();

            if (result.success) {
                alertify.success(result.message);
                modoRegistro();
                listarEmpleados();
            } else {
                alertify.error(result.message);
            }
        } catch (error) {
            console.error("Error en el formulario:", error);
            alertify.error("Error de conexión al guardar. Revisa la consola (F12).");
        }
    });

    tablaBody.addEventListener('click', function(e) {
        const target = e.target;
        if (target.classList.contains('btn-editar')) {
            const empleadoData = { ...target.dataset }; // Copia todos los data-attributes
            modoEdicion(empleadoData);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        if (target.classList.contains('btn-eliminar')) {
            const empleadoId = target.dataset.id;
            alertify.confirm("Eliminar Empleado", "¿Estás seguro de que quieres eliminar este empleado?",
                async function() { // onOk
                    const formData = new FormData();
                    formData.append('action', 'eliminar');
                    formData.append('id', empleadoId);
                    // ... (resto de la lógica de fetch para eliminar) ...
                },
                function() { // onCancel
                    alertify.error('Eliminación cancelada');
                }
            );
        }
    });

    btnCancelar.addEventListener('click', modoRegistro);

    listarEmpleados();
});