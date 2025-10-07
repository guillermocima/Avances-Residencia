const ajaxPostControl = (urlDestino, divDestino, send, mensaje, ejecutar = '') => {
    document.getElementById(divDestino).style.display = "block";
    $("div#" + divDestino).html("<img src='img/loading.gif' width='10%'>");
    $.ajax({
            url: urlDestino,
            data: send,
            type: 'POST',
            cache: true,
            datatype: "json",
            success: function(respuesta) {
                $("#" + divDestino).fadeOut(300, function() {
                    $(this)
                        .html(respuesta)
                        .fadeIn(200);
                });
            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText + '\n' + jqXHR.status;
                }

                $("#" + divDestino).fadeOut(300, function() {
                    $(this)
                        .html('<h4><span class="iconp iconp-fa-frown-o"></span>' + msg + '</h4>')
                        .fadeIn(200);
                });
            }
        })
        .done(function(data) {

            var content = JSON.parse(JSON.stringify(data));
            if (content.success == true) {
                if (mensaje.length > 0) {
                    alertify.success(mensaje);
                }
                if (ejecutar.length > 0) {
                    setTimeout(ejecutar, 1);
                }
            }
            if (content.success == false) {
                alertify.error(content.mensaje);
            }
        });
}