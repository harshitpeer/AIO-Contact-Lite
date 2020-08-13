<?php

/**
 * AIO Contact Lite Common Header Section
 *
 * @link       harshitpeer.com
 * @since      1.0.0
 *
 * @package    Aio_Contact_Lite
 * @subpackage Aio_Contact_Lite/admin/partials
 */
?>

<div class="aio-contact aio-contact-header">
    <div class="aio-contact-logo">
        <img src="<?php echo $this->plugin_admin_dir() . 'images/logo.svg' ?>" alt="AIO Contact Logo">	
    </div>
    <div class="aio-contact-menu">
        <a href="<?php echo admin_url( 'admin.php?page=' . $this->plugin_name ) ?>" class="aio-contact-menu-item"><?php _e('Items') ?></a>
        <a href="<?php echo admin_url( 'admin.php?page=' . $this->plugin_name . '-settings' ) ?>" class="aio-contact-menu-item"><?php _e('Settings') ?></a>
        <a href="https://h-p.co/AIO" class="aio-contact-menu-item aio-contact-menu-highlight" target="_blank"><?php _e('Premium Version') ?></a>
    </div>	
</div>