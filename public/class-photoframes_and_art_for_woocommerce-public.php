<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.narolainfotech.com
 * @since      1.0.0
 *
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/public
 * @author     Narola Infotech <inquiry@narolainfotech.com>
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/public
 * @author     Narola Infotech <inquiry@narolainfotech.com>
 */
class Photoframes_and_art_for_woocommerce_Public {

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
		$this->helper 	   = new Photoandart_For_Woocommerce_Helper();

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
		 * defined in Photoframes_and_art_for_woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Photoframes_and_art_for_woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( !empty($this->helper->framed_art_editor_page()) && is_page($this->helper->framed_art_editor_page()) ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/photoframes_and_art_for_woocommerce-public.css', array(), $this->version, 'all' );
			wp_enqueue_style( 'photoart-font-awesome-style', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), '', 'all' );
		}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
				
		if ( !empty($this->helper->framed_art_editor_page()) && is_page($this->helper->framed_art_editor_page()) ) {
			wp_enqueue_media();
			wp_enqueue_script( 'photoart-lib-script', plugin_dir_url( __FILE__ ) . 'js/lib.js', array(), '3.1.0', 'all' );
			wp_enqueue_script( 'photoart-draggable-script', plugin_dir_url( __FILE__ ) . 'js/draggable.js', array(), '3.1.0', 'all' );
			wp_enqueue_script( 'photoart-dropzone-script', plugin_dir_url( __FILE__ ) . 'js/dropzone.min.js', array(), '5.9.3', 'all' );
			wp_enqueue_script( 'photoart-public-script', plugin_dir_url( __FILE__ ) . 'js/photoframes_and_art_for_woocommerce-public.js?'. time(), array( 'photoart-lib-script', 'photoart-draggable-script' ), '', 'all' );
			wp_localize_script( 'photoart-public-script', 'publicScriptObj', array( 
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'updateBtnText' => __( 'Update', 'photoframes-and-art-for-woocommerce' ),
				'loadingText' => __( 'Loading...', 'photoframes-and-art-for-woocommerce' ),
				'deletingText' => __( 'Deleting...', 'photoframes-and-art-for-woocommerce' ),
				'messages' => array(
					'success' => array(),
					'error'   => array(
						'msg_1' => __( 'Something went wrong. Please try again later.', 'photoframes-and-art-for-woocommerce' )
					),
					'info' => array(
						'msg_1' => __( 'We recommend a DPI of 200 or above. But you can still order at this size.', 'photoframes-and-art-for-woocommerce' ),
						'msg_2' => __( 'DPI needs to be 100 or above. We recommend reducing the print size.', 'photoframes-and-art-for-woocommerce' )
					)
				),
				'maxWidth' 	   => get_option('photoart_max_width'),
				'maxHeight'    => get_option('photoart_max_height'),
				'upload_file'  => admin_url('admin-ajax.php?action=photoart_dropform_upload_handler'),
        		'delete_file'  => admin_url('admin-ajax.php?action=photoart_dropform_delete_file'),
			));
		}
	}

	/**
	 * Loads the framed art editor
	 *
	 * @since  1.0.0
	 */
	public function photoart_framed_art_editor( $page_template ) {
	    if ( !empty($this->helper->framed_art_editor_page()) && is_page($this->helper->framed_art_editor_page()) ) {
	        $page_template = plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/photoframes_and_art_for_woocommerce-public-display.php';
	    }

	    return $page_template;
	}


	
	/**
	 * Custom price
	 *
	 * @since  1.0.0
	 * @param  array $cart_object  Cart object
	 */
	public function photoart_custom_price_to_cart_item( $cart_object ) {  
	    if( !WC()->session->__isset( 'reload_checkout' )) {
	        foreach ( $cart_object->cart_contents as $key => $cart_item ) {
	            if( isset( $cart_item['final_total'] ) ) {
	                $cart_item['data']->set_price($cart_item['final_total']);
	            }
	        }  
	    }  
	}

	/**
	 * Custom price
	 *
	 * @since  1.0.0
	 * @param  html  $price_html  Price
	 * @param  object  $cart_item  Cart item
	 * @param  object  $cart_item_key  Cart item key
	 * @return  html  $price_html  Price
	 */
	public function photoart_cart_item_price( $price_html, $cart_item, $cart_item_key ) {
	    if( isset( $cart_item['final_total'] ) ) {
	        $args = array( 'price' => $cart_item['final_total'] );
	        if ( WC()->cart->display_prices_including_tax() ) {
	            $product_price = wc_get_price_including_tax( $cart_item['data'], $args );
	        } else {
	            $product_price = wc_get_price_excluding_tax( $cart_item['data'], $args );
	        }
	        return wc_price( $product_price );
	    }
	    return $price_html;
	}

	/**
	 * Custom sub total price
	 *
	 * @since  1.0.0
	 * @param  html  $price_html  Price
	 * @param  object  $cart_item  Cart item
	 * @param  object  $cart_item_key  Cart item key
	 * @return  html  $price_html  Price
	 */
	public function photoart_cart_item_price_sub_total( $price_html, $cart_item, $cart_item_key ) {
	    if( isset( $cart_item['final_total'] ) ) {
	        $args = array( 'qty' => $cart_item['quantity'], 'price' => $cart_item['final_total'] );
	        if ( WC()->cart->display_prices_including_tax() ) {
	            $product_price = wc_get_price_including_tax( $cart_item['data'], $args );
	        } else {
	            $product_price = wc_get_price_excluding_tax( $cart_item['data'], $args );
	        }
	        return wc_price( $product_price );
	    }
	    return $price_html;
	}

	/**
	 * Add custom cart item data
	 *
	 * @since  1.0.0
	 * @param  Array  $cart_item_data  Cart item data
	 * @param  Int  $product_id  Product id
	 * @param  Int  $variation_id  Variation
	 * @return  Array  $item_data  Cart item data
	 */
	public function photoart_cart_item_custom_meta_data( $item_data, $cart_item ) {
	    if ( !empty($cart_item['final_total']) ) {
	    	$final_unit 		     = $cart_item['final_unit'];
	    	$final_dpi 			     = $cart_item['final_dpi'];
	    	$final_print_width 	     = $cart_item['final_print_width'];
			$final_print_height      = $cart_item['final_print_height'];
			$final_width 		     = $cart_item['final_width'];
			$final_height 		     = $cart_item['final_height'];
			$final_overall_width     = $cart_item['final_overall_width'];
			$final_overall_height    = $cart_item['final_overall_height'];
			$final_paper 		     = $cart_item['final_paper'];
			$final_frame_material    = $cart_item['final_frame_material'];
			$final_glass 		     = $cart_item['final_glass'];
			$final_window_mount      = $cart_item['final_window_mount'];
			$final_window_mount_size = $cart_item['final_window_mount_size'];
			$final_fixture 		  	 = $cart_item['final_fixture'];
			$final_substrate 	  	 = $cart_item['final_substrate'];
			$final_image 			 = $cart_item['final_image'];
			$calulatedSize 			 = $this->helper->photoart_get_calculated_size($final_print_width, $final_print_height);

	    	if(!empty($final_width) && !empty($final_height) && !empty($final_unit)) {
		    	$item_data[] = array(
		            'key'   => __( 'Printed Area', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $this->helper->get_size($final_width, $final_height, $final_unit),
		        );
			}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_unit)) {
		        $item_data[] = array(
		            'key'   => __( 'Print Size', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $this->helper->get_size($final_print_width, $final_print_height, $final_unit),
		        );
			}

			if(!empty($final_overall_width) && !empty($final_overall_height) && !empty($final_unit)) {
		        $item_data[] = array(
		            'key'   => __( 'Overall Size', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $this->helper->get_size($final_overall_width, $final_overall_height, $final_unit),
		        );
			}

			if(!empty($final_dpi)) {
		        $item_data[] = array(
		            'key'   => __( 'DPI', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $final_dpi,
		        );
			}

			if(!empty($final_paper)) {
		        $item_data[] = array(
		            'key'   => __( 'Paper', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $this->helper->get_data_by_id('paper', 'id', $final_paper)[0]->name,
		        );
			}

	        if(!empty($final_frame_material)) {
		        $item_data[] = array(
		            'key'   => __( 'Frame Material', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $this->helper->get_data_by_id('frame_material', 'id', $final_frame_material)[0]->name,
		        );
	        }

	        if(!empty($final_fixture)) {
		        $item_data[] = array(
		            'key'   => __( 'Fixture', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $this->helper->get_data_by_id('fixture', 'id', $final_fixture)[0]->name,
		        );
	        }

	        if(!empty($final_glass)) {
		        $item_data[] = array(
		            'key'   => __( 'Glass', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $this->helper->get_data_by_id('glass', 'id', $final_glass)[0]->name,
		        );
	        }

	        if(!empty($final_window_mount) && !empty($final_window_mount_size)) {
		        $item_data[] = array(
		            'key'   => __( 'Window Mount', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $this->helper->get_data_by_id('window_mount', 'id', $final_window_mount)[0]->name . ' (' . $final_window_mount_size . __(' cm', 'photoframes-and-art-for-woocommerce' ) .')',
		        );
	        }

	        if(!empty($final_substrate)) {
		        $item_data[] = array(
		            'key'   => __( 'Substrate', 'photoframes-and-art-for-woocommerce' ),
		            'value' => $this->helper->get_data_by_id('substrate', 'id', $final_substrate)[0]->name,
		        );
	        }

	        if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_paper)) {
				$result = $this->helper->photoart_get_size_price('paper', $final_paper, $calulatedSize);
				$item_data[] = array(
		            'key'   => __( 'Printing Cost', 'photoframes-and-art-for-woocommerce' ),
		            'value' => !empty($result) ? $result[0]->price : 0.00,
		        );
			}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_frame_material)) {
				$result = $this->helper->photoart_get_size_price('frame-material', $final_frame_material, $calulatedSize);
				$item_data[] = array(
		            'key'   => __( 'Framing Cost', 'photoframes-and-art-for-woocommerce' ),
		            'value' => !empty($result) ? $result[0]->price : 0.00,
		        );
			}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_glass)) {
				$result = $this->helper->photoart_get_size_price('glass', $final_glass, $calulatedSize);
				$item_data[] = array(
		            'key'   => __( 'Glass Cost', 'photoframes-and-art-for-woocommerce' ),
		            'value' => !empty($result) ? $result[0]->price : 0.00,
		        );
			}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_window_mount)) {
				$result = $this->helper->photoart_get_size_price('window-mount', $final_window_mount, $calulatedSize);
				$item_data[] = array(
		            'key'   => __( 'Window Mount Cost', 'photoframes-and-art-for-woocommerce' ),
		            'value' => !empty($result) ? $result[0]->price : 0.00,
		        );
			}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_substrate)) {
				$result = $this->helper->photoart_get_size_price('substrate', $final_substrate, $calulatedSize);
				$item_data[] = array(
		            'key'   => __( 'Mounting Cost', 'photoframes-and-art-for-woocommerce' ),
		            'value' => !empty($result) ? $result[0]->price : 0.00,
		        );
			}

			if(!empty($final_image)) {
		        $item_data[] = array(
		            'key'   => __( 'Your Art', 'photoframes-and-art-for-woocommerce' ),
		            'value' => '<a href="'. $final_image .'" target="_blank">'. __( 'Preview', 'photoframes-and-art-for-woocommerce' ) .'</a>',
		        );
			}
	    }
	    
	    return $item_data;
	}

	/**
	 * Add custom meta to order
	 *
	 * @since  1.0.0
	 * @param  Object  $item  Cart item data
	 * @param  Int  $cart_item_key  Cart item key
	 * @param  Array  $values  Item values
	 * @param  Object  $order  Order
	 */
	public function photoart_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
		if ( !empty($values['final_total']) ) {
			$final_unit 		     = $values['final_unit'];
	    	$final_dpi 			     = $values['final_dpi'];
	    	$final_print_width 	     = $values['final_print_width'];
			$final_print_height      = $values['final_print_height'];
			$final_width 		     = $values['final_width'];
			$final_height 		     = $values['final_height'];
			$final_overall_width     = $values['final_overall_width'];
			$final_overall_height    = $values['final_overall_height'];
			$final_paper 		     = $values['final_paper'];
			$final_frame_material    = $values['final_frame_material'];
			$final_glass 		     = $values['final_glass'];
			$final_window_mount      = $values['final_window_mount'];
			$final_window_mount_size = $values['final_window_mount_size'];
			$final_fixture 		  	 = $values['final_fixture'];
			$final_substrate 	  	 = $values['final_substrate'];
			$final_image 			 = $values['final_image'];
			$calulatedSize 			 = $this->helper->photoart_get_calculated_size($final_print_width, $final_print_height);

		 	if(!empty($final_width) && !empty($final_height) && !empty($final_unit)) {
		 		$item->add_meta_data( __( 'Printed Area', 'photoframes-and-art-for-woocommerce' ), $this->helper->get_size($final_width, $final_height, $final_unit), true );
		 	}

		 	if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_unit)) {
		 		$item->add_meta_data( __( 'Print Size', 'photoframes-and-art-for-woocommerce' ), $this->helper->get_size($final_print_width, $final_print_height, $final_unit), true );
		 	}

		 	if(!empty($final_overall_width) && !empty($final_overall_height) && !empty($final_unit)) {
		 		$item->add_meta_data( __( 'Overall Size', 'photoframes-and-art-for-woocommerce' ), $this->helper->get_size($final_overall_width, $final_overall_height, $final_unit), true );
		 	}

		 	if(!empty($final_dpi)) {
		 		$item->add_meta_data( __( 'DPI', 'photoframes-and-art-for-woocommerce' ), $final_dpi, true );
		 	}

		 	if(!empty($final_paper)) {
		 		$item->add_meta_data( __( 'Paper', 'photoframes-and-art-for-woocommerce' ), $this->helper->get_data_by_id('paper', 'id', $final_paper)[0]->name, true );
		 	}

		 	if(!empty($final_frame_material)) {
		 		$item->add_meta_data( __( 'Frame Material', 'photoframes-and-art-for-woocommerce' ), $this->helper->get_data_by_id('frame_material', 'id', $final_frame_material)[0]->name, true );
		 	}

		 	if(!empty($final_fixture)) {
		 		$item->add_meta_data( __( 'Fixture', 'photoframes-and-art-for-woocommerce' ), $this->helper->get_data_by_id('fixture', 'id', $final_fixture)[0]->name, true );
		 	}

		 	if(!empty($final_glass)) {
		 		$item->add_meta_data( __( 'Glass', 'photoframes-and-art-for-woocommerce' ), $this->helper->get_data_by_id('glass', 'id', $final_glass)[0]->name, true );
		 	}

		 	if(!empty($final_window_mount) && !empty($final_window_mount_size)) {
		 		$item->add_meta_data( __( 'Window Mount', 'photoframes-and-art-for-woocommerce' ), $this->helper->get_data_by_id('window_mount', 'id', $final_window_mount)[0]->name . ' (' . $final_window_mount_size . __(' cm', 'photoframes-and-art-for-woocommerce' ) .')',true );
		 	}

		 	if(!empty($final_substrate)) {
		 		$item->add_meta_data( __( 'Substrate', 'photoframes-and-art-for-woocommerce' ), $this->helper->get_data_by_id('substrate', 'id', $final_substrate)[0]->name, true );
		 	}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_paper)) {
				$result = $this->helper->photoart_get_size_price('paper', $final_paper, $calulatedSize);
				$item->add_meta_data( __( 'Printing Cost', 'photoframes-and-art-for-woocommerce' ), !empty($result) ? $result[0]->price : 0.00, true );
			}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_frame_material)) {
				$result = $this->helper->photoart_get_size_price('frame-material', $final_frame_material, $calulatedSize);
				$item->add_meta_data( __( 'Framing Cost', 'photoframes-and-art-for-woocommerce' ), !empty($result) ? $result[0]->price : 0.00, true );
			}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_glass)) {
				$result = $this->helper->photoart_get_size_price('glass', $final_glass, $calulatedSize);
				$item->add_meta_data( __( 'Glass Cost', 'photoframes-and-art-for-woocommerce' ), !empty($result) ? $result[0]->price : 0.00, true );
			}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_window_mount)) {
				$result = $this->helper->photoart_get_size_price('window-mount', $final_window_mount, $calulatedSize);
				$item->add_meta_data( __( 'Window Mount Cost', 'photoframes-and-art-for-woocommerce' ), !empty($result) ? $result[0]->price : 0.00, true );
			}

			if(!empty($final_print_width) && !empty($final_print_height) && !empty($final_substrate)) {
				$result = $this->helper->photoart_get_size_price('substrate', $final_substrate, $calulatedSize);
				$item->add_meta_data( __( 'Mounting Cost', 'photoframes-and-art-for-woocommerce' ), !empty($result) ? $result[0]->price : 0.00, true );
			}

			if(!empty($final_image)) {
		 		$item->add_meta_data( __( 'Your Art', 'photoframes-and-art-for-woocommerce' ), '<a href="'. $final_image .'" download>'. __( 'Download', 'photoframes-and-art-for-woocommerce' ) .'</a>', true );
		 	}
		}
	}

	/**
	 * Set framed art thumbnail
	 *
	 * @since  1.0.0
	 */
	public function photoart_product_item_thumbnail( $_product_img, $cart_item, $cart_item_key ) {
		if ( !empty($cart_item['final_total']) ) {
	    	return '<img src="' . $cart_item['final_image'] . '" />';
		}
	}
}

