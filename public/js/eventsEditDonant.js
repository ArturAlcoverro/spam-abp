$(document).ready(function () {

    var type = $("#tipos_donante").find("option:selected").val();

    switch(type){

        case "1":

            $('#row-vinculo').show();
            $('#row-sexo').hide();

        break;

        case "2":

            $('#row-vinculo').hide();
            $('#row-sexo').show();

        break;
    }
});

$('#tipos_donante').change(function () {

    var type = $(this).find("option:selected").val();

    switch(type){

        case "1":

            $('#row-vinculo').show();
            $('#row-sexo').hide();

        break;

        case "2":

            $('#row-vinculo').hide();
            $('#row-sexo').show();

        break;
    }
});

function send() {

    if($("#nombre").val() == "" && $("#cif").val() =="" && $("#correo").val() == ""){
        toast('Añade un nombre, email o cif', 5000);
    }
    else{
        $('#form-create').submit();
    }
}
