var donacionsEnviades;
var donacionsRebudes;

$(document).ready(function () {
    $('#table').DataTable({
        responsive: true,
        dom: 'Blprtip',
        select: true,
        buttons: [
            {
                title: 'Donacions',
                extend: 'copy',
                text: "",
            },
            {
                title: 'Donacions',
                extend: 'excel',
                text: "",
            },
            {
                title: 'Donacions',
                extend: 'pdf',
                text: "",
            },
            {
                title: 'Donacions',
                extend: 'print',
                text: "",
            },
        ],
        language: {
            sProcessing: "Processant...",
            sLengthMenu: "Mostra _MENU_ registres",
            sZeroRecords: "No s'han trobat registres.",
            sInfo: "Mostrant de _START_ a _END_ de _TOTAL_ registres",
            sInfoEmpty: "Mostrant de 0 a 0 de 0 registres",
            sInfoFiltered: "(filtrat de _MAX_ total registres)",
            sInfoPostFix: "",
            sSearch: "Filtrar:",
            sUrl: "",
            oPaginate: {
                sFirst: "Primer",
                sPrevious: "Anterior",
                sNext: "Següent",
                sLast: "Últim"
            },
            select: {
                rows: {
                    _: "%d files seleccionades",
                    1: "1 fila seleccionada"
                }
            },
            buttons: {
                copyTitle: 'Copiat al portapapers',
                copySuccess: {
                    _: '%d donacions copiades',
                    1: '1 donació copiada'
                }
            }
        },
        columnDefs: [
            {
                targets: [0],
                visible: false,
            },
            {
                targets: [1],
                visible: false,
            },
            {
                targets: [3],
                visible: false,
            },
            {
                targets: [5],
                visible: false,
            },
            {
                targets: [7],
                visible: false,
            },
            {
                targets: [15],
                visible: false,
            },
        ]
    });

    $(".toolbar .btn").prependTo(".dt-buttons");
    // $(".toolbar-append .btn").appendTo(".dt-buttons");

    var fechaInicio = new Date();
    var fechaFinal = new Date();

    fechaFinal.setMonth(fechaFinal.getMonth() - 3);

    var day = ("0" + fechaInicio.getDate()).slice(-2);
    var month = ("0" + (fechaInicio.getMonth() + 1)).slice(-2);
    var month2 = ("0" + (fechaFinal.getMonth() + 1)).slice(-2);

    var today = fechaInicio.getFullYear() + "-" + (month) + "-" + (day);
    var today2 = fechaFinal.getFullYear() + "-" + (month2) + "-" + (day);

    $('#fechaInicio').val(today2);
    $('#fechaFinal').val(today);

    $('#facturaButton').click(function (event) {
        descargarFactura(event);
    })

    indexDonaciones();
});

function indexDonaciones() {
    $.ajax({
        url: "api/donations",
        type: "GET",
        dataType: 'json',
        async: true,
        data: {
        },
        beforeSend: function () { },
        error: function (resp) {
            toast(resp.responseJSON.error, 5000);
        },
        success: function (resp) {

            $("#table").DataTable().clear().draw();

            resp['data'].forEach(function (data) {

                $("#table").DataTable().row.add([
                    data['id'],
                    data['subtipo']['tipos_id'],
                    data['subtipo']['tipo']['nombre'],
                    data['subtipos_id'],
                    data['subtipo']['nombre'],
                    data['centros_receptor_id'],
                    data['centro_receptor']['nombre'],
                    data['centros_desti_id'],
                    data['centro_desti']['nombre'],
                    data['donante']['cif'],
                    data['donante']['nombre'],
                    data['donante']['correo'],
                    data['coste'],
                    data['fecha_donativo'],
                    data['hay_factura'] == '0' ? 'Si' : 'No',
                    data['ruta_factura']
                ]).draw();
            });
            $('.unable').hide();
        }
    });
}

