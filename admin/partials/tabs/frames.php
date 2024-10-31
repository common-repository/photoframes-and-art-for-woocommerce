<?php

/**
 * Tab Frames
 *
 * This file is used to markup the frames type tab content.
 *
 * @link        https://www.narolainfotech.com/
 * @since       1.0.0
 * @package     Photoframes_and_art_for_woocommerce
 * @subpackage  Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */

?>
<div id="framing" class="photoart-tabcontent">
	<h2><?php _e( 'Frames', 'photoframes-and-art-for-woocommerce' ); ?></h2>
	<p class="photoart-notice"></p>
	<form id="form-framing" method="post" class="photoart-options-form">
	  	<table class="wp-list-table widefat striped form-table">
	  		<tbody>
	  			<tr>
	  				<td>
	  					<input type="hidden" name="form_action" value="add" />
	  					<input type="hidden" name="frame_id" />
	  					<input type="text" id="frame_name" name="frame_name" value="" placeholder="<?php _e( 'Add frame', 'photoframes-and-art-for-woocommerce' ); ?>" required/>
	  					<label><?php _e( 'Frame Material', 'photoframes-and-art-for-woocommerce' ); ?></label>
	  					<label class="switch">
						  	<input type="checkbox" name="photoart_frame_material" />
						  	<span class="slider round"></span>
						</label>
						<label><?php _e( 'Fixture', 'photoframes-and-art-for-woocommerce' ); ?></label>
						<label class="switch">
						  	<input type="checkbox" name="photoart_fixture" />
						  	<span class="slider round"></span>
						</label>
						<label><?php _e( 'Glass', 'photoframes-and-art-for-woocommerce' ); ?></label>
						<label class="switch">
						  	<input type="checkbox" name="photoart_glass" />
						  	<span class="slider round"></span>
						</label>
						<label><?php _e( 'Window Mount', 'photoframes-and-art-for-woocommerce' ); ?></label>
						<label class="switch">
						  	<input type="checkbox" name="photoart_window_mount" />
						  	<span class="slider round"></span>
						</label>
						<label><?php _e( 'Mount Board Size (cm)', 'photoframes-and-art-for-woocommerce' ); ?></label>
						<label class="switch">
						  	<input type="checkbox" name="photoart_mount_board_size" />
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
			<th><?php _e( 'Frame Material', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Fixture', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Glass', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Window Mount', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Mount Board Size', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Actions', 'photoframes-and-art-for-woocommerce' ); ?></th>
		</thead>
		<tbody>
			<tbody>
				<?php $i = 1; $frames = $args['photoartHelper']->get_frame_list(); if(!empty($frames)) { foreach ($frames as $key => $value) { ?>
				<tr>
					<td><?php echo esc_attr($i); ?></td>
					<td><?php echo esc_attr($value->name); ?></td>
					<td class="<?php echo ($value->frame_material == 'yes') ? 'enabled' : 'disabled'; ?>"><?php echo esc_attr($value->frame_material); ?></td>
					<td class="<?php echo ($value->fixture == 'yes') ? 'enabled' : 'disabled'; ?>"><?php echo esc_attr($value->fixture); ?></td>
					<td class="<?php echo ($value->glass == 'yes') ? 'enabled' : 'disabled'; ?>"><?php echo esc_attr($value->glass); ?></td>
					<td class="<?php echo ($value->window_mount == 'yes') ? 'enabled' : 'disabled'; ?>"><?php echo esc_attr($value->window_mount); ?></td>
					<td class="<?php echo ($value->mount_board_size == 'yes') ? 'enabled' : 'disabled'; ?>"><?php echo esc_attr($value->mount_board_size); ?></td>
					<td>
						<a href="javascript:void(0)" class="button button-primary photoart-tbl-action" data-action="edit" data-model="frame" data-id="<?php echo esc_attr($value->id); ?>" data-frame_name="<?php echo esc_attr($value->name); ?>" data-frame_material="<?php echo esc_attr($value->frame_material); ?>" data-fixture="<?php echo esc_attr($value->fixture); ?>" data-glass="<?php echo esc_attr($value->glass); ?>" data-window_mount="<?php echo esc_attr($value->window_mount); ?>" data-mount_board_size="<?php echo esc_attr($value->mount_board_size); ?>"><?php _e( 'Edit', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-danger photoart-tbl-action" data-action="delete" data-model="frame" data-id="<?php echo esc_attr($value->id); ?>"><?php _e( 'Delete', 'photoframes-and-art-for-woocommerce' ); ?></a>
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