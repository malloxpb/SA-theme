<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Sydney
 */
?>
							</div><!--#row-->
						</div><!--!grid-container-->
					</div><!-- #content -->

					<?php do_action('sydney_before_footer'); ?>
					<footer class="mdl-mega-footer">
						<div class="mdl-mega-footer__middle-section">
							<?php if (is_active_sidebar('footer-1')) : ?>
								<?php get_sidebar('footer'); ?>
							<?php endif; ?>
						</div>
					    <a class="go-top"><i class="fa fa-angle-up"></i></a>
						<div class="mdl-mega-footer__bottom-section">
							<footer id="colophon" class="site-footer" role="contentinfo">
								<div class="site-info container">
									<span> @2017 Student Association at <a class="footer-link" href="http://web.plattsburgh.edu/">State University of New York at Plattsburgh</a> </span>
								</div><!-- .site-info -->
							</footer><!-- #colophon -->
						</div>

					</footer>

					<?php do_action('sydney_after_footer'); ?>
					<?php wp_footer(); ?>
				</div><!--mdl grid-->
			</main><!--mdl layout content-->
		</div><!--mdl layout-->
	</div><!-- #page -->
	
</body>
</html>
