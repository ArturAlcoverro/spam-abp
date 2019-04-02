


$(document).ready(function(){
   // tests charts hardcoded

    llistaCharts();

    $('#llistaOpcions').find('a').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
        init($(this)[0].id);

    });


    // inicialitza el chart default

    init($('#llistaOpcions').children().eq(0).attr('id'));


});
