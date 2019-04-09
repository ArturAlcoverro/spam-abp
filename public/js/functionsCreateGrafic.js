function dTipoData(){
    if($('#dTipoData').val() == 'dinamic'){
        $('#dInterval').show();
        $('#dFixe').hide();
    }
    else{
        $('#dInterval').hide();
        $('#dFixe').show();
    }
}
function oTipoData(){
    if($('#oTipoData').val() == 'dinamic'){
        $('#oInterval').show();
        $('#oFixe').hide();
    }
    else{
        $('#oInterval').hide();
        $('#oFixe').show();
    }
}
//Carrega els subtipus depenen del tipus seleccionat
// function setSubtipos(id) {

//     $('#subtipo_donacion').empty()
//                         .prop( "disabled", false )
//                         .append('<option value="all" selected>Tots</option>');
//     subtipos.forEach(element => {
//         if (element.tipos_id == id) {
//             $('#subtipo_donacion').append('<option value="' + element.id + '">' + element.nombre + '</option>');
//         }
//     });
// }
