jQuery(function($) {
	var $container = $('#masonry-grid').masonry({
	        itemSelector : '.grid-item',
	        columnWidth : ''
	    });

		$container.imagesLoaded().progress(function() {
		    $container.masonry('layout');
		});

	$(document).ready(function(){
		$('.owl-carousel').owlCarousel({
			nav: true,
			navText: [
	            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
	            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        	],
        	lazyLoad: true,
		    responsive:{
		    	1024: {
		    		items: 4
		    	},
		        1400:{
		            items: 5
		        },
		    }
		});

		function moveScroller() {
		    var $anchor = $("#scroller-anchor");
		    var $scroller = $('.site-header');

		    var move = function() {
		        var st = $(window).scrollTop();
		        var ot = $anchor.offset().top;
		        var margin = ($('#wpadminbar').length) ? "100px" : "68px";
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

		moveScroller();
	});
});
