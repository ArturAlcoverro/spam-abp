$( document ).ready(function(){
    // $('#one').hover(function() {

    //     // increase the 500 to larger values to lengthen the duration of the fadeout
    //        // and/or fadein
    //     $('#one').fadeOut(500, function() {
    //         $('#one').attr("src","/newImage.png");
    //         $('#one').fadeIn(500);
    //     });

    // });
    var imgs = [
        "doggo1.jpg",
        "kitty1.jpg",
        "doggo2.jpg",
        "kitty2.jpg",
        "doggo3.jpg",
        "kitty3.jpg",
    ]
    var i = 0;
    setInterval(function(){
        $('.images').fadeOut(1000, function() {
            $('.images').css({'background-image': 'url(../public/media/publica/bg_images/' + imgs[i] + ')'});
            $('.images').fadeIn(1000);
            i++;
            if(i===imgs.length){
                i = 0;
            }
        });

    },7500);

    $(".col h1").fadeIn(1500, function(){
            $(".col h2").fadeIn(3000, function(){
                $(".col h4").fadeIn(1500, function(){
                    $(".row .col").fadeIn(1500, function(){
                        $(".col h3").fadeIn(1500, function(){
                            $(".delighted-text").css("transition", "all .5s ease-in-out");
                            $(".delighted-text").hover(function(){
                                $(this).css("transform", "scale(1.2)");
                            },function(){
                                $(this).css("transform", "scale(1.0)");
                            });
                        });
                    })
            })
        })
    })
});

// var colors = new Array(
//     [153, 204, 51],
//     [138, 181, 51],
//     [122, 158, 51],
//     [107, 135, 51]);

//   var step = 0;
//   //color table indices for:
//   // current color left
//   // next color left
//   // current color right
//   // next color right
//   var colorIndices = [0,1,2,3];

//   //transition speed
//   var gradientSpeed = 0.004;

//   function updateGradient()
//   {

//     if ( $===undefined ) return;

//   var c0_0 = colors[colorIndices[0]];
//   var c0_1 = colors[colorIndices[1]];
//   var c1_0 = colors[colorIndices[2]];
//   var c1_1 = colors[colorIndices[3]];

//   var istep = 1 - step;
//   var r1 = Math.round(istep * c0_0[0] + step * c0_1[0]);
//   var g1 = Math.round(istep * c0_0[1] + step * c0_1[1]);
//   var b1 = Math.round(istep * c0_0[2] + step * c0_1[2]);
//   var color1 = "rgb("+r1+","+g1+","+b1+")";

//   var r2 = Math.round(istep * c1_0[0] + step * c1_1[0]);
//   var g2 = Math.round(istep * c1_0[1] + step * c1_1[1]);
//   var b2 = Math.round(istep * c1_0[2] + step * c1_1[2]);
//   var color2 = "rgb("+r2+","+g2+","+b2+")";

//    $('.navbar').css({
//      background: "-webkit-gradient(linear, left top, right top, from("+color1+"), to("+color2+"))"}).css({
//       background: "-moz-linear-gradient(left, "+color1+" 0%, "+color2+" 100%)"});

//     step += gradientSpeed;
//     if ( step >= 1 )
//     {
//       step %= 1;
//       colorIndices[0] = colorIndices[1];
//       colorIndices[2] = colorIndices[3];

//       //pick two new target color indices
//       //do not pick the same as the current one
//       colorIndices[1] = ( colorIndices[1] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;
//       colorIndices[3] = ( colorIndices[3] + Math.floor( 1 + Math.random() * (colors.length - 1))) % colors.length;

//     }
//   }

//   setInterval(updateGradient,10);
