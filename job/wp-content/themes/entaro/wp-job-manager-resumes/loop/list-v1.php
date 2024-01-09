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
	<div class="resume-normal clearfix">
		<a href="<?php the_resume_permalink(); ?>">

			<?php the_candidate_photo(); ?>
			<div class="candidate-column">
				<h3 class="title-resume"><?php the_title(); ?></h3>
				<?php if ( $category ) : ?>
					<div class="resume-category">
						<i class="fa fa-folder-open-o text-second" aria-hidden="true"></i>
						<?php echo trim($category); ?>
					</div>
				<?php endif; ?>
			</div>
		</a>
	</div>
</div>