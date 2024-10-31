<?php

/**
 * Tab Moulding
 *
 * This file is used to markup the mounting tab content.
 *
 * @link        https://www.narolainfotech.com/
 * @since       1.0.0
 * @package     Photoframes_and_art_for_woocommerce
 * @subpackage  Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */

?>

<div id="frame-material" class="photoart-tabcontent">
	<h2><?php _e( 'Frame Material', 'photoframes-and-art-for-woocommerce' ); ?></h2>
	<p><?php _e( 'Note: The design size should be 500x500', 'photoframes-and-art-for-woocommerce' ); ?></p>
	<p class="photoart-notice"></p>
	<form id="form-frame-material" method="post" class="photoart-options-form">
	  	<table class="wp-list-table widefat striped form-table">
	  		<tbody>
	  			<tr>
	  				<td>
	  					<input type="hidden" name="form_action" value="add" />
	  					<input type="hidden" name="material_id" />
	  					<input type="text" id="material_name" name="material_name" value="" placeholder="<?php _e( 'Add frame material', 'photoframes-and-art-for-woocommerce' ); ?>" required/>
	  					<input type="button" name="upload_design" value="Upload Design" class="button button-danger">
						<input type="hidden" name="selected_design" value="">
	  					<label><?php _e( 'Thin', 'photoframes-and-art-for-woocommerce' ); ?></label>
	  					<label class="switch">
						  	<input type="checkbox" name="photoart_frame_material_thin" />
						  	<span class="slider round"></span>
						</label>
						<label><?php _e( 'Standard', 'photoframes-and-art-for-woocommerce' ); ?></label>
						<label class="switch">
						  	<input type="checkbox" name="photoart_frame_material_standard" />
						  	<span class="slider round"></span>
						</label>
						<label><?php _e( 'Large', 'photoframes-and-art-for-woocommerce' ); ?></label>
						<label class="switch">
						  	<input type="checkbox" name="photoart_frame_material_large" />
						  	<span class="slider round"></span>
						</label>
						<label><?php _e( 'Square', 'photoframes-and-art-for-woocommerce' ); ?></label>
						<label class="switch">
						  	<input type="checkbox" name="photoart_frame_material_square" />
						  	<span class="slider round"></span>
						</label>
	  					<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Add New', 'photoframes-and-art-for-woocommerce' ); ?>">
	  				</td>
	  			</tr>
	  		</tbody>
	  	</table>
  	</form>
  	<table class="wp-list-table widefat striped">
		<thead>
			<th><?php echo '#'; ?></th>
			<th><?php _e( 'Name', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Design', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Thin', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Standard', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Large', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Square', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Actions', 'photoframes-and-art-for-woocommerce' ); ?></th>
		</thead>
		<tbody>
			<tbody>
				<?php $i = 1; $frame_materials = $args['photoartHelper']->get_frame_material_list(); if(!empty($frame_materials)) { foreach ($frame_materials as $key => $value) { $thubImageURL = wp_get_attachment_image_url( $value->design, 'thumbnail' ); $fullImageURL = wp_get_attachment_image_url( $value->design, 'full' ); ?>
				<tr>
					<td><?php echo esc_attr($i); ?></td>
					<td><?php echo esc_attr($value->name); ?></td>
					<td><a href="<?php echo esc_url($fullImageURL); ?>" target="_blank"><img src="<?php echo esc_url($thubImageURL); ?>" class="design-image" width="100px" /></a></td>
					<td class="<?php echo ($value->thin == 'yes') ? 'enabled' : 'disabled'; ?>"><?php echo esc_attr($value->thin); ?></td>
					<td class="<?php echo ($value->standard == 'yes') ? 'enabled' : 'disabled'; ?>"><?php echo esc_attr($value->standard); ?></td>
					<td class="<?php echo ($value->large == 'yes') ? 'enabled' : 'disabled'; ?>"><?php echo esc_attr($value->large); ?></td>
					<td class="<?php echo ($value->square == 'yes') ? 'enabled' : 'disabled'; ?>"><?php echo esc_attr($value->square); ?></td>
					<td>
						<a href="<?php echo $args['photoartHelper']->get_tab_url('size-pricing') . '&module=frame-material&module_item=' . esc_attr($value->id); ?>" class="button button-primary photoart-manage-price"><?php _e( 'Manage Price', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-primary photoart-tbl-action" data-action="edit" data-model="frame_material" data-id="<?php echo esc_attr($value->id); ?>" data-name="<?php echo esc_attr($value->name); ?>" data-thin="<?php echo esc_attr($value->thin); ?>" data-standard="<?php echo esc_attr($value->standard); ?>" data-large="<?php echo esc_attr($value->large); ?>" data-square="<?php echo esc_attr($value->square); ?>" data-design="<?php echo esc_attr($value->design); ?>"><?php _e( 'Edit', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-danger photoart-tbl-action" data-action="delete" data-model="frame_material" data-id="<?php echo esc_attr($value->id); ?>"><?php _e( 'Delete', 'photoframes-and-art-for-woocommerce' ); ?></a>
					</td>
				</tr>
				<?php $i++; } } else { ?>
				<tr>
					<td colspan="8" align="center">
						<p><?php _e( 'No record found', 'photoframes-and-art-for-woocommerce' ); ?></p>	
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</tbody>
	</table>
</div>