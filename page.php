<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Sydney
 */

get_header(); ?>

	<div id="primary" class="content-area grid-70">
		<h3> Student Association activities </h3>
		<main id="main" class="post-wrap homepage-container" role="main">
			<?php
				$args = array(
					'category_name'    => 'sa-events',
					'orderby'          => 'date',
				    'order'            => 'DESC',
				    'posts_per_page'   => 5,
					'post_type'        => 'post',
				);

				$postslist = new WP_Query($args);

				if ($postslist->have_posts()) :
			        while ($postslist->have_posts()) :
			        	$postslist->the_post();
			    		get_template_part( 'page-templates/content', 'post' );
			        endwhile;
			        wp_reset_postdata();
			    endif;
			?>

		</main><!-- #main -->
		<div>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'page-templates/content', 'page' ); ?>
			<?php endwhile; // end of the loop. ?>
		</div>
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
