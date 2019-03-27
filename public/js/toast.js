function toast(msg, time){
    $('.toast').text(msg);
    $('.toast').show(15);
    setTimeout(function(){
        $('.toast').hide(15);
    }, time);
}
