<!-- It will display featured image , post title , date & read more link  -->
<div class="app-slider-wrap <?php esc_attr_e(  'layout-'.$aps_carousal_arguments['display_layout'], $text_domain )?>">
    <input type="hidden" class="display-layout" id="display-layout-id" value="<?php esc_attr_e(  $aps_carousal_arguments['display_slide'], $text_domain )?>"/>
    <div class="owl-carousel owl-theme aps-slider" id="aps_slider">
        <?php foreach($get_posts_data as $post_item_key => $post_item_val): ?>
        <div class="item">
            <?php if(has_post_thumbnail($post_item_val->ID)): ?>
                <?php _e(get_the_post_thumbnail( $post_item_val->ID, 'large' )); ?>
            <?php else: ?>
                <img src="<?php echo esc_url(ANY_POST_SLIDER_PLUGIN_URL.'public/images/place_holder.png'); ?>" alt="place_holder">
            <?php endif; ?>
            <span class="aps_slider_date"> <?php _e(get_the_date('l F j, Y',$post_item_val->ID)); ?></span>
            <a href="<?php echo esc_url(get_the_permalink($post_item_val->ID));?>">
                <h3><?php esc_attr_e( $post_item_val->post_title, $text_domain); ?></h3>
            </a>
            <a href="<?php echo esc_url(get_the_permalink($post_item_val->ID));?>" class="btn button"><?php esc_attr_e("Read More",$text_domain); ?></a>
        </div>
        <?php endforeach; ?>
    </div>
</div>