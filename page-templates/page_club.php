<?php

/*

Template Name: Club page template

*/
	get_header();
?>

	<div id="primary" class="content-area col-md-9">
		<main id="main" class="site-main" role="main">

			<h1 class="page-club-title"> <?php echo get_the_title(); ?> </h1>
		
			<div id="masonry-grid">
				<div class="grid-container">
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

					$args = array(
						'orderby'          => 'name',
					    'order'            => 'ASC',
					    'posts_per_page'   => 15,
						'paged'            => $paged,
						'post_type'        => 'club',
					);

				    $postslist = new WP_Query($args);

				    if ($postslist->have_posts()):
				        while ($postslist->have_posts()): 
				        	$postslist->the_post(); 
				    	?>
						    <article class="grid-item club-item clearfix grid-33 tablet-grid-50 mobile-grid-100">
								<div class="club-inner">
									<a class="club-link" href="<?php the_permalink(); ?>"></a>
									<div class="club-thumbnail">
										<?php the_post_thumbnail('create_thumb_smallpost'); ?>
									</div>
									<div class="club-description">
										<a href="#" class="club-title"><?php the_title(); ?></a>
										<p> <?php the_excerpt(); ?> </p>
									</div>
								</div>
							</article>
				    	<?php  
				        endwhile;
				        echo '</div></div>';
				        kriesi_pagination($postslist->max_num_pages);
				        wp_reset_postdata();
				    endif;
				    ?>


		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>