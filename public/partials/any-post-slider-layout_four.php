<?php 
/*
*  This template is load 4 number layout style
*/
?>
<div class="app-slider-wrap <?php esc_attr_e('layout-'.$aps_carousal_arguments['display_layout'], $text_domain )?>">
    <input type="hidden" class="display-layout" id="display-layout-id" value="<?php esc_attr_e(  $aps_carousal_arguments['display_slide'], $text_domain )?>"/>
    
    <div class="owl-carousel owl-theme aps-slider <?php echo ($aps_carousal_arguments['aps_equalheight'] == 'yes') ? 'aps_equalheight' : '';?> " 
         id="aps_slider_<?php esc_attr_e( $aps_attributes['slider_id'], $text_domain ); ?>" 
         data-id="<?php esc_attr_e( $aps_attributes['slider_id'], $text_domain ); ?>" 
         data-display_slide="<?php esc_attr_e( $aps_carousal_arguments['display_slide'], $text_domain ); ?>" 
         data-aps_mousewheel_scroll="<?php esc_attr_e( $aps_carousal_arguments['aps_mousewheel_scroll'], $text_domain ); ?>" data-aps_sliderarrows="<?php esc_attr_e( $aps_carousal_arguments['aps_sliderarrows'], $text_domain ); ?>" 
         data-aps_sliderdots="<?php esc_attr_e( $aps_carousal_arguments['aps_sliderdots'], $text_domain ); ?>" 
         data-aps_loop="<?php esc_attr_e( $aps_carousal_arguments['aps_loop'], $text_domain ); ?>" 
         data-aps_sliderautoplay="<?php esc_attr_e( $aps_carousal_arguments['aps_sliderautoplay'], $text_domain ); ?>" data-aps_sliderspeed="<?php esc_attr_e( $aps_carousal_arguments['aps_sliderspeed'], $text_domain ); ?>" 
         data-aps_equalheight="<?php esc_attr_e( $aps_carousal_arguments['aps_equalheight'], $text_domain ); ?>" 
         data-image="<?php echo esc_url( plugins_url($text_domain).'/public/images'); ?>">
            
        <?php 
        foreach($get_posts_data as $post_item_key => $post_item_val): ?>
            <div class="item">                
                <a href="<?php echo esc_url(get_the_permalink($post_item_val->ID)); ?>" class="aps_slider_view">
                    <div class="aps-single-item">
                        <div class="aps-slide-image">
                            <?php 
                            if(has_post_thumbnail($post_item_val->ID)): 
                                _e(get_the_post_thumbnail( $post_item_val->ID, 'large' )); 
                            else: ?>
                                <img src="<?php echo esc_url(plugins_url($text_domain).'/public/images/place_holder.png'); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="aps-description">
                            <h3><?php esc_attr_e( $post_item_val->post_title, $text_domain); ?></h3>
                            <?php 
                            $aps_excerpt = wp_trim_words( get_the_excerpt( $post_item_val->ID ),30, '' ) ;
                            if(!empty($aps_excerpt)): ?>
                               <p><?php _e($aps_excerpt); ?></p>
                            <?php endif; ?>
                            <span class="readmore">Read More <svg xmlns="http://www.w3.org/2000/svg" width="33" height="20" viewBox="0 0 33 20" fill="none"> <path fill-rule="evenodd" clip-rule="evenodd" d="M32.1655 8.77724L24.6361 0.70165C24.1251 0.239602 23.1471 0.0484767 22.5773 0.582891C22.0148 1.10989 22.0332 2.13231 22.592 2.66117L27.8861 8.33214H1.95961C1.18023 8.33214 0.547852 8.97049 0.547852 9.75724C0.547852 10.544 1.18023 11.1823 1.95961 11.1823H27.8861L22.592 16.8533C22.1104 17.3413 22.0203 18.399 22.5773 18.9316C23.1325 19.4642 24.1471 19.2934 24.6361 18.8128L32.1655 10.7372C32.4229 10.4608 32.5479 10.136 32.5479 9.75748C32.535 9.41743 32.3953 9.02402 32.1655 8.77724Z" fill="white"/></svg></span>
                        </div>
                    </div>
                </a>
            </div>
            
        <?php endforeach; ?>
    </div>
</div>