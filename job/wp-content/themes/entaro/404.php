<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Entaro
 * @since Entaro 1.0
 */
/*

*Template Name: 404 Page
*/
get_header();
$background = entaro_get_config('background-img');
?>
<section class="page-404" <?php if(!empty($background) && !empty($background['url'])) echo 'style="background:url('.esc_url( $background['url']).')" '; ?> >
	<div id="main-container" class="inner">
		<div id="main-content" class="main-page">
			<section class="error-404 not-found text-center clearfix">
				<div class="slogan">
					<?php if(!empty(entaro_get_config('404_title', '404')) ) { ?>
						<h4 class="title-big"><?php echo wp_kses_post(entaro_get_config('404_title', '404')); ?></h4>
					<?php } else { ?>
						<img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/404.png'); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
					<?php } ?>
				</div>
				<h1 class="page-title"><?php echo wp_kses_post(entaro_get_config('404_subtitle', 'Oops! This page Could Not Be Found!')); ?></h1>
				<div class="page-content">
					<div class="sub-title">
						<?php echo wp_kses_post(entaro_get_config('404_description', 'Sorry bit the page you are looking for does not exist, have been removed or name changed')); ?>
					</div>
					<div class="back-home">
						<a class="btn btn-primary btn-error radius-0" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__('go to homepage','entaro') ?></a>
					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div><!-- .content-area -->
	</div>
</section>
<?php get_footer(); ?>