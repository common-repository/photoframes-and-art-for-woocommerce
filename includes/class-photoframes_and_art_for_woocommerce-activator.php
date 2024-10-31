<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.narolainfotech.com
 * @since      1.0.0
 *
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/includes
 * @author     Narola Infotech <inquiry@narolainfotech.com>
 */
class Photoframes_and_art_for_woocommerce_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {		
		global $wpdb;
		
		$charset_collate = $wpdb->get_charset_collate();
		$paper_type 	 = $wpdb->prefix. PHOTOART_TBL_PREFIX ."paper_type";
		$paper 			 = $wpdb->prefix. PHOTOART_TBL_PREFIX. "paper";
		$frame 			 = $wpdb->prefix. PHOTOART_TBL_PREFIX. "frame";
		$frame_material  = $wpdb->prefix. PHOTOART_TBL_PREFIX. "frame_material";
		$fixture 		 = $wpdb->prefix. PHOTOART_TBL_PREFIX. "fixture";
		$glass 			 = $wpdb->prefix. PHOTOART_TBL_PREFIX. "glass";
		$window_mount 	 = $wpdb->prefix. PHOTOART_TBL_PREFIX. "window_mount";
		$size_pricing 	 = $wpdb->prefix. PHOTOART_TBL_PREFIX. "size_pricing";
		$backgrounds 	 = $wpdb->prefix. PHOTOART_TBL_PREFIX. "backgrounds";
		$substrate 		 = $wpdb->prefix. PHOTOART_TBL_PREFIX. "substrate";

		$sql_paper_type = "CREATE TABLE IF NOT EXISTS {$paper_type} (
			id int(10) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$sql_paper = "CREATE TABLE IF NOT EXISTS {$paper} (
			id int(10) NOT NULL AUTO_INCREMENT,
			paper_type_id int(10) NOT NULL,
			name varchar(100) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$sql_frame = "CREATE TABLE IF NOT EXISTS {$frame} (
			id int(10) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			frame_material varchar(10) NOT NULL,
			fixture varchar(10) NOT NULL,
			glass varchar(10) NOT NULL,
			window_mount varchar(10) NOT NULL,
			mount_board_size varchar(10) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$sql_frame_material = "CREATE TABLE IF NOT EXISTS {$frame_material} (
			id int(10) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			thin varchar(10) NOT NULL,
			standard varchar(10) NOT NULL,
			large varchar(10) NOT NULL,
			square varchar(10) NOT NULL,
			design varchar(100) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$sql_fixture = "CREATE TABLE IF NOT EXISTS {$fixture} (
			id int(10) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			design varchar(100) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$sql_glass = "CREATE TABLE IF NOT EXISTS {$glass} (
			id int(10) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			design varchar(100) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$sql_window_mount = "CREATE TABLE IF NOT EXISTS {$window_mount} (
			id int(10) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			color_code varchar(100) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$sql_size_pricing = "CREATE TABLE IF NOT EXISTS {$size_pricing} (
			id int(10) NOT NULL AUTO_INCREMENT,
			height varchar(100) NOT NULL,
			width varchar(100) NOT NULL,
			price decimal(10, 2) NOT NULL,
			module varchar(50) NOT NULL,
			module_item int(10) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$sql_backgrounds = "CREATE TABLE IF NOT EXISTS {$backgrounds} (
			id int(10) NOT NULL AUTO_INCREMENT,
			background varchar(100) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

		$sql_substrate = "CREATE TABLE IF NOT EXISTS {$substrate} (
			id int(10) NOT NULL AUTO_INCREMENT,
			name varchar(100) NOT NULL,
			PRIMARY KEY (id)
		) $charset_collate;";

	if(get_option('_photoart_query_inserted') == FALSE) {
		$first_sample_paper_type = $wpdb->insert( $paper_type, array( 'id' => NULL, 'name' => 'C-Type' ));
		$first_sample_paper_type_ID = $wpdb->insert_id;		
		$second_sample_paper_type = $wpdb->insert( $paper_type, array( 'id' => NULL, 'name' => 'Giclee' ));
		$second_sample_paper_type_ID = $wpdb->insert_id;
		$first_sample_paper = $wpdb->insert( $paper, array( 'id' => NULL, 'paper_type_id' => $first_sample_paper_type_ID ,'name' => 'Gloss' ));
		$second_sample_paper = $wpdb->insert( $paper, array( 'id' => NULL, 'paper_type_id' => $second_sample_paper_type_ID ,'name' => 'Maxima Matt' ));
		add_option( '_photoart_query_inserted', 'yes');
	}
		require_once(ABSPATH.'wp-admin/includes/upgrade.php');
		dbDelta($sql_paper_type);
		dbDelta($sql_paper);
		dbDelta($sql_frame);
		dbDelta($sql_frame_material);
		dbDelta($sql_fixture);
		dbDelta($sql_glass);
		dbDelta($sql_window_mount);
		dbDelta($sql_size_pricing);
		dbDelta($sql_backgrounds);
		dbDelta($sql_substrate);

		if(get_option('_photoart_default_product') == FALSE) {			
			$productId = wp_insert_post(array(
			  	'post_title'  => 'Photoframes and art Default Product',
			  	'post_status' => 'publish',
			  	'post_type'   => 'product',
			  	'post_author' => 1
			));
			update_post_meta( $productId, '_price', 1 );
			$terms = array( 'exclude-from-search', 'exclude-from-catalog' ); 
			wp_set_post_terms( $productId, $terms, 'product_visibility', false );
			add_option( '_photoart_default_product', $productId);
		}
		
	}

}
