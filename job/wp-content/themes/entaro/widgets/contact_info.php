<?php
extract( $args );
extract( $instance );

?>

<div class="contact-info-widget">
<?php
if ( $email_icon != '' || $email_content != '' ) {
    ?>
    <div class="media email-info pull-right">
        <?php if ( $email_icon ) { ?>
            <div class="media-left media-middle">
                <div class="icon">
                    <img src="<?php echo esc_url($email_icon); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
                </div>
            </div>
        <?php } ?>
        <div class="media-body">
            <?php if ($email_content) { ?>
                <div class="content"><?php echo trim($email_content); ?></div>
            <?php } ?>
        </div>
    </div>
    <?php
}
?>

<?php
if ( $phone_icon != '' || $phone_content != '' ) {
    ?>
    <div class="media phone-info pull-right">
        <?php if ( $phone_icon ) { ?>
            <div class="media-left media-middle">
                <div class="icon">
                <img src="<?php echo esc_url($phone_icon); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
                </div>
            </div>
        <?php } ?>
        <div class="media-body">
            <?php if ($phone_content) { ?>
                <div class="content"><?php echo trim($phone_content); ?></div>
            <?php } ?>
        </div>
    </div>
    <?php
}
?>

<?php
if ( $address_icon != '' || $address_content != '' ) {
    ?>
    <div class="media address-info pull-right">
        <?php if ( $address_icon ) { ?>
            <div class="media-left media-middle">
                <div class="icon">
                <img src="<?php echo esc_url($address_icon); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
                </div>
            </div>
        <?php } ?>
        <div class="media-body">
            <?php if ($address_content) { ?>
                <div class="content"><?php echo trim($address_content); ?></div>
            <?php } ?>
        </div>
    </div>
    <?php
}
?>
</div>