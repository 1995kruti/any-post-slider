<?php

/**
 * Provide a admin area more information for the plugin
 *
 * This file is used to markup the admin-facing apsects of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Any_Post_Slider
 * @subpackage Any_Post_Slider/admin/partials
 */

 $aps_tab = isset($_GET['tab']) ? $_GET['tab'] : null;
 $default_shortcode     = '[aps_slider]';?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="anypostlsider_admin" class="wrap">
    <h2>Any Post Slider Options</h2>
    <nav class="nav-tab-wrapper aps-nav-tab-wrapper">
        <a href="admin.php?page=any-post-slider-settings" class="nav-tab <?php if($aps_tab === null):?>nav-tab-active<?php endif; ?>">General</a>
        <a href="admin.php?page=any-post-slider-settings&tab=info" class="nav-tab <?php if($aps_tab === 'info'):?>nav-tab-active<?php endif; ?>">Information</a>
    </nav>
    <div class="aps_tab_information">
        <div class="aps_current_short_code">
            <h4>Copy this short code to display slider:</h4>
            <div class='aps-current-short-code-wrap'>
                <input type="text" size="20" readonly name="aps_shortcode" id="aps_shortcode_id" value="<?php  esc_attr_e($default_shortcode,$text_domain);  ?>" disabled/>&nbsp;&nbsp; 
                <img src="<?php echo esc_url(ANY_POST_SLIDER_PLUGIN_URL.'/admin/images/copy.svg');?>" class="aps-copy-to-clip" id="aps_copy_to_clip_id" alt="copy"/>
            </div>
        </div>
        <span class="aps-text-copied-msg" style="display:none;">Shortcode copied!</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elit felis</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed elit felis, blandit ut feugiat ac, pretium sit amet nibh.</p>
    </div>
</div>