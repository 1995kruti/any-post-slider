<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing apsects of the plugin.
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
 $default_shortcode     = '[aps_slider]';?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="anypostlsider_admin" class="wrap">
    <h2>Any Post Slider Options</h2>
    <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" enctype="multipart/form-data">
        <nav class="nav-tab-wrapper aps-nav-tab-wrapper">
            <a href="admin.php?page=any-post-slider-settings" class="nav-tab nav-tab-active">General</a>
        </nav>
        <input type="hidden" name="action" value="aps_update_settings"/>
        <?php wp_nonce_field(-1,'anypostlsider_admin_options_nonce_field' ); ?>
        <?php if(isset($_GET["update-status"])): ?>
            <div class="notice notice-success is-dismissible"><p><?php _e('Settings save successfully!'); ?>.</p></div>
        <?php endif; ?>
        <div class="aps_row">
            <div class="aps_row_name">Select Post Types:</div>
            <div class="aps_row_desc">
                <?php 
                foreach($aps_get_all_post_type as $pos_type_key => $pos_type_val): 
                    $post_type_obj = get_post_type_object( $pos_type_val );
                ?>
                <input type="radio" name="aps_pos_type" id="<?php echo $pos_type_key;?>" value="<?php esc_attr_e( $pos_type_val, $text_domain ); ?>" <?php if($aps_options['aps_post_types'] == $pos_type_val){ esc_attr_e( 'checked', $text_domain ); }?>/><label for="<?php echo $pos_type_key;?>"> <?php esc_attr_e( $post_type_obj->labels->name, $text_domain ); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php endforeach; ?>
            </div>	
        </div>
        <div class="aps_row">
            <div class="aps_row_name">Select Style:</div>
            <div class="aps_row_desc">
                <select name="aps_display_layout" id="aps_style">
                    <option value="1" <?php if($aps_options['aps_display_layout'] == '1'){ _e("selected");}?>>Style 1</option>
                    <option value="2" <?php if($aps_options['aps_display_layout'] == '2'){ _e("selected");}?>>Style 2</option>
                    <option value="3" <?php if($aps_options['aps_display_layout'] == '3'){ _e("selected");}?>>Style 3</option>
                </select>
                <div class="aps_style_output">
                    <img class="aps_style_1" src="<?php echo ANY_POST_SLIDER_PLUGIN_URL;?>/admin/images/slider_style1.png" alt="img1" <?php echo ($aps_options['aps_display_layout'] == '1') ? '' : 'style="display:none"';?>>
                    <img class="aps_style_2" src="<?php echo ANY_POST_SLIDER_PLUGIN_URL;?>/admin/images/slider_style2.png" alt="img2" <?php echo ($aps_options['aps_display_layout'] == '2') ? '' : 'style="display:none"';?>>
                    <img class="aps_style_3" src="<?php echo ANY_POST_SLIDER_PLUGIN_URL;?>/admin/images/slider_style3.png" alt="img3" <?php echo ($aps_options['aps_display_layout'] == '3') ? '' : 'style="display:none"';?>>
                </div>              
            </div>
        </div>
        <div class="aps_row">
            <div class="aps_row_name">Select Order:</div>
            <div class="aps_row_desc">
                <select id="aps_post_order" name="aps_post_order">
                    <option value="ASC" <?php if($aps_options['aps_order_by'] == 'ASC'){ esc_attr_e( 'selected', $text_domain ); }?> ><?php esc_attr_e( 'ASC', $text_domain ); ?></option>
                    <option value="DESC" <?php if($aps_options['aps_order_by'] == 'DESC'){ esc_attr_e( 'selected', $text_domain ); }?> ><?php esc_attr_e( 'DESC', $text_domain ); ?></option>
                </select>
            </div>
        </div>
        <div class="aps_row">
            <div class="aps_row_name">Mousewheel Scrolling:</div>
            <div class="aps_row_desc">
                <select id="aps_scroll_to_slide" name="aps_scroll_to_slide">
                    <option value="1" <?php if($aps_options['aps_scroll_to_slide'] == '1'){ esc_attr_e( 'selected', $text_domain ); }?> ><?php esc_attr_e( 'Yes', $text_domain ); ?></option>
                    <option value="0" <?php if($aps_options['aps_scroll_to_slide'] == '0'){ esc_attr_e( 'selected', $text_domain ); }?> ><?php esc_attr_e( 'No', $text_domain ); ?></option>
                </select>
            </div>
        </div>
        <div class="aps_row">
            <div class="aps_row_name">Display Posts</div>
            <div class="aps_row_desc"><input type="number" maxlength="2" min="-1" max="50" name="aps_no_post_display" value="<?php esc_attr_e($aps_options['aps_no_post_display'],$text_domain); ?>" /></div>
        </div>
        
        <div class="aps_row">
            <div class="aps_row_name">Show Navigation Arrows:</div>
            <div class="aps_row_desc">
                <input type="radio" name="aps_sliderarrows" id="aps_sliderarrows1" value="yes" <?php if($aps_options['aps_sliderarrows'] == 'yes'){?> checked="checked"<?php }?>>
                <label for="aps_sliderarrows1">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="aps_sliderarrows" id="aps_sliderarrows3" value="des" <?php if($aps_options['aps_sliderarrows'] == 'des'){?> checked="checked"<?php }?>>
                <label for="aps_sliderarrows3">Desktop Only</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="aps_sliderarrows" id="aps_sliderarrows2" value="no" <?php if($aps_options['aps_sliderarrows'] == 'no'){?> checked="checked"<?php }?>>
                <label for="aps_sliderarrows2">No</label>
            </div>
        </div>
        <div class="aps_row">
            <div class="aps_row_name">Show Navigation Dots:</div>
            <div class="aps_row_desc">
                <input type="radio" name="aps_sliderdots" id="aps_sliderdots1" value="yes" <?php if($aps_options['aps_sliderdots'] == 'yes'){?> checked="checked"<?php }?>>
                <label for="aps_sliderdots1">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="aps_sliderdots" id="aps_sliderdots2" value="no" <?php if($aps_options['aps_sliderdots'] == 'no'){?> checked="checked"<?php }?>>
                <label for="aps_sliderdots2">No</label>
            </div>
        </div>
        <div class="aps_row">
            <div class="aps_row_name">Autoplay Slides:</div>
            <div class="aps_row_desc">
                <input type="radio" name="aps_sliderautoplay" id="aps_sliderautoplay1" value="no" <?php if($aps_options['aps_sliderautoplay'] == 'no'){?> checked="checked"<?php }?>>
                <label for="aps_sliderautoplay1">No</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="aps_sliderautoplay" id="aps_sliderautoplay2" value="yes" <?php if($aps_options['aps_sliderautoplay'] == 'yes'){?> checked="checked"<?php }?>>
                <label for="aps_sliderautoplay2">Yes</label></br></br>
                <div class="aps_sliderspeed" <?php if($aps_options['aps_sliderautoplay'] == 'no'){?> style="display: none;"<?php } ?>>
                    <input type="text" name="aps_sliderspeed" id="aps_sliderspeed" value="<?php esc_attr_e($aps_options['aps_sliderspeed'],$text_domain); ?>"></br>
                    <label for="aps_sliderspeed">How long (in seconds) the slider should animate between slides.</label>
                </div>
            </div>
        </div>

        <div class="aps_row">
            <div class="aps_row_name">Show Images Equal Height:</div>
            <div class="aps_row_desc">
                <input type="radio" name="aps_equalheight" id="aps_equalheight1" value="yes" <?php if($aps_options['aps_equalheight'] == 'yes'){?> checked="checked"<?php }?>>
                <label for="aps_equalheight1">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="aps_equalheight" id="aps_equalheight2" value="no" <?php if($aps_options['aps_equalheight'] == 'no'){?> checked="checked"<?php }?>>
                <label for="aps_equalheight2">No</label>
            </div>
        </div>

        <div class="aps_row">
            <div class="aps_row_name">Select Slide to Display:</div>
            <div class="aps_row_desc">
                <input type="number" maxlength="6" min="1" max="6" name="aps_no_slide_display" value="<?php esc_attr_e($aps_options['aps_no_slide_display'],$text_domain); ?>" />
            </div>
        </div>
        <div class="aps_row"><div class="aps_row_name"><input class="button-primary" type="submit" name="aps_settings_save" value="Save Changes" /></div></div>
    </form>    
     <div class="aps_current_short_code">
        <h4>Copy this short code to display slider:</h4>
        <div class='aps-current-short-code-wrap'>
            <input type="text" size="20" readonly name="aps_shortcode" id="aps_shortcode_id" value="<?php  esc_attr_e($default_shortcode,$text_domain);  ?>" disabled/>&nbsp;&nbsp; 
            <img src="<?php echo esc_url(ANY_POST_SLIDER_PLUGIN_URL.'/admin/images/copy.svg');?>" class="aps-copy-to-clip" id="aps_copy_to_clip_id" alt="copy"/>
        </div>
    </div>
    <span class="aps-text-copied-msg" style="display:none;">Shortcode copied!</span>
</div>