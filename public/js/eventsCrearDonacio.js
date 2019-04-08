var donante = {id:0};
var isDonante = false;
var infoDonante = true;
var isDonacions = false;
var donacions = [];
var i = 0;
var table;
var donacionsEnviades;
var donacionsRebudes;

$(document).ready(function () {

    // l'usuari seleccionas és anonim
    $('#btnAnonim').click(function () {
        ocultarBotones('btnAnonim');
        isDonante = true;
        donante.id = 0;
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
    $('#formDiners').submit(function (event) {
        event.preventDefault();
        var $this = $(this);

        var data = {
            fecha: today(),
            id_usuario: idUsuario,
            id: i,
            subtipo_donacion: tipoDiners,
            centro_receptor: $this.find("#centro_receptor_diners").val(),
            centro_destino: $this.find("#centro_destino_diners").val(),
            unidades: 0,
            cantidad: 0,
            coste: parseFloat($this.find("#costeDiners").val()),
            animales: [],
            factura: $this.find("#FacturaDiners").val(),
            coordinada: $this.find("#spamDiners").is(":checked"),
        };
        donacions[i] = data;
        i++;
        afegirDonacio(data);
        $('#modalDiners').modal('hide');
        $(this)[0].reset();
    });

    //Al fer submit en el modal de material recollim la informació i l'afegim a la taula de donacions
    $('#formMaterial').submit(function (event) {
        event.preventDefault();

        var $this = $(this);

        var coste = parseFloat($this.find("#costeDiners").val());
        if (coste == 0){
            coste = calcularCoste(
                        $this.find("#subtipo_donacion").val(),
                        $('input[name=radioGama]:checked', '#formMaterial').data('value'));
        }

        var data = {
            id: i,
            subtipo_donacion: $this.find("#subtipo_donacion").val(),
            centro_receptor: $this.find("#centro_receptor").val(),
            centro_destino: $this.find("#centro_destino").val(),
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
            isDonacions = false;
        }
    });


    $('#tablaDonacions tbody').on('click', '.btn-edit', function () {
        var data = table.row($(this).parents('tr')).data();
        console.log(data);
    });

    $('#btnSubmit').click(function () {
        if (!isDonante) {
            toast('Debes seleccionar un donante', 2000);
        }
        else if (!isDonacions) {
            toast('Debes añadir alguna donación', 2000);
        }
        else {
            $('.unable').show();
            $('.spinner').removeClass('d-none');
            donacionsEnviades = donacions.length;
            donacionsRebudes = 0;
            donacions.forEach(donacio => {
                storeDonacio(donacio);
            });
        }
    });

});

// Consulta AJAX per obtenir la informació  del donant a traves del DNI/CIF
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

// Envia a la API la informacio sobre les diferents doncions;
function storeDonacio(dataDonacio) {
    dataDonacio.fecha = today()
    dataDonacio.id_usuario = idUsuario;
    dataDonacio.id_donante = donante.id;

    $.ajax({
        async: 'true',
        method: 'POST',
        data: dataDonacio,
        url: 'http://localhost:8080/spam-abp/public/api/donations',
        success: function (resp) {
            console.log(resp);
            donacionsRebudes++;
            reload()
        },
        error: function (jqXHR, exception) {
            console.log(jqXHR);
            console.log(exception);
            donacionsRebudes++;
            reload()
        }
    })
}

//Mostra/Oculta la informació del donant
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

//Mostra la informacio del donant
function setDonant(data) {
    donante = data;
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

//Oculta el botons per seleccionar un tipus de donant
function ocultarBotones(id) {
    $('#titleDonant').text('Informació donant');
    $('.btn-donant').hide();
    $('#' + id + 'Delete').show();
}

//Carrega els subtipus depenen del tipus seleccionat
function setSubtipos(id) {
    $('#subtipo_donacion').empty();
    subtipos.forEach(element => {
        if (element.tipos_id == id) {
            $('#subtipo_donacion').append('<option value="' + element.id + '">' + element.nombre + '</option>');
        }
    });
}

//Agrega una donació a la taula
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
    table.row.add([data.coste + "€", subtipo, centro_receptor, centro_destino, data.id]).draw();
    $('#donacions').show();
    isDonacions = true;
    table.columns.adjust();
    table.responsive.recalc();
}

function today() {
    var t = new Date();
    return t.getFullYear() + "-" +
        (t.getMonth() + 1) + "-" +
        t.getDate() + " " +
        t.getHours() + ":" +
        t.getMinutes() + ":" +
        t.getSeconds();
}

function reload() {
    if (donacionsEnviades == donacionsRebudes) {
        location.reload();
        console.log('YYYY')
    }
}

function calcularCoste(id_subtipo, gama){
    var subtipo;
    var coste;
    subtipos.forEach(element => {
        if(element.id = id_subtipo){
            subtipo = element;
        }
    });

    switch (gama) {
        case 'Alta':
            coste = subtipo.gama_alta
        break;
        case 'Media':
            coste = subtipo.gama_alta
        break;
        case 'Baja':
            coste = subtipo.gama_alta
        break;
    }

    return coste;
}
