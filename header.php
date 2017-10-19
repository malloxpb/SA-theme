<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Sydney
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) : ?>
	<?php if ( get_theme_mod('site_favicon') ) : ?>
		<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('site_favicon')); ?>" />
	<?php endif; ?>
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<div id="facebook"><!--
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1160309744035139";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
--></div>

<?php // do_action('sydney_before_site'); //Hooked: sydney_preloader() ?>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'sydney' ); ?></a>
	<?php do_action('sydney_before_header'); //Hooked: sydney_header_clone() ?>
	<?php dynamic_sidebar('above-header'); ?>
	<div id="scroller-anchor"></div>

	<button id="menu-button-close" class="menu-slide-button close hide-on-desktop" type="button">
		<span>Button for navigation menu</span>
	    <i class="fa fa-times" aria-hidden="true"></i>
	</button>
	<!-- reposive menu  -->
	<div id="menu-mobile">
		<?php
		wp_nav_menu(array(
			'theme_location' => 'mobile_menu',
			'container' => 'nav',
		));
		?>
	</div>

	<header id="masthead" class="site-header <?php if (!is_front_page()) echo "not-front-page-header" ?>" role="banner">
		<div class="alert hide-on-mobile">
            <div class="grid-container">
                <p>Welcome to the Student Association - Students Serving Students - Since 1963</p>
            </div>
        </div>
		<?php /*
		<div class="header-wrap">
            <div class="grid-container">
				<div class="grid-33 tablet-grid-66 mobile-grid-70">
		        <?php if ( get_theme_mod('site_logo') ) : ?>
					<img class="site-logo" src="<?php echo esc_url(get_theme_mod('site_logo')); ?>" alt="<?php bloginfo('name'); ?>" />
		        <?php else : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		        <?php endif; ?>
				</div>
				<div class="grid-66 tablet-grid-33 mobile-grid-30">
					<nav id="mainnav" class="mainnav" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'sydney_menu_fallback' ) ); ?>
					</nav><!-- #site-navigation -->
					<button id="menu-button-open" class="menu-slide-button open hide-on-desktop" type="button">
						<span>Button for navigation menu</span>
					    <i class="fa fa-bars" aria-hidden="true"></i>
					</button>
				</div>
			</div>
		</div>
		*/ ?>
		<!-- Simple header with scrollable tabs. -->
		<!-- Always shows a header, even in smaller screens. -->
		<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		    <header class="mdl-layout__header">
			    <div class="mdl-layout__header-row">
			        <!-- Title -->
			        <span class="mdl-layout-title">Title</span>
			        <!-- Add spacer, to align navigation to the right -->
			        <div class="mdl-layout-spacer"></div>
			        <!-- Navigation. We hide it in small screens. -->
			        <nav class="mdl-navigation mdl-layout--large-screen-only">
				        <a class="mdl-navigation__link" href="">Link</a>
				        <a class="mdl-navigation__link" href="">Link</a>
				        <a class="mdl-navigation__link" href="">Link</a>
				        <a class="mdl-navigation__link" href="">Link</a>
			        </nav>
			    </div>
		    </header>
		<div class="mdl-layout__drawer">
		    <span class="mdl-layout-title">Title</span>
		    <nav class="mdl-navigation">
		        <a class="mdl-navigation__link" href="">Link</a>
		        <a class="mdl-navigation__link" href="">Link</a>
		        <a class="mdl-navigation__link" href="">Link</a>
		        <a class="mdl-navigation__link" href="">Link</a>
		    </nav>
		</div>
		    <main class="mdl-layout__content">
		    	<div class="page-content"><!-- Your content goes here --></div>
		    </main>
		</div>
	</header><!-- #masthead -->

	<?php do_action('sydney_after_header'); ?>

	<?php if (is_front_page()): ?>
	<div class="customized-slider-width"></div>
	<div class="sydney-hero-area">
		<div class="loading-container">
		    <div class="pulse"></div>
		</div>
		<?php sydney_slider_template(); ?>
		<div class="header-image">
			<?php sydney_header_overlay(); ?>
			<img class="header-inner" src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>">
		</div>
		<?php sydney_header_video(); ?>

		<?php do_action('sydney_inside_hero'); ?>
	</div>
	<?php endif; ?>

	<?php do_action('sydney_after_hero'); ?>

	<?php if (!is_singular("post")): ?>
		<?php if (has_post_thumbnail() && (get_theme_mod( 'post_feat_image' ) != 1)): ?>
			<div class="header-image">
				<?php sydney_header_overlay(); ?>
				<img class="header-inner" src="<?php the_post_thumbnail_url(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>">
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<div id="content" class="page-wrap">
		<div class="grid-container content-wrapper">
			<div class="row">
