<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Any_Post_Slider
 * @subpackage Any_Post_Slider/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Any_Post_Slider
 * @subpackage Any_Post_Slider/includes
 * @author     IT Path Solutions PVT LTD <dev3@itpathsolutions.gmail.com>
 */
class Any_Post_Slider {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Any_Post_Slider_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * The settings of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $options    The settings of the plugin.
	 */
	protected $options;

	/**
	 * The list of all post type
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $aps_post_types    The settings of the plugin.
	 */
	protected $aps_post_types;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ANY_POST_SLIDER_VERSION' ) ) {
			$this->version = ANY_POST_SLIDER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'any-post-slider';

		$this->options[] = $this->aps_get_options();
		$this->aps_post_types[] = $this->aps_get_all_post_type();

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->aps_set_default_settings();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Any_Post_Slider_Loader. Orchestrates the hooks of the plugin.
	 * - Any_Post_Slider_i18n. Defines internationalization functionality.
	 * - Any_Post_Slider_Admin. Defines all hooks for the admin area.
	 * - Any_Post_Slider_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-any-post-slider-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-any-post-slider-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-any-post-slider-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-any-post-slider-public.php';

		$this->loader = new Any_Post_Slider_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Any_Post_Slider_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Any_Post_Slider_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Any_Post_Slider_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin,'anypostslider_add_submenu');
		$this->loader->add_action( 'admin_post_aps_update_settings',$plugin_admin,'anypostslider_update_settings');
		$this->loader->add_filter( 'plugin_action_links_'.$this->plugin_name.'/'.$this->plugin_name.'.php',$plugin_admin,'aps_settings_link',10,1 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Any_Post_Slider_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'register_aps_slider_shortcode');
	}	


	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Any_Post_Slider_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrive the settings of the plugin
	 * 
	 * @since     1.0.0
	 * @return    array    The settings of the plugin.
	 */
	public function aps_get_options() {
		$options = get_option('anypostslider_options'); // get plugins settings from database
		return $options;
	}

	/**
	 * Set the default settings of the plugin
	 * 
	 * @since     1.0.0
	 * @return    array    The array of plugins settings.
	 */
	public function aps_set_default_settings() {
		//Pull from WP options database table
		$options = get_option('anypostslider_options');
		if (!is_array($options)) {

			$options['aps_no_post_display'] = 10;

			$options['aps_post_types'] = 'post';

			$options['aps_display_layout'] = 1;

			$options['aps_order_by'] = 'DESC';

			$options['aps_scroll_to_slide'] = 1;

			$options['aps_no_slide_display'] = 3;

			
			
			update_option('anypostslider_options', $options);
		}
		return $options;
	}

	/**
	 * Get all post types of wordpress
	 * 
	 * @since     1.0.0
	 * @return    array   The list of post types.
	 */
	
	public function aps_get_all_post_type() {
		$aps_post_types	   = get_post_types(array('public'   => true,'_builtin' => false),'names','and'); // set arguments to list out the post types
		
		$aps_post_types['posts'] = 'post';
		return $aps_post_types;
	}

	/**
	 * Default layout options
	 * 
	 * @since     1.0.0
	 * @return    array    The layout options array.
	 */
	public function aps_display_layout_options() {
		$layout_options = array(
			'1' => 'One Slide',
			'2' => 'Two Slide',
			'3' => 'Three Slide'
		);
		return $layout_options;
	}
}
