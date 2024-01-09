<div class="apus-search-nocategory">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<input type="hidden" name="post_type" value="product" class="post_type" />
		<div class="input-group"> 
			<input type="text" placeholder="<?php echo esc_attr(esc_html__( 'Search by Model', 'entaro' )); ?>" name="s" class="form-control"/>
			<span class="input-group-btn"> 
				<button type="submit" class="btn"><span class="ti-search"></span></button>
			</span> 
		</div>
	</form>
</div>