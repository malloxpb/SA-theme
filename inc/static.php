<?php
/**
 * Enqueue scripts and styles.
 */
function sydney_scripts() {

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

	wp_enqueue_style( 'sydney-style', get_template_directory_uri() . '/static/css/main.css', false, STATIC_VERSION);

	wp_enqueue_style( 'sydney-font-awesome', get_template_directory_uri() . '/static/fonts/font-awesome.min.css' );

	wp_enqueue_style( 'sydney-ie9', get_template_directory_uri() . '/static/css/ie9.css', array( 'sydney-style' ) );
	wp_enqueue_style( 'unsemantic-grid', get_template_directory_uri() . '/static/css/unsemantic-grid/unsemantic-grid-responsive-tablet.css' );	

	wp_style_add_data( 'sydney-ie9', 'conditional', 'lte IE 9' );

	wp_enqueue_script( 'sydney-scripts', get_template_directory_uri() . '/static/js/scripts.js', array('jquery'),'', true );

	wp_enqueue_script( 'sydney-main', get_template_directory_uri() . '/static/js/main.min.js', array('jquery'),'20170127', true );

	wp_enqueue_script( 'sydney-skip-link-focus-fix', get_template_directory_uri() . '/static/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'sydney-masonry-init', get_template_directory_uri() . '/static/js/masonry-init.js', array('masonry'),'', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action('wp_enqueue_scripts', 'sydney_scripts');

function sydney_enqueue_bootstrap() {
	wp_enqueue_style( 'sydney-bootstrap', get_template_directory_uri() . '/static/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action('wp_enqueue_scripts', 'sydney_enqueue_bootstrap', 9);
