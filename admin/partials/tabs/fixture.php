<?php

/**
 * Tab Fixture
 *
 * This file is used to markup the fixture tab content.
 *
 * @link       https://www.narolainfotech.com/
 * @since      1.0.0
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */

?>

<div id="fixture" class="photoart-tabcontent">
	<h2><?php _e( 'Fixture', 'photoframes-and-art-for-woocommerce' ); ?></h2>
	<p class="photoart-notice"></p>
	<form id="form-fixture" method="post" class="photoart-options-form">
	  	<table class="wp-list-table widefat striped form-table">
	  		<tbody>
	  			<tr>
	  				<td>
	  					<input type="hidden" name="form_action" value="add" />
	  					<input type="hidden" name="fixture_id" />
	  					<input type="text" id="fixture_name" name="fixture_name" value="" placeholder="<?php _e( 'Add fixture', 'photoframes-and-art-for-woocommerce' ); ?>" required/>
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
			<th><?php _e( 'Fixture', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Design', 'photoframes-and-art-for-woocommerce' ); ?></th>
			<th><?php _e( 'Actions', 'photoframes-and-art-for-woocommerce' ); ?></th>
		</thead>
		<tbody>
			<tbody>
				<?php $i = 1; $fixtures = $args['photoartHelper']->get_fixture_list(); if(!empty($fixtures)) { foreach ($fixtures as $key => $value) { $thubImageURL = wp_get_attachment_image_url( $value->design, 'thumbnail' ); $fullImageURL = wp_get_attachment_image_url( $value->design, 'full' ); ?>
				<tr>
					<td><?php echo esc_attr($i); ?></td>
					<td><?php echo esc_attr($value->name); ?></td>
					<td><a href="<?php echo esc_url($fullImageURL); ?>" target="_blank"><img src="<?php echo esc_url($thubImageURL); ?>" class="design-image" /></a></td>
					<td>
						<a href="javascript:void(0)" class="button button-primary photoart-tbl-action" data-action="edit" data-model="fixture" data-id="<?php echo esc_attr($value->id); ?>" data-value="<?php echo esc_attr($value->name); ?>" data-design="<?php echo esc_attr($value->design); ?>"><?php _e( 'Edit', 'photoframes-and-art-for-woocommerce' ); ?></a>
						<a href="javascript:void(0)" class="button button-danger photoart-tbl-action" data-action="delete" data-model="fixture" data-id="<?php echo esc_attr($value->id); ?>"><?php _e( 'Delete', 'photoframes-and-art-for-woocommerce' ); ?></a>
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