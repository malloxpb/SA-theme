<?php
/**
 * Enqueue scripts and styles.
 */
function sydney_scripts() {

	// styles
	if ( get_theme_mod('body_font_name') !='' ) {
	    wp_enqueue_style( 'sydney-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) );
	} else {
	    wp_enqueue_style( 'sydney-body-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,600');
	}

	if ( get_theme_mod('headings_font_name') !='' ) {
	    wp_enqueue_style( 'sydney-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) );
	} else {
	    wp_enqueue_style( 'sydney-headings-fonts', '//fonts.googleapis.com/css?family=Raleway:400,500,600');
	}

	wp_enqueue_style( 'sydney-slider-fonts', '//fonts.googleapis.com/css?family=Cedarville+Cursive');
	wp_enqueue_style( 'sydney-style', get_template_directory_uri() . '/static/css/main.css', false, STATIC_VERSION);
	wp_enqueue_style( 'sydney-slider-style', get_template_directory_uri() . '/static/css/superslides.css');
	wp_enqueue_style('sydney-owlstyle', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css', false, '2.2.1');
	wp_enqueue_style( 'sydney-font-awesome', get_template_directory_uri() . '/static/fonts/font-awesome.min.css' );
	wp_enqueue_style( 'sydney-ie9', get_template_directory_uri() . '/static/css/ie9.css', array( 'sydney-style' ) );
	wp_enqueue_style( 'sydney-unsemantic-grid', get_template_directory_uri() . '/static/css/unsemantic-grid/unsemantic-grid-responsive-tablet.css' );
	wp_enqueue_style('sydney-sidebar', '//cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.css', false, '6.0.2');
	wp_enqueue_style('sydney-hamburger', get_template_directory_uri() . '/static/css/hamburgers.css', false, '0.8.1');

	wp_style_add_data( 'sydney-ie9', 'conditional', 'lte IE 9' );

	// scripts
	wp_enqueue_script( 'sydney-scripts', get_template_directory_uri() . '/static/js/scripts.js', array('jquery'), STATIC_VERSION, true );
	wp_enqueue_script( 'sydney-easing-scripts', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js', ['jquery'], '1.4.1', true );
	wp_enqueue_script( 'sydney-main', get_template_directory_uri() . '/static/js/main.min.js', array('jquery'), STATIC_VERSION, true );
	wp_enqueue_script( 'sydney-skip-link-focus-fix', get_template_directory_uri() . '/static/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script('sydney-owljs', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js', ['jquery'], '2.2.1', true);
	wp_enqueue_script( 'sydney-customizedjs', get_template_directory_uri() . '/static/js/custom-initializer.js', array('jquery'), STATIC_VERSION, true );
	wp_enqueue_script('sydney-snapwidget', '//snapwidget.com/js/snapwidget.js', ['jquery'], '', true);
	wp_enqueue_script('sydney-sidebar', '//cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/6.0.2/jquery.mmenu.all.min.js', ['jquery'], '6.0.2', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action('wp_enqueue_scripts', 'sydney_scripts');

function sydney_enqueue_bootstrap() {
	wp_enqueue_style( 'sydney-bootstrap', get_template_directory_uri() . '/static/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action('wp_enqueue_scripts', 'sydney_enqueue_bootstrap', 9);
