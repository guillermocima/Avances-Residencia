const urlPHP = "/KIDLING-ERP-TORTILLERIAS-main/rh/php/entradas_salidas.php";
const tablaRegistros = document.getElementById("tabla_entradas_salidas");

// Listar entradas y salidas
async function listarEntradasSalidas() {
    const res = await fetch(urlPHP, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: "listar" })
    });
    const json = await res.json();
    tablaRegistros.innerHTML = "";
    if (json.success) {
        json.data.forEach(reg => {
            tablaRegistros.innerHTML += `
                <tr>
                    <td>${reg.nombre}</td>
                    <td>${reg.apellidos}</td>
                    <td>${reg.usuario}</td>
                    <td>${reg.entrada}</td>
                    <td>${reg.salida || "—"}</td>
                    <td>${reg.area}</td>
                    <td>${reg.observacion}</td>
                </tr>`;
        });
    } else {
        alert(json.message);
    }
}

// Registrar entrada
async function registrarEntrada(empleado_id, area = "General", observacion = "A tiempo") {
    const res = await fetch(urlPHP, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: "registrarEntrada", empleado_id, area, observacion })
    });
    const json = await res.json();
    alert(json.message);
    if (json.success) listarEntradasSalidas();
}

// Registrar salida
async function registrarSalida(empleado_id) {
    const res = await fetch(urlPHP, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: "registrarSalida", empleado_id })
    });
    const json = await res.json();
    alert(json.message);
    if (json.success) listarEntradasSalidas();
}

// Cargar tabla al inicio
document.addEventListener("DOMContentLoaded", listarEntradasSalidas);
