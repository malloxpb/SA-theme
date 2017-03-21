<?php
/**
 * Change the excerpt length
 */
function sydney_excerpt_length( $length ) {

  $excerpt = get_theme_mod('exc_lenght', '17');
  return $excerpt;

}
add_filter( 'excerpt_length', 'sydney_excerpt_length', 999 );

/**
 * Blog layout
 */
function sydney_blog_layout() {
	$layout = get_theme_mod('blog_layout','classic');
	return $layout;
}

/**
 * Menu fallback
 */
function sydney_menu_fallback() {
	if ( current_user_can('edit_theme_options') ) {
		echo '<a class="menu-fallback" href="' . admin_url('nav-menus.php') . '">' . __( 'Create your menu here', 'sydney' ) . '</a>';
	}
}

/**
 * Header image overlay
 */
function sydney_header_overlay() {
	$overlay = get_theme_mod( 'hide_overlay', 0);
	if ( !$overlay ) {
		echo '<div class="overlay"></div>';
	}
}

/**
 * Header video
 */
function sydney_header_video() {

	if ( !function_exists('the_custom_header_markup') ) {
		return;
	}

	$front_header_type 	= get_theme_mod( 'front_header_type' );
	$site_header_type 	= get_theme_mod( 'site_header_type' );

	if ( ( get_theme_mod('front_header_type') == 'core-video' && is_front_page() || get_theme_mod('site_header_type') == 'core-video' && !is_front_page() ) ) {
		the_custom_header_markup();
	}
}

/**
 * Polylang compatibility
 */
if ( function_exists('pll_register_string') ) :
function sydney_polylang() {
	for ( $i=1; $i<=5; $i++) {
		pll_register_string('Slide title ' . $i, get_theme_mod('slider_title_' . $i), 'Sydney');
		pll_register_string('Slide subtitle ' . $i, get_theme_mod('slider_subtitle_' . $i), 'Sydney');
	}
	pll_register_string('Slider button text', get_theme_mod('slider_button_text'), 'Sydney');
	pll_register_string('Slider button URL', get_theme_mod('slider_button_url'), 'Sydney');
}
add_action( 'admin_init', 'sydney_polylang' );
endif;

/**
 * Preloader
 */
function sydney_preloader() {
	?>
	<div class="preloader">
	    <div class="spinner">
	        <div class="pre-bounce1"></div>
	        <div class="pre-bounce2"></div>
	    </div>
	</div>
	<?php
}
add_action('sydney_before_site', 'sydney_preloader');

/**
 * Header clone
 */
function sydney_header_clone() {

	$front_header_type 	= get_theme_mod('front_header_type','slider');
	$site_header_type 	=get_theme_mod('site_header_type');

	if ( ( $front_header_type == 'nothing' && is_front_page() ) || ( $site_header_type == 'nothing' && !is_front_page() ) ) { ?>
	
	<div class="header-clone"></div>

	<?php }
}
add_action('sydney_before_header', 'sydney_header_clone');


// Our custom post type function
// for clubs and organizations
function clubs_post_type() {
	$labels = array(
		'name'               => 'Clubs',
		'singular_name'      => 'Club',
		'menu_name'          => 'Club',
		'name_admin_bar'     => 'Club',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Club',
		'new_item'           => 'New Club',
		'edit_item'          => 'Edit Club',
		'view_item'          => 'View Club',
		'all_items'          => 'All Clubs',
		'search_items'       => 'Search Clubs',
		'parent_item_colon'  => 'Parent Clubs:',
		'not_found'          => 'No club found.',
		'not_found_in_trash' => 'No club found in Trash.'
	);

	$args = array( 
		'label'               => __( 'club', 'sydney' ),
		'description'         => __( 'SUNY Plattsburgh Clubs and Organizations', 'sydney' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres', 'category' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'menu_icon'     => 'dashicons-store'
	);
    	register_post_type( 'club', $args );
}
add_action( 'init', 'clubs_post_type' );

// for SA team
function SAteam_post_type() {
	$labels = array(
		'name'               => 'SA team',
		'singular_name'      => 'SA team',
		'menu_name'          => 'SA team',
		'name_admin_bar'     => 'SA team',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New member',
		'new_item'           => 'New member',
		'edit_item'          => 'Edit member',
		'view_item'          => 'View member',
		'all_items'          => 'All members',
		'search_items'       => 'Search for members',
		'not_found'          => 'No member found.',
		'not_found_in_trash' => 'No member found in Trash.'
	);

	$args = array( 
		'label'               => __( 'SA team', 'sydney' ),
		'description'         => __( 'SUNY Plattsburgh SA team', 'sydney' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'genres', 'category' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'page',
		'menu_icon'     => 'dashicons-businessman'
	);
    	register_post_type( 'SAteam', $args );
}
add_action( 'init', 'SAteam_post_type' );
