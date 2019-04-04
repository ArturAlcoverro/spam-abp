var y;

$(document).ready(function () {

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
        success: function (resp) {

            y = resp;

            $("#table").DataTable().clear().draw();

            resp['data'].forEach(function(data) {
                $("#table").DataTable().row.add([
                    data['id'],
                    data['nombre_usuario'],
                    data['correo'],
                    data['nombre'],
                    data['roles_id']
                ]).draw();
            });
        }
    });
}

function deleteUsuario() {

    var row = $("#table").DataTable().row('.selected').data();

    var id = row[0];
    $.ajax({
        url: "http://localhost:8080/spam-abp/public/api/users/" + id,
        type: "DELETE",
        dataType: 'json',
        async: true,
        data: {
        },
        error: function (resp) {

            // $('#info').text("Error al eliminar el registro");
            toast("Error", 2000);
        },
        beforeSend: function () {},
        success: function (resp) {

            indexUsers();
            // $('#info').text("Registro eliminado");
        }
    });
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

