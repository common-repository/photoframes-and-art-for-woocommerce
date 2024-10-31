<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.narolainfotech.com
 * @since      1.0.0
 *
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/includes
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
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/includes
 * @author     Narola Infotech <inquiry@narolainfotech.com>
 */
class Photoframes_and_art_for_woocommerce {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Photoframes_and_art_for_woocommerce_Loader    $loader    Maintains and registers all hooks for the plugin.
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
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PHOTOFRAMES_AND_ART_FOR_WOOCOMMERCE_VERSION' ) ) {
			$this->version = PHOTOFRAMES_AND_ART_FOR_WOOCOMMERCE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'photoframes-and-art-for-woocommerce';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Photoframes_and_art_for_woocommerce_Loader. Orchestrates the hooks of the plugin.
	 * - Photoframes_and_art_for_woocommerce_i18n. Defines internationalization functionality.
	 * - Photoframes_and_art_for_woocommerce_Admin. Defines all hooks for the admin area.
	 * - Photoframes_and_art_for_woocommerce_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-photoframes_and_art_for_woocommerce-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-photoframes_and_art_for_woocommerce-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-photoframes_and_art_for_woocommerce-admin.php';

		/**
		 * The class responsible for defining all ajax calls that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-photoframes-and-art-for-woocommerce-admin-ajax.php';
		
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-photoframes_and_art_for_woocommerce-public.php';

		/**
		 * The class responsible for defining helper functions
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-photoart-for-helper-functions.php';

		/**
		 * The class responsible for defining all ajax calls that occur in the public area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-photoframes_and_art_for_woocommerce-public-ajax.php';

		$this->loader = new Photoframes_and_art_for_woocommerce_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Photoframes_and_art_for_woocommerce_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Photoframes_and_art_for_woocommerce_i18n();

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

		$plugin_admin = new Photoframes_and_art_for_woocommerce_Admin( $this->get_plugin_name(), $this->get_version() );
		$plugin_admin_ajax = new Photoframes_And_Art_For_Woocommerce_Admin_Ajax( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'photoart_register_options_page' );
		$this->loader->add_action( 'trashed_post', $plugin_admin, 'photoart_restore_trashed_post' );	
			
		$this->loader->add_action( 'wp_ajax_photoart_add_background', $plugin_admin_ajax, 'photoart_add_background' );
		$this->loader->add_action( 'wp_ajax_photoart_add_edit_size_pricing', $plugin_admin_ajax, 'photoart_add_edit_size_pricing' );
		$this->loader->add_action( 'wp_ajax_photoart_add_edit_paper_type', $plugin_admin_ajax, 'photoart_add_edit_paper_type' );
		$this->loader->add_action( 'wp_ajax_photoart_add_edit_paper', $plugin_admin_ajax, 'photoart_add_edit_paper' );
		$this->loader->add_action( 'wp_ajax_photoart_add_edit_framing', $plugin_admin_ajax, 'photoart_add_edit_framing' );
		$this->loader->add_action( 'wp_ajax_photoart_add_edit_frame_material', $plugin_admin_ajax, 'photoart_add_edit_frame_material' );
		$this->loader->add_action( 'wp_ajax_photoart_add_edit_fixture', $plugin_admin_ajax, 'photoart_add_edit_fixture' );
		$this->loader->add_action( 'wp_ajax_photoart_add_edit_glass', $plugin_admin_ajax, 'photoart_add_edit_glass' );
		$this->loader->add_action( 'wp_ajax_photoart_add_edit_window_mount', $plugin_admin_ajax, 'photoart_add_edit_window_mount' );
		$this->loader->add_action( 'wp_ajax_photoart_add_edit_substrate', $plugin_admin_ajax, 'photoart_add_edit_substrate' );

		$this->loader->add_action( 'wp_ajax_photoart_action_delete', $plugin_admin_ajax, 'photoart_action_delete' );
		$this->loader->add_action( 'wp_ajax_photoart_update_options', $plugin_admin_ajax, 'photoart_update_options' );





	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Photoframes_and_art_for_woocommerce_Public( $this->get_plugin_name(), $this->get_version() );
		$plugin_public_ajax = new Photoframes_and_art_for_woocommerce_Public_Ajax( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_filter( 'page_template', $plugin_public, 'photoart_framed_art_editor' );

		$this->loader->add_action( 'woocommerce_before_calculate_totals', $plugin_public, 'photoart_custom_price_to_cart_item', 10, 1 );
		$this->loader->add_action( 'woocommerce_cart_item_thumbnail', $plugin_public, 'photoart_product_item_thumbnail', 10, 3 );

		$this->loader->add_action( 'woocommerce_cart_item_price', $plugin_public, 'photoart_cart_item_price', 10, 3 );
		$this->loader->add_action( 'woocommerce_cart_item_subtotal', $plugin_public, 'photoart_cart_item_price_sub_total', 10, 3 );
		$this->loader->add_filter( 'woocommerce_get_item_data', $plugin_public, 'photoart_cart_item_custom_meta_data', 10, 2 );
		$this->loader->add_action( 'woocommerce_checkout_create_order_line_item', $plugin_public, 'checkout_create_order_line_item', 10, 4 );

		$this->loader->add_action( 'wp_ajax_photoart_get_paper_list_action', $plugin_public_ajax, 'photoart_get_paper_list_ajax' );
		$this->loader->add_action( 'wp_ajax_nopriv_photoart_get_paper_list_action', $plugin_public_ajax, 'photoart_get_paper_list_ajax' );
		$this->loader->add_action( 'wp_ajax_photoart_calculate_price', $plugin_public_ajax, 'photoart_calculate_price' );
		$this->loader->add_action( 'wp_ajax_nopriv_photoart_calculate_price', $plugin_public_ajax, 'photoart_calculate_price' );
		$this->loader->add_action( 'wp_ajax_photoart_woocommerce_ajax_add_to_cart', $plugin_public_ajax, 'photoart_add_to_cart' );
		$this->loader->add_action( 'wp_ajax_nopriv_photoart_woocommerce_ajax_add_to_cart', $plugin_public_ajax, 'photoart_add_to_cart' );
		$this->loader->add_action( 'wp_ajax_photoart_dropform_upload_handler', $plugin_public_ajax, 'photoart_upload_image' );
		$this->loader->add_action( 'wp_ajax_nopriv_photoart_dropform_upload_handler', $plugin_public_ajax, 'photoart_upload_image' );
		$this->loader->add_action( 'wp_ajax_photoart_dropform_delete_file', $plugin_public_ajax, 'photoart_delete_image' );
		$this->loader->add_action( 'wp_ajax_nopriv_photoart_dropform_delete_file', $plugin_public_ajax, 'photoart_delete_image' );		

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
	 * @return    Photoframes_and_art_for_woocommerce_Loader    Orchestrates the hooks of the plugin.
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

}
