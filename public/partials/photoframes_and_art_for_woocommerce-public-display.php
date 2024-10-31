<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.narolainfotech.com
 * @since      1.0.0
 *
 * @package    Photoframes_and_art_for_woocommerce
 * @subpackage Photoframes_and_art_for_woocommerce/public/partials
 */

get_header();
$photoartHelper = new Photoandart_For_Woocommerce_Helper();
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
?>
<div class="framed-art-editor-container">
	<div class="framed-art-options-mobile">
		<a href="javascript:void(0)" class="f-art-opt-toggle"><?php _e( 'View Options', 'photoframes-and-art-for-woocommerce' ); ?></a>
	</div>
	<div class="framed-art-editor-column framed-art-options">
		<a href="javascript:void(0)" class="f-art-opt-close"><i class="fa fa-times"></i></a>
		<div class="photoart-acc-main">
			<button class="photoart-accordion print-size-accordion active"><?php _e( 'Print Size', 'photoframes-and-art-for-woocommerce' ); ?></button>
			<div class="photoart-panel" style="display: block;">
				<table class="photoart-form-control-table">
					<tr>
						<td colspan="2">
							<div class="photoart-form-control">
								<p><label><?php _e( 'Units', 'photoframes-and-art-for-woocommerce' ); ?></label></p>
								<ul class="units d-inline-flex">
									<li><input type="radio" id="unit_inches" name="units" value="in" checked> <label for="unit_inches"><?php _e( 'Inches', 'photoframes-and-art-for-woocommerce' ); ?></label></li>
									<li><input type="radio" id="unit_mm" name="units" value="mm"> <label for="unit_mm"><?php _e( 'MM', 'photoframes-and-art-for-woocommerce' ); ?></label></li>
									<li><input type="radio" id="unit_cm" name="units" value="cm"> <label for="unit_cm"><?php _e( 'CM', 'photoframes-and-art-for-woocommerce' ); ?></label></li>
									<input type="hidden" name="previous_unit" value="in">
								</ul>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="photoart-form-control">
						  		<label><?php _e( 'Width', 'photoframes-and-art-for-woocommerce' ); ?></label>
								<input type="number" id="width" name="width" placeholder="<?php _e( 'Width (in)', 'photoframes-and-art-for-woocommerce' ); ?>" class="photoart-change-width"/>
							</div>
						</td>
						<td>
							<div class="photoart-form-control">
								<label><?php _e( 'Height', 'photoframes-and-art-for-woocommerce' ); ?></label>
								<input type="number" id="height" name="height" placeholder="<?php _e( 'Height (in)', 'photoframes-and-art-for-woocommerce' ); ?>" class="photoart-change-height"/>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="photoart-form-control">
								<p class="maximum-dpi"><?php _e( 'Maximum Print Size is', 'photoframes-and-art-for-woocommerce' ); ?> <span><?php echo get_option('photoart_max_width'); ?>" x <?php echo get_option('photoart_max_height'); ?>"</span></p>
								<p class="dpi-score"><?php _e( 'The DPI at the current size:', 'photoframes-and-art-for-woocommerce' ); ?> <span><i class="fa fa-circle-o-notch fa-spin"></i></span></p>
								<p class="dpi-notice" style="display: none;"></p>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
						 <p><label><?php _e( 'Border Sizes (CM)', 'photoframes-and-art-for-woocommerce' ); ?></label></p>
						</td>
					</tr>
					<tr>
						<td class="border-size-td" colspan="2">
							<div class="photoart-form-control">
								<label><?php _e( 'Top', 'photoframes-and-art-for-woocommerce' ); ?></label>
								<input type="number" id="border_size_top" name="border_size_top" class="size-input changeSize" value="0" />
							</div>
						</td>
					</tr>
					<tr>
						<td class="border-size-td">
							<div class="photoart-form-control">
								<label><?php _e( 'Left', 'photoframes-and-art-for-woocommerce' ); ?></label>
								<input type="number" id="border_size_left" name="border_size_left" class="size-input changeSize" value="0" />
							</div>
						</td>
						<td class="border-size-td">
							<div class="photoart-form-control">
								<label><?php _e( 'Right', 'photoframes-and-art-for-woocommerce' ); ?></label>
								<input type="number" id="border_size_right" name="border_size_right" class="size-input changeSize" value="0" />
							</div>
						</td>
					</tr>
					<tr>
						<td class="border-size-td" colspan="2">
							<div class="photoart-form-control">
								<label><?php _e( 'Bottom', 'photoframes-and-art-for-woocommerce' ); ?></label>
								<input type="number" id="border_size_bottom" name="border_size_bottom" class="size-input changeSize" value="0" />
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="photoart-acc-main">
			<button class="photoart-accordion"><?php _e( 'Print Type', 'photoframes-and-art-for-woocommerce' ); ?></button>
			<div class="photoart-panel">
				<div class="photoart-form-control">
					<table class="photoart-form-control-table">
						<tr>
							<td>
								<div class="photoart-form-control">
									<p class="help"><?php _e( 'Need help selecting a paper?', 'photoframes-and-art-for-woocommerce' ); ?></p>
								</div>
								<div class="photoart-form-control">
									<label><?php _e( 'Print Type', 'photoframes-and-art-for-woocommerce' ); ?></label>
									<select id="print_type" name="print_type" class="select-input changeSize">
										<option value="" disabled><?php _e( 'Select print type', 'photoframes-and-art-for-woocommerce' ); ?></option>
										<?php $i = 0; $print_type = $photoartHelper->get_print_type_list(); foreach ($print_type as $key => $value) { ?>
										<option value="<?php echo esc_attr($value->id); ?>" <?php echo ($i == 0) ? 'selected' : ''; ?>><?php echo esc_attr($value->name); ?></option>
										<?php $i++; } ?>
									</select>
								</div>
								<div class="photoart-form-control">
									<label><?php _e( 'Paper', 'photoframes-and-art-for-woocommerce' ); ?></label>
									<select id="paper" name="paper" class="select-input changeSize"></select>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="photoart-acc-main">
			<button class="photoart-accordion"><?php _e( 'Frame Material/Framing', 'photoframes-and-art-for-woocommerce' ); ?></button>
			<div class="photoart-panel">
				<div class="photoart-form-control">
			  		<table class="photoart-form-control-table">
						<tr>
							<td>
								<div class="photoart-form-control">
									<p><label><?php _e( 'Type', 'photoframes-and-art-for-woocommerce' ); ?></label></p>
									<?php if(get_option('photoart_is_active_print_only') == 'yes') { ?>
									<p>
										<input type="radio" id="material_type_print_only" name="frame_material_type" value="print_only" checked> <label for="material_type_print_only"><?php _e( 'Print Only', 'photoframes-and-art-for-woocommerce' ); ?></label>
									</p>
									<?php } if(get_option('photoart_is_active_framing') == 'yes') { ?>
									<p>
										<input type="radio" id="material_type_framing" name="frame_material_type" value="framing"> <label for="material_type_framing"><?php _e( 'Framing', 'photoframes-and-art-for-woocommerce' ); ?></label>
									</p>
									<?php } if(get_option('photoart_is_active_mounting') == 'yes') { ?>
									<p>
										<input type="radio" id="material_type_mounting" name="frame_material_type" value="mounting"> <label for="material_type_mounting"><?php _e( 'Mounting', 'photoframes-and-art-for-woocommerce' ); ?></label>
									</p>
									<?php } ?>
								</div>

								<?php if(get_option('photoart_is_active_framing') == 'yes') { ?>
									<div class="photoart-form-control option-framing">
										<label><?php _e( 'Frame', 'photoframes-and-art-for-woocommerce' ); ?></label>
										<select id="frame" name="frame" class="select-input changeSize">
											<option value="" disabled><?php _e( 'Select frame', 'photoframes-and-art-for-woocommerce' ); ?></option>
											<?php $i = 0; $frames = $photoartHelper->get_frame_list(); foreach ($frames as $key => $value) { ?>
											<option value="<?php echo esc_attr($value->id); ?>" <?php echo ($i == 0) ? 'selected' : ''; ?> data-frame_material="<?php echo $value->frame_material; ?>" data-fixture="<?php echo esc_attr($value->fixture); ?>" data-glass="<?php echo esc_attr($value->glass); ?>" data-window_mount="<?php echo esc_attr($value->window_mount); ?>" data-mount_board_size="<?php echo $value->mount_board_size; ?>"><?php echo esc_attr($value->name); ?></option>
											<?php $i++; } ?>
										</select>
									</div>
									<div class="photoart-form-control option-framing single-frame-material">
										<label><?php _e( 'Frame Material', 'photoframes-and-art-for-woocommerce' ); ?></label>
										<select id="frame_material" name="frame_material" class="select-input changeSize">
											<?php $frame_material = $photoartHelper->get_frame_material_list();
											if(!empty($frame_material)) { $i = 1; foreach ($frame_material as $key => $value) { $fullImageURL = wp_get_attachment_image_url( $value->design, 'full' ); ?>
											<optgroup label="<?php echo esc_attr($value->name); ?>">
												<?php if($value->thin == 'yes') { ?>
												<option value="<?php echo esc_attr($value->id); ?>" data-image="<?php echo esc_url($fullImageURL); ?>" data-border-type="thin"><?php _e( 'Thin', 'photoframes-and-art-for-woocommerce' ); ?></option>
												<?php } if($value->standard == 'yes') { ?>
												<option value="<?php echo esc_attr($value->id); ?>" data-image="<?php echo esc_url($fullImageURL); ?>" data-border-type="standard"><?php _e( 'Standard', 'photoframes-and-art-for-woocommerce' ); ?></option>
												<?php } if($value->large == 'yes') { ?>
												<option value="<?php echo esc_attr($value->id); ?>" data-image="<?php echo esc_url($fullImageURL); ?>" data-border-type="large"><?php _e( 'Large', 'photoframes-and-art-for-woocommerce' ); ?></option>
												<?php } if($value->square == 'yes') { ?>
												<option value="<?php echo esc_attr($value->id); ?>" data-image="<?php echo esc_url($fullImageURL); ?>" data-border-type="square"><?php _e( 'Square', 'photoframes-and-art-for-woocommerce' ); ?></option>
												<?php } ?>
											</optgroup>
											<?php $i++; } } ?>
										</select>
									</div>
									<div class="photoart-form-control option-framing single-fixture">
										<label><?php _e( 'Fixture', 'photoframes-and-art-for-woocommerce' ); ?></label>
										<select id="fixture" name="fixture" class="select-input changeSize">
											<?php $fixture = $photoartHelper->get_fixture_list();
											if(!empty($fixture)) { $i = 1; foreach ($fixture as $key => $value) { ?>
											<option value="<?php echo esc_attr($value->id); ?>" <?php echo ($i == 1) ? 'selected' : ''; ?>><?php echo esc_attr($value->name); ?></option>
											<?php $i++; } } ?>
										</select>
									</div>
									<div class="photoart-form-control option-framing single-glass">
										<label><?php _e( 'Glass', 'photoframes-and-art-for-woocommerce' ); ?></label>
										<select id="glass" name="glass" class="select-input changeSize">
											<option value="" selected><?php _e( 'None', 'photoframes-and-art-for-woocommerce' ); ?></option>
											<?php $glass = $photoartHelper->get_glass_list();
											if(!empty($glass)) { foreach ($glass as $key => $value) { ?>
											<option value="<?php echo esc_attr($value->id); ?>"><?php echo esc_attr($value->name); ?></option>
											<?php } } ?>
										</select>
									</div>
									<div class="photoart-form-control option-framing single-window-mount">
										<label><?php _e( 'Window Mount', 'photoframes-and-art-for-woocommerce' ); ?></label>
										<select id="window_mount" name="window_mount" class="select-input changeSize">
											<option value="" selected><?php _e( 'None', 'photoframes-and-art-for-woocommerce' ); ?></option>
											<?php $window_mount = $photoartHelper->get_window_mount_list();
											if(!empty($window_mount)) { foreach ($window_mount as $key => $value) { ?>
											<option value="<?php echo esc_attr($value->id); ?>" data-color-code="<?php echo esc_attr($value->color_code); ?>"><?php echo esc_attr($value->name); ?></option>
											<?php } } ?>
										</select>
									</div>
									<div class="photoart-form-control single-mount-board-size">
										<label><?php _e( 'Mount Board Size (CM)', 'photoframes-and-art-for-woocommerce' ); ?></label>
										<input type="range" id="mount_board_size" name="mount_board_size" min="2" max="20" value="2" class="slider" oninput="this.nextElementSibling.value = this.value">
										<output><?php echo 2; ?></output>
									</div>
								<?php } if(get_option('photoart_is_active_mounting') == 'yes') { ?>
									<div class="photoart-form-control option-frame-material">
										<label><?php _e( 'Substrate', 'photoframes-and-art-for-woocommerce' ); ?></label>
										<select id="substrate" name="substrate" class="select-input changeSize">
											<?php $substrate = $photoartHelper->get_substrate_list();
											if(!empty($substrate)) { $i = 1; foreach ($substrate as $key => $value) { ?>
											<option value="<?php echo esc_attr($value->id); ?>" <?php echo ($i == 1) ? 'selected' : ''; ?>><?php echo esc_attr($value->name); ?></option>
											<?php $i++; } } ?>
										</select>
									</div>
								<?php } ?>
							</td>
						</tr>
					</table>
			  	</div>
			</div>
		</div>
	</div>
	<div class="framed-art-editor-column framed-art-canvas">
		<p class="background-title"><?php _e( 'Select Image', 'photoframes-and-art-for-woocommerce' ); ?></p>
		<div class="image-list">
			<div class="image">
				<img src="<?php echo PHOTOART_BASE_IMAGE; ?>" class="layer-image-selected" />
			</div>
			<div class="image last">
				<i class="fa fa-plus"></i>
			</div>
		</div>
		<div id="image-canvas-container">
			<div id="map">
		  		<div id="frame-material-image" class="frame-material-image">
		  			<div class="mount-board-img">
					  <img>
					</div>
		  		</div>
		  	</div>
		</div>
		<div class="subtext-p"><i><?php _e( 'Place your image/frame on the background by moving it to where you like it!', 'photoframes-and-art-for-woocommerce' ); ?></i></div>
		<p class="background-title"><?php _e( 'Select Background', 'photoframes-and-art-for-woocommerce' ); ?></p>
		<div class="background-list">
			<div class="background first background-selected">
			</div>
			<?php $backgrounds = $photoartHelper->get_backgrounds_list();
			if(!empty($backgrounds)) { foreach ($backgrounds as $key => $value) { $thubImageURL = wp_get_attachment_image_url( $value->background, 'medium' ); $fullImageURL = wp_get_attachment_image_url( $value->background, 'full' ); ?>
			<div class="background">
				<img src="<?php echo esc_url($thubImageURL); ?>" data-full-image="<?php echo esc_url($fullImageURL); ?>" class=""/>
			</div>
			<?php $i++; } } ?>
			<div class="background last">
				<i class="fa fa-plus"></i>
			</div>
		</div>
	</div>
	<div class="framed-art-editor-column framed-art-result">
		<div class="photoart-result photoart-printed-area">
			<h5 class="p-area-title"><?php _e( 'Printed Area:', 'photoframes-and-art-for-woocommerce' ); ?></h5>
			<div class="p-detail-wrapper"> 
				<p><span class="printed-area-width"><i class="fa fa-circle-o-notch fa-spin"></i></span><b class="unit">in</b> X <span class="printed-area-height"><i class="fa fa-circle-o-notch fa-spin"></i></span><b class="unit">in</b></p>
			</div>
		</div>
		<div class="photoart-result photoart-print-size">
			<h5 class="p-area-title"><?php _e( 'Print Size:', 'photoframes-and-art-for-woocommerce' ); ?></h5>
			<div class="p-detail-wrapper"> 
				<p><span class="printed-size-width"><i class="fa fa-circle-o-notch fa-spin"></i></span><b class="unit">in</b> X <span class="printed-size-height"><i class="fa fa-circle-o-notch fa-spin"></i></span><b class="unit">in</b></p>
			</div>
		</div>
		<div class="photoart-result photoart-overall-size">
			<h5 class="p-area-title"><?php _e( 'Overall Size:', 'photoframes-and-art-for-woocommerce' ); ?></h5>
			<div class="p-detail-wrapper"> 
				<p><span class="printed-overall-width"><i class="fa fa-circle-o-notch fa-spin"></i></span><b class="unit">in</b> X <span class="printed-overall-height"><i class="fa fa-circle-o-notch fa-spin"></i></span><b class="unit">in</b></p>
			</div>
		</div>
		<div class="photoart-result photoart-paper">
			<table class="photoart-form-result">
				<tr>
					<td><h5><?php _e( 'Paper', 'photoframes-and-art-for-woocommerce' ); ?></h5></td>
					<td><p class="photoart-chosen-paper"><i class="fa fa-circle-o-notch fa-spin"></i></p></td>
				</tr>
				<tr class="photoart-fixture hide">
					<td><h5><?php _e( 'Fixture', 'photoframes-and-art-for-woocommerce' ); ?></h5></td>
					<td><p class="photoart-chosen-fixture"><i class="fa fa-circle-o-notch fa-spin"></i></p></td>
				</tr>
				<tr>
					<td><h5><?php _e( 'Printing', 'photoframes-and-art-for-woocommerce' ); ?></h5></td>
					<td><p class="photoart-printing"><i class="fa fa-circle-o-notch fa-spin"></i></p></td>
				</tr>
				<tr class="photoart-framing hide">
					<td><h5><?php _e( 'Framing', 'photoframes-and-art-for-woocommerce' ); ?></h5></td>
					<td><p class="photoart-framing"><i class="fa fa-circle-o-notch fa-spin"></i></p></td>
				</tr>
				<tr class="photoart-glass hide">
					<td><h5><?php _e( 'Glass', 'photoframes-and-art-for-woocommerce' ); ?></h5></td>
					<td><p class="photoart-glass"><i class="fa fa-circle-o-notch fa-spin"></i></p></td>
				</tr>
				<tr class="photoart-window-mount hide">
					<td><h5><?php _e( 'Window Mount', 'photoframes-and-art-for-woocommerce' ); ?></h5></td>
					<td><p class="photoart-window-mount"><i class="fa fa-circle-o-notch fa-spin"></i></p></td>
				</tr>
				<tr class="photoart-mounting hide">
					<td><h5><?php _e( 'Mounting', 'photoframes-and-art-for-woocommerce' ); ?></h5></td>
					<td><p class="photoart-mounting"><i class="fa fa-circle-o-notch fa-spin"></i></p></td>
				</tr>
				<tr>
					<td colspan="2"><br></td>
				</tr>
				<tr>
					<td><h5><?php _e( 'Sub Total', 'photoframes-and-art-for-woocommerce' ); ?></h5></td>
					<td><p class="photoart-sub-total"><i class="fa fa-circle-o-notch fa-spin"></i></p></td>
				</tr>
			</table>
		</div>
		<div class="photoart-result photoart-paper">
			<form class="framed-art-result-form">
				<input type="hidden" name="final_unit" />
				<input type="hidden" name="final_width" />
				<input type="hidden" name="final_height" />
				<input type="hidden" name="final_print_width" />
				<input type="hidden" name="final_print_height" />
				<input type="hidden" name="final_overall_width" />
				<input type="hidden" name="final_overall_height" />
				<input type="hidden" name="final_paper" />
				<input type="hidden" name="final_frame_material" />
				<input type="hidden" name="final_glass" />
				<input type="hidden" name="final_window_mount" />
				<input type="hidden" name="final_window_mount_size" />
				<input type="hidden" name="final_fixture" />
				<input type="hidden" name="final_substrate" />
				<input type="hidden" name="final_dpi" />
				<input type="hidden" name="final_total" />
				<input type="hidden" name="final_image" />
			</form>
			<table class="photoart-form-result">
				<tr>
					<td><a href="javascript:void(0)" class="photoart-btn-add-to-cart disabled"><?php _e( 'Add to cart', 'photoframes-and-art-for-woocommerce' ); ?></a></td>
					<td><a href="<?php echo wc_get_cart_url(); ?>" class="photoart-btn-view-cart disabled"><?php _e( 'View cart', 'photoframes-and-art-for-woocommerce' ); ?></a></td>
				</tr>
			</table>
			<p class="shipping-cost-text"><?php _e( 'To find out your shipping cost , Please proceed to checkout.', 'photoframes-and-art-for-woocommerce' ); ?></p>
		</div>
	</div>
</div>

<?php
} else { ?>
	<h3><?php esc_html_e('To use features of "Photoframes and art for WooCommerce" plugin please check, WooCommerce plugin must be installed and activated in this site.','photoframes-and-art-for-woocommerce'); ?></h3>
<?php }
get_footer();
