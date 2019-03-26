$(document).ready(function () {
    $('#table').DataTable({
        dom: 'Blprtip',
        select: true,
        buttons: [
            {
                title: 'Donacions',
                extend: 'copy',
                text: "",
            },
            {
                title: 'Donacions',
                extend: 'excel',
                text: "",
            },
            {
                title: 'Donacions',
                extend: 'pdf',
                text: "",
            },
            {
                title: 'Donacions',
                extend: 'print',
                text: "",
            },
        ],
        language: {
            lengthMenu: "Muestra _MENU_ registros",
            info: "Mostrando _START_ al _END_ de _TOTAL_ registros",
            paginate: {
                first: "Primero",
                last: "Ultimo",
                next: "Siguiente",
                previous: "Anterior"
            },
        }
    });

    $(".toolbar .btn").prependTo(".dt-buttons");
    // $(".toolbar-append .btn").appendTo(".dt-buttons");

});





