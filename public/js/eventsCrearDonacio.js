var infoDonante = true;
var donante;
var isDonante = false;
var donacions = [];
var i = 0;
var table;

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

    $('.showHide').click(function () {
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
    $("#tipo_donacion").change(function () {
        setSubtipos($("#tipo_donacion").val());
    });

    $('#formMaterial').submit(function (event) {
        event.preventDefault();
        var $this = $(this);
        var data = {
            id: i,
            tipos_donacio: $this.find("#tipo_donacion").val(),
            subtipo_donacion: $this.find("#subtipo_donacion").val(),
            centro_receptor: $this.find("#centro_receptor").val(),
            centro_destino: $this.find("#centro_destino").val(),
            medida: $this.find("#medida").val(),
            unidades: parseInt($this.find("#unidades").val()) || 1,
            cantidad: parseInt($this.find("#cantidad").val()) || 0,
            coste: parseFloat($this.find("#coste").val()) || 0,
            animales: $this.find("#animales").val(),
            factura: $this.find("#factura").val(),
            coordinada: $this.find("#coordinada").is(":checked"),
        };
        donacions[i] = data;
        i++;
        afegirDonacio(data);
        $('#modalMaterial').modal('hide');
    });

    table = $('#tablaDonacions').DataTable({
        responsive: true,
        sort: false,
        dom: 'rt',
        select: false,
        columnDefs: [{
            targets: 4,
            visible: false,
            searchable: false
        },{
            width: "3%",
            targets: -1,
            data: null,
            defaultContent: "<button onclick='deleteRow()' class='btn-delete'></button>"
        }, {
            width: "3%",
            targets: -2,
            data: null,
            defaultContent: "<button onclick='deleteRow()' class='btn-edit'></button>"
        }],
        language: {
            sProcessing: "Processant...",
            sLengthMenu: "Mostra _MENU_ registres",
            sZeroRecords: "No s'han trobat registres.",
            sInfo: "Mostrant de _START_ a _END_ de _TOTAL_ registres",
            sInfoEmpty: "Mostrant de 0 a 0 de 0 registres",
            sInfoFiltered: "(filtrat de _MAX_ total registres)",
            sInfoPostFix: "",
            sSearch: "Filtrar:",
            sUrl: "",
            oPaginate: {
                sFirst: "Primer",
                sPrevious: "Anterior",
                sNext: "Següent",
                sLast: "Últim"
            },
            buttons: {
                copyTitle: 'Copiat al portapapers',
                copySuccess: {
                    _: '%d donacions copiades',
                    1: '1 donació copiada'
                }
            }
        }
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

function toggleDonant() {
    if (infoDonante) {
        $('#donante').hide(100);
        $('.showHide').addClass('rotate-180');
        infoDonante = false;
    }
    else {
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
    $('#subtipo_donacion').empty();
    subtipos.forEach(element => {
        if (element.tipos_id == id) {
            $('#subtipo_donacion').append('<option value="' + element.id + '">' + element.nombre + '</option>');
        }
    });
}
function afegirDonacio(data) {
    var centro_receptor;
    var centro_destino;
    var subtipo;

    subtipos.forEach(function (element) {
        if (element.id == data.subtipo_donacion) {
            subtipo = element.nombre;
        }
    });
    centros.forEach(function (element) {
        if (element.id == data.centro_destino) {
            centro_destino = element.nombre;
        }
        if (element.id == data.centro_receptor) {
            centro_receptor = element.nombre;
        }
    });
    table.row.add([data.coste, subtipo, centro_receptor, centro_destino, data.id]).draw();
    $('#donacions').show();
    table.columns.adjust();
    table.responsive.recalc();
}

function deleteRow(){
    var row = $(this).parents('tr');
    var data = table.row(row).data();
    console.log(data);
}
