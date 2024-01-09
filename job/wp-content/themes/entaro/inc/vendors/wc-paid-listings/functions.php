<?php

function entaro_submit_job_steps($steps) {
	if ( isset($steps['wc-choose-package']) && isset($steps['wc-choose-package']['view']) && is_array($steps['wc-choose-package']['view']) ) {
		$steps['wc-choose-package']['view'] = 'entaro_choose_package';
	}
	return $steps;
}
add_filter( 'submit_job_steps', 'entaro_submit_job_steps', 100 );

function entaro_choose_package( $atts = array() ) {
	if ( class_exists('WP_Job_Manager_Form_Submit_Job') && class_exists('WP_Job_Manager_WCPL_Submit_Job_Form') ) {
		$form      = WP_Job_Manager_Form_Submit_Job::instance();
		$job_id    = $form->get_job_id();
		$step      = $form->get_step();
		$form_name = $form->form_name;
		$packages  = WP_Job_Manager_WCPL_Submit_Job_Form::get_packages( isset( $atts['packages'] ) ? explode( ',', $atts['packages'] ) : array() );
		$user_packages = wc_paid_listings_get_user_packages( get_current_user_id(), 'job_listing' );
		?>
			<form method="post" id="job_package_selection">
				<div class="job_listing_packages_title">
					<input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
					<input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
					<input type="hidden" name="job_manager_form" value="<?php echo esc_attr($form_name); ?>" />
				</div>
				<div class="apus_job_listing_packages">
					<?php get_job_manager_template( 'package-selection.php', array( 'packages' => $packages, 'user_packages' => $user_packages ), 'wc-paid-listings', JOB_MANAGER_WCPL_PLUGIN_DIR . '/templates/' ); ?>
				</div>
			</form>
		<?php
	}
}

function entaro_submit_resume_steps($steps) {
	if ( isset($steps['wc-choose-package']) && isset($steps['wc-choose-package']['view']) && is_array($steps['wc-choose-package']['view']) ) {
		$steps['wc-choose-package']['view'] = 'entaro_resume_choose_package';
	}
	return $steps;
}
add_filter( 'submit_resume_steps', 'entaro_submit_resume_steps', 100 );

function entaro_resume_choose_package( $atts = array() ) {
	if ( class_exists('WP_Resume_Manager_Form_Submit_Resume') && class_exists('WP_Job_Manager_WCPL_Submit_Resume_Form') ) {
		$form      = WP_Resume_Manager_Form_Submit_Resume::instance();
		$resume_id = $form->get_resume_id();
		$job_id    = $form->get_job_id();
		$step      = $form->get_step();
		$form_name = $form->form_name;
		$packages      =  WP_Job_Manager_WCPL_Submit_Resume_Form::get_packages();
		$user_packages = wc_paid_listings_get_user_packages( get_current_user_id(), 'resume' );
		?>
		<form method="post" id="job_package_selection">
			<div class="job_listing_packages_title">
				<input type="hidden" name="resume_id" value="<?php echo esc_attr( $resume_id ); ?>" />
				<input type="hidden" name="job_id" value="<?php echo esc_attr( $job_id ); ?>" />
				<input type="hidden" name="step" value="<?php echo esc_attr( $step ); ?>" />
				<input type="hidden" name="resume_manager_form" value="<?php echo esc_attr($form_name); ?>" />

			</div>
			<div class="apus_job_listing_packages">
				<?php get_job_manager_template( 'resume-package-selection.php', array( 'packages' => $packages, 'user_packages' => $user_packages ), 'wc-paid-listings', JOB_MANAGER_WCPL_PLUGIN_DIR . '/templates/' ); ?>
			</div>
		</form>
		<?php
	}
}

