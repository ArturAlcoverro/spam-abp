var menu = false;

$(document).ready(function () {
    var tab = window.location.href.split("/");
    if (tab.includes('subtipos') || tab.includes('donations') || tab.includes('tipos')) {
        $('#donacionsTab').addClass('active-tab');
    }
    else if (tab.includes('donants')) {
        $('#donantsTab').addClass('active-tab');
    }
    else if (tab.includes('users')) {
        $('#usuarisTab').addClass('active-tab');
    }
    else if (tab.includes('centros')) {
        $('#centrosTab').addClass('active-tab');
    }
    else if (tab.includes('grafics')) {
        $('#graficsTab').addClass('active-tab');
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

    $('#alertModal .btn-secondary').click(function () {
        $('#alertModal .btn-primary').unbind('click');
    });


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

function toast(msg, time) {
    $('.toast').text(msg);
    $('.toast').fadeIn(500);
    setTimeout(function () {
        $('.toast').fadeOut(500);
    }, time);
}

function alert(title, text, callback) {
    $('#alertModal h5').text(title);
    $('#alertModal p').text(text);
    $('#alertModal').modal({ backdrop: 'static', keyboard: false });
    $('#alertModal .btn-primary').click(function () {
        callback();
        $('#alertModal').modal('hide');
        $(this).unbind('click');
    });

}
