<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Entaro
 * @since Entaro 1.0
 */

$footer = apply_filters( 'entaro_get_footer_layout', 'default' );
?>

	</div><!-- .site-content -->

	<footer id="apus-footer" class="apus-footer" role="contentinfo">
		<div class="footer-inner">
			<?php if ( !empty($footer) ): ?>
				<?php entaro_display_footer_builder($footer); ?>
			<?php else: ?>
				<div class="footer-default">
					<div class="apus-copyright">
						<div class="container">
							<div class="copyright-content clearfix">
								<div class="text-copyright pull-right">
									<?php
										
										$allowed_html_array = array( 'a' => array('href' => array()) );
										echo wp_kses(__('&copy; 2018 - Entaro. All Rights Reserved. <br/> Powered by <a href="//apusthemes.com">ApusThemes</a>', 'entaro'), $allowed_html_array);
									?>

								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php
		if ( entaro_get_config('back_to_top') ) { ?>
			<a href="#" id="back-to-top" class="add-fix-top">
				<i class="fa fa-angle-up" aria-hidden="true"></i>
			</a>
		<?php
		}
		?>
	</footer><!-- .site-footer -->
	<?php get_template_part('sidebar'); ?>
	
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>