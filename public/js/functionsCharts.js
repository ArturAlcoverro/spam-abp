

function init(paramsApi, typeChart, optionsChart){

    var data = consultarDataApi(paramsApi);
    createChart(typeChart, data, optionsChart);

}
function llistaCharts(){

    var llista = consultarLlistaApi();
    creaLlista(llista);

}

function consultarOpcionsApi(){

    var options = {
        title:{
          display:true,
          text:'Donacions',
          fontSize:25
        },
        legend:{
          display:true,
          position:'bottom',
          labels:{
            fontColor:'#000'
          }
        },
        // layout:{
        //   padding:{
        //     left:0,
        //     right:0,
        //     bottom:0,
        //     top:0
        //   }
        // },
        tooltips:{
          enabled:true
        }
      };

      return options;
}
//crea una un menu amb les grafiques disponibles.
function creaLlista(llista){
    llista.Lista.forEach(g => {
        var nav = $('<a>').attr('id', 'nav' + g.id)
                             .data('tipo', g.tipo)
                             .data('fechaInit',g.fechaInit)
                             .data('fechaFin', g.fechaFin)
                             .text(g.nombre)
                             .addClass('nav-link')
                             .data('toggle', 'pill')
                             .attr('href', "#grid" + g.id)
                             .attr('role', 'tab')
                             .attr('aria-controls', "grid" + g.id)
                             .attr('aria-selected','false');

        nav.appendTo('#llistaOpcions');

        var grafic = $('<div>').attr('id', 'grid' + g.id)
                               .addClass('tab-pane fade')
                               .attr('role','tabpanel')
                               .attr('aria-labelledby', 'nav' + g.id);
        grafic.appendTo('#tabsGrafiques');
    });
    $('#llistaOpcions').first().addClass('active')
                               .attr('aria-selected','true');
    $('#tabsGrafiques').first().addClass('show active');

}

function consultarLlistaApi(){
    var llista = {"Lista":[
        {"id":1,"tipo":"bar","nombre":"General", "fechaInit":"2019-01-01", "fechaFin":"2019-01-30"},
        {"id":2,"tipo":"pie","nombre":"Comida", "fechaInit":"2019-02-01", "fechaFin":"2019-03-02"},
        {"id":3,"tipo":"line","nombre":"Otros", "fechaInit":"2019-03-01", "fechaFin":"2019-03-30"}
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
function createChart(type, data, options){
    var myChart = $('#myChart')[0].getContext('2d');

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
