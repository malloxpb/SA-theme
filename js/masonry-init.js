
//Masonry init
jQuery(function($) {
	var $container = $('#masonry-grid').masonry({
	        itemSelector : '.grid-item',
	        columnWidth : ''
	    });

		$container.imagesLoaded().progress(function() {
		    $container.masonry('layout');
		});
});