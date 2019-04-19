var donante = { id: 0 };
var isDonante = false;
var infoDonante = true;
var isDonacions = false;
var donacions = [];
var formDonacions = [];
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

    setMedida($("#subtipo_donacion").val());
    $("#subtipo_donacion").change(function () {
        setMedida($("#subtipo_donacion").val());
    });

    //Al fer submit en el modal de material recollim la informació i l'afegim a la taula de donacions
    $('#formDiners').submit(function (event) {
        event.preventDefault();
        var $this = $(this);
        var formData = new FormData();
        formData.append('id', i);
        formData.append('subtipo_donacion', tipoDiners);
        formData.append('centro_receptor', $this.find("#centro_receptor_diners").val());
        formData.append('centro_destino', $this.find("#centro_destino_diners").val());
        formData.append('unidades', 0);
        formData.append('cantidad', 0);
        formData.append('coste', parseFloat($this.find("#costeDiners").val()));
        formData.append('animales', []);
        formData.append('factura', $this.find("#FacturaDiners")[0].files[0]);
        formData.append('coordinada', $this.find("#spamDiners").is(":checked"));

        var data = {
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
        formDonacions[i] = formData;
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
        var formData = new FormData();
        var coste = parseFloat($this.find("#coste").val());
        if (isNaN(coste)) {
            coste = calcularCoste(
                $this.find("#subtipo_donacion").val(),
                $('input[name=radioGama]:checked', '#formMaterial').data('value'));
        }
        formData.append('id', i);
        formData.append('subtipo_donacion', $this.find("#subtipo_donacion").val());
        formData.append('centro_receptor', $this.find("#centro_receptor").val());
        formData.append('centro_destino', $this.find("#centro_destino").val());
        formData.append('unidades', parseInt($this.find("#unidades").val()) || 1);
        formData.append('cantidad', parseInt($this.find("#cantidad").val()) || 0);
        formData.append('coste', coste);
        formData.append('animales', $this.find("#animales").val());
        formData.append('factura', $this.find("#factura")[0].files[0]);
        formData.append('coordinada', $this.find("#coordinada").is(":checked"));

        var data = {
            id: i,
            subtipo_donacion: $this.find("#subtipo_donacion").val(),
            centro_receptor: $this.find("#centro_receptor").val(),
            centro_destino: $this.find("#centro_destino").val(),
            unidades: parseInt($this.find("#unidades").val()) || 1,
            cantidad: parseInt($this.find("#cantidad").val()) || 0,
            coste: coste,
            animales: $this.find("#animales").val(),
            factura: $this.find("#factura").val(),
            coordinada: $this.find("#coordinada").is(":checked"),
            factura: $this.find("#factura")[0].files[0],
        };
        formDonacions[i] = formData;
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

    //Visualitzem la fila selccionada
    $('#tablaDonacions tbody').on('click', '.btn-edit', function () {
        var row = table.row($(this).parents('tr')).data();
        var data;
        var animales = "";
        var coordinada;

        donacions.forEach(element => {
            if (element.id == row[4]) {
                data = element;
            }
        });

        data.animales.forEach(element => {
            switch (element) {
                case "1":
                    animales = animales + "Perro, "
                    break;
                case "2":
                    animales = animales + "Gato, "
                    break;
                case "3":
                    animales = animales + "Hurón, "
                    break;
            }
        });

        animales = animales.substring(0, animales.length - 2);

        data.coordinada ? coordinada = 'Si' : coordinada = 'No';
        var x = getSubtipus(data.subtipo_donacion);

        $('#detall .valor').text(data.coste + "€");
        $('#detall .subtipus').text(getSubtipus(data.subtipo_donacion).nombre);
        $('#detall .origen').text(getCentro(data.centro_destino).nombre);
        $('#detall .desti').text(getCentro(data.centro_receptor).nombre);
        $('#detall .unitats').text(data.unidades);
        $('#detall .cantitat').text(data.cantidad + getSubtipus(data.subtipo_donacion).tipo_unidad);
        $('#detall .animals').text(animales);
        $('#detall .coordinada').text(coordinada);
        $("#modalDetall").modal()
    });

    //Eliminem la fila selccionada
    $('#tablaDonacions tbody').on('click', '.btn-delete', function () {
        var $this = $(this);
        var data = table.row($this.parents('tr')).data();
        var index = donacions.map(x => {
            return x.id;
        }).indexOf(data[4]);

        alert('Estas seguro?', 'Se eliminara eol registro seleccionado', function () {

            donacions.splice(index, 1);
            formDonacions.splice(index, 1);

            table.row($this.parents('tr')).remove().draw();
            if (table.rows().count() == 0) {
                $('#donacions').hide();
                isDonacions = false;
            }
        });
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
            donacionsEnviades = table.rows().count();
            donacionsRebudes = 0;
            formDonacions.forEach(donacio => {
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
        url: '../api/donants/' + dni,
        success: function (data) {
            callback(data.data);
        }
    })
}

// Envia a la API la informacio sobre les diferents doncions;
function storeDonacio(dataDonacio) {

    dataDonacio.append('fecha', today());
    dataDonacio.append('id_usuario', idUsuario);
    dataDonacio.append('id_donante', donante.id);


    $.ajax({
        async: 'true',
        method: 'POST',
        data: dataDonacio,
        processData: false,
        contentType: false,
        enctype: 'multipart/form-data',
        url: '../api/donations',
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

function calcularCoste(id_subtipo, gama) {
    var subtipo;
    var coste;
    subtipos.forEach(element => {
        if (element.id == id_subtipo) {
            subtipo = element;
        }
    });

    switch (gama) {
        case 'Alta':
            coste = subtipo.gama_alta
            break;
        case 'Media':
            coste = subtipo.gama_media
            break;
        case 'Baja':
            coste = subtipo.gama_baja
            break;
    }

    return coste;
}

function getSubtipus(id) {
    var resp;
    subtipos.forEach(element => {
        if (element.id == id) {
            resp = element;
        }
    });
    return resp;
}

function getCentro(id) {
    var resp;
    centros.forEach(element => {
        if (element.id == id) {
            resp = element;
        }
    });
    return resp;

}

function pdf() {

    var imgData = 'data:image/jpeg;base64,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';

    var doc = new jsPDF()

    doc.addImage(imgData, 'JPEG', 10, 10, 60, 25);

    doc.text('Certificado de donacion', 10, 50);
    doc.text('El donante PACO ha hecho una donacion de 50 euros en SPAM', 10, 60);

    doc.save('certificado.pdf');
}
