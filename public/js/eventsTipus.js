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
        beforeSend: function () {},
        error : function (resp) {
            toast(resp.responseJSON.error,5000);
        },
        success: function (resp) {

            $("#table").DataTable().clear().draw();

            resp['data'].forEach(function(data) {
                $("#table").DataTable().row.add([
                    data['id'],
                    data['nombre'],
                ]).draw();
            });
        }
    });
}

function deleteTipus() {

    var rows = $("#table").DataTable().rows('.selected').data();

    for (var i = 0; i < rows.length; i++) {

        $.ajax({
            url: "api/tipos/" + rows[i][0],
            type: "DELETE",
            dataType: 'json',
            async: true,
            data: {
            },
            error: function (resp) {
                toast(resp.responseJSON.error,5000);
            },
            beforeSend: function () {},
            success: function (resp) {
                indexTipus();
            }
        });
    }
}

function openEdit() {

    var row = $("#table").DataTable().row('.selected').data();

    if(row != undefined){

        $("#editNombre").val(row[1]);

        $("#edit-modal").modal();
    }
}

function editTipus() {

    var row = $("#table").DataTable().row('.selected').data();

    var id = row[0];

    $.ajax({
        url: "api/tipos/" + id,
        type: "PUT",
        dataType: 'json',
        async: true,
        data: {
            "nombre": $("#editNombre").val()
        },
        error: function (resp) {
            toast(resp.responseJSON.error,5000);
        },
        beforeSend: function () {},
        success: function (resp) {
            indexTipus();
        }
    });
}

function addTipus() {

    $.ajax({
        url: "api/tipos",
        type: "POST",
        dataType: 'json',
        async: true,
        data: {
            "nombre" : $("#addNombre").val()
        },
        error: function (resp) {
            toast(resp.responseJSON.error,5000);
        },
        beforeSend: function () {},
        success: function (resp) {

            console.log("succces");

            indexTipus();
        }
    });
}
