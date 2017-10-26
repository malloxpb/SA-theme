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
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1160309744035139';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'sydney' ); ?></a>
	<?php do_action('sydney_before_header'); //Hooked: sydney_header_clone() ?>
	<?php dynamic_sidebar('above-header'); ?>
	<div id="scroller-anchor"></div>


	<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
			<!-- Title -->
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
          <div class="mdl-layout-spacer"></div>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
			<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>
        </header>
        <nav id="main-menubar" class="demo-navigation mdl-navigation mdl-color-text--white">
		    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => 'sydney_menu_fallback' ) ); ?>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
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
