$(document).ready(function(){
        //Carrega els subtipus depenen del tipus
        setSubtipos(subtipo.tipos_id);
        $('#subtipo_donacion option[value="'+subtipo.id+'"]').attr("selected", "selected");
        $("#tipo_donacion").change(function () {
            setSubtipos($("#tipo_donacion").val());
        });

        setMedida($("#subtipo_donacion").val());
        $("#subtipo_donacion").change(function () {
            setMedida($("#subtipo_donacion").val());
        });
})

//Carrega els subtipus depenen del tipus seleccionat
function setSubtipos(id) {
    $('#subtipo_donacion').empty();
    subtipos.forEach(element => {
        if (element.tipos_id == id) {
            $('#subtipo_donacion').append('<option value="' + element.id + '">' + element.nombre + '</option>');
        }
    });
}

function setMedida(id_subtipo) {
    var unidad;
    subtipos.forEach(element => {
        if (element.id == id_subtipo) {
            unidad = element.tipo_unidad;
        }
    });

    if (unidad != "") {
        $('#unidadMedida').text(' (' + unidad + ')');
    } else {
        $('#unidadMedida').text('');
    }
}
