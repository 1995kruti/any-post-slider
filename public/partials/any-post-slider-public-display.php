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
$default_layout_options  = $aps_object->aps_display_layout_options();

$aps_default_option = get_option('anypostslider_options');

if(!isset($aps_attributes) && empty($default_arguments)):
    $aps_carousal_arguments = array(
        'post_type'      => $aps_default_option['aps_post_types'],
        'post_count'     => $aps_default_option['aps_no_post_display'],
        'display_layout' => $aps_default_option['aps_display_layout'],
        'display_order'  => $aps_default_option['aps_order_by'],
        'display_slide'  => $aps_default_option['aps_no_slide_display']
    );
else:
    $aps_attributes['display_slide'] = isset($aps_attributes['display_slide']) ? $aps_attributes['display_slide'] : $aps_default_option['aps_no_slide_display'];
    $aps_carousal_arguments = $aps_attributes;
endif;


$get_posts_data = get_posts(
    array(
        'post_type'      => $aps_carousal_arguments['post_type'],
        'posts_per_page' => $aps_carousal_arguments['post_count'],
        'order'          => $aps_carousal_arguments['display_order'],
        // 'slide_to_display' => $aps_carousal_arguments['display_slide'],
        'display_layout' => $aps_carousal_arguments['display_layout'],
        'display_slide'  => $aps_carousal_arguments['display_slide'],
        'post_status'    => array('publish')
    )
);
if(isset($get_posts_data) && !is_admin()):
    if($aps_carousal_arguments['display_layout'] == 1):
        ob_start();
        setup_postdata( $get_posts_data );
            require(ANY_POST_SLIDER_PLUGIN_DIR . '/public/partials/any-post-slider-layout_one.php');
        echo ob_get_clean();
    elseif($aps_carousal_arguments['display_layout'] == 2):
        ob_start();
        setup_postdata( $get_posts_data );
            require(ANY_POST_SLIDER_PLUGIN_DIR . '/public/partials/any-post-slider-layout_two.php');
        echo ob_get_clean();
    elseif($aps_carousal_arguments['display_layout'] == 3):
        ob_start();
        setup_postdata( $get_posts_data );
            require(ANY_POST_SLIDER_PLUGIN_DIR . '/public/partials/any-post-slider-layout_three.php');
        echo ob_get_clean();
    endif;

endif;