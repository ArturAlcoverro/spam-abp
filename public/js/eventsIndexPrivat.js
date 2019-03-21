$(document).ready(function(){
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

        $(".toolbar .btn").prependTo(".dt-buttons");
        $('.buttons-copy').attr('title',"Copiar")
    });
});
