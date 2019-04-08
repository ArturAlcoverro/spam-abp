$(document).ready(function () {
    indexSubtipus();
    console.log(window.location.pathname);
});

function indexSubtipus() {
    $.ajax({
        url: "http://localhost:8080/spam-abp/public/api/subtipos",
        type: "GET",
        dataType: 'json',
        async: true,
        data: {
        },
        beforeSend: function () { },
        success: function (resp) {

            console.log(resp);
            x = resp;

            $("#table").DataTable().clear().draw();

            resp['data'].forEach(function (data) {
                $("#table").DataTable().row.add([
                    data['id'],
                    data['nombre'],
                    data['tipo']['nombre'],
                    data['gama_alta'],
                    data['gama_media'],
                    data['gama_baja'],
                    data['tipo_unidad'],
                ]).draw();
            });
        }
    });
}

function editSubtipus() {

    var rows = $("#table").DataTable().rows('.selected').data();

    if (rows.length != 1) {
        toast('Per editar has de seleccionar UN registre', 2000);
    } else {
        var id = rows[0][0];

        $('#form_edit').attr('action', document.URL + '/' + id + '/edit');
        $('#form_edit').submit();
    }
}

function deleteSubtipus() {

    var rows = $("#table").DataTable().rows('.selected').data();

    if (rows.length == 0) {
        toast('Per eliminar has de seleccionar UN registre', 2000);
    }
    else {
        for (var i = 0; i < rows.length; i++) {

            $.ajax({
                url: "http://localhost:8080/spam-abp/public/api/subtipos/" + rows[i][0],
                type: "DELETE",
                dataType: 'json',
                async: true,
                data: {
                },
                error: function (resp) {
                    toast(resp.responseJSON.error, 5000);
                },
                beforeSend: function () { },
                success: function (resp) {
                    indexSubtipus();
                }
            });
        }
    }
}


