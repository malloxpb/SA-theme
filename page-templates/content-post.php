<?php
/**
 * @package Sydney
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("demo-card-wide mdl-card mdl-shadow--2dp"); ?>>
	<div class="mdl-card__title" style="background:url('<?php if (has_post_thumbnail() && (get_theme_mod('index_feat_image') != 1)) { the_post_thumbnail_url('sydney-post-thumb'); } ?>');background-size:cover;background-repeat:none;">
	    <?php the_title( sprintf( '<h2 class="poster-title mdl-card__title-text"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</div>

	<div class="mdl-card__supporting-text">
		<?php if ( (get_theme_mod('full_content_home') == 1 && is_home() ) || (get_theme_mod('full_content_archives') == 1 && is_archive() ) ) : ?>
			<?php the_content(); ?>
		<?php else : ?>
			<?php the_excerpt(); ?>
		<?php endif; ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sydney' ),
				'after'  => '</div>',
			) );
		?>
		<?php sydney_posted_on(); ?>
	</div>

	<div class="mdl-card__actions mdl-card--border">
	    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
	        <?php _e('Continue reading','sydney'); ?>
	    </a>
	</div>
</article><!-- #post-## -->
