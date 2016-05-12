if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {} else {
    $('head').append('<script type="text/javascript" src="bootstrap/js/parallax.js"></script>');
        $('body').append('<script type="text/javascript" src="bootstrap/js/parallax.js"></script>');
}
/* Navbar */
$(document).ready(function () {
    var scroll_start = 0;
    var startchange = $('.navbar');
    var offset = startchange.offset();
    $(document).scroll(function () {
        scroll_start = $(this).scrollTop();
        if (scroll_start > offset.top) {
            $('.navbar').css('background-color', 'rgba(10,12,15,1)');
            $('.navbar').css('box-shadow', '0px 3px 15px rgba(0,0,0,0.3)');
            $('.navbar').css('min-height', '70px');
            $('.navbar-header').css('margin-top', '19px');
            $('.orcus-logo-menu').css('max-height', '28px');
            $('.orcus-font-menu').css('max-height', '18px');
            $('.orcus-font-menu-anchor').css('padding-right', '90px');
            $('.navbar-nav').css('margin-top', '-2px');
            $('.navbar-right').css('margin-top', '1px');
        } else {
            $('.navbar').css('background-color', 'transparent');
            $('.navbar').css('box-shadow', '100px 10px 5px transparent');
            $('.navbar-header').css('margin-top', '45px');
            $('.orcus-logo-menu').css('max-height', '42px');
            $('.orcus-font-menu').css('max-height', '23px');
            $('.orcus-font-menu-anchor').css('padding-right', '50px');
            $('.navbar-nav').css('margin-top', '32px');
            $('.navbar-right').css('margin-top', '35px');
        }
    });
});

// Modal Signup PHP script interaction
var modal = $('#signup-modal');
modal.find('.login-btn').click(function() {
    $(this).prop('disabled', true);

    var email = modal.find('#email').val();
    var password = modal.find('#password').val();

    if (!isEmptyOrSpaces(email) && !isEmptyOrSpaces(password)) {
        // Call registration script
        $.ajax({
            url: 'index.php?view=scr_registration',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                password: password
            }
        }).done(function(data) {
            // Get data back
            console.log(data);
        }).fail(function(xhr, textStatus, errorThrown){
            // Get error
            console.log(xhr);
        });
    }

    $(this).prop('disabled', false);
});

// Modal Login PHP script interaction
var modal2 = $('#login-modal');
modal2.find('.login-btn').click(function() {
    $(this).prop('disabled', true);

    var email = modal2.find('#email').val();
    var password = modal2.find('#password').val();

    if (!isEmptyOrSpaces(email) && !isEmptyOrSpaces(password)) {
        // Call login script
        $.ajax({
            url: 'index.php?view=scr_login',
            type: 'POST',
            dataType: 'json',
            data: {
                email: email,
                password: password
            }
        }).done(function(data) {
            // Get data back
            console.log(data);
        });
    }

    $(this).prop('disabled', false);
});

// Utility function
function isEmptyOrSpaces(str) {
    return str === null || str.match(/^\s*$/) !== null;
}
