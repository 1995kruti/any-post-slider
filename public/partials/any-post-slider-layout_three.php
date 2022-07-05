<!-- It will display featured image  & post title only-->
<div class="app-slider-wrap <?php esc_attr_e('layout-'.$aps_carousal_arguments['display_layout'], $text_domain )?>">
    <input type="hidden" class="display-layout" id="display-layout-id" value="<?php esc_attr_e(  $aps_carousal_arguments['display_slide'], $text_domain )?>"/>
        <div class="owl-carousel owl-theme aps-slider" 
         id="aps_slider_<?php esc_attr_e( $aps_attributes['slider_id'], $text_domain ); ?>" 
         data-id="<?php esc_attr_e( $aps_attributes['slider_id'], $text_domain ); ?>" 
         data-display_slide="<?php esc_attr_e( $aps_carousal_arguments['display_slide'], $text_domain ); ?>" 
         data-aps_mousewheel_scroll="<?php esc_attr_e( $aps_carousal_arguments['aps_mousewheel_scroll'], $text_domain ); ?>" data-aps_sliderarrows="<?php esc_attr_e( $aps_carousal_arguments['aps_sliderarrows'], $text_domain ); ?>" 
         data-aps_sliderdots="<?php esc_attr_e( $aps_carousal_arguments['aps_sliderdots'], $text_domain ); ?>" 
         data-aps_loop="<?php esc_attr_e( $aps_carousal_arguments['aps_loop'], $text_domain ); ?>" 
         data-aps_sliderautoplay="<?php esc_attr_e( $aps_carousal_arguments['aps_sliderautoplay'], $text_domain ); ?>" data-aps_sliderspeed="<?php esc_attr_e( $aps_carousal_arguments['aps_sliderspeed'], $text_domain ); ?>" 
         data-aps_equalheight="<?php esc_attr_e( $aps_carousal_arguments['aps_equalheight'], $text_domain ); ?>" 
         data-image="<?php echo esc_url( plugins_url($text_domain).'/public/images'); ?>">
            
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