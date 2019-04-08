$(document).ready(function () {

    // var date = Date();

    // $('#fechaInicio').val(date.getFullYear + "-" + date.getMonth + "-" + date.getDate);
    // $('#fechaFinal').val(date.getFullYear + "-" + date.getMonth + "-" + date.getDate);

    indexDonaciones();
});

function indexDonaciones() {
    $.ajax({
        url: "http://localhost:8080/spam-abp/public/api/donations",
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
                    data['subtipo']['tipos_id'],
                    data['subtipo']['tipo']['nombre'],
                    data['subtipos_id'],
                    data['subtipo']['nombre'],
                    data['centros_receptor_id'],
                    data['centro_receptor']['nombre'],
                    data['centros_desti_id'],
                    data['centro_desti']['nombre'],
                    data['donante']['cif'],
                    data['coste'],
                    data['fecha_donativo']
                ]).draw();
            });
        }
    });
}

function deleteDonacion() {

    var rows = $("#table").DataTable().rows('.selected').data();

    for (var i = 0; i < rows.length; i++) {

        $.ajax({
            url: "http://localhost:8080/spam-abp/public/api/donations/" + rows[i][0],
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
                indexDonaciones();
            }
        });
    }
}

function editDonacion() {

    var row = $("#table").DataTable().row('.selected').data();

    var id = row[0];

    $('#form_edit').attr('action', "http://localhost:8080/spam-abp/public/donations/" + id + "/edit");
    $('#form_edit').submit();
}

function filtrar() {

    var fechaInicio = $('#fechaInicio').val();
    var fechaFinal = $('#fechaFinal').val();

    $.ajax({
        url: "http://localhost:8080/spam-abp/public/api/filtro/"+ fechaInicio + "/" + fechaFinal,
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
                    data['subtipo']['tipos_id'],
                    data['subtipo']['tipo']['nombre'],
                    data['subtipos_id'],
                    data['subtipo']['nombre'],
                    data['centros_receptor_id'],
                    data['centro_receptor']['nombre'],
                    data['centros_desti_id'],
                    data['centro_desti']['nombre'],
                    data['donante']['cif'],
                    data['coste'],
                    data['fecha_donativo']
                ]).draw();
            });

            $("#table").DataTable().column(1).search($('#tipos').val()  )
                .column(3).search($('#subtipos').val())
                .column(5).search($('#centrosReceptores').val())
                .column(7).search($('#centrosDestino').val())
                .column(9).search($('#dni').val())
                .draw();
        }
    });
}
