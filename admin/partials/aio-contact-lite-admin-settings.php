<?php

/**
 * AIO Contact Lite Settings Page
 *
 * @link       harshitpeer.com
 * @since      1.0.0
 *
 * @package    Aio_Contact_Lite
 * @subpackage Aio_Contact_Lite/admin/partials
 */

$settings = get_option( $this->plugin_name . '-settings');
if(!is_array($settings)) {
    $settings = array();
}

$default_settings = new \stdClass;
$default_settings->position = 'br';
$default_settings->button_icon = 'fas fa-comment-alt';
$default_settings->button_icon_color = '#FFFFFF';
$default_settings->button_color = '#3047EC';

foreach($default_settings as $key => $value) {
    if(!isset($settings[$key])) {
        $settings[$key] = $value;
    }
}
?>
<?php settings_errors(); ?>
<div class="aio-contact aio-contact-body">
    <div class="aio-contact-section">
        <div class="aio-contact-section-title">
            <h2><?php _e('Appearance') ?></h2>
            <p class="aio-h-italic-text aio-h-dim-text"><?php _e('You can tweak the settings here to change the look and feel of AIO Contact.') ?></p>
        </div>
        <div class="aio-contact-fields">
            <form action="options.php" method="post">
                <div class="aio-contact-field">
                    <div class="aio-contact-field-label">
                        <label for="position"><?php _e('Position') ?></label>
                    </div>
                    <div class="aio-contact-field-input">
                        <select name="position" id="position">
                            <option value="bl" <?php esc_attr_e( ($settings['position'] == 'bl') ? 'selected' : '' ) ?>><?php _e('Bottom Left') ?></option>
                            <option value="br" <?php esc_attr_e( ($settings['position'] == 'br') ? 'selected' : '' ) ?>><?php _e('Bottom Right') ?></option>
                        </select>
                        <br>
                        <p class="aio-field-description aio-h-italic-text aio-h-dim-text"><?php _e('You can change the position of the AIO Contact button') ?></p>
                    </div>
                </div>
                <div class="aio-contact-field">
                    <div class="aio-contact-field-label">
                        <label for="button_icon"><?php _e('Button Icon') ?></label>
                    </div>
                    <div class="aio-contact-field-input">
                        <button class="btn btn-secondary" id="button_icon" name="button_icon" role="iconpicker" data-icon="<?php esc_attr_e( $settings['button_icon'] ) ?>"></button>
                        <br>
                        <p class="aio-field-description aio-h-italic-text aio-h-dim-text"><?php _e('This is the icon which will be shown the trigger button') ?></p>
                        <div class="aio-h-divider"></div>
                        <input type="text" class="color-picker" name="button_icon_color" id="button_icon_color" value="<?php esc_attr_e( $settings['button_icon_color'] ) ?>">
                        <p class="aio-field-description aio-h-italic-text aio-h-dim-text"><?php _e('You can set the button icon color') ?></p>
                    </div>
                </div>
                <div class="aio-contact-field">
                    <div class="aio-contact-field-label">
                        <label for="button_color"><?php _e('Button Color') ?></label>
                    </div>
                    <div class="aio-contact-field-input">
                        <input type="text" class="color-picker" name="button_color" id="button_color" value="<?php esc_attr_e( $settings['button_color'] ) ?>">
                        <br>
                        <p class="aio-field-description aio-h-italic-text aio-h-dim-text"><?php _e('This is the color of the trigger button') ?></p>
                        <div class="aio-h-divider"></div>
                        <div class="aio-contact-extra-field">
                            <input type="checkbox" id="button_box_shadow" name="button_box_shadow" value="1" <?php esc_attr_e( ($settings['button_box_shadow']) ? 'checked' : '' ) ?>>
                            <label class="form-check-label" for="button_box_shadow"><?php _e('Show Button Box Shadow') ?></label>
                        </div>
                    </div>
                </div>
                <div class="aio-contact-field">
                    <?php 
                    settings_fields( $this->plugin_name );
                    do_settings_sections( $this->plugin_name );
                    submit_button(esc_html__('Save Settings', $this->plugin_name), 'primary','settings', TRUE); 
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
