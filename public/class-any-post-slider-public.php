<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Any_Post_Slider
 * @subpackage Any_Post_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Any_Post_Slider
 * @subpackage Any_Post_Slider/public
 * @author     IT Path Solutions PVT LTD <dev3@itpathsolutions.gmail.com>
 */
class Any_Post_Slider_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/owl.carousel.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'any-post-slider-public', plugin_dir_url( __FILE__ ) . 'css/any-post-slider-public.css', array(), $this->version,'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/owl.carousel.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'any-post-slider-public', plugin_dir_url( __FILE__ ) . 'js/any-post-slider-public.js', array( 'jquery' ), $this->version, true );
	}

	public function register_aps_slider_shortcode() {
		
		add_shortcode('aps_slider', array($this, 'aps_slider_shortcode'));
	}
	
	public function aps_slider_shortcode($aps_attributes) {	
		
		include ANY_POST_SLIDER_PLUGIN_DIR . '/public/partials/any-post-slider-public-display.php';
	}

}
