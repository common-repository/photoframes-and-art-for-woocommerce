<?php

/**
 * The public-specific ajax calls of the plugin.
 *
 * @link        https://www.narolainfotech.com/
 * @package     Photoframes_and_art_for_woocommerce
 * @subpackage  Photoframes_and_art_for_woocommerce/public
 * @author      Narola Infotech <inquiry@narolainfotech.com>
 */

class Photoframes_and_art_for_woocommerce_Public_Ajax {

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
	 * @param  string  $plugin_name  The name of this plugin.
	 * @param  string  $version  The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version 	   = $version;
		$this->helper 	   = new Photoandart_For_Woocommerce_Helper();
	}
	
	/**
	 * Get paper list
	 *
	 * @since  1.0.0
	 * @return  json  Success/Failed response
	 */
	public function photoart_get_paper_list_ajax() {
		$options 	 = '';
		$paper_type  = sanitize_text_field($_POST['formData']['paper_type']);

		if(!empty($paper_type)) {
			$result = $this->helper->get_data_by_id('paper', 'paper_type_id', $paper_type);
			if(!empty($result)) {
				$i = 0; foreach ($result as $key => $value) {
					$selected = ($i == 0) ? 'selected' : '';
					$options .= '<option value="'. $value->id .'" '. $selected .'>'. $value->name .'</option>';
					$i++;
				}
				$response = $this->helper->photoart_success_response('Data found', array('options' => $options));
			} else {
				$response = $this->helper->photoart_success_response('No paper found', array('options' => null));
			}
		} else {
			$response = $this->helper->photoart_unexpected_response();
		}

		wp_send_json($response);
	}

	/**
	 * Calculate pricing
	 *
	 * @since  1.0.0
	 * @return  json  Success/Failed response
	 */
	public function photoart_calculate_price() {
		$params = array();
		$prices = array();
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

		$width 			= !empty($params['final_overall_width']) ? $params['final_overall_width'] : '';
		$height 		= !empty($params['final_overall_height']) ? $params['final_overall_height'] : '';
		$paper 			= !empty($params['final_paper']) ? $params['final_paper'] : '';
		$frame_material = !empty($params['final_frame_material']) ? $params['final_frame_material'] : '';
		$glass 			= !empty($params['final_glass']) ? $params['final_glass'] : '';
		$window_mount 	= !empty($params['final_window_mount']) ? $params['final_window_mount'] : '';
		$fixture 		= !empty($params['final_fixture']) ? $params['final_fixture'] : '';
		$substrate 		= !empty($params['final_substrate']) ? $params['final_substrate'] : '';
		$calulatedSize 	= $this->helper->photoart_get_calculated_size($width, $height);

		// Get printing price
		if(!empty($width) && !empty($height) && !empty($paper)) {
			$result = $this->helper->photoart_get_size_price('paper', $paper, $calulatedSize);
			if(!empty($result)) {
				$prices['prices']['printing'] = $result[0]->price;
			} else {
				$prices['prices']['printing'] = number_format(0, 2);
			}
		}

		// Get framing price
		if(!empty($width) && !empty($height) && !empty($frame_material)) {
			$result = $this->helper->photoart_get_size_price('frame-material', $frame_material, $calulatedSize);
			if(!empty($result)) {
				$prices['prices']['framing'] = $result[0]->price;
			} else {
				$prices['prices']['framing'] = number_format(0, 2);
			}
		}

		// Get glass price
		if(!empty($width) && !empty($height) && !empty($glass)) {
			$result = $this->helper->photoart_get_size_price('glass', $glass, $calulatedSize);
			if(!empty($result)) {
				$prices['prices']['glass'] = $result[0]->price;
			} else {
				$prices['prices']['glass'] = number_format(0, 2);
			}
		}

		// Get window mount price
		if(!empty($width) && !empty($height) && !empty($window_mount)) {
			$result = $this->helper->photoart_get_size_price('window-mount', $window_mount, $calulatedSize);
			if(!empty($result)) {
				$prices['prices']['window_mount'] = $result[0]->price;
			} else {
				$prices['prices']['window_mount'] = number_format(0, 2);
			}
		}

		// Get substrate price
		if(!empty($width) && !empty($height) && !empty($substrate)) {
			$result = $this->helper->photoart_get_size_price('substrate', $substrate, $calulatedSize);
			if(!empty($result)) {
				$prices['prices']['substrate'] = $result[0]->price;
			} else {
				$prices['prices']['substrate'] = number_format(0, 2);
			}
		}

		$prices['sub_total'] = number_format ( (float) $prices['prices']['printing'] + (float) $prices['prices']['framing'] + (float) $prices['prices']['glass'] + (float) $prices['prices']['window_mount'] + (float) $prices['prices']['substrate'], 2 );
		$prices['total'] = $prices['sub_total'];

		if(!empty($prices)) {
			$response = $this->helper->photoart_success_response('Success', $prices);
		} else {
			$response = $this->helper->photoart_unexpected_response();
		}

		wp_send_json($response);
	}

	/**
	 * Add to cart
	 *
	 * @since  1.0.0
	 * @return  json  Success/Failed response
	 */
	public function photoart_add_to_cart() {		
		$error = false;
		$params = array();		
		$formData = sanitize_text_field( $_POST['form_data'] );
		if( $formData != '' ){
			$parts = explode('&', $formData);
			foreach ($parts as $part) {
				$keyValue = explode('=', $part, 2);
				if (count($keyValue) == 2) {
					$params[$keyValue[0]] = $keyValue[1];
				}
			}
		}

		$final_dpi = (int) $params['final_dpi'];

		if($final_dpi < 100) {
			$error = true;
			$erromsg = __( 'DPI needs to be 100 or above. We recommend reducing the print size.', 'photoframes-and-art-for-woocommerce' );
		}

		if($error != true) {			
			$product_id 	   = apply_filters('woocommerce_add_to_cart_product_id', absint(get_option('_photoart_default_product')));			
			$quantity 		   = 1;
	        $variation_id 	   = absint(0);
	        $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
						
	        if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, array(), $params)) {
	            do_action('woocommerce_ajax_added_to_cart', $product_id);
	            WC()->cart->calculate_totals();
				WC()->cart->set_session();
				WC()->cart->maybe_set_cart_cookies();

	            if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
	                wc_add_to_cart_message(array($product_id => $quantity), true);
	            }

	            WC_AJAX :: get_refreshed_fragments();
	        } else {
	            $data = array(
	                'error' => true,
	                'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

	            wp_send_json($data);
	        }
		} else {
			wp_send_json($this->helper->photoart_failed_response($erromsg));
		}

        wp_die();
	}

	/**
	 * Upload images to media
	 *
	 * @since  1.0.0
	 * @return  json  Success/Failed response
	 */
	public function photoart_upload_image() {
		if (!empty($_FILES)) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );

            foreach ($_FILES as $file => $array) {
                if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                	wp_send_json(array(
                			'status'  => 'error',
                			'message' => __('Error: ', 'photoframes-and-art-for-woocommerce') . $_FILES[$file]['error']
                		)
                	);
                }

                $attachment = media_handle_upload($file, 0);

                if (is_wp_error($attachment)) {
                	wp_send_json(array(
                        'status'  => 'error',
                        'message' => __($attachment->get_error_message(), 'photoframes-and-art-for-woocommerce'),
                    ));
                } else {
                    wp_send_json(array(
                        'status'   	 => 'ok',
                        'attachment' => array('id' => $attachment, 'url' => wp_get_attachment_image_url( $attachment, 'full' )),
                        'message' 	 => __('File uploaded', 'photoframes-and-art-for-woocommerce'),
                    ));
                }
            }
        } else {
        	wp_send_json(
        		array(
        			'status'  => 'error',
        			'message' => __('There is nothing to upload!', 'photoframes-and-art-for-woocommerce')
        		)
        	);
        }
	}

	/**
	 * Delete image
	 *
	 * @since  1.0.0
	 * @return  json  Success/Failed response
	 */
	public function photoart_delete_image() {
		$attachment_id = absint( sanitize_text_field( $_POST['attachment_id'] ) );
        $result 	   = wp_delete_attachment($attachment_id, true);
        if ($result) { wp_send_json(array('status' => 'ok')); }
	}
}