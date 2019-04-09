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

        oTipoData();
    });

    // $(".tipo_donacion").change(function () {

    //     if ($(".tipo_donacion:checked").length == 1){
    //         setSubtipos($(this).data("id"));
    //     }
    //     else{
    //         $('#subtipo_donacion').append('<option value="-1" selected></option>')
    //         .prop( "disabled", true );
    //     }


    // });

    $('#dTipoData').change(function(){
        dTipoData();
    });
    $('#oTipoData').change(function(){
        oTipoData();
    });





});
