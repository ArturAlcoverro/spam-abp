$(document).ready(function () {

    indexDonants();
});

function indexDonants() {
    $.ajax({
        url: "http://localhost:8080/spam-abp/public/api/donants",
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
                    data['cif'],
                    data['tipo_donante']['tipo'],
                    data['correo'],
                    data['pais']
                ]).draw();
            });
        }
    });
}

function deleteDonant() {

    var rows = $("#table").DataTable().rows('.selected').data();

    for (var i = 0; i < rows.length; i++) {

        $.ajax({
            url: "http://localhost:8080/spam-abp/public/api/donants/" + rows[i][0],
            type: "DELETE",
            dataType: 'json',
            async: true,
            data: {
            },
            error: function (resp) {


                //resp.status
                //resp.responseJSON.error


                toast(resp.responseJSON.error,5000);
            },
            beforeSend: function () {},
            success: function (resp) {
                indexDonants();
            }
        });
    }
}

function editDonant() {

    var row = $("#table").DataTable().row('.selected').data();

    var id = row[0];

    $('#form_edit').attr('action', "http://localhost:8080/spam-abp/public/donants/" + id + "/edit");
    $('#form_edit').submit();
}
