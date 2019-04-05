$(document).ready(function(){
    $('#btnDades').click(function () {
        //objectipus
        $('#modalGrafic').modal();
        $('#lblvalor').text('Valor a mostrar');
        $('#objectiu').hide();

    });
    $('#btnComp').click(function () {
        $('#modalGrafic').modal();
        //objectipus
        $('#modalGrafic').modal();
        $('#lblvalor').text('Valor a mostrar');
        $('#objectiu').hide();
        
    });
    $('#btnObj').click(function () {
        $('#modalGrafic').modal();
        //objectipus
        $('#modalGrafic').modal();
        $('#lblvalor').text('Objectiu');
        $('#objectiu').show();
    });

    
});