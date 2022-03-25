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
	 * Create action for the submenu page
	 *
	 * @since    1.0.0
	 */
	public function anypostslider_add_submenu () {
		add_menu_page(
			__( 'Any Post Slider options', 'textdomain' ),
			'Any Post Slider',
			'manage_options',
			'any-post-slider-settings',
			array($this, 'anypostslider_display_submenu_page'),
			ANY_POST_SLIDER_PLUGIN_URL.'admin/images/snowy-owl.png',
			99
		);
	}

	/**
	 * Admin settings submenu page
	 *
	 * @since    1.0.0
	 */
	public static function anypostslider_display_submenu_page() {
		include ANY_POST_SLIDER_PLUGIN_DIR.'/admin/partials/any-post-slider-admin-display.php';
	}

	/**
	 * Update admin settings
	 * 
	 * @since    1.0.0
	 */
	public function anypostslider_update_settings() {
		$status = 'false';
		if(isset($_POST['aps_settings_save']) && 
			( isset ($_POST['action']) == "aps_update_settings") &&
			( isset( $_POST['anypostlsider_admin_options_nonce_field'] ) &&
				wp_verify_nonce( $_POST['anypostlsider_admin_options_nonce_field'] ) && 
				current_user_can('manage_options')
			)
		):
			$aps_object  = new Any_Post_Slider();
			$aps_options = $aps_object->aps_get_options();  

			$aps_options['aps_no_post_display'] = (int)stripslashes($_POST['aps_no_post_display']);

			$aps_options['aps_post_types'] = sanitize_text_field($_POST['aps_pos_type']);

			$aps_options['aps_display_layout'] = (int)stripslashes($_POST['aps_display_layout']);
			
			$aps_options['aps_order_by'] = sanitize_text_field($_POST['aps_post_order']);

			$aps_options['aps_scroll_to_slide'] = (int)stripslashes($_POST['aps_scroll_to_slide']);
			
			$aps_options['aps_sliderarrows'] = sanitize_text_field($_POST['aps_sliderarrows']);
			
			$aps_options['aps_sliderdots'] = sanitize_text_field($_POST['aps_sliderdots']);
			
			$aps_options['aps_sliderautoplay'] = sanitize_text_field($_POST['aps_sliderautoplay']);
			
			$aps_options['aps_sliderspeed'] = sanitize_text_field($_POST['aps_sliderspeed']);
			
			$aps_options['aps_equalheight'] = sanitize_text_field($_POST['aps_equalheight']);

			$aps_options['aps_no_slide_display'] = (int)stripslashes($_POST['aps_no_slide_display']);
			
			$response = update_option('anypostslider_options', $aps_options);
			if($response):
				$status = 'true';
			endif;
		else:
		endif;
		wp_redirect(admin_url('admin.php?page=any-post-slider-settings&update-status=' . $status));
	}
	
	/**
	 * Plugin settings link
	 * 
	 * @since    1.0.0
	 */
	public function aps_settings_link( array $links ) {
		$url = get_admin_url() . "admin.php?page=any-post-slider-settings";
		$settings_link = '<a href="' . $url . '">' . __('Settings', 'textdomain') . '</a>';
		  	$links[] = $settings_link;
		return $links;
	}
	
}
