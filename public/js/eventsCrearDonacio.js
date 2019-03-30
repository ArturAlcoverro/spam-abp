var donante = false;
$(document).ready(function () {
    $('#btnAnonim').click(function () {
        ocultarBotones($(this).attr('id'));
    });
    $('#btnParticular').click(function () {
        $('#modalParticular').modal();
    });
    $('#btnEmpresa').click(function () {
        $('#modalEmpresa').modal();
    });
});

$('#modalParticular .btn').click(function () {
    var $this = $(this);
    var dni = $('#modalParticular input').val();
    if (dni == '') {

    }
    else {
        $('.spinner-border').show();
        $this.hide();
        getDonant(dni, function (data) {
            if (data != '') {
                console.log(data)
            }
            else {
                alert('bad');
            }
            $('.spinner-border').show();
            $this.hide();
        });
    }
});

function getDonant(dni, callback) {
    $.ajax({
        async: 'true',
        method: 'GET',
        url: 'http://localhost:8080/spam-abp/public/api/donants/' + dni,
        success: function (data) {
            callback(data);
        }
    })
}

function setDonant(data) {

}

function ocultarBotones(id) {
    $('.btn-donant').hide();
    $('#' + id).show();
    $('#' + id).addClass('closeBtn');
    $('#' + id).click(function () {
        $('#' + id).click(function () {
            ocultarBotones($(this).attr('id'));
        });
        $('.btn-donant').show();
        $('#' + id).removeClass('closeBtn');
    });
}
