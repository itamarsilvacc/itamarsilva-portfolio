<?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
$isp_logo_image = $custom_logo_image[0];
?>
<a class="img-logo" href="<?php echo SITE_URL; ?>"><img src="<?php echo $isp_logo_image; ?>" alt="<?php echo SITE_NAME; ?> - <?php echo SITE_DESCRIPTION; ?>"></a>