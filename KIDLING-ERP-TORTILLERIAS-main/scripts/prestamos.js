$(document).ready(function() {
    // Cargar empleados en el select
    cargarEmpleados();
    
    // Cargar lista de préstamos
    cargarPrestamos();
    
    // Calcular total cuando cambia la cantidad
    $('#cantidad').on('input', function() {
        $('#total').val($(this).val());
    });
    
    // Guardar préstamo
    $('#btnGuardar').click(function() {
        guardarPrestamo();
    });
    
    // Editar préstamo
    $('#btnEditar').click(function() {
        editarPrestamo();
    });
    
    // Buscar préstamo
    $('#buscarPrestamo').keyup(function() {
        filtrarPrestamos();
    });
    
    // Filtrar por empleado
    $('#filtroEmpleado').change(function() {
        filtrarPrestamos();
    });
});

function cargarEmpleados() {
    $.ajax({
        url: '../../php/empleadosCRUD.php?action=read',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            const selectEmpleado = $('#empleado');
            const filtroEmpleado = $('#filtroEmpleado');
            
            selectEmpleado.empty().append('<option value="">Seleccione empleado...</option>');
            filtroEmpleado.empty().append('<option value="">Todos los empleados</option>');
            
            data.forEach(empleado => {
                if (empleado.activo) {
                    const option = `<option value="${empleado.id}">${empleado.nombre}</option>`;
                    selectEmpleado.append(option);
                    filtroEmpleado.append(option);
                }
            });
        },
        error: function(error) {
            console.error('Error al cargar empleados:', error);
        }
    });
}

function cargarPrestamos() {
    $.ajax({
        url: '../../php/prestamosCRUD.php?action=read',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            const tbody = $('#tablaPrestamos tbody');
            tbody.empty();
            
            data.forEach(prestamo => {
                const row = `
                    <tr data-id="${prestamo.id}">
                        <td>${prestamo.nombre_empleado}</td>
                        <td>${prestamo.dia}</td>
                        <td>${prestamo.fecha}</td>
                        <td>$${parseFloat(prestamo.cantidad).toFixed(2)}</td>
                        <td>$${parseFloat(prestamo.total).toFixed(2)}</td>
                        <td>
                            <button class="btn-editar">Editar</button>
                            <button class="btn-eliminar">Eliminar</button>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
            
            // Agregar eventos a los botones
            $('.btn-editar').click(function() {
                const id = $(this).closest('tr').data('id');
                prepararEdicion(id);
            });
            
            $('.btn-eliminar').click(function() {
                const id = $(this).closest('tr').data('id');
                eliminarPrestamo(id);
            });
        },
        error: function(error) {
            console.error('Error al cargar préstamos:', error);
        }
    });
}

function guardarPrestamo() {
    const prestamoData = {
        empleado_id: $('#empleado').val(),
        dia: $('#dia').val(),
        fecha: $('#fecha').val(),
        cantidad: $('#cantidad').val(),
        total: $('#total').val()
    };
    
    if (!validarPrestamo(prestamoData)) return;
    
    $.ajax({
        url: '../../php/prestamosCRUD.php?action=create',
        type: 'POST',
        data: prestamoData,
        success: function(response) {
            alert(response.message);
            limpiarFormulario();
            cargarPrestamos();
        },
        error: function(error) {
            console.error('Error al guardar préstamo:', error);
        }
    });
}

function prepararEdicion(id) {
    $.ajax({
        url: `../../php/prestamosCRUD.php?action=read&id=${id}`,
        type: 'GET',
        dataType: 'json',
        success: function(prestamo) {
            $('#empleado').val(prestamo.empleado_id);
            $('#dia').val(prestamo.dia);
            $('#fecha').val(prestamo.fecha);
            $('#cantidad').val(prestamo.cantidad);
            $('#total').val(prestamo.total);
            
            $('#btnGuardar').hide();
            $('#btnEditar').data('id', prestamo.id).show().prop('disabled', false);
        },
        error: function(error) {
            console.error('Error al cargar préstamo:', error);
        }
    });
}

function editarPrestamo() {
    const prestamoData = {
        id: $('#btnEditar').data('id'),
        empleado_id: $('#empleado').val(),
        dia: $('#dia').val(),
        fecha: $('#fecha').val(),
        cantidad: $('#cantidad').val(),
        total: $('#total').val()
    };
    
    if (!validarPrestamo(prestamoData)) return;
    
    $.ajax({
        url: '../../php/prestamosCRUD.php?action=update',
        type: 'POST',
        data: prestamoData,
        success: function(response) {
            alert(response.message);
            limpiarFormulario();
            cargarPrestamos();
        },
        error: function(error) {
            console.error('Error al actualizar préstamo:', error);
        }
    });
}

function eliminarPrestamo(id) {
    if (confirm('¿Está seguro de eliminar este préstamo?')) {
        $.ajax({
            url: `../../php/prestamosCRUD.php?action=delete&id=${id}`,
            type: 'POST',
            success: function(response) {
                alert(response.message);
                cargarPrestamos();
            },
            error: function(error) {
                console.error('Error al eliminar préstamo:', error);
            }
        });
    }
}

function filtrarPrestamos() {
    const termino = $('#buscarPrestamo').val().toLowerCase();
    const empleadoId = $('#filtroEmpleado').val();
    
    $('#tablaPrestamos tbody tr').each(function() {
        const textoFila = $(this).text().toLowerCase();
        const filaEmpleadoId = $(this).find('td:first').text();
        
        const coincideTexto = termino === '' || textoFila.includes(termino);
        const coincideEmpleado = empleadoId === '' || $(this).data('empleado-id') == empleadoId;
        
        $(this).toggle(coincideTexto && coincideEmpleado);
    });
}

function validarPrestamo(data) {
    if (!data.empleado_id) {
        alert('Seleccione un empleado');
        return false;
    }
    
    if (!data.cantidad || parseFloat(data.cantidad) <= 0) {
        alert('Ingrese una cantidad válida');
        return false;
    }
    
    return true;
}

function limpiarFormulario() {
    $('#empleado').val('');
    $('#dia').val('Lunes');
    $('#fecha').val(new Date().toISOString().split('T')[0]);
    $('#cantidad').val('');
    $('#total').val('');
    
    $('#btnGuardar').show();
    $('#btnEditar').hide().prop('disabled', true);
}