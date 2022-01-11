<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Any_Post_Slider
 * @subpackage Any_Post_Slider/admin/partials
 */

 $aps_object            = new Any_Post_Slider();
 $text_domain           = $aps_object->get_plugin_name();
 $aps_options           = $aps_object->aps_get_options();  
 $aps_get_all_post_type = $aps_object->aps_get_all_post_type();
 $layout_option         = $aps_object->aps_display_layout_options();
 $default_shortcode     = "[aps_slider post_type=".$aps_options['aps_post_types']." post_count=".$aps_options['aps_no_post_display']." display_layout=".$layout_option[$aps_options['aps_display_layout']]." display_order=".$aps_options['aps_order_by']."]";

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="anypostlsider_admin" class="wrap">
    <h2>Any Post Slider Options</h2>
    <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="aps_update_settings"/>
        <?php wp_nonce_field(-1,'anypostlsider_admin_options_nonce_field' ); ?>
        <?php if(isset($_GET["update-status"])): ?>
            <div class="notice notice-success is-dismissible"><p><?php _e('Settings save successfully!'); ?>.</p></div>
        <?php endif; ?>
        <div class="fl_box">
            <p>Display Posts:</p>
            <p><input type="number" maxlength="2" min="-1" max="50" name="aps_no_post_display" value="<?php esc_attr_e($aps_options['aps_no_post_display'],$text_domain); ?>" /></p>
        </div>
        <div class="fl_box">
            <p>Select Post Types:</p>
            <p>
                <?php 
                foreach($aps_get_all_post_type as $pos_type_key => $pos_type_val): 
                    $post_type_obj = get_post_type_object( $pos_type_val );
                ?>
                <input type="radio" name="aps_pos_type" id="<?php echo $pos_type_key;?>" value="<?php esc_attr_e( $pos_type_val, $text_domain ); ?>" <?php if($aps_options['aps_post_types'] == $pos_type_val){ esc_attr_e( 'checked', $text_domain ); }?>/><label for="<?php echo $pos_type_key;?>"> <?php esc_attr_e( $post_type_obj->labels->name, $text_domain ); ?></label>
                <?php endforeach; ?>
            </p>	
        </div>
        <div class="fl_box">
            <p>Select Display Layout:</p>
            <p>
                <label for="<?php esc_attr_e('layout_1',$text_domain);?>"> <input type="radio" name="aps_display_layout" id="layout_1" value="<?php esc_attr_e( '1', $text_domain ); ?>" <?php if($aps_options['aps_display_layout'] == '1'){echo "checked";}?> /><?php esc_attr_e( 'Single frame', $text_domain ); ?></label>
                <label for="<?php esc_attr_e('layout_2',$text_domain);?>"> <input type="radio" name="aps_display_layout" id="layout_2" value="<?php esc_attr_e( '2', $text_domain ); ?>" <?php if($aps_options['aps_display_layout'] == '2'){echo "checked";}?>/><?php esc_attr_e( 'Double frame', $text_domain ); ?></label>
                <label for="<?php esc_attr_e('layout_3',$text_domain);?>"> <input type="radio" name="aps_display_layout" id="layout_3" value="<?php esc_attr_e( '3', $text_domain ); ?>" <?php if($aps_options['aps_display_layout'] == '3'){echo "checked";}?>/><?php esc_attr_e( 'Three frame', $text_domain ); ?> </label>
            </p>
        </div>
        <div class="fl_box">
            <p>Select Order:</p>
            <p>
                <select id="aps_post_order" name="aps_post_order">
                    <option value="ASC" <?php if($aps_options['aps_order_by'] == 'ASC'){ esc_attr_e( 'selected', $text_domain ); }?> ><?php esc_attr_e( 'ASC', $text_domain ); ?></option>
                    <option value="DESC" <?php if($aps_options['aps_order_by'] == 'DESC'){ esc_attr_e( 'selected', $text_domain ); }?> ><?php esc_attr_e( 'DESC', $text_domain ); ?></option>
                </select>
            </p>
        </div>
        <p><input class="button-primary" type="submit" name="aps_settings_save" value="Save Changes" /></p>
    </form>
    <div class="aps_current_short_code">
        <p>Your short code for above chosen options:</p>
        <div class='aps-current-short-code-wrap'>
            <input type="text" size="100" readonly name="aps_shortcode" id="aps_shortcode_id" value="<?php  esc_attr_e($default_shortcode,$text_domain);  ?>" disabled/>
            <img src="<?php echo esc_url(ANY_POST_SLIDER_PLUGIN_URL.'/admin/images/copy.png');?>" class="aps-copy-to-clip" id="aps_copy_to_clip_id" />
        </div>
    </div>
</div>
<span class="aps-text-copied-msg" style="display:none;">Shortcode copied!</span>