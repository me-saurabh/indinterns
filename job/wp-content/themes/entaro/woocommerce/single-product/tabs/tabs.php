<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$i = 0;
if ( ! empty( $tabs ) ) : ?>

	<div class="woocommerce-tabs tabs-v1">
		<div class="tap-top">
			<ul class="tabs-list nav nav-tabs">
				<?php foreach ( $tabs as $key => $tab ) : ?>
					<li <?php echo trim($i == 0 ? ' class="active"' : '');?>>
						<a data-toggle="tab" href="#tabs-list-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></a>
					</li>
				<?php $i++; endforeach; ?>
			</ul>
		</div>
		<div class="tab-content">
		<?php $i = 0; ?>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="tab-pane<?php echo esc_attr($i == 0 ? ' active in' : ''); ?>" id="tabs-list-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $tab['callback'] ) ) {
					call_user_func( $tab['callback'], $key, $tab );
				}
				?>
			</div>
		<?php $i++; endforeach; ?>
		</div>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>
<?php endif; ?>