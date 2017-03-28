<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Sydney
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="widget-area grid-30">
	<div id="secondary" role="complementary">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #secondary -->

	<?php dynamic_sidebar( 'under-sidebar' ); ?>
</div>
