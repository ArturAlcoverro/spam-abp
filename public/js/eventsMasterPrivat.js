var menu = false;

$(document).ready(function () {
    var tab = window.location.href.split("/")[5];
    switch (tab) {
        case 'donations':
            $('#donacionsTab').addClass('active-tab');
            break;
        case 'donants':
            $('#donantsTab').addClass('active-tab');
            break;
        case 'user':
            $('#usuarisTab').addClass('active-tab');
            break;
        default: alert(tab); break;

    }
    $(".menu-btn").click(function () {
        if (menu) {
            hideMenu();
        } else {
            showMenu();
        }
    });

    $(".menu a").click(function () {
        hideMenu();
    });

    $(".menu-close-space").click(function () {
        hideMenu();
    });

    $('#body').removeClass('d-none');

});

function showMenu() {
    $(".menu").animate({
        "left": "0"
    }, 300);
    $(".menu-btn-animation:nth-child(1)").addClass("menu-btn-1-active");
    $(".menu-btn-animation:nth-child(2)").addClass("menu-btn-2-active");
    $(".menu-btn-animation:nth-child(3)").addClass("menu-btn-3-active");
    $(".menu-btn").addClass("menu-btn-active");
    $(".content").addClass("blur");
    menu = true;
}

function hideMenu() {
    $(".menu").animate({
        "left": "-100%"
    }, 300);
    $(".menu-btn-animation:nth-child(1)").removeClass("menu-btn-1-active");
    $(".menu-btn-animation:nth-child(2)").removeClass("menu-btn-2-active");
    $(".menu-btn-animation:nth-child(3)").removeClass("menu-btn-3-active");
    $(".menu-btn").removeClass("menu-btn-active");
    $(".content").removeClass("blur");

    menu = false;
}

//switch idioma
$("#idiomaSwitch").change(function () {
    window.location = "locale/" + $("#idiomaSwitch option:selected").val();
    //window.location = '{{ url("locale/" ) }}';
});

function toast(msg, time){
    $('.toast').text(msg);
    $('.toast').fadeIn(500);
    setTimeout(function(){
        $('.toast').fadeOut(500);
    }, time);
}
