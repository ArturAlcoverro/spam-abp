$(document).ready(function () {

    var fechaInicio = new Date();
    var fechaFinal = new Date();

    fechaFinal.setMonth(fechaFinal.getMonth() - 3);

    var day = ("0" + fechaInicio.getDate()).slice(-2);
    var month = ("0" + (fechaInicio.getMonth() + 1)).slice(-2);
    var month2 = ("0" + (fechaFinal.getMonth() + 1)).slice(-2);

    var today = fechaInicio.getFullYear()+"-"+(month)+"-"+(day);
    var today2 = fechaFinal.getFullYear()+"-"+(month2)+"-"+(day);

    $('#fechaInicio').val(today2);
    $('#fechaFinal').val(today);

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
        error : function (resp) {
            toast(resp.responseJSON.error,5000);
        },
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
            error : function (resp) {
                toast(resp.responseJSON.error,5000);
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

    console.log("inicio");
    console.log($('#fechaInicio').val());
    console.log("final");
    console.log($('#fechaFinal').val());

    $.ajax({
        url: "http://localhost:8080/spam-abp/public/api/filtro/"+ fechaInicio + "/" + fechaFinal,
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
