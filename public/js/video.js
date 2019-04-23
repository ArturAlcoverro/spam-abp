$( document ).ready(function(){

    doVideoThings();




});

function doVideoThings(){
    var done = false;
    $('video').on("timeupdate", function(){
        if(this.currentTime >= 48 && !done){
            disableVideo(this);

            var actualVideo = this;

            createOption('Licencia');
            createOption('Psicotécnico');
            createOption('Seguro de responsabilitat civil');
            createOption('Ninguno');
            done = true;

            $(".hidden-video").fadeIn(1500);

            $('#vcontainer .col').on("click", function(){
                $('#vcontainer .row').append("<div class='text-center font-weight-light mt-5 delighted-text text-white'>Fallaste! Para adoptar un perro de estas razas, la legislación actual exige: Tener la licencia para tenencia de perros potencialmente peligrosos (renovable cada 5 años), Psicotécnico, Seguro de responsabilitat civil </div>");
                //$(this).children().css('color', 'red');
                //$('#vcontainer .col:nth-child(4) h5').children().css('color', 'green');
                $('#vcontainer .col').unbind();
                enableVideo(actualVideo);
            });
            $('#vcontainer .col:nth-child(4)').unbind();
            $('#vcontainer .col:nth-child(4)').on("click", function(){
                $('#vcontainer .row').append("<div class='text-center font-weight-light mt-5 delighted-text text-white'>Acertastes! Para adoptar un perro de estas razas, la legislación actual exige: Tener la licencia para tenencia de perros potencialmente peligrosos (renovable cada 5 años), Psicotécnico, Seguro de responsabilitat civil </div>");
                //$(this).children().css('color', 'green');
                $('#vcontainer .col').unbind();
                enableVideo(actualVideo);
            });

            $("#vcontainer .col").css("transition", "all .5s ease-in-out");
            $('#vcontainer .col').hover(function(){
                $(this).css("transform", "scale(1.2)");
            },function(){
                $(this).css("transform", "scale(1.0)");
            });
        }
    });

    $('video').on("ended", function(){
        $("#vcontainer .row").empty();
        $(".hidden-video").css("display", "none");
        $("h2").fadeIn(2000);

        $('video').on("play", function(){
            $("h2").css("display", "none");
            $('video').unbind();
            doVideoThings();
        });
    });
}

function disableVideo(obj){
    obj.pause();
    obj.controls = false;
}

function enableVideo(obj){
    obj.play();
    obj.controls = true;
}

function createOption(option){
    $('#vcontainer .row').append('<div class="col"><h5 class="hidden-video mx-auto delighted-text text-white">'+option+'</h5></div>');
}