function deleteDonacion() {
    var rows = $("#table").DataTable().rows('.selected').data();
    var msg;

    if (rows.length == 0) {
        toast('Per eliminar has de seleccionar UN registre', 2000);
    } else {
        if (rows.length > 1) {
            msg = 'Se eliminaran ' + rows.length + ' registros';
        } else {
            msg = 'Se eliminara 1 registro';
        }
        alert('Estas seguro?', msg, function () {
            donacionsEnviades = rows.length;
            donacionsRebudes = 0;
            $('.unable').show();

            for (var i = 0; i < rows.length; i++) {
                $.ajax({
                    url: "api/donations/" + rows[i][0],
                    type: "DELETE",
                    dataType: 'json',
                    async: true,
                    data: {
                    },
                    error: function (jqXHR, exception) {
                        donacionsRebudes++;
                        console.log(jqXHR);
                        console.log(exception);
                        reload();
                        toast(exception.responseJSON.error, 5000);
                        if (donacionsRebudes == donacionsEnviades) {
                            $('.unable').hide();
                        }
                    },
                    beforeSend: function () { },
                    success: function (resp) {
                        donacionsRebudes++;
                        if (donacionsRebudes == donacionsEnviades) {
                            indexDonaciones();
                        }
                    }
                });
            }
        });
    }
}

function editDonacion() {

    var rows = $("#table").DataTable().rows('.selected').data();

    if (rows.length != 1) {
        toast('Per editar has de seleccionar UN registre', 2000);
    }
    else {
        var id = rows[0][0];

        $('#form_edit').attr('action', "donations/" + id + "/edit");
        $('#form_edit').submit();
    }
}

function descargarFactura(event) {
    var rows = $("#table").DataTable().rows('.selected').data();
    if (rows.length != 1) {
        toast('Seleccionar UN registre per descarregar la seva factura', 2000);
        event.preventDefault();
    }
    else if (rows[0][12] == 'No') {
        toast('Aquesta donació no te factura', 2000);
        event.preventDefault();
    }
    else {
        var ruta = rows[0][13];
        if (ruta != '') {
            $('#facturaButton').attr('href', asset + ruta);
        } else {
            toast('Error! Aquesta donació no te factura', 2000);
            event.preventDefault();
        }
    }
}


function filtrar() {

    var fechaInicio = $('#fechaInicio').val();
    var fechaFinal = $('#fechaFinal').val();

    $.ajax({
        url: "api/filtro/" + fechaInicio + "/" + fechaFinal,
        type: "GET",
        dataType: 'json',
        async: true,
        data: {
        },
        beforeSend: function () { },
        error: function (resp) {
            toast(resp.responseJSON.error, 5000);
        },
        success: function (resp) {

            $("#table").DataTable().clear().draw();

            resp['data'].forEach(function (data) {
                $("#table").DataTable().row.add([
                    data['id'],
                    data['subtipo']['tipos_id'],
                    data['subtipo']['tipo']['nombre'],
                    data['subtipos_id'],
                    data['subtipo']['nombre'],
                    data['centros_receptor_id'],
                    data['centro_receptor']['nombre'],
                    data['centros_desti_id'],
                    data['centro_desti']['nombre'],
                    data['donante']['cif'],
                    data['donante']['nombre'],
                    data['donante']['correo'],
                    data['coste'],
                    data['fecha_donativo'],
                    data['hay_factura'] == '0' ? 'Si' : 'No',
                    data['ruta_factura']
                ]).draw();
            });

            $("#table").DataTable().column(1).search($('#tipos').val())
                .column(3).search($('#subtipos').val())
                .column(5).search($('#centrosReceptores').val())
                .column(7).search($('#centrosDestino').val())
                .column(9).search($('#dni').val())
                .column(10).search($('#name').val())
                .column(11).search($('#email').val())
                .draw();
        }
    });
}

function msgAdmin() {
    toast('Eliminar no permitido, contacta con un administrador', 2000);
}
