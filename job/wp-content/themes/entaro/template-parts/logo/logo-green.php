<?php
    $logo = entaro_get_config('media-logo2');
?>

<?php if( isset($logo['url']) && !empty($logo['url']) ): ?>
    <div class="logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
    </div>
<?php else: ?>
    <div class="logo logo-theme">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
            <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/logo-green.png'); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
    </div>
<?php endif; ?>