

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
    llista.Lista.forEach(g => {
        var nav = $('<a>').attr('id', 'nav' + g.id)
                             .data('id', g.id)
                             .data('nombre', g.nombre)
                             .data('tipo', g.tipo)
                             .data('fechaInit',g.fechaInit)
                             .data('fechaFin', g.fechaFin)
                             .data('token', g.token)
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
    var llista = {"Lista":[
        {"id":1,"tipo":"bar","nombre":"General", "fechaInit":"2019-01-01", "fechaFin":"2019-01-30", "token":34582374058972},
        {"id":2,"tipo":"pie","nombre":"Comida", "fechaInit":"2019-02-01", "fechaFin":"2019-03-02", "token":34544474058972},
        {"id":3,"tipo":"line","nombre":"Otros", "fechaInit":"2019-03-01", "fechaFin":"2019-03-30", "token":34582374333972}
    ]};

    return llista;
}

//retorna els dataserts usats als charts
function consultarDataApi(params){
    //data provisional de proba hardcoded
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
