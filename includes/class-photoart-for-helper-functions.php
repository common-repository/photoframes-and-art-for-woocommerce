<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since       1.0.0
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/includes
 */
class Photoandart_For_Woocommerce_Helper {

	/**
	 * WordPress database access abstraction class object.
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private $wpdb;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since  1.0.0
	 */
	public function __construct() {
	    global $wpdb;
	    $this->wpdb = $wpdb;
	}

	/**
	 * List of all modules
	 *
	 * @since   1.0.0
	 * @return  Array  All modules
	 */
	public function photoart_get_all_modules() {
		return array(
			'general-settings' => array(
				'title' => __( 'General Settings', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'no',
				'is_default' => 'yes',
				'show_in_nav' => 'yes'
			),
			'size-pricing' => array(
				'title' => __( 'Size Pricing', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'no',
				'is_default' => 'no',
				'show_in_nav' => 'no'
			),
			'backgrounds' => array(
				'title' => __( 'Backgrounds', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'no',
				'is_default' => 'no',
				'show_in_nav' => 'yes'
			),
			'print-type' => array(
				'title' => __( 'Print Type', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'no',
				'is_default' => 'no',
				'show_in_nav' => 'yes'
			),
			'paper' => array(
				'title' => __('Paper', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'yes',
				'is_default' => 'no',
				'show_in_nav' => 'yes'
			),
			'frames' => array(
				'title' => __( 'Frames', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'no',
				'is_default' => 'no',
				'show_in_nav' => 'yes'
			),
			'frame-material' => array(
				'title' => __( 'Frame Material', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'yes',
				'is_default' => 'no',
				'show_in_nav' => 'yes'
			),
			'fixture' => array(
				'title' => __( 'Fixture', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'no',
				'is_default' => 'no',
				'show_in_nav' => 'yes'
			),
			'glass' => array(
				'title' => __( 'Glass', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'yes',
				'is_default' => 'no',
				'show_in_nav' => 'yes'
			),
			'window-mount' => array(
				'title' => __( 'Window Mount', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'yes',
				'is_default' => 'no',
				'show_in_nav' => 'yes'
			),
			'substrate' => array(
				'title' => __( 'Substrate', 'photoframes-and-art-for-woocommerce' ),
				'has_price' => 'yes',
				'is_default' => 'no',
				'show_in_nav' => 'yes'
			)
		);
	}

	/**
	 * Get all backgrounds
	 *
	 * @since   1.0.0
	 * @return  Array  List of backgrounds
	 */
	public function get_backgrounds_list() {
		$tbl_backgrounds = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'backgrounds';
		$backgrounds 	 = $this->wpdb->get_results( "SELECT * FROM {$tbl_backgrounds}" );
		return $backgrounds;
	}

	/**
	 * Get all pricing
	 *
	 * @since   1.0.0
	 * @return  Array  List of pricing
	 */
	public function get_size_pricing_list($module, $module_item) {
		$tbl_size_pricing = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'size_pricing';
		$size_pricing 	  = $this->wpdb->get_results( "SELECT * FROM {$tbl_size_pricing} WHERE module = '{$module}' AND module_item = {$module_item}" );
		return $size_pricing;
	}

	/**
	 * Get all print types
	 *
	 * @since   1.0.0
	 * @return  Array  List of print types
	 */
	public function get_print_type_list() {
		$tbl_paper_type = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'paper_type';
		$paper_type 	= $this->wpdb->get_results( "SELECT * FROM {$tbl_paper_type}" );
		return $paper_type;
	}

	/**
	 * Get all print types
	 *
	 * @since   1.0.0
	 * @return  Array  List of print types
	 */
	public function photoart_get_paper_list() {
		$tbl_paper_type = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'paper_type';
		$tbl_paper 		= $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'paper';
		$papers 		= $this->wpdb->get_results( "SELECT *, {$tbl_paper_type}.name as paper_type_name, {$tbl_paper}.id AS paper_id, {$tbl_paper}.name AS paper_name FROM {$tbl_paper} LEFT JOIN {$tbl_paper_type} ON {$tbl_paper}.paper_type_id = {$tbl_paper_type}.id" );
		return $papers;
	}

	/**
	 * Get all frames
	 *
	 * @since   1.0.0
	 * @return  Array  List of frame list
	 */
	public function get_frame_list() {
		$tbl_frame = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'frame';
		$frames    = $this->wpdb->get_results( "SELECT * FROM {$tbl_frame}" );
		return $frames;
	}

	/**
	 * Get all frame materials
	 *
	 * @since   1.0.0
	 * @return  Array  List of frame materials
	 */
	public function get_frame_material_list() {
		$tbl_frame_material = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'frame_material';
		$frame_materials 	= $this->wpdb->get_results( "SELECT * FROM {$tbl_frame_material}" );
		return $frame_materials;
	}

	/**
	 * Get all fixture
	 *
	 * @since   1.0.0
	 * @return  Array  List of fixtures
	 */
	public function get_fixture_list() {
		$tbl_fixture = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'fixture';
		$fixtures 	 = $this->wpdb->get_results( "SELECT * FROM {$tbl_fixture}" );
		return $fixtures;
	}

	/**
	 * Get all glass
	 *
	 * @since   1.0.0
	 * @return  Array  List of glasses
	 */
	public function get_glass_list() {
		$tbl_glass = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'glass';
		$glasses   = $this->wpdb->get_results( "SELECT * FROM {$tbl_glass}" );
		return $glasses;
	}

	/**
	 * Get all window mounts
	 *
	 * @since   1.0.0
	 * @return  Array  List of window mounts
	 */
	public function get_window_mount_list() {
		$tbl_window_mount = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'window_mount';
		$window_mounts 	  = $this->wpdb->get_results( "SELECT * FROM {$tbl_window_mount}" );
		return $window_mounts;
	}

	/**
	 * Get all substrate
	 *
	 * @since   1.0.0
	 * @return  Array  List of substrate
	 */
	public function get_substrate_list() {
		$tbl_substrate = $this->wpdb->prefix. PHOTOART_TBL_PREFIX .'substrate';
		$substrate 	   = $this->wpdb->get_results( "SELECT * FROM {$tbl_substrate}" );
		return $substrate;
	}

	/**
	 * Get by id
	 *
	 * @since   1.0.0
	 * @return  Array  List of data from the respective table
	 */
	public function get_data_by_id($table, $fieldby, $id) {
		$table = $this->wpdb->prefix. PHOTOART_TBL_PREFIX . $table;
		$data  = $this->wpdb->get_results( "SELECT * FROM {$table} WHERE {$fieldby} = {$id}" );
		return $data;
	}

	/**
	 * Get size price
	 *
	 * @since   1.0.0
	 * @param  $paper  Paper
	 * @param  $frame_material  Frame Material
	 * @param  $glass  Glass
	 * @param  $window_mount  Window Mount
	 * @param  $substrate  Substrate
	 * @return  Array  List of data from the respective table
	 */
	public function photoart_get_size_price($module, $module_item, $calculated_size) {
		$table = $this->wpdb->prefix. PHOTOART_TBL_PREFIX . 'size_pricing';
		$data  = $this->wpdb->get_results( "SELECT *, `height`*`width` AS `calculated_size` FROM `{$table}` WHERE `module` IN ('{$module}') AND `module_item` IN ({$module_item}) ORDER BY ABS( `calculated_size` - {$calculated_size})" );
		return $data;
	}

	/**
	 * is active tab
	 *
	 * @since   1.0.0
	 * @param  $is_tab  Tab ID
	 * @return  Boolean True/False
	 */
	public function set_active_tab($is_tab) {
		//error_reporting(0);
		// $active_tab = sanitize_text_field($_GET['tab']);
		// $active_page = sanitize_text_field($_GET['page']);
		$active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : '';
		$active_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';

		if( is_admin() && $active_page == 'photoandart-settings' && ( isset($active_tab) && $active_tab == $is_tab ) ) {
			return true;
		} else if(is_admin() && !isset($active_tab)) {
			return 'default';
		} else {
			return false;
		}
	}
	// public function set_active_tab($is_tab) {
	// 	error_reporting(0);
	// 	$active_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : '';
	// 	$active_page = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';
	
	// 	if (is_admin() && $active_page == 'photoandart-settings' && $active_tab == $is_tab) {
	// 		return true;
	// 	} elseif (is_admin() && empty($active_tab)) {
	// 		return 'default';
	// 	} else {
	// 		return false;
	// 	}
	// }

	/**
	 * Get admin settings tab URL
	 *
	 * @since   1.0.0
	 * @param  $tab  Tab ID
	 * @return  Array  Tab URL
	 */
	public function get_tab_url($tab) {
		return admin_url( 'admin.php?page=photoandart-settings&tab='. $tab );
	}

	/**
	 * Check if it's pricing page
	 *
	 * @since   1.0.0
	 * @param  $tab  Tab ID
	 * @return  Boolean True/False
	 */
	public function is_pricing_page($tab) {
		//error_reporting(0);
		// $active_page = sanitize_text_field($_GET['page']);
		// $active_module = sanitize_text_field($_GET['page']);
		$active_page = isset($_GET['tab']) ? sanitize_text_field($_GET['page']) : '';
		$active_module = isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '';
		if(is_admin() && $active_page == 'photoandart-settings' && $active_module == $tab) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Get printed area
	 *
	 * @since   1.0.0
	 * @param  Float  $width  Width
	 * @param  Float  $height  Height
	 * @param  String  $unit  Unit
	 * @return  String  Size
	 */
	public function get_size($width, $height, $unit) {
		return $width . ' '. $unit .' X '. $height . ' '. $unit;
	}

	/**
	 * Get calculated size
	 *
	 * @since   1.0.0
	 * @param  Float  $width  Width
	 * @param  Float  $height  Height
	 * @return  Float  Size
	 */
	public function photoart_get_calculated_size($width, $height) {
		return (int) $width * (int) $height;
	}

	/**
	 * Get editor page
	 *
	 * @since  1.0.0
	 */
	public function framed_art_editor_page() {
		return get_option('photoart_frontend_editor_page');
	}

	/**
	 * Send Success Response
	 *
	 * @since  1.0.0
	 * @return  Array  Success response
	 */
	public function photoart_success_response($message, $data = null) {
		return array( 'status' => 'success', 'msg' => __( $message, 'photoframes-and-art-for-woocommerce' ), 'data' => $data );
	}

	/**
	 * Send Failed Response
	 *
	 * @since  1.0.0
	 * @return  Array  Failed error response
	 */
	public function photoart_failed_response($message) {
		return array( 'status' => 'failed', 'msg' => __( $message, 'photoframes-and-art-for-woocommerce' ) );
	}

	/**
	 * Send Unexpected Response
	 *
	 * @since  1.0.0
	 * @return  Array  Unexpected error response
	 */
	public function photoart_unexpected_response() {
		return array( 'status' => 'failed', 'msg' => __( 'Something went wrong. Please try again later', 'photoframes-and-art-for-woocommerce' ) );
	}
}
