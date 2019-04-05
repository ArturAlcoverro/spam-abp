var x;

$(document).ready(function () {

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

            x=resp;

            $("#table").DataTable().clear().draw();

            resp['data'].forEach(function(data) {
                $("#table").DataTable().row.add([
                    data['id'],
                    data['subtipo']['tipo']['nombre'],
                    data['subtipo']['nombre'],
                    data['centro_receptor']['nombre'],
                    data['centro_desti']['nombre'],
                    data['donante']['cif'],
                    data['coste'],
                    data['fecha_donativo']
                ]).draw();
            });
        }
    });
}

function filtrar() {

    var date = $('#fecha').val();

    $.ajax({
        url: "http://localhost:8080/spam-abp/public/api/filtro/"+ date,
        type: "GET",
        dataType: 'json',
        async: true,
        data: {
        },
        beforeSend: function () {},
        success: function (resp) {

            x = resp;

            $("#table").DataTable().clear().draw();

            resp['data'].forEach(function(data) {
                $("#table").DataTable().row.add([
                    data['id'],
                    data['subtipo']['tipo']['nombre'],
                    data['subtipo']['nombre'],
                    data['centro_receptor']['nombre'],
                    data['centro_desti']['nombre'],
                    data['donante']['cif'],
                    data['coste'],
                    data['fecha_donativo']
                ]).draw();
            });



            // var data1 = $("#table").DataTable()
            // .column(1)
            // .search()
            // .data()
            // .filter(function (value, index) {
            //     return value > 20 ? true : false;
            // });


            // var data1 = $("#table").DataTable()
            // .column( 0 )
            //     .data()
            //         .filter( function ( value, index ) {



            //         });


        }
    });


}
