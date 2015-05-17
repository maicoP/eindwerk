(function($){ //anonymous function
    

    //page scroll easing.js
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 50)
        }, 1250, 'easeInOutExpo');
        event.preventDefault();
    });

    //navigatie highlight
    $('body').scrollspy({
        target: '.navbar-fixed-top',
        offset: 50
    })

    //menu sluiten op mobile
    $('.navbar-collapse ul li a').click(function() {
        $('.navbar-toggle:visible').click();
    });

    //navigatie offset
    $('#top_nav').affix({
        offset: {
            top: 100
        }
    })

    new WOW().init();
    //animaties pas laden als user ervoorbij scrolled

})(jQuery); 
