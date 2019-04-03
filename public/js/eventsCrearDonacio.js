var infoDonante = true;
var donante;
var isDonante = false;
$(document).ready(function () {
    // l'usuari seleccionas és anonim
    $('#btnAnonim').click(function () {
        ocultarBotones('btnAnonim');
        isDonante = true;
        $('.showHide').show();
    });

    // Obre el modal per buscar un particular
    $('#btnParticular').click(function () {
        $('.not-found').addClass('d-none');
        $('.empty-error').addClass('d-none');
        $('#modalParticular').modal();
    });

    // Obre el modal per buscar una empresa
    $('#btnEmpresa').click(function () {
        $('.not-found').addClass('d-none');
        $('.empty-error').addClass('d-none');
        $('#modalEmpresa').modal();
    });

    // Obre el modal per agregar una donació de material
    $('#btnMaterial').click(function () {
        $('#modalMaterial').modal();
    });

    // Obre el modal per agregar una donació de diners
    $('#btnDiners').click(function () {
        $('#modalDiners').modal();
    });

    // Eliminar el usuario seleccionado
    $('.closeBtn').click(function () {
        $('#titleDonant').text('Selecciona un donant');
        $('.btn-donant').show();
        $('.closeBtn').hide();
        $("#infoParticular").hide();
        $("#infoEmpresa").hide();
        $(".showHide").hide();

        isDonante = false;
    });

    $('.showHide').click(function(){
        toggleDonant();
    });

    $('#modalParticular .btn').click(function () {
        var $this = $(this);
        var dni = $('#modalParticular input').val();
        if (dni == '') {
            $('.not-found').addClass('d-none');
            $('.empty-error').removeClass('d-none');
        }
        else {
            $('.spinner').removeClass('d-none');
            $this.hide();
            getDonant(dni, function (data) {
                if (data.length != 0) {
                    $('.not-found').addClass('d-none');
                    $('.empty-error').addClass('d-none');
                    $('#modalParticular').modal('hide');
                    isDonante = true;
                    console.log(data);
                    setDonant(data);
                }
                else {
                    $('.not-found').removeClass('d-none');
                    $('.empty-error').addClass('d-none');
                }
                $('.spinner').addClass('d-none');
                $this.show();
            });
        }
    });

    $('#modalEmpresa .btn').click(function () {
        var $this = $(this);
        var dni = $('#modalEmpresa input').val();
        if (dni == '') {
            $('.not-found').addClass('d-none');
            $('.empty-error').removeClass('d-none');
        }
        else {
            $('.spinner').removeClass('d-none');
            $this.hide();
            getDonant(dni, function (data) {
                if (data.length != 0) {
                    $('.not-found').addClass('d-none');
                    $('.empty-error').addClass('d-none');
                    $('#modalEmpresa').modal('hide');
                    isDonante = true;
                    setDonant(data);
                    console.log(data);
                }
                else {
                    $('.not-found').removeClass('d-none');
                    $('.empty-error').addClass('d-none');
                }
                $('.spinner').addClass('d-none');
                $this.show();
            });
        }
    });

    setSubtipos(1);
    $("#tipos_donacion").change(function () {
        setSubtipos($("#tipos_donacion").val());
    });

    $('#formMaterial').submit(function (event) {
        event.preventDefault();
        var data = ($(this).serializeArray());
        console.log(data);
    });

    $('#tablaDonacions').DataTable({
        responsive: true,
        sort: false,
        dom: 'rt',
        select: false,
    });


});

function getDonant(dni, callback) {
    $.ajax({
        async: 'true',
        method: 'GET',
        url: 'http://localhost:8080/spam-abp/public/api/donants/' + dni,
        success: function (data) {
            callback(data.data);
        }
    })
}

function toggleDonant(){
    if(infoDonante){
        $('#donante').hide(100);
        $('.showHide').addClass('rotate-180');
        infoDonante = false;
    }
    else{
        $('#donante').show(100);
        $('.showHide').removeClass('rotate-180');
        infoDonante = true;
    }
}

function setDonant(data) {
    var habitual;
    var nombre = data.nombre;
    if (data.tipos_donantes_id == 1) {
        ocultarBotones('btnEmpresa');
        $("#infoEmpresa #nombreEmpresa span").text(nombre.charAt(0).toUpperCase() + nombre.slice(1));
        $("#infoEmpresa #dniEmpresa span").text(data.cif);
        $("#infoEmpresa").show();
    } else if (data.tipos_donantes_id == 2) {
        ocultarBotones('btnParticular');
        $("#infoParticular #nombreParticular span").text(nombre.charAt(0).toUpperCase() + nombre.slice(1));
        $("#infoParticular #dniParticular span").text(data.cif);
        $("#infoParticular").show();
    }
    $(".showHide").show();
}

function ocultarBotones(id) {
    $('#titleDonant').text('Informació donant');
    $('.btn-donant').hide();
    $('#' + id + 'Delete').show();
}

function setSubtipos(id) {
    $('#subtipos_donacion').empty();
    subtipos.forEach(element => {
        if (element.tipos_id == id) {
            $('#subtipos_donacion').append('<option value="' + element.id + '">' + element.nombre + '</option>');
        }
    });

}
