

function init(selectedNav){

    var options = opcions(selectedNav);

    consultarDataApi(options);

}
function llistaCharts(){

    var llista = consultarLlistaApi();
    creaLlista(llista);

}


//consulta la data allotjada a la nav per construir el grafic
function opcions(selectedNav){
    var nav = $('#' + selectedNav);
    var valores = [nav.data('fechaInit'), nav.data('fechaFin')]

    var options =
      {"optionsChart":{
        title:{
          display: true,
          text: nav.text()
        },
        legend:{
          display:true,
          position:'bottom',
          labels:{
            fontColor:'#000'
          }
        },
        tooltips:{
          enabled:true
        }
      },
      "tipo":nav.data('tipo'),
      "paramsApi":nav.data(),
      "id":nav.data('id')
    };
      return options;
}
//crea una un menu amb les grafiques disponibles, els tabs  i ells canvas per morstrar grafics corresponents.
function creaLlista(llista){

  //,"tema":"dades"}
    llista.Lista.forEach(g => {
        var nav = $('<a>').attr('id', 'nav' + g.id)
                             .data('id', g.id)
                             .data('nombre', g.nombre)
                             .data('tipo', g.tipo_grafico)
                             .data('fechaInit',g.data_init)
                             .data('fechaFin', g.data_fin)
                             .data('tipo_data', g.tipo_data)
                             .data('intervalo', g.intervalo)
                             .data('magnitud_intervalo',g.magnitud_intervalo)
                             .data('tipos_donacion', g.tipos_donacion)
                             .data('origen', g.origen)
                             .data('desti', g.desti)
                             .data('animales', g.animales)
                             .data('mostrar_valor',g.mostrar_valor)
                             .data('ordenar',g.ordenar)
                             .data('tema',g.tema)
                             .data('objetivos', g.objetivos)
                             .text(g.nombre)
                             .addClass('nav-link')
                             .data('toggle', 'pill')
                             .attr('href', "#tab" + g.id)
                             .attr('role', 'tab')
                             .attr('aria-controls', "tab" + g.id)
                             .attr('aria-selected','false');

        nav.appendTo('#llistaOpcions');

        var tab = $('<div>').attr('id', 'tab' + g.id)
                               .addClass('tab-pane fade')
                               .attr('role','tabpanel')
                               .attr('aria-labelledby', 'nav' + g.id);
        tab.appendTo('#tabsGrafiques');

        var grafic = $('<canvas>').attr('id', 'chart' + g.id);

        grafic.appendTo('#tab' + g.id);

    });

    $('#llistaOpcions').children().eq(0).addClass('active')
                                        .attr('aria-selected','true');
    $('#tabsGrafiques').children().eq(0).addClass('show active');


}

