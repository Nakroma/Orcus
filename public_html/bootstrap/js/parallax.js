var outerHeight = $('.parallax').outerHeight();
function parallax(){
    var scrolled = $(window).scrollTop();
    $('.hdiw-bg-1').css('bottom', (outerHeight-(0.7*scrolled)-400) + 'px');
}

$(window).scroll(function(e){
    parallax();
});

var outerHeight2 = $('.parallax2').outerHeight();
function parallax2(){
    var scrolled = $(window).scrollTop();
    $('.hdiw-bg-2').css('bottom', (outerHeight2-(0.7*scrolled-900)) + 'px');
}

$(window).scroll(function(e){
    parallax2();
});


var outerHeight3 = $('.parallax3').outerHeight();
function parallax3(){
    var scrolled = $(window).scrollTop();
    $('.hdiw-bg-4').css('bottom', (outerHeight3-(0.7*scrolled)+600) + 'px');
}

$(window).scroll(function(e){
    parallax3();
});

