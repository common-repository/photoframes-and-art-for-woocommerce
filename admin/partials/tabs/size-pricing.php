<?php

/**
 * Tab Size Pricing
 *
 * This file is used to markup the size pricing tab content.
 *
 * @link        https://www.narolainfotech.com/
 * @since       1.0.0
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */

?>
<div id="size-pricing" class="photoart-tabcontent">
	<h2><?php _e( 'Size Pricing', 'photoframes-and-art-for-woocommerce' ); ?></h2>
	<p class="photoart-notice"></p>
	<form id="form-size-pricing" method="post" class="photoart-options-form">
	  	<table class="wp-list-table widefat striped form-table">
	  		<tbody>
	  			<tr>
	  				<td>
	  					<input type="hidden" name="form_action" value="add" />
	  					<input type="hidden" name="size_pricing_id" />
	  					<input type="hidden" name="size_module" value="<?php echo esc_attr($_GET['module']); ?>" />
	  					<input type="hidden" min="1" name="size_module_item" value="<?php echo esc_attr($_GET['module_item']); ?>" />
	  					<input type="number" min="1" id="width" name="width" value="" placeholder="<?php _e( 'Enter width', 'photoframes-and-art-for-woocommerce' ); ?>" required/>
	  					<input type="number" min="1" id="height" name="height" value="" placeholder="<?php _e( 'Enter height', 'photoframes-and-art-for-woocommerce' ); ?>" required/>
	  					<input type="number"  id="price" name="price" value="" placeholder="<?php _e( 'Enter price', 'photoframes-and-art-for-woocommerce' ); ?>" required/>
	  					<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Add New', 'photoframes-and-art-for-woocommerce' ); ?>">
	  				</td>
	  			</tr>
	  		</tbody>
	  	</table>
  	</form>
	<table class="wp-list-table widefat striped">
		<thead>
			<th><?php _e( '#', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Size', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Calulated Size', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Price', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Actions', 'photoframes-and-art-for-woocommerce' ); ?></th>
		</thead>
		<tbody>
			<tbody>
				<?php 
				$module_santi = sanitize_text_field($_GET['module']);
				$module_item_santi = sanitize_text_field($_GET['module_item']);
				$i = 1; 
				$size_pricing = $args['photoartHelper']->get_size_pricing_list($module_santi, $module_item_santi);
				if(!empty($size_pricing)) { foreach ($size_pricing as $key => $value) { 
					?>
				<tr>
					<td><?php echo esc_attr($i); ?></td>
					<td><?php echo esc_attr($value->width) . 'x'. esc_attr($value->height) . ' <b>OR</b> '. esc_attr($value->height) . 'x'. esc_attr($value->width); ?></td>
					<td><?php echo esc_attr($value->width) * esc_attr($value->height); ?></td>
					<td><?php echo esc_attr($value->price); ?></td>
					<td>
						<a href="javascript:void(0)" class="button button-primary photoart-tbl-action" data-action="edit" data-model="size_pricing" data-id="<?php echo esc_attr($value->id); ?>" data-height="<?php echo esc_attr($value->height); ?>" data-width="<?php echo esc_attr($value->width); ?>" data-price="<?php echo esc_attr($value->price); ?>"><?php _e( 'Edit', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-danger photoart-tbl-action" data-action="delete" data-model="size_pricing" data-id="<?php echo esc_attr($value->id); ?>"><?php _e( 'Delete', 'photoframes-and-art-for-woocommerce' ); ?></a>
					</td>
				</tr>
				<?php $i++; } } else { ?>
				<tr>
					<td colspan="5" align="center">
						<p><?php _e( 'No record found', 'photoframes-and-art-for-woocommerce' ); ?></p>	
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</tbody>
	</table>
</div>