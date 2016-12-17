(function($) {
    twitterFetcher.fetch('345170787868762112', 'example1', 1,true,    true, false);
})(jQuery);


(function($) {
    $("#owl-demo1").owlCarousel({
        navigation: false,
        pagination: true,
        autoPlay: true,
        responsiveRefreshRate: 200,
        items: 3,
        itemsDesktop: [1199,3],
        itemsTablet: [970,2],
        itemsMoblie: [500,1],
        navigationText: false
    });
})(jQuery);


(function($) {
    $('.imagepopup').colorbox({maxWidth:'95%', maxHeight:'95%', rel:'gal'});
})(jQuery);


//media queries and functions
(function ($){
    $(function (){
        $smallscreen_parallax();
        $(window).resize(function () {
            $smallscreen_parallax()
        });
    });

    $smallscreen_parallax = function ()
    {
        if ( $(window).width() <= 767 ) {

            //remove parallax
            $('.section3').parallax("0", 0);
            $('.section4').parallax("0", 0);

            //add flexslider without animation triger
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "fade",navigation:false,slideshowSpeed: 6000,             animationSpeed: 600,
                    start: function(){
                        $('body').removeClass('loading');
                        $('.slidertexthide').removeClass('slidertexthide');

                    }
                });
            });
        }
        else {

            //add parallax
            $('.section3').parallax("50%", 0.2);
            $('.section4').parallax("50%", 0.2);

            //add flexslider with animation triger
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "fade",navigation:false,slideshowSpeed: 6000,
                    animationSpeed: 600,
                    start: function(){
                        $('body').removeClass('loading');
                        $('.slidertexthide').removeClass('slidertexthide');

                        //animation triger
                        $('.startAnimation').waypoint(function() {
                                var animationclass = $(this).attr('data-animate');
                                $(this).css('opacity', '1');
                                $(this).addClass("animated " + animationclass);
                            },
                            {
                                offset: '100%',
                                triggerOnce: true
                            }
                        );

                    }
                });
            });

        }
    }
})(jQuery);


(function($) {
    $('.bxtestimonials').bxSlider({
        mode: 'vertical', adaptiveHeight: true, controls: false
    });
})(jQuery);


(function($) {
    var menu = $('.navbar');
    $(window).scroll(function() {
    });

    $('.navbar a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        var target = this.hash,
            $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 1000, 'swing', function() {
            window.location.hash = target;
        });
    });

    $('.bottomlinks a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        var target = this.hash,
            $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 1000, 'swing', function() {
            window.location.hash = target;
        });
    });

    $('.eventsscroll a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        var target = this.hash,
            $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 1000, 'swing', function() {
            window.location.hash = target;
        });
    });
})(jQuery);


(function($) {
    $('.sticker').scrollspy();
})(jQuery);

(function($) {
    $(".sticker").sticky();
})(jQuery);


(function($){
    $(window).load(function() {
        // Masonry Trigger
        var $container = $('#masonrycontainer');
        $container.masonry({
            itemSelector: '.masonryselector'
        });
    });
})(jQuery);


function scrollToTop($) {
    jQuery('html, body').animate({
        scrollTop: 0
    }, 'slow');
}(jQuery);

