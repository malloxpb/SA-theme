jQuery(function($) {
	var $container = $('#masonry-grid').masonry({
	        itemSelector : '.grid-item',
	        columnWidth : ''
	    });

	$container.imagesLoaded().progress(function() {
	    $container.masonry('layout');
	});

	function moveScroller() {
	    var $anchor = $("#scroller-anchor");
	    var $scroller = $('.site-header');

	    var move = function() {
	        var st = $(window).scrollTop();
	        var ot = $anchor.offset().top;
	        var margin = ($('#wpadminbar').length) ? "" : "68px";
	        if(st > 68) {
	            $scroller.css({
	                position: "fixed",
	                top: "0px",
	                background: "#5d0202",
	            });
	            $('.alert').css('display', 'inherit');
	        } else {
	            if(st <= 68) {
	                $scroller.css({
	                    position: "absolute",
	                    top: margin,
	                    background: "transparent",
	                });
	                $('.alert').css('display', 'none');
	            }
	        }
	    };
	    $(window).scroll(move);
	    move();
	} 

	function owlInit() {
		$('.owl-carousel').owlCarousel({
			nav: true,
			navText: [
	            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
	            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
	    	],
	    	lazyLoad: true,
		    responsive:{
		    	0: {
		    		items: 2
		    	},
		    	1024: {
		    		items: 4
		    	},
		        1400:{
		            items: 5
		        },
		    }
		});
	}

	function menuMobile() {
		slideMenu = $('#menu-mobile');

	    var sidebarMenu = $('#menu-mobile').find('nav');

	    sidebarMenu.mmenu({
	        "extensions": [
	            "pagedim-black",
	            "border-offset"
	        ],
	        offCanvas: {
	          "position": "right"
	        },
	        navbar: {
			    title: ""
			},
	    });

	    var api = sidebarMenu.data('mmenu');

	    $('.menu-slide-button').on('click', function () {
	        api.open();
	        $('.menu-slide-button').toggleClass('is-active');
	    });

	    // $('.menu-toggle.close').on('click', function () {
	    //     api.close();
	    // });
	}

	$(document).ready(function(){
		owlInit();
		moveScroller();
		menuMobile();

		$(window).resize(function() {
	        var bodyheight = $(this).width() + 30;
	        $(".slide-item").width(bodyheight);
	    }).resize();
	});
});
