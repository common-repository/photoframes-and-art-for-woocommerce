<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.narolainfotech.com
 * @since      1.0.0
 *
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/admin
 * @author     Narola Infotech <inquiry@narolainfotech.com>
 */
class Photoframes_and_art_for_woocommerce_Admin {

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
		 * defined in Photoframes_and_art_for_woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Photoframes_and_art_for_woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/photoframes_and_art_for_woocommerce-admin.css', array(), $this->version, 'all' );

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
		 * defined in Photoframes_and_art_for_woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Photoframes_and_art_for_woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_media();
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/photoframes_and_art_for_woocommerce-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script(
			$this->plugin_name, 'adminScriptObj',
			array( 
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'updateBtnText' => __( 'Update', 'photoframes-and-art-for-woocommerce' ),
				'loadingText' => __( 'Loading...', 'photoframes-and-art-for-woocommerce' ),
				'deletingText' => __( 'Deleting...', 'photoframes-and-art-for-woocommerce' ),
				'messages' => array(
					'success' => array(),
					'error'  => array(
						'msg_1' => __( 'Something went wrong. Please try again later.', 'photoframes-and-art-for-woocommerce' )
					)
				)
			) 
		);
	}

	/**
	 * Create an setting page
	 *
	 * @since  1.0.0
	 */
	public function photoart_register_options_page() {
		add_submenu_page( 'woocommerce', __( 'Photoframe and Art', 'photoframes-and-art-for-woocommerce' ), __( 'Photoframe and Art', 'photoframes-and-art-for-woocommerce' ), 'manage_options', 'photoandart-settings', array( $this, 'photoart_options_page' ) );
  	}

	/**
	 * Setting page content
	 *
	 * @since  1.0.0
	 */
	public function photoart_options_page() {
		$photoartHelper = new Photoandart_For_Woocommerce_Helper();
		
	  	load_template( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/tabs/navigation.php', true, $args = array( 'photoartHelper' => $photoartHelper ) );

	  	foreach ($args['photoartHelper']->photoart_get_all_modules() as $key => $value) {
			if($key != 'general-settings') {
				if($photoartHelper->set_active_tab($key) === true) {
					load_template( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/tabs/'. $key .'.php', true, $args = array( 'photoartHelper' => $photoartHelper ) );
				}
			} else {
				if($photoartHelper->set_active_tab($key) === true || $photoartHelper->set_active_tab($key) === 'default') {
					load_template( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/tabs/'. $key .'.php', true, $args = array( 'photoartHelper' => $photoartHelper ) );
				}
			}
		}
	}

	/**
	 * Prevent frame art default product from delete
	 *
	 * @since  1.0.0
	 */
	function photoart_restore_trashed_post( $post_id ) {	
		$post_type_value = get_post_type( $post_id );
		$get_default_product = get_option( '_photoart_default_product', true );
		if ( $post_type_value === 'product' && $post_id === (int) $get_default_product ) {
			wp_untrash_post( $post_id );
		}
		
	}


}
