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

    //Mostra/Oculta la informació del donant
    $('.showHide').click(function () {
        toggleDonant();
    });

    //Busca el Particular per DNI i mostra la seva informació
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

    //Busca la Empres per CIF i mostra la seva informació
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

    //Carrega els subtipus depenen del tipus
    setSubtipos(1);
    $("#tipo_donacion").change(function () {
        setSubtipos($("#tipo_donacion").val());
    });

    //Al fer submit en el modal de material recollim la informació i l'afegim a la taula de donacions
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
        afegirDonacioMaterial(data);
        $('#modalMaterial').modal('hide');
        $(this)[0].reset();
    });

    //Carreguem la taula
    table = $('#tablaDonacions').DataTable({
        responsive: true,
        sort: false,
        dom: 'rt',
        select: false,
        columnDefs: [{
            targets: 4,
            visible: false,
            searchable: false
        }, {
            responsivePriority: 1,
            width: "3%",
            targets: -1,
            data: null,
            defaultContent: "<button class='btn-delete'></button>"
        }, {
            responsivePriority: 1,
            width: "3%",
            targets: -2,
            data: null,
            defaultContent: "<button class='btn-edit'></button>"
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

    //Eliminem la fila selccionada
    $('#tablaDonacions tbody').on('click', '.btn-delete', function () {
        var data = table.row($(this).parents('tr')).data();
        var deleteObj;

        var index = donacions.map(x => {
            return x.id;
        }).indexOf(data[4]);
        donacions.splice(index, 1);

        table.row($(this).parents('tr')).remove().draw();
        if (table.rows().count() == 0) {
            $('#donacions').hide();
        }
    });


    $('#tablaDonacions tbody').on('click', '.btn-edit', function () {
        var data = table.row($(this).parents('tr')).data();
        console.log(data);
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
function afegirDonacioMaterial(data) {
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

function afegirDonacioDiners(data) {
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
