<?php
/**
 * Template for resume content inside a list of resumes.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/content-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Resume Manager
 * @category    Template
 * @version     1.13.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$category = get_the_resume_category(); ?>
<div <?php resume_class(); ?>>
	<div class="resume-large-info clearfix">
		<div class="clearfix">
			<div class="img">
				<?php the_candidate_photo(); ?>
			</div>
			<div class="candidate-column">
				<div class="media">
					<div class="media-left media-middle left-info">
						<h3 class="title-resume"><a href="<?php the_resume_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( $category ) : ?>
							<div class="resume-category">
								<i class="fa fa-folder-open-o text-second" aria-hidden="true"></i>
								<?php echo trim($category); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="media-body media-middle text-right">
						<?php the_resume_links(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="des">
			<?php echo entaro_substring(apply_filters( 'the_resume_description', do_shortcode($post->post_content) ),18,'...'); ?>
		</div>
		<div class="bottom-link"><a class="btn-sm-list" href="<?php the_resume_permalink(); ?>"><?php esc_html_e('View Profile', 'entaro'); ?></a></div>
	</div>
</div>