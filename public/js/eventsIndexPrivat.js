    $(document).ready(function () {
        cargarTabla(10);

        $(".toolbar .btn").prependTo(".dt-buttons");
        // $(".toolbar-append .btn").appendTo(".dt-buttons");

        // $(".dataTables_length label").prependTo(".dataTables_paginate");
        $(".dataTables_length select").change(function(){
            $(this).parent().prependTo(".dataTables_paginate");
        });

    });

    function cargarTabla(len){
        $('#table').DataTable({
            pageLength: len,
            dom: 'Bprtip',
            buttons: [
                {
                    extend: 'copy',
                    text:"",
                },
                {
                    extend: 'excel',
                    text:"",
                },
                {
                    extend: 'pdf',
                    text:"",
                },
                {
                    extend: 'print',
                    text:"",
                },
            ],
            select: true,
        });

        $select = $("<select>");
        $select.attr('id', 'table-length');
        $select.append($('<option value="10">10</option>'));
        $select.append($('<option value="25">25</option>'));
        $select.append($('<option value="50">50</option>'));
        $select.append($('<option value="100">100</option>'));
        $(".dataTables_paginate").prepend($select);
        $('#table-length').change(function(){
            len = parseInt($(this).val());
            cargarTabla(len);
        });
    }

