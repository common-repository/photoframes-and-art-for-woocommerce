<?php

/**
 * Tab Paper
 *
 * This file is used to markup the paper type tab content.
 *
 * @link        https://www.narolainfotech.com/
 * @since       1.0.0
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */


?>

<div id="paper" class="photoart-tabcontent">
	<h2><?php _e( 'Paper', 'photoframes-and-art-for-woocommerce' ); ?></h2>
	<p class="photoart-notice"></p>
	<form id="form-paper" method="post" class="photoart-options-form">
	  	<table class="wp-list-table widefat striped form-table">
	  		<tbody>
	  			<tr>
	  				<td>
	  					<input type="hidden" name="form_action" value="add" />
	  					<input type="hidden" name="paper_id" />
	  					<input type="hidden" name="paper_id" />
	  					<input type="text" id="photoart_paper" name="photoart_paper" value="" placeholder="<?php _e( 'Add paper', 'photoframes-and-art-for-woocommerce' ); ?>" required/>
	  					<select name="paper_type" required>
	  						<option value="" selected disabled> <?php _e( 'Print type', 'photoframes-and-art-for-woocommerce' ); ?></option>
	  						<?php $paper_types = $args['photoartHelper']->get_print_type_list(); foreach ($paper_types as $key => $value) { ?>
	  						<option value="<?php echo esc_attr($value->id); ?>"><?php echo esc_attr($value->name); ?></option>
	  						<?php } ?>
	  					</select>
	  					<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Add New', 'photoframes-and-art-for-woocommerce' ); ?>">
	  				</td>
	  			</tr>
	  		</tbody>
	  	</table>
  	</form>
	<table class="wp-list-table widefat striped">
		<thead>
			<th><?php echo '#'; ?></th>
			<th><?php _e( 'Paper', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Paper Type', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Actions', 'photoframes-and-art-for-woocommerce' ); ?></th>
		</thead>
		<tbody>
			<tbody>
				<?php $i = 1; $papers = $args['photoartHelper']->photoart_get_paper_list(); if(!empty($papers)) { foreach ($papers as $key => $value) { ?>
				<tr>
					<td><?php echo esc_attr($i); ?></td>
					<td><?php echo esc_attr($value->paper_name); ?></td>
					<td><?php echo esc_attr($value->paper_type_name); ?></td>
					<td>
						<a href="<?php echo esc_attr($args['photoartHelper']->get_tab_url('size-pricing')) . '&module=paper&module_item=' . esc_attr($value->paper_id); ?>" class="button button-primary photoart-manage-price"><?php _e( 'Manage Price', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-primary photoart-tbl-action" data-action="edit" data-model="paper" data-id="<?php echo esc_attr($value->paper_id); ?>" data-paper-type-id="<?php echo esc_attr($value->paper_type_id); ?>" data-value="<?php echo esc_attr($value->paper_name); ?>"><?php _e( 'Edit', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-danger photoart-tbl-action" data-action="delete" data-model="paper" data-id="<?php echo esc_attr($value->paper_id); ?>"><?php _e( 'Delete', 'photoframes-and-art-for-woocommerce' ); ?></a>
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