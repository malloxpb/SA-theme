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
		    loop:true,
		    nav:true,
		    navText: [
	            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
	            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        	],
        	autoplay: true,
        	lazyLoad: true,
        	autoplayTimeout: 4000,
        	slideBy: 'page',
		    responsive:{
		        0:{
		            items: 2
		        },
		        600:{
		            items: 5
		        },
		        1000:{
		            items: 7
		        }
		    }
		});
	});
});
