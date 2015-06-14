(function($){ 

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
    });

    $('.btn_contact').click(function(){
        var naam = $('input[name="naam"]').val();
        var email = $('input[name="email"]').val();
        var bedrijf = $('input[name="bedrijf"]').val();
        var bericht = $('textarea').val();
        console.log($('input[name="_token"]').val());
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });

        $.ajax({
            type: "POST",
            url: '/message/send',
            data: {naam:naam, email:email, bedrijf:bedrijf,boodschap:bericht},
            success: function( data ) {
                $('.alert-danger').remove();
                $('.alert-message').remove();
                $('form').prepend('<div class=" col-md-4 col-md-offset-4 alert alert-message"><p>'+data['message']+'</p></div>');
                $('input[name="naam"]').val('');
                $('input[name="email"]').val('');
                $('input[name="bedrijf"]').val('');
                $('textarea').val('');
            },
            error: function(data){
            var errors = data.responseJSON;
                $('.alert-danger').remove();
                $('.alert-message').remove();
                $('form').prepend('<div class=" col-md-4 col-md-offset-4 alert alert-danger"></div>');
                $.each(errors, function(index, error) {
                    $('.alert-danger').prepend('<p>'+error+'</p>');
                });
          }
        });
        
    })

    new WOW().init();
    //animaties pas laden als user ervoorbij scrolled

})(jQuery); 
