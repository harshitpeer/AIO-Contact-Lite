<?php

/**
 * AIO Contact Lite Items Page
 *
 * @link       harshitpeer.com
 * @since      1.0.0
 *
 * @package    Aio_Contact_Lite
 * @subpackage Aio_Contact_Lite/admin/partials
 */

$items = json_decode(get_option( $this->plugin_name . '-items' ));
if($items == null) {
    $items = array();
}
?>
<div class="aio-contact-preloader">
    <i class="fas fa-sync-alt fa-spin"></i>
</div>
<div id="aio-contact-items" class="d-none"><?php _e(json_encode($items)) ?></div>
<div class="aio-contact aio-contact-body">
    <div class="row aio-contact-items" id="sortable">
        <?php foreach($items as $item_id => $item) { ?>
        <div class="col-xl-3 col-lg-4 col-md-6" id="aio-contact-item-<?php esc_attr_e($item_id) ?>">
            <div class="aio-contact-item">
                <div class="aio-contact-item-header">
                    <div class="aio-contact-item-text">
                        <div class="aio-contact-item-icon" style="color: <?php esc_attr_e($item->color) ?>"> 
                            <i class="<?php esc_attr_e($item->icon) ?>"></i>
                        </div>
                        <div class="aio-contact-item-title">
                            <?php esc_html_e($item->title) ?>
                        </div>
                    </div>
                    <div class="aio-contact-item-actions">
                        <div class="aio-contact-item-action aio-contact-item-action-edit text-success hvr-bob" data-id="<?php esc_attr_e($item_id) ?>">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="aio-contact-item-action aio-contact-item-action-delete text-danger hvr-bob" data-id="<?php esc_attr_e($item_id) ?>">
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="col-lg-2 col-md-3">
            <div class="aio-contact-item-add aio-contact-item-add-trigger aio-h-spin-hover">
                <div class="aio-contact-item-add-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="aio-contact-item-add-text">
                    <?php _e('Add Item') ?>
                </div>
            </div>
        </div>
        <?php if(count($items) == 0) { ?>
        <div class="col-lg-3 col-md-4">
            <div class="aio-contact-item-add aio-contact-import-sample-items aio-h-spin-hover">
                <div class="aio-contact-item-add-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <div class="aio-contact-item-add-text">
                    <?php _e('Import Sample Items') ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!-- Add/Edit Item Modal --> 
<div class="modal fade" id="addEditItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="item_modal_title"><?php _e('New Item') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="item_title"><?php _e('Title') ?></label>
                    <input type="text" class="form-control" id="item_title" required>
                </div>
                <div class="form-group">
                    <label for="item_icon"><?php _e('Icon') ?></label>
                    <button class="btn btn-secondary form-control" id="item_icon" name="item_icon" role="iconpicker"></button>
                </div>
                <div class="form-group">
                    <label for="item_color"><?php _e('Color') ?></label><br>
                    <input type="text" class="color-picker" name="item_color" id="item_color">
                </div>     
                <div class="form-group aio_contact_custom_fields" id="aio_field">
                    <label for="item_url"><?php _e('URL') ?></label>
                    <input type="url" class="form-control" id="item_url">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php _e('Close') ?></button>
                <button type="button" class="btn btn-primary" id="item_modal_action"><?php _e('Add Item') ?></button>
            </div>
        </div>
    </div>
</div>

<input type="button" class="d-none" value="Save" id="aio-contact-save-items">