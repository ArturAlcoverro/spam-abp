function tipoData(){
    if($('#tipoData').val() == 'dinamic'){
        $('#interval').show();
        $('#fixe').hide();
    }
    else{
        $('#interval').hide();
        $('#fixe').show();
    }
}
//Carrega els subtipus depenen del tipus seleccionat
function setSubtipos(id) {

    $('#subtipo_donacion').empty()
                        .prop( "disabled", false )
                        .append('<option value="all" selected>Tots</option>');
    subtipos.forEach(element => {
        if (element.tipos_id == id) {
            $('#subtipo_donacion').append('<option value="' + element.id + '">' + element.nombre + '</option>');
        }
    });
}
