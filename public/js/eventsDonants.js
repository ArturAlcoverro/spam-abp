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
                searchable: false
            }]
    });

    $(".toolbar .btn").prependTo(".dt-buttons");
    // $(".toolbar-append .btn").appendTo(".dt-buttons");

    indexDonants();
});

function indexDonants() {
    $.ajax({
        url: "api/donants",
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

                var yesno;

                if (data['es_habitual'] == 0) {

                    yesno = "No";
                }
                else {
                    yesno = "Si";
                }

                $("#table").DataTable().row.add([
                    data['id'],
                    data['nombre'],
                    data['cif'],
                    data['tipo_donante']['tipo'],
                    data['correo'],
                    data['pais'],
                    yesno
                ]).draw();
            });
            $('.unable').hide();
            $("#table").DataTable().columns.adjust();
            $("#table").DataTable().responsive.recalc();
        }
    });
}

function deleteDonant() {
    var rows = $("#table").DataTable().rows('.selected').data();
    var msg;

    if (rows.length == 0) {
        toast('Para eliminar tienes que seleccionar UN registro', 2000);
    }
    else {
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
                    url: "api/donants/" + rows[i][0],
                    type: "DELETE",
                    dataType: 'json',
                    async: true,
                    data: {
                    },
                    error: function (resp) {
                        //resp.status
                        //resp.responseJSON.error
                        donacionsRebudes++;
                        toast(resp.responseJSON.error, 5000);
                        if (donacionsRebudes == donacionsEnviades) {
                            $('.unable').hide();
                        }
                    },
                    beforeSend: function () { },
                    success: function (resp) {
                        donacionsRebudes++;
                        if (donacionsRebudes == donacionsEnviades) {
                            indexDonants();
                        }
                    }
                });
            }
        });
    }
}

function editDonant() {

    var rows = $("#table").DataTable().rows('.selected').data();

    if (rows.length != 1) {
        toast('Para editar tienes que seleccionar UN registro', 2000);
    } else {
        var id = rows[0][0];

        $('#form_edit').attr('action', "donants/" + id + "/edit");
        $('#form_edit').submit();
    }
}

function msgAdmin() {
    toast('Eliminar no permitido, contacta con un administrador', 2000);
}