function consultarLlistaApi(){
  var llista = {"Lista":[]};
  $.ajax({
    url: "api/grafico",
    type: "GET",
    dataType: 'json',
    async: false,
    data: {
    },
    beforeSend: function () { },
    error: function (resp) {
        toast(resp.responseJSON.error, 5000);
    },
    success: function (resp) {

        llista.Lista = resp['data'];
    }
});
    return llista;
}
function consultarDataApi(options){
    var params = options.paramsApi;
    var data;
    var apiTipos = params.tipos_donacion.replace(',','-')
    if (params.tema == "comparativa"){
        var fechasI = new Array();
        var fechasF = new Array();
        fechasI = params.fechaInit.split(",");
        fechasF = params.fechaFin.split(",");

    }else{
        if(params.tipo_data == "dinamic"){
            var intervalo;
            var hoy = new Date();
            var data1;
            var data2;
            switch(params.magnitud_intervalo) {
                case "aaaa":
                    intervalo = params.intervalo * 365;
                  break;
                case "mm":
                    intervalo = params.intervalo * 30;
                  break;
                case "dd":
                    intervalo = params.intervalo;
                  break;
            }

            data2 = hoy.getFullYear() + '-' + (hoy.getMonth()+1) + '-' + (hoy.getDate()+ 1);
            hoy.setDate(hoy.getDate()-intervalo);
            data1 = hoy.getFullYear() + '-' + (hoy.getMonth()+1) + '-' + hoy.getDate();

            $.ajax({
                //DonatiusByData($dataInici, $dataFi, $tipos, $subtipo, $ordenar, $poblacio, $origen, $desti, $animal, $valor)
                // url:"htwww.abp-politecnics.com/2019/daw/projecte02/dw01/spam-abp/public/api/estadisticas/donativos/2019-2-11/2019-4-11",
                url: "api/estadisticas/donativos/" + data1 + "/" + data2 + "/" + params.tipos_donacion + "/" + 0 + "/" + params.ordenar + "/" + 0
                    + "/" + params.origen + "/" + params.desti + "/" + params.animales + "/" + params.mostrar_valor,
                type: "GET",
                dataType: 'json',
                async: true,
                data: {
                },
                beforeSend: function () { },
                error: function (resp) {
                alert(resp.responseJSON.error);
                   toast(resp.responseJSON.message + "line" + resp.responseJSON.line, 5000);
                },
                success: function (resp) {
                    data = dataSets(resp['data'], params);
                    createChart(options.tipo, data, options.optionsChart, options.id);
                }
            });
        }
    }
}
//retorna els dataserts usats als charts
function dataSets(dataApi,params){


    //http://localhost:8080/spam-abp/public/api/estadisticas/donativos/0000-00-00/2019-12-31
    // .data('id', g.id)
    // .data('nombre', g.nombre)
    // .data('tipo', g.tipo_grafico)
    // .data('fechaInit',g.data_init)
    // .data('fechaFin', g.data_fin)
    // .data('tipo_data', g.tipo_data)
    // .data('intervalo', g.intervalo)
    // .data('tipos_donacion', g.tipos_donacion)
    // .data('centro', g.centro)
    // .data('animales', g.animales)
    // .data('mostrar_valor',g.mostrar_valor)
    // .data('ordenar',g.ordenar)
    // .data('tema',g.tema)
//     $('#nav6').data(): Object
// animales: "all"
// centro: "5"
// fechaFin: null
// fechaInit: null
// id: 6
// intervalo: "30dd"
// mostrar_valor: "cash"
// nombre: "aiosfaskldfa"
// objetivos: null
// ordenar: "tipus"
// tema: "dades"
// tipo: "bar"
// tipo_data: "dinamic"
// tipos_donacion: "Menjar,Veterinaria,Oficines"
    // var ordenar = "tipus"
    // var tipos = new Array();
    // tipos = params.tipos_donacion.split(',');
    var datasets = [];
    var dataset;
    // var labels = tipos;
    // var donatius = [];

    // $.each(tipos, function(ii,t){
    //     var donatiu = 0;
    //     $.each(dataApi,function(i,d){
    //       if (t == d.subtipo.tipo.nombre){
    //           donatiu = donatiu + d.coste;
    //       }
    //     });
    //     donatius.push(donatiu);
    // });
    dataset = {
        label:'Donacions',
        data:dataApi['data'],
        //backgroundColor:'green',
        backgroundColor:[
          'rgba(255, 99, 132, 0.6)',
          'rgba(54, 162, 235, 0.6)',
          'rgba(255, 206, 86, 0.6)',
          'rgba(123, 31, 255, 0.6)',
          'rgba(222, 11, 145, 0.6)',
          'rgba(75, 192, 192, 0.6)'
        ],
        borderWidth:1,
        borderColor:'#777',
        hoverBorderWidth:2,
        hoverBorderColor:'#777'
    };
    datasets.push(dataset);

    if(params.tema == "objectiu"){
        var objectius = new Array();
        objectius = params.objetivos.split(',');
        // $.each(tipos, function(ii,t){
        //     var donatiu = objectius[ii];
        //     donatius.push(donatiu);
        // });
        dataset = {
            label:'Objectius',
            data:objectius,
            //backgroundColor:'green',
            backgroundColor:[
                'rgba(255, 99, 132, 0.6)',
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 206, 86, 0.6)',
                'rgba(123, 31, 255, 0.6)',
                'rgba(222, 11, 145, 0.6)',
                'rgba(75, 192, 192, 0.6)'
            ],
            borderWidth:1,
            borderColor:'#777',
            hoverBorderWidth:2,
            hoverBorderColor:'#777'
        };
        datasets.push(dataset);
    }

    var data = {
        labels:dataApi['labels'],
        datasets:datasets
      };
    return data;
}
// crea un gràfic a aprtir dels parametres proporcionats
function createChart(type, data, options, id){
    var myChart = $('#chart' + id)[0].getContext('2d');

    // Global Options
    // Chart.defaults.global.defaultFontFamily = 'Lato';
    // Chart.defaults.global.defaultFontSize = 18;
    // Chart.defaults.global.defaultFontColor = '#777';

    var massPopChart = new Chart(myChart, {
      type: type, // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data: data,
      options: options
    });
}
