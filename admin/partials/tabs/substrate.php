<?php

/**
 * Tab Substrate
 *
 * This file is used to markup the substrate tab content.
 *
 * @link        https://www.narolainfotech.com/
 * @since       1.0.0
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */

?>

<div id="substrate" class="photoart-tabcontent">
	<h2><?php _e( 'Substrate', 'photoframes-and-art-for-woocommerce' ); ?></h2>
	<p class="photoart-notice"></p>
	<form id="form-substrate" method="post" class="photoart-options-form">
	  	<table class="wp-list-table widefat striped form-table">
	  		<tbody>
	  			<tr>
	  				<td>
	  					<input type="hidden" name="form_action" value="add" />
	  					<input type="hidden" name="substrate_id" />
	  					<input type="text" id="substrate_name" name="substrate_name" value="" placeholder="<?php _e( 'Add substrate', 'photoframes-and-art-for-woocommerce' ); ?>" required/>
	  					<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Add New', 'photoframes-and-art-for-woocommerce' ); ?>">
	  				</td>
	  			</tr>
	  		</tbody>
	  	</table>
  	</form>
	<table class="wp-list-table widefat striped">
		<thead>
			<th><?php echo '#'; ?></th>
			<th><?php _e( 'Substrate', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Actions', 'photoframes-and-art-for-woocommerce' ); ?></th>
		</thead>
		<tbody>
			<tbody>
				<?php $i = 1; $substrate = $args['photoartHelper']->get_substrate_list(); if(!empty($substrate)) { foreach ($substrate as $key => $value) { ?>
				<tr>
					<td><?php echo esc_attr($i); ?></td>
					<td><?php echo esc_attr($value->name); ?></td>
					<td>
						<a href="<?php echo $args['photoartHelper']->get_tab_url('size-pricing') . '&module=substrate&module_item=' . $value->id; ?>" class="button button-primary photoart-manage-price"><?php _e( 'Manage Price', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-primary photoart-tbl-action" data-action="edit" data-model="substrate" data-id="<?php echo esc_attr($value->id); ?>" data-value="<?php echo esc_attr($value->name); ?>"><?php _e( 'Edit', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-danger photoart-tbl-action" data-action="delete" data-model="substrate" data-id="<?php echo esc_attr($value->id); ?>"><?php _e( 'Delete', 'photoframes-and-art-for-woocommerce' ); ?></a>
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
		</tbody>
	</table>
</div>