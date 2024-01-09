<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$companies = Entaro_Job_Manager_Company::get_companies();
$bcol = 12/$columns;
if ( !empty($companies) ) {
	$companies_by_letter = array();

	foreach ( $companies as $company ) {
		$companies_by_letter[strtoupper($company[0])][] = $company;
	}

?>
<div class="widget widget-list-companies <?php echo esc_attr($el_class); ?>">
	
    <div class="widget-content">
		<?php if ( $show_filter_alphabet ) { ?>
			<ul class="list-alphabet">
				<?php foreach ( range( 'A', 'Z' ) as $value ) { ?>
					<li><a href="#<?php echo esc_attr($value); ?>"><?php echo esc_attr($value); ?></a></li>
				<?php } ?>
			</ul>
		<?php } ?>

		<div class="companies-wrapper row">
			<?php foreach ( range( 'A', 'Z' ) as $letter ) {
				if ( ! isset( $companies_by_letter[ $letter ] ) ) {
					continue;
				}
				?>
				<div class="company-items col-md-<?php echo esc_attr($bcol); ?>">
					<div id="<?php echo esc_attr($letter); ?>" class="letter-title"><span><?php echo esc_attr($letter); ?></span></div>
					<?php
					foreach ( $companies_by_letter[$letter] as $company_name ) {
						$count = count( get_posts( array( 'post_type' => 'job_listing',
									'meta_key' => '_company_name',
									'meta_value' => $company_name,
									'nopaging' => true )
								));
			?>
						<div class="company-item">
							<a href="<?php echo esc_url(Entaro_Job_Manager_Company::get_url( $company_name )); ?>">
								<?php echo sprintf(__('%s (%d)', 'entaro'), $company_name, $count); ?>
							</a>
						</div>

				<?php } ?>
				</div>
			<?php } ?>
		</div>
    </div>
</div>
<?php }