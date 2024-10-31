<?php

/**
 * The admin-specific ajax calls of the plugin.
 *
 * @link       https://www.narolainfotech.com/
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/admin
 * @author     Narola Infotech <inquiry@narolainfotech.com>
 */
class Photoframes_And_Art_For_Woocommerce_Admin_Ajax {
	
	/**
	 * WordPress database access abstraction class object.
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private $wpdb;

	/**
	 * The ID of this plugin.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     string  $plugin_name  The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     string  $version  The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since  1.0.0
	 * @param  string $plugin_name  The name of this plugin.
	 * @param  string $version  The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		global $wpdb;
		$this->plugin_name = $plugin_name;
		$this->version 	   = $version;
	    $this->wpdb 	   = $wpdb;
		$this->helper 	   = new Photoandart_For_Woocommerce_Helper();
	}

	/**
	 * Add/Edit Fixture
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_background() {
		$params = array();				
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		if(!empty($params['selected_background'])) {
			if($params['form_action'] == 'add') {
				$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'backgrounds', array('background' => $params['selected_background'] ) );
				if($is_inserted != 0) {
					$response = $this->helper->photoart_success_response('background has been added.');
				} else {
					$response = $this->helper->photoart_unexpected_response();
				}
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else {
			$response = $this->helper->photoart_failed_response('Please select the background image.');
		}

		wp_send_json($response);
	}

	/**
	 * Add/Edit Size Pricing
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_edit_size_pricing() {
		$params = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		if($params['form_action'] == 'add') {
			$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'size_pricing', array('height' => $params['height'], 'width' => $params['width'], 'price' => $params['price'], 'module' => $params['size_module'], 'module_item' => $params['size_module_item'] ) );
			if($is_inserted != 0) {
				$response = $this->helper->photoart_success_response('Size has been added.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else if($params['form_action'] == 'edit') {
			$is_updated = $this->wpdb->update( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'size_pricing', array('height' => $params['height'], 'width' => $params['width'], 'price' => $params['price'], 'module' => $params['size_module'], 'module_item' => $params['size_module_item'] ), array( 'id' => $params['size_pricing_id'] ), NULL, NULL);
			if($is_updated != 0) {
				$response = $this->helper->photoart_success_response('Size has been updated.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		}

		wp_send_json($response);
	}

	/**
	 * Add/Edit Paper Type
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_edit_paper_type() {
		$params = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		if($params['form_action'] == 'add') {
			$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'paper_type', array('name' => $params['photoart_paper_type']) );
			if($is_inserted != 0) {
				$response = $this->helper->photoart_success_response('Paper type has been added.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else if($params['form_action'] == 'edit') {
			$is_updated = $this->wpdb->update( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'paper_type', array( 'name' => $params['photoart_paper_type'] ), array( 'id' => $params['paper_type_id'] ), NULL, NULL);
			if($is_updated != 0) {
				$response = $this->helper->photoart_success_response('Paper type has been updated.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		}

		wp_send_json($response);
	}

	/**
	 * Add/Edit Paper Type
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_edit_paper() {
		$params = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		if($params['form_action'] == 'add') {
			$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'paper', array('paper_type_id' => $params['paper_type'], 'name' => $params['photoart_paper'] ) );
			if($is_inserted != 0) {
				$response = $this->helper->photoart_success_response('Paper has been added.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else if($params['form_action'] == 'edit') {
			$is_updated = $this->wpdb->update( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'paper', array( 'paper_type_id' => $params['paper_type'], 'name' => $params['photoart_paper'] ), array( 'id' => $params['paper_id'] ), NULL, NULL);
			if($is_updated != 0) {
				$response = $this->helper->photoart_success_response('Paper has been updated.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		}

		wp_send_json($response);
	}

	/**
	 * Add/Edit Frame
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_edit_framing() {
		$params = array();
		$modules_arr = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		$frame_material = isset($params['photoart_frame_material']) ? 'yes' : 'no';
		$fixture = isset($params['photoart_fixture']) ? 'yes' : 'no';
		$glass = isset($params['photoart_glass']) ? 'yes' : 'no';
		$window_mount = isset($params['photoart_window_mount']) ? 'yes' : 'no';
		$mount_board_size = isset($params['photoart_mount_board_size']) ? 'yes' : 'no';

		if($params['form_action'] == 'add') {
			$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'frame', array('name' => $params['frame_name'], 'frame_material' => $frame_material, 'fixture' => $fixture, 'glass' => $glass, 'window_mount' => $window_mount, 'mount_board_size' => $mount_board_size ) );
			if($is_inserted != 0) {
				$response = $this->helper->photoart_success_response('Frame type has been added.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else if($params['form_action'] == 'edit') {
			$is_updated = $this->wpdb->update( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'frame', array('name' => $params['frame_name'], 'frame_material' => $frame_material, 'fixture' => $fixture, 'glass' => $glass, 'window_mount' => $window_mount, 'mount_board_size' => $mount_board_size ), array( 'id' => $params['frame_id'] ), NULL, NULL);
			if($is_updated != 0) {
				$response = $this->helper->photoart_success_response('Frame type has been updated.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		}

		wp_send_json($response);
	}

	/**
	 * Add/Edit Moduling
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_edit_frame_material() {
		$params = array();
		$modules_arr = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		$thin = isset($params['photoart_frame_material_thin']) ? 'yes' : 'no';
		$standard = isset($params['photoart_frame_material_standard']) ? 'yes' : 'no';
		$large = isset($params['photoart_frame_material_large']) ? 'yes' : 'no';
		$square = isset($params['photoart_frame_material_square']) ? 'yes' : 'no';

		if($params['form_action'] == 'add') {
			$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'frame_material', array('name' => $params['material_name'], 'thin' => $thin, 'standard' => $standard, 'large' => $large, 'square' => $square, 'design' => $params['selected_design'] ) );
			if($is_inserted != 0) {
				$response = $this->helper->photoart_success_response('Frame material has been added.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else if($params['form_action'] == 'edit') {
			$is_updated = $this->wpdb->update( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'frame_material', array('name' => $params['material_name'], 'thin' => $thin, 'standard' => $standard, 'large' => $large, 'square' => $square, 'design' => $params['selected_design'] ), array( 'id' => $params['material_id'] ), NULL, NULL);
			if($is_updated != 0) {
				$response = $this->helper->photoart_success_response('Frame material has been updated.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		}

		wp_send_json($response);
	}

	/**
	 * Add/Edit Fixture
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_edit_fixture() {
		$params = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		if($params['form_action'] == 'add') {
			$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'fixture', array('name' => $params['fixture_name'], 'design' => $params['selected_design']) );
			if($is_inserted != 0) {
				$response = $this->helper->photoart_success_response('Fixture has been added.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else if($params['form_action'] == 'edit') {
			$is_updated = $this->wpdb->update( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'fixture', array( 'name' => $params['fixture_name'], 'design' => $params['selected_design'] ), array( 'id' => $params['fixture_id'] ), NULL, NULL);
			if($is_updated != 0) {
				$response = $this->helper->photoart_success_response('Fixture has been updated.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		}

		wp_send_json($response);
	}

	/**
	 * Add/Edit Glass
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_edit_glass() {
		$params = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		if($params['form_action'] == 'add') {
			$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'glass', array('name' => $params['glass_name'], 'design' => $params['selected_design'] ) );
			if($is_inserted != 0) {
				$response = $this->helper->photoart_success_response('Glass has been added.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else if($params['form_action'] == 'edit') {
			$is_updated = $this->wpdb->update( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'glass', array( 'name' => $params['glass_name'], 'design' => $params['selected_design'] ), array( 'id' => $params['glass_id'] ), NULL, NULL);
			if($is_updated != 0) {
				$response = $this->helper->photoart_success_response('Glass has been updated.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		}

		wp_send_json($response);
	}

	/**
	 * Add/Edit Window Mount
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_edit_window_mount() {
		$params = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		if($params['form_action'] == 'add') {
			$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'window_mount', array('name' => $params['window_mount_name'], 'color_code' => $params['color_code'] ) );
			if($is_inserted != 0) {
				$response = $this->helper->photoart_success_response('Window mount has been added.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else if($params['form_action'] == 'edit') {
			$is_updated = $this->wpdb->update( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'window_mount', array( 'name' => $params['window_mount_name'], 'color_code' => $params['color_code'] ), array( 'id' => $params['window_mount_id'] ), NULL, NULL);
			if($is_updated != 0) {
				$response = $this->helper->photoart_success_response('Window mount has been updated.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		}

		wp_send_json($response);
	}

	/**
	 * Add/Edit Substrate
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_add_edit_substrate() {
		$params = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		if($params['form_action'] == 'add') {
			$is_inserted = $this->wpdb->insert( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'substrate', array('name' => $params['substrate_name'] ) );
			if($is_inserted != 0) {
				$response = $this->helper->photoart_success_response('Substrate has been added.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		} else if($params['form_action'] == 'edit') {
			$is_updated = $this->wpdb->update( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . 'substrate', array( 'name' => $params['substrate_name'] ), array( 'id' => $params['substrate_id'] ), NULL, NULL);
			if($is_updated != 0) {
				$response = $this->helper->photoart_success_response('Substrate has been updated.');
			} else {
				$response = $this->helper->photoart_unexpected_response();
			}
		}

		wp_send_json($response);
	}

	/**
	 * Delete Action
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success/Failed response
	 */
	public function photoart_action_delete() {
		$id = isset($_POST['id']) ? sanitize_text_field( $_POST['id'] ) : '';
		$model = isset($_POST['model']) ? sanitize_text_field( $_POST['model'] ) : '';

		if(!empty($id) && !empty($model) && $model == 'size_pricing') {
			$response = $this->photoart_delete_model( $model, $id, 'Size has been deleted.' );
		} else if(!empty($id) && !empty($model) && $model == 'paper_type') {
			$response = $this->photoart_delete_model( $model, $id, 'Paper type has been deleted.' );
		} else if(!empty($id) && $model == 'paper') {
			$response = $this->photoart_delete_model( $model, $id, 'Paper has been deleted.' );
		} else if(!empty($id) && $model == 'frame') {
			$response = $this->photoart_delete_model( $model, $id, 'Frame type has been deleted.' );
		} else if(!empty($id) && $model == 'frame_material') {
			$response = $this->photoart_delete_model( $model, $id, 'Frame material has been deleted.' );
		} else if(!empty($id) && $model == 'fixture') {
			$response = $this->photoart_delete_model( $model, $id, 'Fixture has been deleted.' );
		} else if(!empty($id) && $model == 'glass') {
			$response = $this->photoart_delete_model( $model, $id, 'Glass has been deleted.' );
		} else if(!empty($id) && $model == 'window_mount') {
			$response = $this->photoart_delete_model( $model, $id, 'Window mount has been deleted.' );
		} else if(!empty($id) && $model == 'backgrounds') {
			$response = $this->photoart_delete_model( $model, $id, 'Background has been deleted.' );
		} else if(!empty($id) && $model == 'substrate') {
			$response = $this->photoart_delete_model( $model, $id, 'Substrate has been deleted.' );
		}  else {
			$response = $this->helper->photoart_unexpected_response();
		}

		wp_send_json($response);
	}

