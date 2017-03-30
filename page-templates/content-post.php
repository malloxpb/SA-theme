<?php
/**
 * @package Sydney
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid-container poster-inner">
		<div class="grid-33">
			<?php if ( has_post_thumbnail() && ( get_theme_mod( 'index_feat_image' ) != 1 ) ) : ?>
				<div class="poster-thumb">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('sydney-post-thumb'); ?></a>
				</div>
			<?php endif; ?>
		</div>

		<div class="<?php if (has_post_thumbnail()) echo "grid-66"; ?>">
			<div class="inner-content">
				<header class="poster-header">
					<?php the_title( sprintf( '<h1 class="poster-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
				</header><!-- .poster-header -->

				<div class="poster-content">
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
				</div><!-- .poster-content -->
			</div>

			<?php if ( 'post' == get_post_type() && get_theme_mod('hide_meta_index') != 1 ) : ?>
			<div class="poster-meta list-meta clearfix">
				<?php sydney_posted_on(); ?>
				<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php _e('Continue reading','sydney'); ?></a>
			</div><!-- .poster-meta -->
			<?php endif; ?>
		</div>
	</div>
</article><!-- #post-## -->
