

function init(selectedNav){

    var options = opcions(selectedNav);

    var data = consultarDataApi(options.paramsApi);

    createChart(options.tipo, data, options.optionsChart, options.id);

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
      "paramsApi":{"token":nav.data('token'), "valores": valores},
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
                             .data('tipos_donacion', g.tipos_donacion)
                             .data('centro', g.centro)
                             .data('animales', g.animales)
                             .data('mostrar_valor',g.mostrar_valor)
                             .data('ordenar',g.ordenar)
                             .data('tema',g.tema)
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
    url: "http://localhost:8080/spam-abp/public/api/grafico",
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

//retorna els dataserts usats als charts
function consultarDataApi(params){
    //data provisional de proba hardcoded

    //http://localhost:8080/spam-abp/public/api/estadisticas/donativos/0000-00-00/2019-12-31
    var data = {
        labels:['Mejnar', 'Medicina', 'Higiene', 'Altres'],
        datasets:[{
          label:'Donacions',
          data:[
            617594,
            181045,
            153060,
            106519
          ],
          //backgroundColor:'green',
          backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:2,
          hoverBorderColor:'#777'
        },
        {
          label:'Objectius',
          data:[
            817894,
            381765,
            650000,
            206959
          ],
          //backgroundColor:'green',
          backgroundColor:[
            'rgba(000, 000, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)'
          ],
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#00000038'
        }

      ]
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
