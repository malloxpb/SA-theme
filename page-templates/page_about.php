<?php
/*
Template Name: About us Page
*/

get_header(); ?>

	<div id="primary" class="fp-content-area">
		<main id="main" class="site-main" role="main">

			<div class="entry-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div><!-- .entry-content -->

			<div id="masonry-grid">
				<div class="grid-container">
				<?php
					$args = array(
						'orderby'          => 'name',
					    'order'            => 'ASC',
						'post_type'        => 'SAteam',
						'posts_per_page'   => -1,
					);

					$postslist = new WP_Query($args);

					if ($postslist->have_posts()):
					    while ($postslist->have_posts()):
					    	$postslist->the_post(); 
					    ?>
					    <article class="grid-item aboutus-post-wrapper grid-25 tablet-grid-33 mobile-grid-50">
							<div class="aboutus-inner">
								<div class="aboutus-thumbnail">
									<?php the_post_thumbnail('create_thumb_small'); ?>
								</div>
								<div class="club-description">
									<h3 class="aboutus-title"><?php the_title(); ?></h3>
									<div class="aboutus-description-inner hidden">
										<p> <?php the_excerpt(); ?> </p>
									</div>
								</div>
							</div>
						</article>
						<?php
					    endwhile;
					endif;
				?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
