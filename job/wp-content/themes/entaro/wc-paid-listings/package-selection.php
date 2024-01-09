<?php if ( $packages || $user_packages ) :
	$checked = 1;
	?>
	<?php if ( $user_packages ) : ?>
		<ul class="job_packages">
			
			<li class="package-section"><?php esc_html_e( 'Your Packages:', 'entaro' ); ?></li>
			<?php foreach ( $user_packages as $key => $package ) :
				$package = wc_paid_listings_get_package( $package );
				?>
				<li class="user-job-package">
					<input type="radio" <?php checked( $checked, 1 ); ?> name="job_package" value="user-<?php echo esc_attr($key); ?>" id="user-package-<?php echo esc_attr($package->get_id()); ?>" />
					<label for="user-package-<?php echo esc_attr($package->get_id()); ?>"><?php echo trim($package->get_title()); ?></label><br/>
					<?php
						if ( $package->get_limit() ) {
							printf( _n( '%s job posted out of %d', '%s jobs posted out of %d', $package->get_count(), 'entaro' ), $package->get_count(), $package->get_limit() );
						} else {
							printf( _n( '%s job posted', '%s jobs posted', $package->get_count(), 'entaro' ), $package->get_count() );
						}

						if ( $package->get_duration() ) {
							printf(  ', ' . _n( 'listed for %s day', 'listed for %s days', $package->get_duration(), 'entaro' ), $package->get_duration() );
						}

						$checked = 0;
					?>
				</li>
			<?php endforeach; ?>
			
		</ul>
	<?php endif; ?>

	<?php if ( $packages ) : ?>
		<div class="widget widget-subwoo">
			<div class="row">
				<?php foreach ( $packages as $key => $package ) :
					$product = wc_get_product( $package );
					if ( ! $product->is_type( array( 'job_package', 'job_package_subscription' ) ) || ! $product->is_purchasable() ) {
						continue;
					}
					?>

					<div class="col-md-4">
						<div class="subwoo-inner <?php echo esc_attr($product->is_featured() ? 'featured' : ''); ?>">
							<?php if($product->is_featured()){ ?>
								<span class="armorial"><i class="fa fa-star" aria-hidden="true"></i></span>
							<?php } ?>
							<div class="header-sub">
								<div class="wdiget no-margin">
									<h3 class="widget-title line-center"><?php echo trim($product->get_title()); ?></h3>
									<div class="price">
										<div class="text-white price-inner <?php echo esc_attr($product->is_featured()?' bg-second':' bg-theme');  ?>">
											<div class="inner">
											<?php echo (!empty($product->get_price())) ? $product->get_price_html() : esc_html__('Free','entaro'); ?>
											</div>
										</div>	
									</div>
								</div>
							</div>
							<div class="bottom-sub">
								<?php if ( ! empty( $product->post->post_excerpt ) ) : ?>
									<div class="content">
										<?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) ?>
									</div>
								<?php endif; ?>
								<div class="button-action text-center">
									<button class="button product_type_simple add_to_cart_button ajax_add_to_cart btn btn-danger product_type_simple" type="submit" name="job_package" value="<?php echo esc_attr($product->get_id()); ?>" id="package-<?php echo esc_attr($product->get_id()); ?>">
										<?php esc_html_e('Get Started', 'entaro') ?>
									</button>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>
<?php else : ?>

	<p><?php esc_html_e( 'No packages found', 'entaro' ); ?></p>

<?php endif; ?>
