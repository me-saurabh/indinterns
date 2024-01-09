<?php
/**
 * Account sign-in template to display above submit resume form.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/account-signin.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Resume Manager
 * @category    Template
 * @version     1.15.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_user_logged_in() ) : ?>

	<fieldset>
		<label><?php esc_html_e( 'Your account', 'entaro' ); ?></label>
		<div class="field account-sign-in">
			<?php
				$user = wp_get_current_user();
				printf(__( 'You are currently signed in as <strong>%s</strong>.', 'entaro' ), $user->user_login );
			?>

			<a class="button" href="<?php echo apply_filters( 'submit_resume_form_logout_url', wp_logout_url( get_permalink() ) ); ?>"><?php esc_html_e( 'Sign out', 'entaro' ); ?></a>
		</div>
	</fieldset>

<?php else :

	$account_required             = resume_manager_user_requires_account();
	$registration_enabled         = resume_manager_enable_registration();
	$generate_username_from_email = resume_manager_generate_username_from_email();
	?>
	<fieldset class="top-filed">
		<label><?php esc_html_e( 'Have an account?', 'entaro' ); ?></label>
		<div class="field account-sign-in">
			<a class="button btn btn-sm btn-success" href="<?php echo apply_filters( 'submit_resume_form_login_url', wp_login_url( add_query_arg( array( 'job_id' => $class->get_job_id() ), get_permalink() ) ) ); ?>"><?php esc_html_e( 'Sign in', 'entaro' ); ?></a><br/>

			<?php if ( $registration_enabled ) : ?>

				<?php esc_html_e( 'If you don&rsquo;t have an account you can create one below by entering your email address. Your account details will be confirmed via email.', 'entaro' ); ?>

			<?php elseif ( $account_required ) : ?>

				<?php echo apply_filters( 'submit_resume_form_login_required_message',  esc_html__( 'You must sign in to submit a resume.', 'entaro' ) ); ?>

			<?php endif; ?>
		</div>
	</fieldset>
	<?php if ( $registration_enabled ) : ?>
		<?php if ( ! $generate_username_from_email ) : ?>
			<fieldset>
				<label><?php esc_html_e( 'Username', 'entaro' ); ?> <?php echo apply_filters( 'submit_resume_form_required_label', ( ! $account_required ) ? ' <small>' . esc_html__( '(optional)', 'entaro' ) . '</small>' : '' ); ?></label>
				<div class="field">
					<input type="text" class="input-text" name="create_account_username" id="account_username" value="<?php if ( ! empty( $_POST['create_account_username'] ) ) echo sanitize_text_field( stripslashes( $_POST['create_account_username'] ) ); ?>" />
				</div>
			</fieldset>
		<?php endif; ?>
		<?php do_action( 'resume_manager_register_form' ); ?>
	<?php endif; ?>

<?php endif; ?>
