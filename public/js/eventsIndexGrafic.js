$(document).ready(function () {

    $('#table').DataTable({
        responsive: true,
        dom: 'Blprtip',
        select: true,
        buttons: [
            {
                title: 'Gráfics',
                extend: 'copy',
                text: "",
            },
            {
                title: 'Gráfics',
                extend: 'excel',
                text: "",
            },
            {
                title: 'Gráfics',
                extend: 'pdf',
                text: "",
            },
            {
                title: 'Gráfics',
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
            select: {
                rows: {
                    _: "%d files seleccionades",
                    1: "1 fila seleccionada"
                }
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
            },

        ]
    });

    $(".toolbar .btn").prependTo(".dt-buttons");
    // $(".toolbar-append .btn").appendTo(".dt-buttons");

    var fechaInicio = new Date();
    var fechaFinal = new Date();

    fechaFinal.setMonth(fechaFinal.getMonth() - 3);

    var day = ("0" + fechaInicio.getDate()).slice(-2);
    var month = ("0" + (fechaInicio.getMonth() + 1)).slice(-2);
    var month2 = ("0" + (fechaFinal.getMonth() + 1)).slice(-2);

    var today = fechaInicio.getFullYear() + "-" + (month) + "-" + (day);
    var today2 = fechaFinal.getFullYear() + "-" + (month2) + "-" + (day);

    $('#fechaInicio').val(today2);
    $('#fechaFinal').val(today);

    indexGrafics();
});

function indexGrafics() {
    $.ajax({
        url: "api/grafico",
        type: "GET",
        dataType: 'json',
        async: true,
        data: {
        },
        beforeSend: function () { },
        error: function (resp) {
            toast(resp.responseJSON.error, 5000);
        },
        success: function (resp) {

            $("#table").DataTable().clear().draw();

            resp['data'].forEach(function (data) {
                var a;
                if (data['animales'] === 0){
                    a = "tots";
                }else{


                }

                $("#table").DataTable().row.add([
                    data['id'],
                    data['nombre'],
                    data['tema'].charAt(0).toUpperCase() + data['tema'].slice(1),
                    data['tipos_donacion'],
                    data['origen'],
                    data['desti'],
                    data['animales'],
                    data['ordenar'].charAt(0).toUpperCase() + data['ordenar'].slice(1),
                    data['publica'] == 1 ? 'Si' : 'No',

                ]).draw();
            });
        }
    });
}

function deleteDonacion() {
    var rows = $("#table").DataTable().rows('.selected').data();

    if (rows.length == 0) {
        toast('Para eliminar tienes que seleccionar UN registro', 2000);
    } else {

        for (var i = 0; i < rows.length; i++) {

            $.ajax({
                url: "api/grafics/" + rows[i][0],
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
                    indexDonaciones();
                }
            });
        }
    }
}

function editDonacion() {

    var rows = $("#table").DataTable().rows('.selected').data();

    if (rows.length != 1) {
        toast('Para editar tienes que seleccionar UN registro', 2000);
    }
    else {
        var id = rows[0][0];

        $('#form_edit').attr('action', "donations/" + id + "/edit");
        $('#form_edit').submit();
    }
}

// function filtrar() {

//     var fechaInicio = $('#fechaInicio').val();
//     var fechaFinal = $('#fechaFinal').val();

//     console.log("inicio");
//     console.log($('#fechaInicio').val());
//     console.log("final");
//     console.log($('#fechaFinal').val());

//     $.ajax({
//         url: "http://localhost:8080/spam-abp/public/api/filtro/" + fechaInicio + "/" + fechaFinal,
//         type: "GET",
//         dataType: 'json',
//         async: true,
//         data: {
//         },
//         beforeSend: function () { },
//         error: function (resp) {
//             toast(resp.responseJSON.error, 5000);
//         },
//         success: function (resp) {

//             $("#table").DataTable().clear().draw();

//             resp['data'].forEach(function (data) {
//                 $("#table").DataTable().row.add([
//                     data['id'],
//                     data['subtipo']['tipos_id'],
//                     data['subtipo']['tipo']['nombre'],
//                     data['subtipos_id'],
//                     data['subtipo']['nombre'],
//                     data['centros_receptor_id'],
//                     data['centro_receptor']['nombre'],
//                     data['centros_desti_id'],
//                     data['centro_desti']['nombre'],
//                     data['donante']['cif'],
//                     data['coste'],
//                     data['fecha_donativo']
//                 ]).draw();
//             });

//             $("#table").DataTable().column(1).search($('#tipos').val())
//                 .column(3).search($('#subtipos').val())
//                 .column(5).search($('#centrosReceptores').val())
//                 .column(7).search($('#centrosDestino').val())
//                 .column(9).search($('#dni').val())
//                 .draw();
//         }
//     });
// }
