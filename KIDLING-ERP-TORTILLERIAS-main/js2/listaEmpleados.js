const urlPHP = "/KIDLING-ERP-TORTILLERIAS-main/rh/php/empleados.php";

const tablaEmpleados = document.getElementById("tabla_empleados");
const form = document.getElementById("form_empleado");

const getFormData = () => ({
    nombre: document.getElementById("rh_nombre").value.trim(),
    apellidos: document.getElementById("rh_apellidos").value.trim(),
    puesto: document.getElementById("rh_puesto").value.trim(),
    usuario: document.getElementById("rh_usuario").value.trim(),
    password: document.getElementById("rh_password").value.trim()
});

let selectedId = null;

// Listar empleados
async function listarEmpleados() {
    const data = new FormData();
    data.append("action", "listar");
    const res = await fetch(urlPHP, { method: "POST", body: data });
    const json = await res.json();
    tablaEmpleados.innerHTML = "";
    if (json.success) {
        json.data.forEach(emp => {
            tablaEmpleados.innerHTML += `
                <tr>
                    <td>${emp.nombre}</td>
                    <td>${emp.apellidos}</td>
                    <td>${emp.puesto}</td>
                    <td>${emp.usuario}</td>
                    <td>${emp.password}</td>
                    <td>
                        <button class="btn-editar" data-id="${emp.id}">✏️</button>
                        <button class="btn-eliminar" data-id="${emp.id}">🗑️</button>
                    </td>
                </tr>`;
        });

        // Asignar eventos a botones de editar y eliminar
        document.querySelectorAll(".btn-editar").forEach(btn => {
            btn.addEventListener("click", (e) => {
                selectedId = e.target.dataset.id;
                const fila = e.target.closest("tr");
                document.getElementById("rh_nombre").value = fila.children[0].textContent;
                document.getElementById("rh_apellidos").value = fila.children[1].textContent;
                document.getElementById("rh_puesto").value = fila.children[2].textContent;
                document.getElementById("rh_usuario").value = fila.children[3].textContent;
                document.getElementById("rh_password").value = fila.children[4].textContent;

                // Cambiar botones
                document.getElementById("btn_registrar").style.display = "none";
                document.getElementById("btn_editar").style.display = "inline-block";

                alert("Empleado cargado en el formulario, edita los datos y presiona 'Editar'");
            });
        });

        document.querySelectorAll(".btn-eliminar").forEach(btn => {
            btn.addEventListener("click", async (e) => {
                const id = e.target.dataset.id;
                if (!confirm("¿Seguro que deseas eliminar este empleado?")) return;
                const res = await fetch(urlPHP, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ action: "eliminar", id })
                });
                const json = await res.json();
                alert(json.message);
                if (json.success) listarEmpleados();
            });
        });
    }
}

// Registrar empleado
document.getElementById("btn_registrar").addEventListener("click", async () => {
    const empleado = getFormData();
    const res = await fetch(urlPHP, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: "registrar", ...empleado })
    });
    const json = await res.json();
    alert(json.message);
    if (json.success) { listarEmpleados(); form.reset(); }
});

// Editar empleado
document.getElementById("btn_editar").addEventListener("click", async () => {
    if (!selectedId) return alert("Selecciona un empleado desde la tabla con el botón ✏️");
    const empleado = getFormData();
    const res = await fetch(urlPHP, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: "editar", id: selectedId, ...empleado })
    });
    const json = await res.json();
    alert(json.message);
    if (json.success) { 
        listarEmpleados(); 
        form.reset(); 
        selectedId = null;

        // Volver a mostrar "REGISTRAR" y ocultar "EDITAR"
        document.getElementById("btn_registrar").style.display = "inline-block";
        document.getElementById("btn_editar").style.display = "none";
    }
});

// Cargar la tabla al inicio
listarEmpleados();
