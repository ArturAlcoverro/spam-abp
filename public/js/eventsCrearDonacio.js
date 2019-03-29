function getDonant(dni){
    $.ajax({
        async: 'true',
        method: 'GET',
        url: 'http://localhost:8080/spam-abp/public/api/donants/' + dni,
        success: function(data){
            log(data)
        }
    })
}

function setDonant(data){

}
