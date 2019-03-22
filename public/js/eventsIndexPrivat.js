    $(document).ready(function () {
        $('#table').DataTable({
            dom: 'Blrtip',
            buttons: [
                {
                    extend: 'copy',
                    text:"",
                    title:"Donacions"
                },
                {
                    extend: 'excel',
                    text:"",
                    title:"Donacions"
                },
                {
                    extend: 'pdf',
                    text:"",
                    title:"Donacions"
                },
                {
                    extend: 'print',
                    text:"",
                    title:"Donacions"
                },
            ],
            select: true,
        });

        $(".toolbar-prepend .btn").prependTo(".dt-buttons");
        $(".toolbar-append .btn").appendTo(".dt-buttons");

    });

