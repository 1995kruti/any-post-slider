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

if(!isset($aps_attributes) || empty($default_arguments)):
    $aps_default_option = get_option('anypostslider_options');
    $aps_carousal_arguments = array(
        'post_type' => $aps_default_option['aps_post_types'],
        'post_count' => $aps_default_option['aps_no_post_display'],
        'display_layout' => $aps_default_option['aps_display_layout'],
        'display_order' => $aps_default_option['aps_order_by'],
    );
else:
    $aps_carousal_arguments = $aps_attributes;
endif;

$get_posts_data = get_posts(
    array(
        'post_type'      => $aps_carousal_arguments['post_type'],
        'posts_per_page' => $aps_carousal_arguments['post_count'],
        'order'          => $aps_carousal_arguments['display_order'],
        'post_status'    => array('publish')
    )
);
if(isset($get_posts_data) && !is_admin()):
// ob_start();

?>
<input type="hidden" class="display-layout" id="display-layout-id" value="<?php esc_attr_e(  $aps_carousal_arguments['display_layout'], $text_domain )?>"/>
<div class="owl-carousel owl-theme aps-slider" id="aps_slider">
    <?php foreach($get_posts_data as $post_item_key => $post_item_val): ?>
    <div class="item" data-hash="<?php esc_attr_e($post_item_val->ID); ?>">
        <?php _e(get_the_post_thumbnail( $post_item_val->ID, 'large', array( 'class' => 'alignleft' ) )); ?>
        <h4><?php esc_html_e( $post_item_val->post_title, $text_domain); ?></h4>
        <?php if(has_excerpt($post_item_val->ID)): ?>
        <p><?php $excerpt = substr(get_the_excerpt($post_item_val->ID), 0, 100); _e($excerpt." ..."); ?></p>
        <?php endif; ?>
        <a href="<?php echo esc_url(get_the_permalink($post_item_val->ID)); ?>"><?php esc_attr_e("Read More",$text_domain); ?></a>
    </div>
    <?php endforeach; ?>
</div>
<?php
// ob_end_flush();
endif;