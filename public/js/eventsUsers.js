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

                toast("Error",2000);
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

