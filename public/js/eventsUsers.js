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



    indexUsers();
});

function indexUsers() {
    $.ajax({
        url: "http://localhost:8080/spam-abp/public/api/users",
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
                    data['nombre_usuario'],
                    data['correo'],
                    data['nombre'],
                    data['rol']['rol']
                ]).draw();
            });
        }
    });
}

function deleteUsuario() {

    var rows = $("#table").DataTable().rows('.selected').data();

    for (var i = 0; i < rows.length; i++) {

        $.ajax({
            url: "http://localhost:8080/spam-abp/public/api/users/" + rows[i][0],
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
                indexUsers();
            }
        });
    }
}

function editUser() {

    var row = $("#table").DataTable().row('.selected').data();

    var id = row[0];

    $('#form_edit').attr('action', "http://localhost:8080/spam-abp/public/users/" + id + "/edit");
    $('#form_edit').submit();
}

function changePassword() {
    $("#password").removeAttr('readonly');
}

