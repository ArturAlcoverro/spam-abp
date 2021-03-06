var donacionsEnviades;
var donacionsRebudes;

$(document).ready(function () {

    $('#table').DataTable({
        responsive: true,
        dom: 'Blprtip',
        select: true,
        buttons: [
            {
                title: 'Tipus',
                extend: 'copy',
                text: "",
            },
            {
                title: 'Tipus',
                extend: 'excel',
                text: "",
            },
            {
                title: 'Tipus',
                extend: 'pdf',
                text: "",
            },
            {
                title: 'Tipus',
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
                    _: '%d tipus copiades',
                    1: '1 tipus copiada'
                }
            }
        },
        // columnDefs: [
        //     {
        //         targets: [0],
        //         visible: false,
        //         searchable: false
        //     }]
    });

    $(".toolbar .btn").prependTo(".dt-buttons");
    // $(".toolbar-append .btn").appendTo(".dt-buttons");

    indexTipus();
});

function indexTipus() {
    $.ajax({
        url: "api/tipos",
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
                    data['nombre'],
                ]).draw();
            });
            $('.unable').hide();
            $("#table").DataTable().columns.adjust();
            $("#table").DataTable().responsive.recalc();
        }
    });
}

function deleteTipus() {
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
                    url: "api/tipos/" + rows[i][0],
                    type: "DELETE",
                    dataType: 'json',
                    async: true,
                    data: {
                    },
                    error: function (resp) {
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
                            indexTipus();
                        }
                    }
                });
            }
        });
    }
}

function openEdit() {

    var rows = $("#table").DataTable().rows('.selected').data();

    if (rows.length != 1) {
        toast('Para editar tienes que seleccionar UN registro', 2000);
    } else {
        $("#editNombre").val(rows[0][1]);
        $("#edit-modal").modal();
    }
}

function editTipus() {
    var row = $("#table").DataTable().row('.selected').data();
    var id = row[0];

    $('.unable').show();

    $.ajax({
        url: "api/tipos/" + id,
        type: "PUT",
        dataType: 'json',
        async: true,
        data: {
            "nombre": $("#editNombre").val()
        },
        error: function (resp) {
            toast(resp.responseJSON.error, 5000);
            $('.unable').hide();
        },
        beforeSend: function () { },
        success: function (resp) {
            indexTipus();
        }
    });
}

function addTipus() {

    $('.unable').show();

    $.ajax({
        url: "api/tipos",
        type: "POST",
        dataType: 'json',
        async: true,
        data: {
            "nombre": $("#addNombre").val()
        },
        error: function (resp) {
            toast(resp.responseJSON.error, 5000);
            $('.unable').hide();
        },
        beforeSend: function () { },
        success: function (resp) {

            console.log("succces");

            indexTipus();
        }
    });
}
