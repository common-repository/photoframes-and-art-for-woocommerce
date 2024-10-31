<?php

/**
 * Tab Glass
 *
 * This file is used to markup the glass tab content.
 *
 * @link        https://www.narolainfotech.com/
 * @since       1.0.0
 * @package     Photoframes_and_art_for_woocommerce
 * @subpackage  Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */

?>

<div id="glass" class="photoart-tabcontent">
	<h2><?php _e( 'Glass', 'photoframes-and-art-for-woocommerce' ); ?></h2>
	<p class="photoart-notice"></p>
	<form id="form-glass" method="post" class="photoart-options-form">
	  	<table class="wp-list-table widefat striped form-table">
	  		<tbody>
	  			<tr>
	  				<td>
	  					<input type="hidden" name="form_action" value="add" />
	  					<input type="hidden" name="glass_id" />
	  					<input type="text" id="glass_name" name="glass_name" value="" placeholder="<?php _e( 'Add glass', 'photoframes-and-art-for-woocommerce' ); ?>" required/>
	  					<input type="button" name="upload_design" value="Upload Design" class="button button-danger">
						<input type="hidden" name="selected_design" value="">
	  					<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Add New', 'photoframes-and-art-for-woocommerce' ); ?>">
	  				</td>
	  			</tr>
	  		</tbody>
	  	</table>
  	</form>
	<table class="wp-list-table widefat striped">
		<thead>
			<th><?php echo '#'; ?></th>
			<th><?php _e( 'Glass', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Design', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Actions', 'photoframes-and-art-for-woocommerce' ); ?></th>
		</thead>
		<tbody>
			<tbody>
				<?php $i = 1; $glasses = $args['photoartHelper']->get_glass_list(); if(!empty($glasses)) { foreach ($glasses as $key => $value) {
					$thubImageURL = wp_get_attachment_image_url( $value->design, 'thumbnail' );
					$fullImageURL = wp_get_attachment_image_url( $value->design, 'full' ); ?>
				<tr>
					<td><?php echo esc_attr($i); ?></td>
					<td><?php echo esc_attr($value->name); ?></td>
					<td><a href="<?php echo esc_url($fullImageURL); ?>" target="_blank"><img src="<?php echo esc_url($thubImageURL); ?>" class="design-image" /></a></td>
					<td>
						<a href="<?php echo $args['photoartHelper']->get_tab_url('size-pricing') . '&module=glass&module_item=' . $value->id; ?>" class="button button-primary photoart-manage-price"><?php _e( 'Manage Price', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-primary photoart-tbl-action" data-action="edit" data-model="glass" data-id="<?php echo esc_attr($value->id); ?>" data-value="<?php echo esc_attr($value->name); ?>" data-design="<?php echo esc_attr($value->design); ?>"><?php _e( 'Edit', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-danger photoart-tbl-action" data-action="delete" data-model="glass" data-id="<?php echo esc_attr($value->id); ?>"><?php _e( 'Delete', 'photoframes-and-art-for-woocommerce' ); ?></a>
					</td>
				</tr>
				<?php $i++; } } else { ?>
				<tr>
					<td colspan="4" align="center">
						<p><?php _e( 'No record found', 'photoframes-and-art-for-woocommerce' ); ?></p>	
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</tbody>
	</table>
</div>