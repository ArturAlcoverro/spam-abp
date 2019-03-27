

function init(paramsApi, typeChart, optionsChart){

    var data = consultarApi(paramsApi);
    createChart(typeChart, data, optionsChart);

}

//retorna els dataserts usats als charts
function consultarApi(params){

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
          hoverBorderWidth:3,
          hoverBorderColor:'#000'
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
          hoverBorderColor:'#000'
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