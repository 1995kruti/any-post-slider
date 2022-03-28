<!-- It will display featured image  & post title only-->
<div class="app-slider-wrap <?php esc_attr_e(  'layout-'.$aps_carousal_arguments['display_layout'], $text_domain )?>">
    <input type="hidden" class="display-layout" id="display-layout-id" value="<?php esc_attr_e(  $aps_carousal_arguments['display_slide'], $text_domain )?>"/>
    <div class="owl-carousel owl-theme aps-slider" id="aps_slider">
        <?php foreach($get_posts_data as $post_item_key => $post_item_val): ?>
        <div class="item">
            <?php 
            if(has_post_thumbnail($post_item_val->ID)): 
                _e(get_the_post_thumbnail( $post_item_val->ID, 'large' )); 
            else: ?>
                <img src="<?php echo esc_url(ANY_POST_SLIDER_PLUGIN_URL.'public/images/place_holder.png'); ?>">
            <?php endif; ?>
            <a href="<?php echo esc_url(get_the_permalink($post_item_val->ID)); ?>">
                <h3><?php esc_attr_e( $post_item_val->post_title, $text_domain); ?></h3>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>