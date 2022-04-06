<!-- It will display featured image  & post title only-->
<div class="app-slider-wrap <?php esc_attr_e(  'layout-'.$aps_carousal_arguments['display_layout'], $text_domain )?>">
    <input type="hidden" class="display-layout" id="display-layout-id" value="<?php esc_attr_e(  $aps_carousal_arguments['display_slide'], $text_domain )?>"/>
        <div class="owl-carousel owl-theme aps-slider" id="aps_slider_<?php echo $aps_attributes['slider_id']; ?>" data-id="<?php echo $aps_attributes['slider_id']; ?>"data-display_slide ="<?php echo $aps_carousal_arguments['display_slide']; ?>" data-aps_mousewheel_scroll ="<?php echo $aps_carousal_arguments['aps_mousewheel_scroll']; ?>" data-aps_sliderarrows ="<?php echo $aps_carousal_arguments['aps_sliderarrows']; ?>" data-aps_sliderdots ="<?php echo $aps_carousal_arguments['aps_sliderdots']; ?>" data-aps_loop ="<?php echo $aps_carousal_arguments['aps_loop']; ?>" data-aps_sliderautoplay ="<?php echo $aps_carousal_arguments['aps_sliderautoplay']; ?>" data-aps_sliderspeed ="<?php echo $aps_carousal_arguments['aps_sliderspeed']; ?>" data-aps_equalheight ="<?php echo $aps_carousal_arguments['aps_equalheight']; ?>" data-image = "<?php echo plugins_url($text_domain).'/public/images'; ?>" >
            
        <?php foreach($get_posts_data as $post_item_key => $post_item_val): ?>
        <div class="item">
            <?php 
            if(has_post_thumbnail($post_item_val->ID)): 
                _e(get_the_post_thumbnail( $post_item_val->ID, 'large' )); 
            else: ?>
                <img src="<?php echo esc_url(plugins_url($text_domain).'/public/images/place_holder.png'); ?>">
            <?php endif; ?>
            <a href="<?php echo esc_url(get_the_permalink($post_item_val->ID)); ?>">
                <h3><?php esc_attr_e( $post_item_val->post_title, $text_domain); ?></h3>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>