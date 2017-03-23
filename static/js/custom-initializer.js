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
		    responsive:{
		        0:{
		            items:1
		        },
		        600:{
		            items:3
		        },
		        1000:{
		            items:5
		        }
		    }
		});
	});
});
