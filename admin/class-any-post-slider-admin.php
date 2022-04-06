<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Any_Post_Slider
 * @subpackage Any_Post_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Any_Post_Slider
 * @subpackage Any_Post_Slider/admin
 * @author     IT Path Solutions PVT LTD <dev3@itpathsolutions.gmail.com>
 */
class Any_Post_Slider_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The layout option of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $layout_options    The current layout_option of this plugin.
	 */
	private $layout_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Any_Post_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Any_Post_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		// enqueue slider plugin CSS
		wp_enqueue_style( 'any-post-slider-admin', plugin_dir_url( __FILE__ ) . 'css/any-post-slider-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Any_Post_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Any_Post_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// enqueue slider plugin JS
		wp_enqueue_script( 'any-post-slider-admin-js', plugin_dir_url( __FILE__ ) . 'js/any-post-slider-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Create action for the MEta Field For CPT
	 *
	 * @since    1.0.0
	 */
	public function aps_metabox() {
	    add_meta_box(
	        'aps-slider-setting',
	        __( 'Any Post Slider Setting', 'sitepoint' ),
	        array($this,'aps_sliders_settings'),
	        'any_post_slider'
	    );
	}

	/**
	 * Create action for the CPT
	 *
	 * @since    1.0.0
	 */
	public function anypostslider_custom_post_type () {

			$supports = array(
			'title', // APS Slider Title
			);
			$labels = array(
			'name' => _x('Any Post Slider', 'plural'),
			'singular_name' => _x('any post slider', 'singular'),
			'menu_name' => _x('Any Post Slider', 'admin menu'),
			'name_admin_bar' => _x('Any Post Slider', 'admin bar'),
			'add_new' => _x('Add New Slider', 'add new'),
			'add_new_item' => __('Add New Slider'),
			'new_item' => __('New Slider'),
			'edit_item' => __('Edit Slider'),
			'view_item' => __('View Slider'),
			'all_items' => __('All Sliders'),
			'not_found' => __('No Slider found.'),
			'register_meta_box_cb' => 'aps_metabox',
			);
			$args = array(
			'supports' => $supports,
			'labels' => $labels,
			'hierarchical' => false,
			'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
			'publicly_queryable' => false,  // you should be able to query it
			'show_ui' => true,  // you should be able to edit it in wp-admin
			'exclude_from_search' => true,  // you should exclude it from search results
			'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
			'has_archive' => false,  // it shouldn't have archive page
			'rewrite' => false,  // it shouldn't have rewrite rules
			'menu_icon'           => 'dashicons-slides',
			);
			register_post_type('any_post_slider', $args);
			
	}

	public function set_custom_edit_aps_cpt_columns($columns) {

	    $columns['slider_shortcode'] = __( 'Slider Shordcode','');

	    return $columns;
	}
	// Adding New Coulmn in CPT 
	public function aps_new_coulmn( $column_name, $post_id ) 
	{
	    if ( $column_name == 'slider_shortcode')
	    	$shortcode_name =  get_post_meta($post_id,'aps_shortcode_name',true);
	        printf( '<span name="aps_shortcode" id="aps_shortcode_id" value="'.$shortcode_name.'"/>'.$shortcode_name.'</span>' );

	}
	/**
	 * Admin settings page 
	 *
	 * @since    1.0.0
	 */
	public static function aps_sliders_settings() {

		include dirname(__FILE__).'/partials/any-post-slider-cpt-display.php';
	}

	/**
	 * Update admin settings
	 * 
	 * @since    1.0.0
	 */
	public function anypostslider_update_settings($any_post_slider_id,$any_post_slider) {
		if ( $any_post_slider->post_type == 'any_post_slider' ) {

			$status = 'false';
			if(isset( $_POST['aps_cpt_nonce'] ) &&
				wp_verify_nonce( $_POST['aps_cpt_nonce'], 'aps_cpt_nonce')	
			):
				$aps_object  = new Any_Post_Slider();
				$aps_options = $aps_object->aps_get_options();  
				
				$aps_options['aps_no_post_display'] = (int)stripslashes($_POST['aps_no_post_display']);
				$aps_options['aps_post_types'] = sanitize_text_field($_POST['aps_pos_type']);
				$aps_options['aps_display_layout'] = (int)stripslashes($_POST['aps_display_layout']);
				$aps_options['aps_order_by'] = sanitize_text_field($_POST['aps_post_order']);
				$aps_options['aps_mousewheel_scroll'] = sanitize_text_field($_POST['aps_mousewheel_scroll']);
				$aps_options['aps_sliderarrows'] = sanitize_text_field($_POST['aps_sliderarrows']);
				$aps_options['aps_sliderdots'] = sanitize_text_field($_POST['aps_sliderdots']);
				$aps_options['aps_loop'] = sanitize_text_field($_POST['aps_loop']);
				$aps_options['aps_sliderautoplay'] = sanitize_text_field($_POST['aps_sliderautoplay']);
				$aps_options['aps_sliderspeed'] = sanitize_text_field($_POST['aps_sliderspeed']);
				$aps_options['aps_equalheight'] = sanitize_text_field($_POST['aps_equalheight']);
				$aps_options['aps_no_slide_display'] = (int)stripslashes($_POST['aps_no_slide_display']);
				$aps_options['aps_shortcode_name'] = '[aps_slider slider_id='.$any_post_slider_id.']'; 

				// $response = update_post_meta('anypostslider_options', $aps_options);
				foreach ( $aps_options as $aps_options_key => $aps_options_value ) {
        				$response = update_post_meta( $any_post_slider_id, $aps_options_key, $aps_options_value );
    			}
				if($response):
					$status = 'true';
				endif;
			else:
			endif;
		}

	}
	
	/**
	 * Plugin settings link
	 * 
	 * @since    1.0.0
	 */
	public function aps_settings_link( array $links ) {
		$url = get_admin_url() . "edit.php?post_type=any_post_slider";
		$settings_link = '<a href="' . $url . '">' . __('Settings', 'textdomain') . '</a>';
		  	$links[] = $settings_link;
		return $links;
	}
	
}
