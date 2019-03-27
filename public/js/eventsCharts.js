$(document).ready(function(){
   // tests charts hardcoded

    // inicialitza el chart default
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
    init("", "bar", options);


});