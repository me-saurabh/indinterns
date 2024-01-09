<?php
if ( !function_exists ('entaro_custom_styles') ) {
	function entaro_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		
			<?php
				$font_source = entaro_get_config('font_source');
				$main_font = entaro_get_config('main_font');
				$main_font = isset($main_font['font-family']) ? $main_font['font-family'] : false;
				$main_google_font_face = entaro_get_config('main_google_font_face');
			?>
			<?php if ( ($font_source == "1" && $main_font) || ($font_source == "2" && $main_google_font_face) ): ?>
				h1, h2, h3, h4, h5, h6, .widget-title,.widgettitle
				{
					font-family: 
					<?php if ( $font_source == "2" ) echo '\'' . $main_google_font_face . '\','; ?>
					<?php if ( $font_source == "1" ) echo '\'' . $main_font . '\','; ?> 
					sans-serif;
				}
			<?php endif; ?>
			/* Second Font */
			<?php
				$secondary_font = entaro_get_config('secondary_font');
				$secondary_font = isset($secondary_font['font-family']) ? $secondary_font['font-family'] : false;
				$secondary_google_font_face = entaro_get_config('secondary_google_font_face');
			?>
			<?php if ( ($font_source == "1" && $secondary_font) || ($font_source == "2" && $secondary_google_font_face) ): ?>
				body
				{
					font-family: 
					<?php if ( $font_source == "2" ) echo '\'' . $secondary_google_font_face . '\','; ?>
					<?php if ( $font_source == "1" ) echo '\'' . $secondary_font . '\','; ?> 
					sans-serif;
				}			
			<?php endif; ?>

			/* Custom Color (skin) */ 

			/* check second color -------------------------*/ 	
			<?php if ( entaro_get_config('second_color') != "" ) : ?>
				.text-theme-second
				{
					color: <?php echo esc_html( entaro_get_config('second_color') ); ?>;
				}
				/* check second background color */
				.add-fix-top,
				.bg-theme-second
				{
					background-color: <?php echo esc_html( entaro_get_config('second_color') ); ?>;
				}
				.contact-form.style2 .btn[type="submit"],
				.contact-form input:focus, .contact-form textarea:focus{
					border-color: <?php echo esc_html( entaro_get_config('second_color') ); ?>;
				}
			<?php endif; ?>

			/* check main color */ 
			<?php if ( entaro_get_config('main_color') != "" ) : ?>
				/* seting background main */
				.apus-footer .add-fix-top:focus, .apus-footer .add-fix-top:active, .apus-footer .add-fix-top:hover,
				.category-wrapper-item.style3:hover .icon-wrapper,
				.widget-features-box.st_bg .feature-box-default:hover,
				.widget-search-form .show-search,
				.resume-large-info .btn-sm-list,
				.resume-large-info::before{
					background-color: <?php echo esc_html( entaro_get_config('main_color') ) ?>;
				}
				.widget-search-form.half.style_2 .submit .btn:hover,
				.widget-features-box.st_left .feature-box-default::before,
				.job-list_2:hover .right-content::before,
				.category-wrapper-item.style2:hover,
				.category-wrapper-item.style2:hover:before,
				.category-wrapper-item.style2:hover:after,
				.apus-pagination > span:hover, .apus-pagination > span.current, .apus-pagination > a:hover, .apus-pagination > a.current,
				.widget-list-companies .letter-title span::before,
				.navbar-nav.megamenu > li > a::before,
				.navbar-nav.megamenu > li > a::after,
				.category-wrapper-item.default:hover::before, .category-wrapper-item.default:active::before,
				.widget-jobs .widget-title-wrapper,
				.apus-register .space,
				.job-list:hover .job_tags,
				.sidebar .widget .widget-title, .apus-sidebar .widget .widget-title,
				.widget .widget-title::before, .widget .widgettitle::before, .widget .widget-heading::before,
				.widget .widget-title::after, .widget .widgettitle::after, .widget .widget-heading::after,
				.nav-tabs.tab-jobs > li.active > a, .nav-tabs.tab-jobs > li:hover > a,
				.bg-theme
				{
					background-color: <?php echo esc_html( entaro_get_config('main_color') ) ?> !important;
				}
				/* setting color*/
				.category-wrapper-item.style3 .icon-wrapper,
				.widget-search-form.p_fix .widget-title,
				.widget-features-box.st_white .feature-box-default:hover .fbox-icon,
				.contact-us-footer .left-inner,
				.post-grid-v3 i,
				.post-grid-v3 .btn-v3,
				.resume-large-info .resume-links a::before,
				.category-wrapper-item.style2 .icon-wrapper,
				.widget_meta ul li a:hover, .widget_meta ul li a:active, .widget_archive ul li a:hover, .widget_archive ul li a:active, .widget_recent_entries ul li a:hover, .widget_recent_entries ul li a:active, .widget_categories ul li a:hover, .widget_categories ul li a:active,
				.widget_meta ul li, .widget_archive ul li, .widget_recent_entries ul li, .widget_categories ul li,
				.widget-list-companies .letter-title,
				.apus-breadscrumb .breadcrumb a:hover, .apus-breadscrumb .breadcrumb a:active,
				.apus-breadscrumb .breadcrumb .active,
				.category-wrapper-item.style1 .icon-wrapper,
				.search-header .icon-search,
				.widget-search-form .title strong,
				.category-wrapper-item.default .icon-wrapper,
				.widget-list-locations ul li, .widget-list-categories ul li,
				.widget-list-locations ul li.current-cat-parent > a, .widget-list-locations ul li.current-cat > a, .widget-list-locations ul li:hover > a, .widget-list-categories ul li.current-cat-parent > a, .widget-list-categories ul li.current-cat > a, .widget-list-categories ul li:hover > a,
				.feature-box-default .fbox-icon,
				a:hover,a:active,a:focus,
				.btn-link,
				.text-theme{
					color: <?php echo esc_html( entaro_get_config('main_color') ) ?>;
				}
				/* setting border color*/
				.widget-jobs-tabs.st_center .tab-jobs,
				.apus-footer,
				.category-wrapper-item.style3 .icon-wrapper,
				.widget-search-form.p_fix .search_jobs_inner select, .widget-search-form.p_fix .search_jobs_inner .chosen-choices, .widget-search-form.p_fix .search_jobs_inner .chosen-single, .widget-search-form.p_fix .search_jobs_inner input[type="text"],
				.widget-search-form.half.style_2 .submit .btn:hover,
				.widget-search-form.half.style_2 .left-inner,
				.apus-pagination > span:hover, .apus-pagination > span.current, .apus-pagination > a:hover, .apus-pagination > a.current,
				.job-list:hover .job_tags,
				.job-list:hover,
				.border-theme{
					border-color: <?php echo esc_html( entaro_get_config('main_color') ) ?>;
				}
				.btn-link-more,
				.apus-footer .dark2 .menu li a::before,
				.widget-search .btn, .widget-search .viewmore-products-btn,
				.breadcrumb > li + li::before,
				.link-more,
				.text-theme{
					color: <?php echo esc_html( entaro_get_config('main_color') ) ?> !important;
				}
				.company-wrapper,
				.widget-contact .widget-content,
				.author-info,
				#commentform,
				.post-grid-v1 .author-share,
				.sidebar .widget .widget-title + *, .apus-sidebar .widget .widget-title + *,
				.post-grid-v2 .author-share,
				.resume-large,
				.apus-register .item,
				.category-wrapper-item.style1,
				.sidebar .widget .content, .sidebar .widget .widget-content, .apus-sidebar .widget .content, .apus-sidebar .widget .widget-content,
				.feature-box-default,
				.subwoo-inner{
					border-bottom-color:<?php echo esc_html( entaro_get_config('main_color') ) ?>;
				}
				.widget-search-form.vertical{
					border-top-color:<?php echo esc_html( entaro_get_config('main_color') ) ?>;
				}
			<?php endif; ?>


			/* check Second color */ 
			<?php if ( entaro_get_config('second_color') != "" ) : ?>
				.widget-search-form.half.style_2 .submit .btn{
					background-color:<?php echo esc_html( entaro_get_config('second_color') ) ?>;
				}
				.widget-search-form.half.style_2 .submit .btn{
					border-color:<?php echo esc_html( entaro_get_config('second_color') ) ?>;
				}

				.subwoo-inner2.featured .button-action .btn, .subwoo-inner2.featured .button-action .viewmore-products-btn, .subwoo-inner2:hover .button-action .btn, .subwoo-inner2:hover .button-action .viewmore-products-btn,
				.resume-large-info:hover .btn-sm-list,
				.resume-large-info:hover::before,
				.widget-features-box.st_left .feature-box-default:hover::before ,
				.resume-large:hover .btn-sm-list, .resume-large:active .btn-sm-list,
				.subwoo-inner.featured .button-action .btn, .subwoo-inner.featured .button-action .viewmore-products-btn,
				.subwoo-inner:hover .button-action .btn, .subwoo-inner:hover .button-action .viewmore-products-btn,
				.company-wrapper:hover .btn-conpany, .company-wrapper:active .btn-conpany,
				.bg-second{
					background-color:<?php echo esc_html( entaro_get_config('second_color') ) ?> !important;
				}

				.btn-link-more:hover,
				.btn-link-more:focus,
				.post-grid-v3:hover i, .post-grid-v3:hover .btn-v3,
				.resume-large-info:hover .title-resume a,
				.resume-large-info .resume-category i,
				.widget-job-taxonomy a::before,
				.widget-list-companies .company-items .company-item::before,
				.list-second li::before,
				.category-wrapper-item.style1:hover .icon-wrapper, .category-wrapper-item.style1:active .icon-wrapper,
				.feature-box-default:hover .fbox-icon, .feature-box-default:hover .ourservice-heading,
				.widget-list-locations ul li a::before, .widget-list-categories ul li a::before,
				.apus-footer .menu li a::before,
				.text-second{
					color:<?php echo esc_html( entaro_get_config('second_color') ) ?> !important;
				}
				.subwoo-inner2.featured .button-action .btn, .subwoo-inner2.featured .button-action .viewmore-products-btn, .subwoo-inner2:hover .button-action .btn, .subwoo-inner2:hover .button-action .viewmore-products-btn,
				.single-resume-content .widget-title i,
				.subwoo-inner.featured .button-action .btn, .subwoo-inner.featured .button-action .viewmore-products-btn,
				.subwoo-inner:hover .button-action .btn, .subwoo-inner:hover .button-action .viewmore-products-btn,
				.border-second{
					border-color:<?php echo esc_html( entaro_get_config('second_color') ) ?>  !important;
				}
				.resume-large:hover, .resume-large:active,
				.category-wrapper-item.style1:hover, .category-wrapper-item.style1:active,
				.feature-box-default:hover,
				.subwoo-inner:hover,
				.company-wrapper:hover, .company-wrapper:active{
					border-bottom-color:<?php echo esc_html( entaro_get_config('second_color') ) ?>;
				}
			<?php endif; ?>


			<?php if ( entaro_get_config('button_color') != "" ) : ?>
				.btn-outline.btn-theme
				{
					color: <?php echo esc_html( entaro_get_config('button_color') ); ?>;
				}
				/* check second background color */
				.listing-action .change-view:hover, .listing-action .change-view.active,
				div.job_listings .load_more_jobs,
				.btn-theme
				{
					background-color: <?php echo esc_html( entaro_get_config('button_color') ); ?>;
				}
				.listing-action .change-view:hover, .listing-action .change-view.active,
				div.job_listings .load_more_jobs,
				.btn-outline.btn-white,
				.btn-theme
				{
					border-color: <?php echo esc_html( entaro_get_config('button_color') ); ?>;
				}

			<?php endif; ?>

			<?php if ( entaro_get_config('button_hover_color') != "" ) : ?>
				.text-theme-second
				{
					color: <?php echo esc_html( entaro_get_config('button_hover_color') ); ?>;
				}
				/* check second background color */
				div.job_listings .load_more_jobs:focus, div.job_listings .load_more_jobs:hover,
				.search-header .icon-search:hover, .search-header .icon-search:active, .search-header .icon-search.active,
				.btn-outline.btn-white:hover,
				.btn-outline.btn-white:active,
				.btn-outline.btn-themes:hover,
				.btn-outline:active,
				.btn-theme:hover,.btn-theme:focus, .btn-theme:active, .btn-theme.active
				{
					background-color: <?php echo esc_html( entaro_get_config('button_hover_color') ); ?>;
				}
				div.job_listings .load_more_jobs:focus, div.job_listings .load_more_jobs:hover,
				.search-header .icon-search:hover, .search-header .icon-search:active, .search-header .icon-search.active,
				.btn-outline.btn-white:hover,
				.btn-outline.btn-white:active,
				.btn-theme:hover,
				.btn-theme:active,
				.btn-theme:focus
				{
					border-color: <?php echo esc_html( entaro_get_config('button_hover_color') ); ?>;
				}
			<?php endif; ?>



			<?php if ( entaro_get_config('button_sc_color') != "" ) : ?>
				.btn-second
				{
					background-color: <?php echo esc_html( entaro_get_config('button_sc_color') ); ?>;
				}
				.btn-second
				{
					border-color: <?php echo esc_html( entaro_get_config('button_sc_color') ); ?>;
				}
			<?php endif; ?>

			<?php if ( entaro_get_config('button_sc_hover_color') != "" ) : ?>
				.btn-second:hover,
				.btn-second:focus
				{
					background-color: <?php echo esc_html( entaro_get_config('button_sc_hover_color') ); ?>;
				}
				.btn-second:hover,
				.btn-second:focus
				{
					border-color: <?php echo esc_html( entaro_get_config('button_sc_hover_color') ); ?>;
				}
			<?php endif; ?>

			/***************************************************************/
			/* Top Bar *****************************************************/
			/***************************************************************/
			/* Top Bar Backgound */
			<?php $topbar_bg = entaro_get_config('topbar_bg'); ?>
			<?php if ( !empty($topbar_bg) ) :
				$image = isset($topbar_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $topbar_bg['background-image']) : '';
				$topbar_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				#apus-topbar {
					<?php if ( isset($topbar_bg['background-color']) && $topbar_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $topbar_bg['background-color'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-repeat']) && $topbar_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $topbar_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-size']) && $topbar_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $topbar_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-attachment']) && $topbar_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $topbar_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($topbar_bg['background-position']) && $topbar_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $topbar_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $topbar_bg_image ): ?>
				    background-image: <?php echo esc_html( $topbar_bg_image ) ?>;
				    <?php endif; ?>
				}
			<?php endif; ?>
			/* Top Bar Color */
			<?php if ( entaro_get_config('topbar_text_color') != "" ) : ?>
				#apus-topbar {
					color: <?php echo esc_html(entaro_get_config('topbar_text_color')); ?>;
				}
			<?php endif; ?>
			/* Top Bar Link Color */
			<?php if ( entaro_get_config('topbar_link_color') != "" ) : ?>
				#apus-topbar a {
					color: <?php echo esc_html(entaro_get_config('topbar_link_color')); ?>;
				}
			<?php endif; ?>

			<?php if ( entaro_get_config('topbar_link_hover_color') != "" ) : ?>
				#apus-topbar a:hover,#apus-topbar a:active,#apus-topbar a:focus {
					color: <?php echo esc_html(entaro_get_config('topbar_link_hover_color')); ?>;
				}
			<?php endif; ?>

			/***************************************************************/
			/* Header *****************************************************/
			/***************************************************************/
			/* Header Backgound */
			<?php $header_bg = entaro_get_config('header_bg'); ?>
			<?php if ( !empty($header_bg) ) :
				$image = isset($header_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $header_bg['background-image']) : '';
				$header_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>	.header-v2 .sticky-header,
			?>	.header-v3 .sticky-header,
			?>	.header-v4 .sticky-header,
				#apus-header {
					<?php if ( isset($header_bg['background-color']) && $header_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $header_bg['background-color'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-repeat']) && $header_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $header_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-size']) && $header_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $header_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-attachment']) && $header_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $header_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($header_bg['background-position']) && $header_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $header_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $header_bg_image ): ?>
				    background-image: <?php echo esc_html( $header_bg_image ) ?>;
				    <?php endif; ?>
				}
			<?php endif; ?>
			/* Header Color */
			<?php if ( entaro_get_config('header_text_color') != "" ) : ?>
				#apus-header {
					color: <?php echo esc_html(entaro_get_config('header_text_color')); ?>;
				}
			<?php endif; ?>
			/* Header Link Color */
			<?php if ( entaro_get_config('header_link_color') != "" ) : ?>
				#apus-header a {
					color: <?php echo esc_html(entaro_get_config('header_link_color'));?> ;
				}
			<?php endif; ?>
			/* Header Link Color Active */
			<?php if ( entaro_get_config('header_link_color_active') != "" ) : ?>
				#apus-header .active > a,
				#apus-header a:active,
				#apus-header a:hover {
					color: <?php echo esc_html(entaro_get_config('header_link_color_active')); ?>;
				}
			<?php endif; ?>


			/* Menu Link Color */
			<?php if ( entaro_get_config('main_menu_link_color') != "" ) : ?>
				.navbar-nav.megamenu > li > a{
					color: <?php echo esc_html(entaro_get_config('main_menu_link_color'));?> !important;
				}
			<?php endif; ?>
			
			/* Menu Link Color Active */
			<?php if ( entaro_get_config('main_menu_link_color_active') != "" ) : ?>
				.navbar-nav.megamenu > li:hover > a,
				.navbar-nav.megamenu > li.active > a,
				.navbar-nav.megamenu > li > a:hover,
				.navbar-nav.megamenu > li > a:active
				{
					color: <?php echo esc_html(entaro_get_config('main_menu_link_color_active')); ?> !important;
				}
			<?php endif; ?>
			<?php if ( entaro_get_config('main_menu_link_color_active') != "" ) : ?>
				.navbar-nav.megamenu > li.active > a,
				.navbar-nav.megamenu > li:hover > a{
					border-color: <?php echo esc_html(entaro_get_config('main_menu_link_color_active'));?> !important;
				}
			<?php endif; ?>

			/***************************************************************/
			/* Footer *****************************************************/
			/***************************************************************/
			/* Footer Backgound */
			<?php $footer_bg = entaro_get_config('footer_bg'); ?>
			<?php if ( !empty($footer_bg) ) :
				$image = isset($footer_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $footer_bg['background-image']) : '';
				$footer_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				#apus-footer {
					<?php if ( isset($footer_bg['background-color']) && $footer_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $footer_bg['background-color'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-repeat']) && $footer_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $footer_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-size']) && $footer_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $footer_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-attachment']) && $footer_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $footer_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($footer_bg['background-position']) && $footer_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $footer_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $footer_bg_image ): ?>
				    background-image: <?php echo esc_html( $footer_bg_image ) ?>;
				    <?php endif; ?>
				}
			<?php endif; ?>
			/* Footer Heading Color*/
			<?php if ( entaro_get_config('footer_heading_color') != "" ) : ?>
				#apus-footer h1, #apus-footer h2, #apus-footer h3, #apus-footer h4, #apus-footer h5, #apus-footer h6 ,#apus-footer .widget-title {
					color: <?php echo esc_html(entaro_get_config('footer_heading_color')); ?> !important;
				}
			<?php endif; ?>
			/* Footer Color */
			<?php if ( entaro_get_config('footer_text_color') != "" ) : ?>
				.apus-footer .dark2,
				#apus-footer {
					color: <?php echo esc_html(entaro_get_config('footer_text_color')); ?>;
				}
			<?php endif; ?>
			/* Footer Link Color */
			<?php if ( entaro_get_config('footer_link_color') != "" ) : ?>
				#apus-footer a {
					color: <?php echo esc_html(entaro_get_config('footer_link_color')); ?>;
				}
			<?php endif; ?>

			/* Footer Link Color Hover*/
			<?php if ( entaro_get_config('footer_link_color_hover') != "" ) : ?>
				#apus-footer a:hover {
					color: <?php echo esc_html(entaro_get_config('footer_link_color_hover')); ?>;
				}
			<?php endif; ?>




			/***************************************************************/
			/* Copyright *****************************************************/
			/***************************************************************/
			/* Copyright Backgound */
			<?php $copyright_bg = entaro_get_config('copyright_bg'); ?>
			<?php if ( !empty($copyright_bg) ) :
				$image = isset($copyright_bg['background-image']) ? str_replace(array('http://', 'https://'), array('//', '//'), $copyright_bg['background-image']) : '';
				$copyright_bg_image = $image && $image != 'none' ? 'url('.esc_url($image).')' : $image;
			?>
				.apus-copyright {
					<?php if ( isset($copyright_bg['background-color']) && $copyright_bg['background-color'] ): ?>
				    background-color: <?php echo esc_html( $copyright_bg['background-color'] ) ?> !important;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-repeat']) && $copyright_bg['background-repeat'] ): ?>
				    background-repeat: <?php echo esc_html( $copyright_bg['background-repeat'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-size']) && $copyright_bg['background-size'] ): ?>
				    background-size: <?php echo esc_html( $copyright_bg['background-size'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-attachment']) && $copyright_bg['background-attachment'] ): ?>
				    background-attachment: <?php echo esc_html( $copyright_bg['background-attachment'] ) ?>;
				    <?php endif; ?>
				    <?php if ( isset($copyright_bg['background-position']) && $copyright_bg['background-position'] ): ?>
				    background-position: <?php echo esc_html( $copyright_bg['background-position'] ) ?>;
				    <?php endif; ?>
				    <?php if ( $copyright_bg_image ): ?>
				    background-image: <?php echo esc_html( $copyright_bg_image ) ?> !important;
				    <?php endif; ?>
				}
			<?php endif; ?>

			/* Footer Color */
			<?php if ( entaro_get_config('copyright_text_color') != "" ) : ?>
				.apus-copyright {
					color: <?php echo esc_html(entaro_get_config('copyright_text_color')); ?>;
				}
			<?php endif; ?>
			/* Footer Link Color */
			<?php if ( entaro_get_config('copyright_link_color') != "" ) : ?>
				.apus-copyright a {
					color: <?php echo esc_html(entaro_get_config('copyright_link_color')); ?>;
				}
			<?php endif; ?>

			/* Footer Link Color Hover*/
			<?php if ( entaro_get_config('copyright_link_color_hover') != "" ) : ?>
				.apus-copyright a:hover {
					color: <?php echo esc_html(entaro_get_config('copyright_link_color_hover')); ?>;
				}
			<?php endif; ?>

			/* Woocommerce Breadcrumbs */
			<?php if ( entaro_get_config('breadcrumbs') == "0" ) : ?>
			.woocommerce .woocommerce-breadcrumb,
			.woocommerce-page .woocommerce-breadcrumb
			{
				display:none;
			}
			<?php endif; ?>


	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		return implode($new_lines);
	}
}
