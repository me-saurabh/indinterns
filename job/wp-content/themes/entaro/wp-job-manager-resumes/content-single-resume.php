<?php
/**
 * Content for a single resume.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/content-single-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Resume Manager
 * @category    Template
 * @version     1.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
$video    = get_the_candidate_video( $post );
if ( resume_manager_user_can_view_resume( $post->ID ) ) : ?>
	<div class="single-resume-content widget">

		<?php do_action( 'single_resume_start' ); ?>

		<div class="resume-aside">
			<?php if($post->_candidate_photo){ ?>
				<div class="avarta-cadidate">
					<?php the_candidate_photo('full'); ?>
				</div>
			<?php } ?>
			<div class="right-content">
				<?php the_resume_links(); ?>
				<?php get_job_manager_template( 'contact-details.php', array( 'post' => $post ), 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>
				
				<p class="job-title"><?php the_candidate_title(); ?></p>
				<p class="location"><?php the_candidate_location(); ?></p>

				
				<ul class="meta">
					<?php do_action( 'single_resume_meta_start' ); ?>

					<?php if ( get_the_resume_category() ) : ?>
						<li class="resume-category"><?php the_resume_category(); ?></li>
					<?php endif; ?>

					<li class="date-posted" itemprop="datePosted"><date><?php printf(__( 'Updated %s ago', 'entaro' ), human_time_diff( get_the_modified_time( 'U' ), current_time( 'timestamp' ) ) ); ?></date></li>

					<?php do_action( 'single_resume_meta_end' ); ?>
				</ul>
			</div>
		</div>
		<?php if(do_shortcode($post->post_content)){ ?>
			<h3 class="widget-title no-padding"><?php esc_html_e( 'Description', 'entaro' ); ?></h3>
			<div class="resume_description">
				<?php echo apply_filters( 'the_resume_description', do_shortcode($post->post_content) ); ?>
			</div>
		<?php } ?>
		<?php if($video ){ ?>
			<h3 class="widget-title"><i class="fa fa-video-camera text-second" aria-hidden="true"></i><?php esc_html_e( 'Video', 'entaro' ); ?></h3>
			<?php the_candidate_video(); ?>
		<?php } ?>
		<?php if ( ( $skills = wp_get_object_terms( $post->ID, 'resume_skill', array( 'fields' => 'names' ) ) ) && is_array( $skills ) ) : ?>
			<h2 class="widget-title"><i class="fa fa-rocket text-second" aria-hidden="true"></i><?php esc_html_e( 'Skills', 'entaro' ); ?></h2>
			<ul class="resume-manager-skills">
				<?php echo '<li>' . implode( '</li><li>', $skills ) . '</li>'; ?>
			</ul>
		<?php endif; ?>

		<?php if ( $items = get_post_meta( $post->ID, '_candidate_education', true ) ) : ?>
			<h2 class="widget-title"><i class="fa fa-graduation-cap text-second" aria-hidden="true"></i><?php esc_html_e( 'Education', 'entaro' ); ?></h2>
			<dl class="resume-manager-education">
			<?php
				foreach( $items as $item ) : ?>

					<dt>
						<small class="date"><?php echo esc_html( $item['date'] ); ?></small>
						<h3 class="sub-title"><?php printf(__( '%s at %s', 'entaro' ), '<strong class="qualification">' . esc_html( $item['qualification'] ) . '</strong>', '<strong class="location">' . esc_html( $item['location'] ) . '</strong>' ); ?></h3>
					</dt>
					<dd>
						<?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
					</dd>

				<?php endforeach;
			?>
			</dl>
		<?php endif; ?>

		<?php if ( $items = get_post_meta( $post->ID, '_candidate_experience', true ) ) : ?>
			<h2 class="widget-title"><i aria-hidden="true" class="fa fa-star text-second"></i><?php esc_html_e( 'Experience', 'entaro' ); ?></h2>
			<dl class="resume-manager-experience">
			<?php
				foreach( $items as $item ) : ?>

					<dt>
						<small class="date"><?php echo esc_html( $item['date'] ); ?></small>
						<h3 class="sub-title"><?php printf(__( '%s at %s', 'entaro' ), '<strong class="job_title">' . esc_html( $item['job_title'] ) . '</strong>', '<strong class="employer">' . esc_html( $item['employer'] ) . '</strong>' ); ?></h3>
					</dt>
					<dd>
						<?php echo wpautop( wptexturize( $item['notes'] ) ); ?>
					</dd>

				<?php endforeach;
			?>
			</dl>
		<?php endif; ?>

		<!-- portfolio -->
		<?php if ( $items = get_post_meta( $post->ID, '_candidate_portfolio', true ) ) : ?>
			<h2 class="widget-title"><i aria-hidden="true" class="fa fa-file-image-o text-second"></i><?php esc_html_e( 'Portfolio', 'entaro' ); ?></h2>
			<div id="resume-manager-portfolio" class="resume-manager-portfolio">
				<div class="row row-grid-14">
					<?php
						foreach( $items as $item ) : ?>
							<div class="col-xs-4">
								<a href="<?php echo esc_url($item); ?>" class="popup-image">
									<img src="<?php echo esc_url($item); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
									<i class="fa fa-search"></i>
								</a>
							</div>
						<?php endforeach;
					?>
				</div>
			</div>
		<?php endif; ?>

		<!-- skills -->
		<?php if ( $items = get_post_meta( $post->ID, 'entaro_resume_candidate_skills', true ) ) : ?>
			<h2 class="widget-title"><i aria-hidden="true" class="fa fa-line-chart text-second"></i><?php esc_html_e( 'Skills', 'entaro' ); ?></h2>
			<ul class="resume-manager-skills">
			<?php
				foreach( $items as $item ) : ?>

					<li class="progress-skill">
						<div class="progress-tile"><?php echo esc_attr($item['label']); ?> <span><?php echo esc_attr($item['value']); ?>%</span></div>
						 <div class="progress">
						  	<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo esc_attr($item['value']); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo esc_attr($item['value']); ?>%">
						  	</div>
						</div> 
					</li>

				<?php endforeach;
			?>
			</ul>
		<?php endif; ?>

		<?php if ( $items = get_post_meta( $post->ID, 'entaro_resume_candidate_awards', true ) ) : ?>
			<h2 class="widget-title"><i aria-hidden="true" class="fa fa-trophy text-second"></i><?php esc_html_e( 'Awards', 'entaro' ); ?></h2>
			<dl class="resume-manager-experience">
			<?php
				foreach( $items as $item ) : ?>

					<dt>
						<small class="date"><?php echo esc_html( $item['date'] ); ?></small>
						<h3 class="sub-title"><?php echo '<strong class="job_title">' . esc_html( $item['title'] ) . '</strong>'; ?></h3>
					</dt>
					<dd>
						<?php echo wpautop( wptexturize( $item['description'] ) ); ?>
					</dd>

				<?php endforeach;
			?>
			</dl>
		<?php endif; ?>

		<?php do_action( 'single_resume_end' ); ?>
	</div>
<?php else : ?>

	<?php get_job_manager_template_part( 'access-denied', 'single-resume', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/' ); ?>

<?php endif; ?>
