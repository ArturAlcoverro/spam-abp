function editDonant() {

    var row = $("#table").DataTable().row('.selected').data();

    var id = row[0];

    $('#form_edit').attr('action', "http://localhost:8080/spam-abp/public/donants/" + id + "/edit");
    $('#form_edit').submit();
}

function deleteDonant() {

    var row = $("#table").DataTable().row('.selected').data();

    var id = row[0];

    $('#form_delete').attr('action', "http://localhost:8080/spam-abp/public/donants/" + id);
    $('#form_delete').submit();
}

$('#tipos_donante').change(function () {

    var type = $(this).find("option:selected").val();

    switch(type){

        case "1":

            $('#row-cif').show();
            $('#row-sexo').hide();

        break;

        case "2":

            $('#row-cif').hide();
            $('#row-sexo').show();

        break;
    }
});

$('#row-sexo').hide();
