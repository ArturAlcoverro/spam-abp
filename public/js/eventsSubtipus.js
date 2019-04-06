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
                    data['tipo_unidad'],
                ]).draw();
            });
        }
    });
}

function editDonant() {

    var rows = $("#table").DataTable().rows('.selected').data();

    if (rows.length != 1) {
        toast('Per editar has de seleccionar UN registre', 2000);
    } else {
        var id = row[0];

        $('#form_edit').attr('action', document.URL + '/' + id + '/edit');
        $('#form_edit').submit();
    }
}
