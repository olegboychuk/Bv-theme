(function ($) {
	"use strict";

    $(window).on('load',function() {
        // alert('loaded');
    });
    	//After Page Ready
	$(document).ready(function () {
        var w = $( window ).width();
        var h = $( window ).height();
        var headerHeight = $('.header').outerHeight();
        
        //AOS
        AOS.init();
        
        //Menu
		$(".mobile-menu-trigger").on("click", function() {
            $(this).toggleClass('open');
            $('.mobheader-row').toggleClass('open');
			var menu = $(".the-mobile-menu");
			if (menu.hasClass('active')) {
                menu.removeClass('view');
                setTimeout(() => {
                    menu.removeClass('active');
                }, 500 );
			} else {
                menu.addClass('active');
                setTimeout(() => {
                    menu.addClass('view');
                }, 500 );
			}
		});
        if(w<767){
            $('main').css('margin-top',headerHeight);
        }
        //Menu close after click
        $('.the-mobile-menu .main-menu li a').on("click", function() {
            $(".mobile-menu-trigger").trigger('click');
        });

    });
    
})(jQuery);
