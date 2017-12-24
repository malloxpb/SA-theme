<?php
/*
Template Name: events page
*/

get_header(); ?>

	<div id="primary" class="content-area grid-70">
		<h2> Events on campus </h2>
		<main id="main" class="post-wrap event-homepage" role="main">
			<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'category_name'    => 'events',
					'orderby'          => 'date',
				    'order'            => 'DESC',
				    'posts_per_page'   => 15,
				    'paged'            => $paged,
					'post_type'        => 'post',
				);

				$postslist = new WP_Query($args);

				if ($postslist->have_posts()) :
			        while ($postslist->have_posts()) :
			        	$postslist->the_post();
			    		get_template_part( 'page-templates/content', 'post' );
			        endwhile;
			        kriesi_pagination($postslist->max_num_pages);
			        wp_reset_postdata();
			    endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
