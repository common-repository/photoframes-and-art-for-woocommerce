<?php

/**
 * Tab Title
 *
 * This file is used to markup the title of the tabs.
 *
 * @link        https://www.narolainfotech.com/
 * @since       1.0.0
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/admin/partials/tabs
 */

?>

<h2><?php _e( 'Photoframes and art for WooCommerce', 'photoframes-and-art-for-woocommerce' ); ?></h2>
<div class="photoart-tab">
	<?php foreach ($args['photoartHelper']->photoart_get_all_modules() as $key => $value) { if($value['show_in_nav'] == 'yes') { if($value['is_default'] == 'yes') { ?>
		<a href="<?php echo esc_attr($args['photoartHelper']->get_tab_url($key)); ?>" class="photoart-tablinks <?php echo ($args['photoartHelper']->set_active_tab($key) === true || $args['photoartHelper']->set_active_tab($key) === 'default' ) ? 'active' : ''; ?>"><?php echo esc_attr($value['title']); ?></a>
	<?php } else if ($value['has_price'] == 'yes') { ?>
		<a href="<?php echo esc_attr($args['photoartHelper']->get_tab_url($key)); ?>" class="photoart-tablinks <?php echo ($args['photoartHelper']->set_active_tab($key) === true || $args['photoartHelper']->is_pricing_page($key) === true ) ? 'active' : ''; ?>"><?php echo esc_attr($value['title']); ?></a>
	<?php } else { ?>
		<a href="<?php echo esc_url($args['photoartHelper']->get_tab_url($key)); ?>" class="photoart-tablinks <?php echo ($args['photoartHelper']->set_active_tab($key) === true) ? 'active' : ''; ?>"><?php echo esc_attr($value['title']); ?></a>
	<?php } } } ?>
</div>