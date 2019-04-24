$( document ).ready(function(){
    doVideoThings();
});

function doVideoThings(){
    var done1 = false;
    var done2 = false;
    $('video').on("timeupdate", function(){
        if(this.currentTime >= 64 && !done1){
            $("#vcontainer .row").empty();
            $(".hidden-video").css("display", "none");

            disableVideo(this);

            $('#pregunta').text("¿Cuál de los siguientes no es necesario para obtener una licencia de razas potencialmente peligrosas?")

            document.querySelector('#vcontainer .row').scrollIntoView({ behavior: 'smooth' });

            var actualVideo = this;

            createOption('Licencia');
            createOption('Psicotécnico');
            createOption('Seguro de responsabilitat civil');
            createOption('Ninguno');
            done1 = true;

            $(".hidden-video").fadeIn(1500);

            $('#vcontainer .col').on("click", function(){
                $('#vcontainer .row').append("<div class='text-center font-weight-light mt-5 delighted-text'>Fallaste! Para adoptar un perro de estas razas, la legislación actual exige: Tener la licencia para tenencia de perros potencialmente peligrosos (renovable cada 5 años), Psicotécnico, Seguro de responsabilitat civil </div>");
                //$(this).children().css('color', 'red');
                //$('#vcontainer .col:nth-child(4) h5').children().css('color', 'green');
                $('#vcontainer .col').unbind();
                createReturnToVideo(actualVideo);
                document.querySelector('#vcontainer .row').scrollIntoView({ behavior: 'smooth' });
            });
            $('#vcontainer .col:nth-child(4)').unbind();
            $('#vcontainer .col:nth-child(4)').on("click", function(){
                $('#vcontainer .row').append("<div class='text-center font-weight-light mt-5 delighted-text'>Acertastes! Para adoptar un perro de estas razas, la legislación actual exige: Tener la licencia para tenencia de perros potencialmente peligrosos (renovable cada 5 años), Psicotécnico, Seguro de responsabilitat civil </div>");
                //$(this).children().css('color', 'green');
                $('#vcontainer .col').unbind();
                createReturnToVideo(actualVideo);
                document.querySelector('#vcontainer .row').scrollIntoView({ behavior: 'smooth' });
            });
        }
        else if(this.currentTime >= 41 && !done2) {
            disableVideo(this);

            document.querySelector('#vcontainer .row').scrollIntoView({ behavior: 'smooth' });

            var actualVideo = this;

            createOption('10%');
            createOption('25%');
            createOption('50%');
            createOption('75%');
            done2 = true;

            $(".hidden-video").fadeIn(1500);

            $('#vcontainer .col').on("click", function(){
                $('#vcontainer .row').append("<div class='text-center font-weight-light mt-5 delighted-text'>Fallaste! El balance de la gestión en 2018 da estos resultados: Total animales acogidos, 2.088 (842 gatos y 1.206 perros–aproximadamente el 50% de las razas llamadas Potencialmente Peligrosas).</div>");
                //$(this).children().css('color', 'red');
                //$('#vcontainer .col:nth-child(4) h5').children().css('color', 'green');
                $('#vcontainer .col').unbind();
                createReturnToVideo(actualVideo);
                document.querySelector('#vcontainer .row').scrollIntoView({ behavior: 'smooth' });
            });
            $('#vcontainer .col:nth-child(3)').unbind();
            $('#vcontainer .col:nth-child(3)').on("click", function(){
                $('#vcontainer .row').append("<div class='text-center font-weight-light mt-5 delighted-text'>Acertastes! El balance de la gestión en 2018 da estos resultados: Total animales acogidos, 2.088 (842 gatos y 1.206 perros–aproximadamente el 50% de las razas llamadas Potencialmente Peligrosas).</div>");
                //$(this).children().css('color', 'green');
                $('#vcontainer .col').unbind();
                createReturnToVideo(actualVideo);
                document.querySelector('#vcontainer .row').scrollIntoView({ behavior: 'smooth' });
            });
        }
    });

    $('video').on("ended", function(){
        $("#vcontainer .row").empty();
        $(".hidden-video").css("display", "none");
        document.querySelector('#vcontainer .row').scrollIntoView({ behavior: 'smooth' });
        $("h2").fadeIn(2000);

        $('video').on("play", function(){
            $("h2").css("display", "none");
            $('video').unbind();
            doVideoThings();
        });
    });

    document.querySelector('video').scrollIntoView({ behavior: 'smooth' });
}

function disableVideo(obj){
    closeFullscreen();
    obj.pause();
    obj.controls = false;
}

function enableVideo(obj){
    document.querySelector('video').scrollIntoView({ behavior: 'smooth' });
    obj.play();
    obj.controls = true;
}

function createOption(option){
    $('#vcontainer .row').append('<div class="col"><h5 class="text-center hidden-video mx-auto delighted-text option">'+option+'</h5></div>');
}

function createReturnToVideo(video){
    $('.btn').fadeIn(1000);
    $('.btn').on('click', function(){
        enableVideo(video);
        $('.btn').css('display', 'none');
    });
}

function closeFullscreen() {
    if (document.exitFullscreen) {
      document.exitFullscreen();
      document.querySelector('video').scrollIntoView({ behavior: 'smooth' });
    } else if (document.mozCancelFullScreen) { /* Firefox */
      document.mozCancelFullScreen();
      document.querySelector('video').scrollIntoView({ behavior: 'smooth' });
    } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
      document.webkitExitFullscreen();
      document.querySelector('video').scrollIntoView({ behavior: 'smooth' });
    } else if (document.msExitFullscreen) { /* IE/Edge */
      document.msExitFullscreen();
      document.querySelector('video').scrollIntoView({ behavior: 'smooth' });
    }
  }
