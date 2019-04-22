var donante = { id: 0 };
var isDonante = false;
var infoDonante = true;
var isDonacions = false;
var donacions = [];
var formDonacions = [];
var i = 0;
var table;
var tableParticulars;
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
        var rows = tableParticulars.rows('.selected').data();
        var row;
        var data;

        if (rows.length > 0) {
            row = rows[0];
            data = {
                nombre: row[0],
                cif: row[1],
                correo: row[2],
                id: row[3],
                tipos_donantes_id: row[4],
            };
            isDonante = true;
            console.log(data);
            setDonant(data);
            $('#modalParticular').modal('hide');
        }
        else {
            toast('Selecciona un donant', 1000);
        }
    });

    //Busca la Empres per CIF i mostra la seva informació
    $('#modalEmpresa .btn').click(function () {
        var $this = $(this);
        var rows = tableEmpresas.rows('.selected').data();
        var row;
        var data;

        if (rows.length > 0) {
            row = rows[0];
            data = {
                nombre: row[0],
                cif: row[1],
                correo: row[2],
                id: row[3],
                tipos_donantes_id: row[4],
            };
            isDonante = true;
            console.log(data);
            setDonant(data);
            $('#modalEmpresa').modal('hide');
        }
        else {
            toast('Selecciona un donant', 1000);
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

    tableEmpresas = $('#table-empresas').DataTable({
        responsive: true,
        sort: true,
        dom: '<pf><t>',
        select: {
            style: 'single'
        }, columnDefs: [{
            targets: 3,
            visible: false,
            searchable: false
        }, {
            targets: 4,
            visible: false,
            searchable: false
        }],
        language: {
            sProcessing: "Processant...",
            sLengthMenu: "Mostra _MENU_ registres",
            sZeroRecords: "No s'han trobat registres.",
            sInfo: "Mostrant de _START_ a _END_ de _TOTAL_ registres",
            sInfoEmpty: "Mostrant de 0 a 0 de 0 registres",
            sInfoFiltered: "(filtrat de _MAX_ total registres)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
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

    tableParticulars = $('#table-particulars').DataTable({
        responsive: true,
        sort: true,
        dom: '<pf><t>',
        select: {
            style: 'single'
        },
        columnDefs: [{
            targets: 3,
            visible: false,
            searchable: false
        }, {
            targets: 4,
            visible: false,
            searchable: false
        }],
        language: {
            sProcessing: "Processant...",
            sLengthMenu: "Mostra _MENU_ registres",
            sZeroRecords: "No s'han trobat registres.",
            sInfo: "Mostrant de _START_ a _END_ de _TOTAL_ registres",
            sInfoEmpty: "Mostrant de 0 a 0 de 0 registres",
            sInfoFiltered: "(filtrat de _MAX_ total registres)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
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
        $("#infoEmpresa #correuEmpresa span").text(data.correo);
        $("#infoEmpresa").show();
    } else if (data.tipos_donantes_id == 2) {
        ocultarBotones('btnParticular');
        $("#infoParticular #nombreParticular span").text(nombre.charAt(0).toUpperCase() + nombre.slice(1));
        $("#infoParticular #dniParticular span").text(data.cif);
        $("#infoParticular #correuParticular span").text(data.correo);
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

    var imgData = 'data:image/png;base64,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r5Si9QZ19HIIXg1YLwe0E8BeKDpFkATQDsie8kfQAtxmSwUAyxCchmJZod+E4jGx5PFE0Xn4xqtWnojsomJg+hHseq6QPJBQfY2qXK7A5QJc7H620rl+31qquKDy70F9AYCj0BcBWQZwCtDTosiJyGMqzr9q+8pDQ2/At6O8toaWtrtgYQBA/7Zuqu6DwxQcLAbcJZoovkpjYnPH4c1URyBYMlbN5VevPbz+bwNlm7W4D+5uYiDsvRtrEfc5KW13wzq3vUL1Pfs2J0Dj9Bm3iriNZXdMdkJkeNufuYncmZrjids1RmVjHJb/PEtKY9DBTC3VnZFspD+5gD2OdlwpKikIXq/Q1wtkPyAXRHF+l6oCOUAfAuQrIviytuH+ZquEqKSVko6bffgR7F3Ld/xXqFwLxVsh8kNhnEehT4rqoogcd7B27OLU6sOsBCEiIiIiIiKiVmW0e+cdJ3Cpleh4taXoguLlDvBDAF4GyKUALlqvLLkIwPdtr5TUIoAXARQVeEGANYWeAuQUgOcEeEqAfysC/9amaycLnauP3/JqrER8ibHRqknH891xApe2Wbu6HbX2i1iXQfWVClwq0EsAeen2ShtVAM+vV4GcEsWzCjwjgicUzhMJyEmVwpczKcRqSTcRERERERERkUlGk44UHSYda3OrwmqGbrJERERERERERCbU3UiGqJkx4UhEREREREREVD8mHYmIiIiIiIiIiChQTDoSERERERERERFRoJh0JCIiIiIiIiIiokAx6UhERERERERERESBYtKRiIiIiIiIiIiIAsWkIxEREREREREREQWKSUciIiIiIiIiIiIKFJOOREREREREREREFCgmHYmIiIiIiIiIiChQTDoSERERERERERFRoJh0JCIiIiIiIiIiokAx6UhERERERERERESBYtKRiIiIiIiIiIiIAsWkIxEREREREREREQWKSUciIiIiIiIiIiIKFJOOREREREREREREFCgmHYmIiIiIiIiIiChQTDoSERERERERERFRoJh0JCIiIiIiIiIiokAx6UhERERERERERESBYtKRiIiIiIiIiIiIAsWkIxEREREREREREQWKSUciIiIiIiIiIiIKFJOOREREREREREREFCgmHYmIiIiIiIiIiChQTDoSERERERERERFRoJh0JCIiIiIiIiIiokAx6UhERERERERERESBYtKRiIiIiIiIiIiIAsWkIxEREREREREREQWKSUciIiIiIiIiIiIKFJOOREREREREREREFCgmHYmIiIiIiIiIiChQTDoSERERERERERFRoJh0JCIiIiIiIiIiokAx6UhERERERERERESBYtKRiIiIiIiIiIiIAsWkIxEREREREREREQWKSUciIiIiIiIiIiIKFJOOREREREREREREFCgmHYmIiIiIiIiIiChQTDoSERERERERERFRoJh0JCIiIiIiIiIiokAx6dgiHHW+YzqG8ynUcXatPGc6DiIiIiIiIiIiChaTji3i4j0r/6yqz5iOYzMBPnfzfrxoOg4iIiIiIiIiIgoWk44t4vB+nBWreD2gRdOxuPTZhOO823QUREREREREREQUPCYdW8hg6uxn1dJrFPpVs5HoZ0Q0deNVK0+YjYOIiIiIiIiIiMIgpgOg6KlCJud3v13F+mlA+wXWyyM466MAPovE2l8MHlh9KPzzERERERERERGRKUw6Eu6c73iFpboflvwwYL1G1fl+EfkBOLgEgksAJADsBqRj+3fr9wCsATirwHMAvi3AtxX6LQvyqAPnkfY9Kw/fsB+nI70oIiIiIiIiIiIy5v8D9atmkfQLtNwAAAAASUVORK5CYII=';

    var doc = new jsPDF()

    doc.addImage(imgData, 'JPEG', 10, 10, 120, 25);

    var date = new Date();

    var day = ("0" + date.getDate()).slice(-2);
    var month = ("0" + (date.getMonth() + 1)).slice(-2);

    var today = date.getFullYear() + "-" + (month) + "-" + (day);

    var nombre = $("#user").text();

    var nombreDonante = donante.nombre;
    var cifDonante = donante.cif;

    var rows = $("#tablaDonacions").DataTable().rows().data();

    var suma = 0;

    for(var i = 0; i<rows.length; i++){
        console.log(rows[i][0]);

        var x = rows[i][0].replace(/\€/g, '');

        suma = suma + parseInt(x);
    }

    doc.text('CERTIFICADO DE DONACIÓN', 10, 50);

    var txt = "D/Dª " + nombre + " en calidad de trabajador de la entidad SOCIETAT PROTECTORA D'ANIMALS DE MATARÓ con NIF G58223785 y domicilio social en Ctra. Nacional II, Km. 648, 4 certifica que: SOCIETAT PROTECTORA D'ANIMALS DE MATARÓ es una fundación de utilidad pública incluida entre las reguladas en el art.16 de la ley 49/2002. \n \nSOCIETAT PROTECTORA D'ANIMALS DE MATARÓ ha recibido de D/Dña "+ nombreDonante + " con DNI/CIF " + cifDonante + " el valor estimado de "+ suma + " euros durante el año " + date.getFullYear() + ". \n \nLa cantidad indicada ha sido entregada en concepto de donativo, destinado al cumplimiento de los fines de la fundación/asociación. Esta donación tiene carácter irrevocable, sin perjuicio de lo establecido en las normas imperativas civiles que regulan la revocación de las donaciones. \n \n" + today;

    var splitTitle = doc.splitTextToSize(txt, 180);
    doc.text(10, 60, splitTitle);

    doc.save('spam_certificado.pdf');
}
