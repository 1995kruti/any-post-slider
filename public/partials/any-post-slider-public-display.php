<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Any_Post_Slider
 * @subpackage Any_Post_Slider/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php

$aps_object              = new Any_Post_Slider();
$text_domain             = $aps_object->get_plugin_name();
$plugin_version          = $aps_object->get_version();
$default_layout_options  = $aps_object->aps_display_layout_options();
$aps_public_object  = new Any_Post_Slider_Public($text_domain,$plugin_version);
$slider_id = $aps_attributes['slider_id'];
$aps_default_option['aps_no_post_display'] = get_post_meta($slider_id,'aps_no_post_display',true);
$aps_default_option['aps_post_types'] = get_post_meta($slider_id,'aps_post_types',true);
$aps_default_option['aps_display_layout'] = get_post_meta($slider_id,'aps_display_layout',true);
$aps_default_option['aps_order_by'] = get_post_meta($slider_id,'aps_order_by',true);
$aps_default_option['aps_no_slide_display'] = get_post_meta($slider_id,'aps_no_slide_display',true);
$aps_default_option['aps_mousewheel_scroll'] = get_post_meta($slider_id,'aps_mousewheel_scroll',true);
$aps_default_option['aps_sliderarrows'] = get_post_meta($slider_id,'aps_sliderarrows',true);
$aps_default_option['aps_sliderdots'] = get_post_meta($slider_id,'aps_sliderdots',true);
$aps_default_option['aps_loop'] = get_post_meta($slider_id,'aps_loop',true);
$aps_default_option['aps_sliderautoplay'] = get_post_meta($slider_id,'aps_sliderautoplay',true);
$aps_default_option['aps_sliderspeed'] = get_post_meta($slider_id,'aps_sliderspeed',true);
$aps_default_option['aps_equalheight'] = get_post_meta($slider_id,'aps_equalheight',true);


if(empty($aps_attributes)): // if short code has no attributes passed
    $aps_carousal_arguments = array(
        'post_type'      => $aps_default_option['aps_post_types'],
        'post_count'     => $aps_default_option['aps_no_post_display'],
        'display_layout' => $aps_default_option['aps_display_layout'],
        'display_order'  => $aps_default_option['aps_order_by'],
        'display_slide'  => $aps_default_option['aps_no_slide_display'],
    );
else: // if shortcode has attributes added
    $aps_attributes['post_count'] = isset($aps_attributes['post_count']) ? $aps_attributes['post_count'] : $aps_default_option['aps_no_post_display'];
    $aps_attributes['post_type'] = isset($aps_attributes['post_type']) ? $aps_attributes['post_type'] : $aps_default_option['aps_post_types'];
    $aps_attributes['display_layout'] = isset($aps_attributes['display_layout']) ? $aps_attributes['display_layout'] : $aps_default_option['aps_display_layout'];
    $aps_attributes['display_order'] = isset($aps_attributes['display_order']) ? $aps_attributes['display_order'] : $aps_default_option['aps_order_by'];
    $aps_attributes['display_slide'] = isset($aps_attributes['display_slide']) ? $aps_attributes['display_slide'] : $aps_default_option['aps_no_slide_display'];
    $aps_attributes['aps_mousewheel_scroll'] = isset($aps_attributes['aps_mousewheel_scroll']) ? $aps_attributes['aps_mousewheel_scroll'] : $aps_default_option['aps_mousewheel_scroll'];
    $aps_attributes['aps_sliderarrows'] = isset($aps_attributes['aps_sliderarrows']) ? $aps_attributes['aps_sliderarrows'] : $aps_default_option['aps_sliderarrows'];
    $aps_attributes['aps_sliderdots'] = isset($aps_attributes['aps_sliderdots']) ? $aps_attributes['aps_sliderdots'] : $aps_default_option['aps_sliderdots'];
    $aps_attributes['aps_loop'] = isset($aps_attributes['aps_loop']) ? $aps_attributes['aps_loop'] : $aps_default_option['aps_loop'];
    $aps_attributes['aps_sliderautoplay'] = isset($aps_attributes['aps_sliderautoplay']) ? $aps_attributes['aps_sliderautoplay'] : $aps_default_option['aps_sliderautoplay'];
    $aps_attributes['aps_sliderspeed'] = isset($aps_attributes['aps_sliderspeed']) ? $aps_attributes['aps_sliderspeed'] : $aps_default_option['aps_sliderspeed'];
    $aps_attributes['aps_equalheight'] = isset($aps_attributes['aps_equalheight']) ? $aps_attributes['aps_equalheight'] : $aps_default_option['aps_equalheight'];
    $aps_carousal_arguments = $aps_attributes;
endif;


// prepare postdata array
$get_posts_data = get_posts(
    array(
        'post_type'      => $aps_carousal_arguments['post_type'],
        'posts_per_page' => $aps_carousal_arguments['post_count'],
        'order'          => $aps_carousal_arguments['display_order'],
        'display_layout' => $aps_carousal_arguments['display_layout'],
        'display_slide'  => $aps_carousal_arguments['display_slide'],
        'post_status'    => array('publish')
    )
);

if(isset($get_posts_data) && !is_admin() && !empty($get_posts_data)):
   
    if($aps_carousal_arguments['display_layout'] == 1):
        
        setup_postdata( $get_posts_data );
        require(dirname(__FILE__) . '/any-post-slider-layout_one.php');
        wp_reset_postdata();
        
    elseif($aps_carousal_arguments['display_layout'] == 2):
        
        setup_postdata( $get_posts_data );
        require(dirname(__FILE__) . '/any-post-slider-layout_two.php');
        wp_reset_postdata();
        
    elseif($aps_carousal_arguments['display_layout'] == 3):
        
        setup_postdata( $get_posts_data );
        require(dirname(__FILE__) . '/any-post-slider-layout_three.php');
        wp_reset_postdata();
        
    elseif($aps_carousal_arguments['display_layout'] == 4):
        
        setup_postdata( $get_posts_data );
        require(dirname(__FILE__) . '/any-post-slider-layout_four.php');
        wp_reset_postdata();
        
    elseif($aps_carousal_arguments['display_layout'] == 5):
        
        setup_postdata( $get_posts_data );
        require(dirname(__FILE__) . '/any-post-slider-layout_five.php');
        wp_reset_postdata();
        
    endif;
else:
    setup_postdata( $aps_carousal_arguments );
    require(dirname(__FILE__) . '/any-post-slider-no_content.php');
    wp_reset_postdata();

endif;