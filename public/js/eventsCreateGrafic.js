$(document).ready(function(){
    $('#btnDades').click(function () {

        $('#modalGraficDades').modal();
        dTipoData();

    });
    $('#btnComp').click(function () {

        $('#modalGraficComparativa').modal();


    });
    $('#btnObj').click(function () {

        $('#modalGraficObjectius').modal();

        $(".tipo_donacion").each(function(){
            if($(this).prop('checked')){
                $('#objectiu' + $(this).data("tipo")).prop( "disabled", false );
            }else{
                $('#objectiu' + $(this).data("tipo")).prop( "disabled", true );
            }
        });

        oTipoData();
    });

    $(".tipo_donacion").change(function () {


        if($(this).prop('checked')){
            $('#objectiu' + $(this).data("tipo")).prop( "disabled", false );
        }else{
            $('#objectiu' + $(this).data("tipo")).val(null)
                                                 .prop( "disabled", true );
        }
    });

    $('#dTipoData').change(function(){
        dTipoData();
    });
    $('#oTipoData').change(function(){
        oTipoData();
    });





});
