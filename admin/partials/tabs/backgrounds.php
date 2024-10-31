<?php

/**
 * Tab Backgrounds
 *
 * This file is used to markup the fixture tab content.
 *
 * @link        https://www.narolainfotech.com/
 * @since       1.0.0
 * @package     Photoframes_and_art_for_woocommerce
 * @subpackage  Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */

?>

<div id="backgrounds" class="photoart-tabcontent">
	<h2><?php _e( 'Backgrounds', 'photoframes-and-art-for-woocommerce' ); ?></h2>
	<p class="photoart-notice"></p>
	<form id="form-backgrounds" method="post" class="photoart-options-form">
	  	<table class="wp-list-table widefat striped form-table">
	  		<tbody>
	  			<tr>
	  				<td>
	  					<input type="hidden" name="form_action" value="add" />
	  					<input type="hidden" name="background_id" />
	  					<input type="button" name="upload_background" value="Upload Background" class="button button-danger">
						<input type="hidden" name="selected_background" value="">
	  					<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Add New', 'photoframes-and-art-for-woocommerce' ); ?>">
	  				</td>
	  			</tr>
	  		</tbody>
	  	</table>
  	</form>
	<table class="wp-list-table widefat striped">
		<thead>
			<th><?php _e( '#', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Background', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Actions', 'photoframes-and-art-for-woocommerce' ); ?></th>
		</thead>
		<tbody>			
				<?php $i = 1; $backgrounds = $args['photoartHelper']->get_backgrounds_list(); if(!empty($backgrounds)) { foreach ($backgrounds as $key => $value) { $thubImageURL = wp_get_attachment_image_url( $value->background, 'thumbnail' ); $fullImageURL = wp_get_attachment_image_url( $value->background, 'full' ); ?>
				<tr>
					<td><?php echo esc_attr($i); ?></td>
					<td><a href="<?php echo esc_url($fullImageURL); ?>" target="_blank"><img src="<?php echo esc_url($thubImageURL); ?>" class="design-image" /></a></td>
					<td>
						<a href="javascript:void(0)" class="button button-danger photoart-tbl-action" data-action="delete" data-model="backgrounds" data-id="<?php echo esc_attr($value->id); ?>"><?php _e( 'Delete', 'photoframes-and-art-for-woocommerce' ); ?></a>
					</td>
				</tr>
				<?php $i++; } } else { ?>
				<tr>
					<td colspan="3" align="center">
						<p><?php _e( 'No record found', 'photoframes-and-art-for-woocommerce' ); ?></p>	
					</td>
				</tr>
				<?php } ?>			
		</tbody>
	</table>
</div>