<?php

/**
 * Tab General Settings
 *
 * This file is used to markup the general setting tab content.
 *
 * @link        https://www.narolainfotech.com/
 * @since       1.0.0
 * @package     Photoframes_and_art_for_woocommerce
 * @subpackage  Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */

?>

<div id="general-settings" class="photoart-tabcontent">
	<h2><?php _e( 'General Settings', 'photoframes-and-art-for-woocommerce' ); ?></h2>
	<p><?php _e( 'Note: Woocommerce Default currency will be used for pricing', 'photoframes-and-art-for-woocommerce' ); ?></p>
	<p class="photoart-notice"></p>
	<form id="form-general-settings" method="post" class="photoart-options-form">
	  	<table class="wp-list-table widefat striped form-table">
	  		<tbody>
	  			<tr>
	  				<td><?php _e( 'Select Frontend Editor Page', 'photoframes-and-art-for-woocommerce' ); ?></td>
	  				<td>
	  					<select name="photoart_frontend_editor_page">
	  						<option value=""><?php _e( 'Select Page', 'photoframes-and-art-for-woocommerce' ); ?></option>
	  						<?php $pages = get_pages(); foreach ($pages as $key => $value) { ?>
	  						<option value="<?php echo esc_attr($value->post_name); ?>" <?php echo (get_option('photoart_frontend_editor_page') == $value->post_name) ? 'selected' : ''; ?>><?php echo esc_attr($value->post_title); ?></option>
	  						<?php } ?>
	  					</select>
	  					<p><?php _e( 'Choose the page on which you wish to display the editor for framed art.', 'photoframes-and-art-for-woocommerce' ); ?></p>
	  				</td>
	  			</tr> 
	  			<tr>
	  				<td><?php _e( 'Maximum Print Size', 'photoframes-and-art-for-woocommerce' ); ?></td>
	  				<td><?php _e( 'Height', 'photoframes-and-art-for-woocommerce' ); ?> <input type="text" name="photoart_max_height" value="<?php echo esc_attr( get_option('photoart_max_height') ); ?>" placeholder="<?php _e( 'Enter height', 'photoframes-and-art-for-woocommerce' ); ?>"> <?php _e( 'Width', 'photoframes-and-art-for-woocommerce' ); ?> <input type="text" name="photoart_max_width" value="<?php echo esc_attr (get_option('photoart_max_width')); ?>" placeholder="<?php _e( 'Enter width', 'photoframes-and-art-for-woocommerce' ); ?>"></td>
	  			</tr>
	  			<tr>
	  				<td><?php _e( 'Print Only', 'photoframes-and-art-for-woocommerce' ); ?></td>
	  				<td>
	  					<label class="switch">
						  	<input type="checkbox" name="photoart_is_active_print_only" <?php echo (esc_attr(get_option('photoart_is_active_print_only')) == 'yes') ? 'checked' : ''; ?> />
						  	<span class="slider round"></span>
						</label>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td><?php _e( 'Framing', 'photoframes-and-art-for-woocommerce' ); ?></td>
	  				<td>
	  					<label class="switch">
						  	<input type="checkbox" name="photoart_is_active_framing" <?php echo (esc_attr(get_option('photoart_is_active_framing')) == 'yes') ? 'checked' : ''; ?> />
						  	<span class="slider round"></span>
						</label>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td><?php _e( 'Mounting', 'photoframes-and-art-for-woocommerce' ); ?></td>
	  				<td>
	  					<label class="switch">
						  	<input type="checkbox" name="photoart_is_active_mounting" <?php echo (esc_attr(get_option('photoart_is_active_mounting')) == 'yes') ? 'checked' : ''; ?> />
						  	<span class="slider round"></span>
						</label>
	  				</td>
	  			</tr>
	  			<tr>
	  				<td colspan="2"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save Settings', 'photoframes-and-art-for-woocommerce' ); ?>"></td>
	  			</tr>
	  		</tbody>
	  	</table>
  	</form>
</div>