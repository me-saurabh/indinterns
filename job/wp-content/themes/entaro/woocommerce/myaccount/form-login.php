<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$args = array('#customer_login', '#customer_register');
$action = isset($_COOKIE['entaro_login_register']) && in_array($_COOKIE['entaro_login_register'], $args) ? $_COOKIE['entaro_login_register'] : '#customer_login';
?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="user">

	<div id="customer_login" class="register_login_wrapper <?php echo esc_attr($action == '#customer_login' ? 'active' : ''); ?>">
		<h2 class="title"><?php esc_html_e( 'Login', 'entaro' ); ?></h2>
		<form method="post" class="login" role="form">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="form-group form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'entaro' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text form-control" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
			</p>
			<p class="form-group form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'entaro' ); ?> <span class="required">*</span></label>
				<input class="input-text form-control" type="password" name="password" id="password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="form-group form-row">
				<?php wp_nonce_field( 'woocommerce-login' ); ?>
				<div class="form-group clearfix">
					<span for="rememberme" class="inline pull-left">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php esc_html_e( 'Remember me', 'entaro' ); ?>
					</span>
					<span class="lost_password pull-right">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'entaro' ); ?></a>
					</span>
				</div>
				<input type="submit" class="btn btn-theme btn-block" name="login" value="<?php esc_html_e( 'sign in', 'entaro' ); ?>" />
			</div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
			<div class="create text-center">
				<div class="line-border center">
					<span class="center-line"><?php echo esc_html__('or','entaro') ?></span>
				</div>
				<a class="creat-account register-login-action" href="#customer_register"><?php echo esc_html__('CREATE AN ACCOUNT','entaro'); ?></a>
			</div>
		<?php endif; ?>

	</div>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	<div id="customer_register" class="content-register register_login_wrapper <?php echo esc_attr($action == '#customer_register' ? 'active' : ''); ?>">

		<h2 class="title"><?php esc_html_e( 'Register', 'entaro' ); ?></h2>
		<form method="post" class="register widget" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="form-group form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'entaro' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
				</p>

			<?php endif; ?>

			<p class="form-group form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'entaro' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="form-group form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'entaro' ); ?> <span class="required">*</span></label>
					<input type="password" class="input-text form-control" name="password" id="reg_password" />
				</p>

			<?php else : ?>

				<p><?php esc_html_e( 'A password will be sent to your email address.', 'entaro' ); ?></p>

			<?php endif; ?>


			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="form-group form-row">
				<?php wp_nonce_field( 'woocommerce-register' ); ?>
				<input type="submit" class="btn btn-info btn-block" name="register" value="<?php esc_html_e( 'Register', 'entaro' ); ?>" />
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

		<div class="create text-center">
			<div class="line-border center">
				<span class="center-line"><?php echo esc_html__('or','entaro') ?></span>
			</div>
			<a class="login-account register-login-action" href="#customer_login"><?php echo esc_html__('SIGN IN','entaro'); ?></a>
		</div>

	</div>

<?php endif; ?>
</div>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>