	/**
	 * Delete query
	 *
	 * @since  1.0.0
	 * @param  string  $table  Table name
	 * @param  int  $id  ID
	 * @param  string  $success_msg  success message
	 * @return  Array  success response
	 */
	public function photoart_delete_model($model, $id, $success_msg) {
		$is_deleted = $this->wpdb->delete( $this->wpdb->prefix . PHOTOART_TBL_PREFIX . $model, ['id' => $id], ['%d'] );
		if($is_deleted != 0) {
			return $this->helper->photoart_success_response($success_msg);
		} else {
			return $this->helper->photoart_unexpected_response();
		}
	}

	/**
	 * Update Options
	 *
	 * @since  1.0.0
	 * @return  JsonArray Success response
	 */
	public function photoart_update_options() {
		$params = array();
		$formData = sanitize_text_field( $_POST['formData'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}
		update_option( 'photoart_max_height', $params['photoart_max_height'] );
		update_option( 'photoart_max_width', $params['photoart_max_width'] );
		update_option( 'photoart_is_active_print_only', isset($params['photoart_is_active_print_only']) ? 'yes' : 'no' );
		update_option( 'photoart_is_active_framing', isset($params['photoart_is_active_framing']) ? 'yes' : 'no' );
		update_option( 'photoart_is_active_mounting', isset($params['photoart_is_active_mounting']) ? 'yes' : 'no' );
		update_option( 'photoart_frontend_editor_page', $params['photoart_frontend_editor_page'] );
		wp_send_json($this->helper->photoart_success_response('Settings Saved.'));
	}		
}
