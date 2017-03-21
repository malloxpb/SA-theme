<?php
/**
 * Sydney functions and definitions
 *
 * @package Sydney
 */


if ( ! function_exists( 'sydney_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function sydney_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Sydney, use a find and replace
	 * to change 'sydney' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sydney', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1170; /* pixels */
	}

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('sydney-large-thumb', 830, 830, true);
	add_image_size('sydney-medium-thumb', 550, 400, true);
	add_image_size('sydney-small-thumb', 230, 230, true);
	add_image_size('sydney-service-thumb', 350, 350, true);
	add_image_size('sydney-mas-thumb', 480, 480, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sydney' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sydney_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // sydney_setup
add_action( 'after_setup_theme', 'sydney_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function sydney_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sydney' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widget_areas', '3');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'sydney' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	//Register the front page widgets
	if ( function_exists('siteorigin_panels_activate') ) {
		register_widget( 'Facebook_Widget' );
		register_widget( 'Sydney_List' );
		register_widget( 'Sydney_Services_Type_A' );
		register_widget( 'Sydney_Services_Type_B' );
		register_widget( 'Sydney_Facts' );
		register_widget( 'Sydney_Clients' );
		register_widget( 'Sydney_Testimonials' );
		register_widget( 'Sydney_Skills' );
		register_widget( 'Sydney_Action' );
		register_widget( 'Sydney_Video_Widget' );
		register_widget( 'Sydney_Social_Profile' );
		register_widget( 'Sydney_Employees' );
		register_widget( 'Sydney_Latest_News' );
		register_widget( 'Sydney_Contact_Info' );
		register_widget( 'Sydney_Portfolio' );
	}

}
add_action( 'widgets_init', 'sydney_widgets_init' );

/**
 * Load the front page widgets.
 */
if ( function_exists('siteorigin_panels_activate') ) {
	require get_template_directory() . "/widgets/facebook-widget.php";
	require get_template_directory() . "/widgets/fp-list.php";
	require get_template_directory() . "/widgets/fp-services-type-a.php";
	require get_template_directory() . "/widgets/fp-services-type-b.php";
	require get_template_directory() . "/widgets/fp-facts.php";
	require get_template_directory() . "/widgets/fp-clients.php";
	require get_template_directory() . "/widgets/fp-testimonials.php";
	require get_template_directory() . "/widgets/fp-skills.php";
	require get_template_directory() . "/widgets/fp-call-to-action.php";
	require get_template_directory() . "/widgets/video-widget.php";
	require get_template_directory() . "/widgets/fp-social.php";
	require get_template_directory() . "/widgets/fp-employees.php";
	require get_template_directory() . "/widgets/fp-latest-news.php";
	require get_template_directory() . "/widgets/fp-portfolio.php";
	require get_template_directory() . "/widgets/contact-info.php";
}

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

	wp_enqueue_style( 'sydney-style', get_template_directory_uri() . '/static/css/main.css', array(), time() );

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
add_action( 'wp_enqueue_scripts', 'sydney_scripts' );

/**
 * Enqueue Bootstrap
 */
function sydney_enqueue_bootstrap() {
	wp_enqueue_style( 'sydney-bootstrap', get_template_directory_uri() . '/static/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'sydney_enqueue_bootstrap', 9 );

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

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Page builder support
 */
require get_template_directory() . '/inc/page-builder.php';

/**
 * Slider
 */
require get_template_directory() . '/inc/slider.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Theme info
 */
require get_template_directory() . '/inc/theme-info.php';

/**
 * Woocommerce basic integration
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Upsell
 */
require get_template_directory() . '/inc/upsell/class-customize.php';

/**
 *TGM Plugin activation.
 */
require_once dirname( __FILE__ ) . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'sydney_recommend_plugin' );
function sydney_recommend_plugin() {

    $plugins[] = array(
            'name'               => 'Page Builder by SiteOrigin',
            'slug'               => 'siteorigin-panels',
            'required'           => false,
    );

	if ( !function_exists('wpcf_init') ) {
	    $plugins[] = array(
		        'name'               => 'Sydney Toolbox - custom posts and fields for the Sydney theme',
		        'slug'               => 'sydney-toolbox',
		        'required'           => false,
		);
	}

    tgmpa( $plugins);

}

// custom pagination kriesi
function kriesi_pagination($pages = '', $range = 2) {  
    $showitems = ($range * 2)+1;  

    global $paged;

    if (empty($paged)) {
    	$paged = 1;
    }

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class='pagination'>";

        // for 2 arrows at the beginning of the pagination
        if ($paged > 2 && $paged > $range+1 && $showitems < $pages) {
        	echo "<a href='" . get_pagenum_link(1) . "'>&laquo;</a>";
        }
        if ($paged > 1 && $showitems < $pages) {
        	echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a>";
        }

        // numbers of the pagination
        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                echo ($paged == $i)? "<span class='current'>" . $i . "</span>":"<a href='".get_pagenum_link($i) . "' class='inactive' >" . $i . "</a>";
            }
        }

        // 2 arrows at the end of the pagination
        if ($paged < $pages && $showitems < $pages) {
         	echo "<a href='".get_pagenum_link($paged + 1) . "'>&rsaquo;</a>";
        } 
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
        	echo "<a href='".get_pagenum_link($pages) . "'>&raquo;</a>";
        }

        echo "</div>\n";
    }
}

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
