<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://profiles.wordpress.org/harshitpeer
 * @since      1.0.0
 *
 * @package    Aio_Contact_Lite
 * @subpackage Aio_Contact_Lite/public/partials
 */
?>

<style><?php echo $aio_custom_css ?></style>
<div class="aio-contact-parent">
    <div class="aio-contact-floating animate__animated animate__fadeInUp">
        <div class="aio-contact">
            <div class="aio-contact-blocks aio-contact-items">
                <?php foreach($items as $item_id => $item) { ?>
                    <div class="aio-contact-block animate__animated animate__fadeInUp" data-url="<?php esc_attr_e($item->url) ?>">
                        <div class="aio-contact-block-icon" style="color: <?php esc_attr_e($item->color) ?>">
                            <i class="<?php esc_attr_e($item->icon) ?>"></i>
                        </div>
                        <div class="aio-contact-block-details">
                            <div class="aio-contact-block-title">
                                <?php esc_html_e($item->title) ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="aio-contact-trigger animate__animated animate__fadeInRight">
        <div class="aio-contact-trigger-front">
            <i class="<?php esc_attr_e( $settings['button_icon'] ) ?>"></i>
        </div>
        <div class="aio-contact-trigger-back">
            <i class="fas fa-times"></i>
        </div>
    </div>
</div>