jQuery(function($) {
	function unsemanticGrid() {
		var $container = $('#masonry-grid').masonry({
		        itemSelector : '.grid-item',
		        columnWidth : ''
		    });

		$container.imagesLoaded().progress(function() {
		    $container.masonry('layout');
		});
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
		    	728: {
		    		items: 3
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

	function resizeSlider() {
		$(window).resize(function() {
	        var bodyheight = $(this).width() + 30;
	        $(".customized-slider-width").width(bodyheight);
	    }).resize();
	}

	function initSidebar() {
		$('#main-menubar ul li a').addClass('mdl-navigation__link')
		$('#main-menubar').show();
	}

	$(document).ready(function() {
		initSidebar();
		if (!(typeof(componentHandler) == 'undefined')) {
		    componentHandler.upgradeAllRegistered();
		}
		owlInit();
		unsemanticGrid();
		resizeSlider();
	});
});
