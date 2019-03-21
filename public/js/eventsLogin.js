var hide = true;

$(document).ready(function () {
    $(".fill").each(function () {
        var $label = $("#" + $(this).attr("id") + "Label");
        if ($(this).val() != "") {
            $label.css({
                "top": "4px",
                "font-size": "13px",
                "z-index": "0"
            });
        }
    });

    $(".fill").on('focus', function () {
        var $label = $("#" + $(this).attr("id") + "Label");
        $label.css({ color: "var(--primary-color-dark)" });
        $label.animate({
            "top": "4px",
            "font-size": "13px",
            "z-index": "0"
        }, 120);
    });

    $(".fill").on('blur', function () {
        var $label = $("#" + $(this).attr("id") + "Label");
        if (!$("#Password").is(":focus")) {
            if ($(this).val() == "") {
                $label.animate({
                    "top": "15px",
                    "font-size": "17px",
                    "z-index": "-1"
                }, 120);
            }
            $label.css({ color: "#8a8a8a" });
        }
    });

    $("#hideShow").click(function (e) {
        var $this = $(this);
        var $input = $("#Password");



        if (hide) {
            $this.addClass("pulse")
            hide = false;
            $this.text("visibility");
            $this.css("color", "var(--primary-color)")
            $input.attr("type", "text");
        } else {
            $this.removeClass("pulse");
            hide = true;
            $this.text("visibility_off");
            $this.css("color", "#8a8a8a6e")
            $input.attr("type", "password");
        }

    });
});
