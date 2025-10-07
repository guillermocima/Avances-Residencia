// Archivo: js2/asistencias.js (Versión Final con Formato de Hora)

document.addEventListener("DOMContentLoaded", function() {
    const urlPHP = "php/gestion_asistencias.php";
    const tablaBody = document.getElementById("tabla_asistencias");

    /**
     * ¡NUEVA FUNCIÓN! Formatea la hora en formato 12h AM/PM (ej. 6:00 AM).
     */
    function formatearHora(fechaSQL) {
        if (!fechaSQL || fechaSQL.startsWith('0000-00-00')) {
            return "---";
        }
        const fecha = new Date(fechaSQL);
        if (isNaN(fecha.getTime())) {
            return "---";
        }
        // Opciones para formatear la hora
        const opciones = { hour: 'numeric', minute: 'numeric', hour12: true };
        return fecha.toLocaleTimeString('en-US', opciones);
    }

    async function listarAsistencias() {
        try {
            const response = await fetch(urlPHP);
            const result = await response.json();

            tablaBody.innerHTML = '<tr><td colspan="7">Cargando...</td></tr>';

            if (result.success) {
                tablaBody.innerHTML = "";
                if (result.data.length > 0) {
                    result.data.forEach(reg => {
                        tablaBody.innerHTML += `
                            <tr>
                                <td>${reg.nombre}</td>
                                <td>${reg.apellidos}</td>
                                <td>${reg.usuario}</td>
                                <td>${formatearHora(reg.hora_entrada)}</td>
                                <td>${formatearHora(reg.hora_salida)}</td>
                                <td>${reg.area || 'N/A'}</td>
                                <td>${reg.observacion || '---'}</td>
                            </tr>
                        `;
                    });
                } else {
                     tablaBody.innerHTML = `<tr><td colspan="7">No hay registros de asistencia.</td></tr>`;
                }
            } else {
                tablaBody.innerHTML = `<tr><td colspan="7">${result.message}</td></tr>`;
            }
        } catch (error) {
            tablaBody.innerHTML = `<tr><td colspan="7">Error al cargar los datos.</td></tr>`;
            console.error("Error en fetch:", error);
        }
    }

    listarAsistencias();
});