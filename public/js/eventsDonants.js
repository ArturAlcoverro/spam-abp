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
        success: function (resp) {

            y = resp;

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

    var row = $("#table").DataTable().row('.selected').data();

    var id = row[0];

    $.ajax({
        url: "http://localhost:8080/spam-abp/public/api/donants/" + id,
        type: "DELETE",
        dataType: 'json',
        async: true,
        data: {
        },
        error: function (resp) {

            // $('#info').text("Error al eliminar el registro");

            toast("Error",2000);
        },
        beforeSend: function () {},
        success: function (resp) {

            indexDonants();
            // $('#info').text("Registro eliminado");
        }
    });
}

function editDonant() {

    var row = $("#table").DataTable().row('.selected').data();

    var id = row[0];

    $('#form_edit').attr('action', "http://localhost:8080/spam-abp/public/donants/" + id + "/edit");
    $('#form_edit').submit();
}

$('#tipos_donante').change(function () {

    var type = $(this).find("option:selected").val();

    switch(type){

        case "1":

            $('#row-vinculo').show();
            $('#row-sexo').hide();

        break;

        case "2":

            $('#row-vinculo').hide();
            $('#row-sexo').show();

        break;
    }
});


