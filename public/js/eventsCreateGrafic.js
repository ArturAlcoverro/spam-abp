$(document).ready(function(){
    $('#btnDades').click(function () {
        //objectipus
        $('#modalGraficDades').modal();
        if ($(".tipo_donacion:checked").length == 1){
            setSubtipos($(this).data("id"));
        }
        else{
            $('#subtipo_donacion').append('<option value="-1" selected></option>')
            .prop( "disabled", true );
        }
        tipoData();


    });
    $('#btnComp').click(function () {
        //objectipus
        $('#modalGraficComparativa').modal();
        if ($(".tipo_donacion:checked").length == 1){
            setSubtipos($(this).data("id"));
        }
        else{
            $('#subtipo_donacion').append('<option value="-1" selected></option>')
            .prop( "disabled", true );
        }


    });
    $('#btnObj').click(function () {

        //objectipus
        $('#modalGraficObjectius').modal();
        if ($(".tipo_donacion:checked").length == 1){
            setSubtipos($(this).data("id"));
        }
        else{
            $('#subtipo_donacion').append('<option value="-1" selected></option>')
            .prop( "disabled", true );
        }
        tipoData();
    });

    $(".tipo_donacion").change(function () {

        if ($(".tipo_donacion:checked").length == 1){
            setSubtipos($(this).data("id"));
        }
        else{
            $('#subtipo_donacion').append('<option value="-1" selected></option>')
            .prop( "disabled", true );
        }


    });

    $('#tipoData').change(function(){
        tipoData();
    });





});
