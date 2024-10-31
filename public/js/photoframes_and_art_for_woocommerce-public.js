(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 */

	$(function() {
		var imageBackground 		  = '.background-list .background img';
		var noBackground 			  = '.background.first';
		var imageBase 				  = '.image-list .image img';
		var imageFrameMaterial 		  = '#frame-material-image';
		var imageCanvasContainer 	  = '#image-canvas-container';
		var imageMountBoard 		  = '.frame-material-image .mount-board-img';
		var imageBaseLayer 			  = '#image-canvas-container #map img';
		var optionsFramedArt 		  = '.framed-art-options';
		var optionFraming 			  = 'option-framing';
		var optionFrameMaterial 	  = 'option-frame-material';
		var inputMountBoardSize 	  = 'input[name="mount_board_size"]';
		var inputWidth 				  = 'input[name="width"]';
		var inputHeight 			  = 'input[name="height"]';
		var inputBorderTop 			  = 'input[name="border_size_top"]';
		var inputBorderLeft 		  = 'input[name="border_size_left"]';
		var inputBorderRight 		  = 'input[name="border_size_right"]';
		var inputBorderBottom 		  = 'input[name="border_size_bottom"]';
		var inputPreviousUnit 		  = 'input[name="previous_unit"]';
		var radioUnits 				  = 'input[name="units"]';
		var radioFrameMaterialType 	  = 'input[name="frame_material_type"]';
		var selectPrintType 		  = 'select[name="print_type"]';
		var selectWindowMount 		  = 'select[name="window_mount"]';
		var selectFrameMaterial 	  = 'select[name="frame_material"]';
		var selectFrame 			  = 'select[name="frame"]';
		var selectPaper 			  = 'select[name="paper"]';
		var selectGlass 			  = 'select[name="glass"]';
		var selectFixture 			  = 'select[name="fixture"]';
		var selectSubstrate 		  = 'select[name="substrate"]';
		var labelUnit 				  = 'b.unit';
		var labelDpiNotice 			  = 'p.dpi-notice';
		var labelDpiScore 			  = 'p.dpi-score span';
		var optionsResultRow 		  = 'tr.photoart';
		var labelChosenPaper 		  = 'p.photoart-chosen-paper';
		var labelChosenFixture 		  = 'p.photoart-chosen-fixture';
		var priceGlass 				  = 'p.photoart-glass';
		var pricePrinting 			  = 'p.photoart-printing';
		var priceFraming 			  = 'p.photoart-framing';
		var priceSubTotal 			  = 'p.photoart-sub-total';
		var priceWindowMount 		  = 'p.photoart-window-mount';
		var priceSubstrate 			  = 'p.photoart-mounting';
		var sectionMountBoard 		  = '.single-mount-board-size';
		var inputFinalUnit 		  	  = 'input[name="final_unit"]';
		var inputFinalHeight 		  = 'input[name="final_height"]';
		var inputFinalWidth 		  = 'input[name="final_width"]';
		var inputFinalPrintWidth 	  = 'input[name="final_print_width"]';
		var inputFinalPrintHeight 	  = 'input[name="final_print_height"]';
		var inputFinalOverallWidth 	  = 'input[name="final_overall_width"]';
		var inputFinalOverallHeight   = 'input[name="final_overall_height"]';
		var inputFinalFrameMaterial   = 'input[name="final_frame_material"]';
		var inputFinalPaper 		  = 'input[name="final_paper"]';
		var inputFinalGlass 		  = 'input[name="final_glass"]';
		var inputFinalWindowMount 	  = 'input[name="final_window_mount"]';
		var inputFinalWindowMountSize = 'input[name="final_window_mount_size"]';
		var inputFinalFixture 		  = 'input[name="final_fixture"]';
		var inputFinalSubstrate 	  = 'input[name="final_substrate"]';
		var inputFinalDpi 			  = 'input[name="final_dpi"]';
		var inputFinalTotal 		  = 'input[name="final_total"]';
		var inputFinalImage 		  = 'input[name="final_image"]';
		var btnAddCartViewCart		  = '.photoart-form-result td a';
		var btnAddToCart 			  = '.photoart-btn-add-to-cart';
		var accordianPrintSize 		  = '.print-size-accordion';

		photoart_Accordian();
	   	updateFramingOptions( getFrameMaterialType() );
	   	getPaperList( 'photoart_get_paper_list_action', { paper_type: $(selectPrintType).val() }, 'yes' );
	   	updateBackground(null, $('img.background-selected').data('full-image') );

	   	$("<img/>").attr('src', getDefaultBaseImage()).on('load', function() {
			updateBaseImage(null, getDefaultBaseImage() );
			updateWidth(convert(this.width, 'px', 'in').toFixed(2));
			updateHeight(convert(this.height, 'px', 'in').toFixed(2));

			const unit 	  = getCurrentUnit();
			const dpi 	  = this.height / getHeight();
			const widthIn = this.width / dpi;
			const value   = convert(widthIn, 'in', unit);

			updateWidth(value.toFixed(2));
			manageBaseImageSize();
			updateDPI(dpi);
			updateUnits();
		});

	   	Draggable.create(imageFrameMaterial, { type: "x, y", containment: imageCanvasContainer, edgeResistance: 0.2 });
	   	setTimeout(function(){ calculatePrice(); }, 4000);
	   	Dropzone.autoDiscover = false;
	   	dropzoneInit('.image.last', 'base', '.image.last.dz-clickable i');
	   	dropzoneInit('.background.last', 'background', '.background.last.dz-clickable i');

	   	$(document).on("click", imageBackground, function() {
	    	updateBackground($(this), $(this).data('full-image'));
	    	manageBaseImageSize();
	    	$(inputWidth).change();
	    	$(inputHeight).change();
	   	});

	   	$(document).on("click", ".f-art-opt-toggle",function() {
	    	$(optionsFramedArt).addClass('active');
	   	});

	   	$(document).on("click", ".f-art-opt-close",function() {
	    	$(optionsFramedArt).removeClass('active');
	   	});

	   	$(document).on("click", imageBase, function() {
			updateBaseImage($(this), $(this).attr('src'));
			$("<img/>").attr('src', getDefaultBaseImage()).on('load', function() {
				const unit = getCurrentUnit();
				updateWidth(convert(this.width, 'px', 'in').toFixed(2));
				updateHeight(convert(this.height, 'px', 'in').toFixed(2));
				updateWidth(convert(getWidth(), 'in', unit).toFixed(2));
				updateHeight(convert(getHeight(), 'in', unit).toFixed(2));
				manageBaseImageSize();
				updateUnits();
			});
		});

		$(document).on("click", radioUnits, function() {
			updateUnits();
		});

	   	$(document).on("click", radioFrameMaterialType, function() {
	    	updateFramingOptions($(this).val());
	    	manageFramingOptions();
	   		manageBaseImageSize();
	    	updateUnits();
	    	calculatePrice();
	   	});
	   	$(document).on("click", btnAddToCart, function(e) {
			
	    	e.preventDefault();
	    	var $thisbutton = $(this), form = $('.framed-art-result-form');

	    	$.ajax({
	            type: 'post',
	            url: publicScriptObj.ajaxUrl,
	            data: {
	            	action: 'photoart_woocommerce_ajax_add_to_cart',
	            	form_data: form.serialize()
	            },
	            beforeSend: function (response) {
	                $(btnAddCartViewCart).addClass('disabled');					
	            },
	            complete: function (response) {
	                $(btnAddCartViewCart).removeClass('disabled');
	            },
	            success: function (response) {					
	            	if(response.status != 'failed') {
	            		if (response.error && response.product_url) {
	            			alert(publicScriptObj.messages.error.msg_1);
		                    return;
		                } else {
		                    $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
		                }
	            	} else {								
	            		alert(response.msg);
	            	}
	            }
	        });
	   	});

		$(document).on("click", '.img-delete-btn', function(e) {
			var attachment = $(this).data('attachment');
			$(this).closest('div').remove();
			if(attachment != '') {
				$.ajax({
					type: 'POST',
					url: publicScriptObj.delete_file,
					data: {
						'attachment_id': attachment
					},
					success: function (response) {
						if(response.status != 'ok') {
							console.log(response.status);
						}
					},
				});
			}
		});

		$(document).on("click", noBackground, function(e) {
			$(imageBackground).removeClass('background-selected');
			$(imageCanvasContainer).attr('style', '');
			$(this).addClass('background-selected');
			$('img.layer-image-selected').click();
			manageBaseImageSize();
		});

		$(document).on("change", selectPrintType, function() {
	    	getPaperList('photoart_get_paper_list_action', { paper_type: $(this).val() }, 'no' );
	   	});

	   	$(document).on("change", selectFrameMaterial, function() {
	   		manageFrameMaterialImage('set', $(this).find(':selected').data('image'));
	   		manageBaseImageSize();
	   		updateUnits();
	   		calculatePrice();
	   	});

	   	$(document).on("change", inputWidth, function() {	   		
			$("<img/>").attr('src', getDefaultBaseImage()).on('load', function() {
				const unit 	   = getCurrentUnit();
				const widthIn  = convert(getWidth(), unit, 'in');
				const dpi 	   = this.width / widthIn;
				const heightIn = this.height / dpi;
				const value    = convert(heightIn, 'in', unit);

				updateHeight(value.toFixed(2));
				manageBaseImageSize();
				updateDPI(dpi);
				updateUnits();
				calculatePrice();
			});			
		});

		$(document).on("change", inputHeight, function() {			
			$("<img/>").attr('src', getDefaultBaseImage()).on('load', function() {
				const unit 	   = getCurrentUnit();
				const heightIn = convert(getHeight(), unit, 'in');
				const dpi 	   = this.height / heightIn;
				const widthIn  = this.width / dpi;
				const value    = convert(widthIn, 'in', unit);

				updateWidth(value.toFixed(2));
				manageBaseImageSize();
				updateDPI(dpi);
				updateUnits();
				calculatePrice();
			});			
		});

	   	$(document).on("change", selectFrame, function() {
	    	hideShowSingleOptions('frame-material', getFramingOptionStatus($(this), 'frame_material'));
	    	hideShowSingleOptions('fixture', getFramingOptionStatus($(this), 'fixture'));
	    	hideShowSingleOptions('glass', getFramingOptionStatus($(this), 'glass'));
	    	hideShowSingleOptions('window-mount', getFramingOptionStatus($(this), 'window_mount'));
	    	hideShowSingleOptions('mount-board-size', getFramingOptionStatus($(this), 'window_mount'));
	    	manageFramingOptions();
	    	manageBaseImageSize();
	    	updateUnits();
	    	calculatePrice();
	   	});

	   	$(document).on("change", selectWindowMount, function() {
	   		updateWindowMount(
	   			$(this).find(':selected').text(),
	   			$(this).find(':selected').val(),
	   			$(this).find(':selected').data('color-code'),
	   			$(inputMountBoardSize).val()
	   		);
	   		hideShowWindowMount();
	   		manageBaseImageSize();
	   		updateUnits();
	   		calculatePrice();
	   	});

	   	$(document).on("change", inputBorderTop, function() {
	   		manageBaseImageSize();
	   		updateUnits();
	   		calculatePrice();
	   	});

	   	$(document).on("change", inputBorderLeft, function() {
	   		manageBaseImageSize();
	   		updateUnits();
	   		calculatePrice();
	   	});

	   	$(document).on("change", inputBorderRight, function() {
	   		manageBaseImageSize();
	   		updateUnits();
	   		calculatePrice();
	   	});

	   	$(document).on("change", inputBorderBottom, function() {
	   		manageBaseImageSize();
	   		updateUnits();
	   		calculatePrice();
	   	});

	   	$(document).on("change", selectPaper, function() {
	   		updatePaperLabel($(this).find(':selected').text(), $(this).find(':selected').val());
	   		calculatePrice();
	   	});

	   	$(document).on("change", selectGlass, function() {
	   		updateGlassLabel($(this).find(':selected').text(), $(this).find(':selected').val());
	   		calculatePrice();
	   	});

	   	$(document).on("change", selectFixture, function() {
	   		updateFixtureLabel($(this).find(':selected').text(), $(this).find(':selected').val());
	   	});

	   	$(document).on("change", selectSubstrate, function() {
	   		updateMountingLabel($(this).find(':selected').text(), $(this).find(':selected').val());
	   		calculatePrice();
	   	});

	   	$(document).on("change", inputMountBoardSize, function() {
	   		if($(selectWindowMount).val() != '') {
		   		updateWindowMount(
		   			$(selectWindowMount).find(':selected').text(),
		   			$(selectWindowMount).find(':selected').val(),
		   			$(selectWindowMount).find(':selected').data('color-code'),
		   			$(this).val()
		   		);
		   		manageBaseImageSize();
	   		}
		   	updateUnits();
		   	calculatePrice();
	   	});

	   	function dropzoneInit(element, type, loader) {
	   		new Dropzone(element, {
	            url: publicScriptObj.upload_file,
	            paramName: "mwp-dropform-file",
	            acceptedFiles: 'image/*',
				maxFilesize: 300,
				addRemoveLinks: false,
				uploadMultiple: false,
				createImageThumbnails: false,
				uploadprogress: function(file, progress, bytesSent) {
					$(loader).attr('class', '');
					if(progress != 100) {
				    	$(loader).text(progress.toFixed(2) + '%');
					} else {
						$(loader).text('Rendering...');
					}
				},
				success: function (file, response) {
					$(loader).text('');
					$(loader).attr('class', 'fa fa-plus');
					if(response.status != 'error') {
						if(response.attachment != '') {
							if(type == 'base') {
								$(`<div class="image"><img src="${response.attachment.url}"><a href="javascript:void(0)" class="img-delete-btn" data-attachment="${response.attachment.id}"><i class="fa fa-times"></i></a></div>`).insertBefore($(element));
							} else if(type == 'background') {
								$(`<div class="background"><img src="${response.attachment.url}" data-full-image="${response.attachment.url}" class="background-selected"><a href="javascript:void(0)" class="img-delete-btn" data-attachment="${response.attachment.id}"><i class="fa fa-times"></i></a></div>`).insertBefore($(element));
							}
						} else {
							alert(publicScriptObj.messages.error.msg_1);
						}
					} else {
						alert(response.message);
					}
				},
				error: function (file, response) {
					$(loader).text('');
					$(loader).attr('class', 'fa fa-plus');
					alert(response);
				}
	        });
	   	}

	   	function manageFramingOptions() {
			updateWindowMount($(selectWindowMount).find(':selected').text(), $(selectWindowMount).find(':selected').val(), $(selectWindowMount).find(':selected').data('color-code'), $(inputMountBoardSize).val());
			hideShowWindowMount();
			updateGlassLabel($(selectGlass).find(':selected').text(), $(selectGlass).find(':selected').val());
			updateFixtureLabel($(selectFixture).find(':selected').text(), $(selectFixture).find(':selected').val());
			updateMountingLabel($(selectSubstrate).find(':selected').text(), $(selectSubstrate).find(':selected').val());
		}

		function updateFramingOptions(val) {
			if(val == 'print_only') {
	    		hideOrShow(optionFraming, 'hide');
	    		hideOrShow(optionFrameMaterial, 'hide');
	    		manageFrameMaterialImage('unset', null);
	    	} else if(val == 'framing') {
	    		hideOrShow(optionFraming, 'show');
	    		$('.option-frame-material').hide();
	    		if(isActiveFrameMaterial() == 'yes') {
	    			manageFrameMaterialImage('set', getFrameMaterialImage());
	    		}
	    	} else if(val == 'mounting') {
	    		hideOrShow(optionFrameMaterial, 'show');
	    		hideOrShow(optionFraming, 'hide');
	    		manageFrameMaterialImage('unset', null);
	    	}
		}

		function getPaperList(action, formData, onLoad) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: publicScriptObj.ajaxUrl,
				data: { action: action, formData: formData },
				success: function(response) {
					if(response && response.status == 'success') {
						if(response.data.options) {
							$(selectPaper).html(response.data.options);
							updatePaperLabel($(selectPaper).find(':selected').text(), $(selectPaper).find(':selected').val());
							if(onLoad == 'no') {
								calculatePrice();
							}
						}
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				}
			});
		}

		function calculatePrice() {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: publicScriptObj.ajaxUrl,
				data: { action: 'photoart_calculate_price', formData: $('.framed-art-result-form').serialize() },
				beforeSend: function(){
			        $(btnAddCartViewCart).addClass('disabled');
			        $(pricePrinting).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$(priceFraming).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$(priceGlass).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$(priceWindowMount).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
					$(priceSubstrate).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
			        $(priceSubTotal).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
			    },
				success: function(response) {
					if(response.status == 'success') {
						if(response.data.prices != '' || response.data.prices != null) {
							$(pricePrinting).text(response.data.prices.printing);
							$(priceFraming).text(response.data.prices.framing);
							$(priceGlass).text(response.data.prices.glass);
							$(priceWindowMount).text(response.data.prices.window_mount);
							$(priceSubstrate).text(response.data.prices.substrate);
							$(priceSubTotal).text(response.data.sub_total);
							$(inputFinalTotal).val(response.data.total);
							if($(inputFinalDpi).val() > 99) {
								$(btnAddCartViewCart).removeClass('disabled');
								$(accordianPrintSize).removeClass('danger');
							}
						} else {
							alert(publicScriptObj.messages.error.msg_1);
						}
					} else {
						alert(response.status);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				}
			});
		}

		function hideShowSingleOptions(option, val) { 
			if(val == 'yes') {
				$(`.single-${option}`).show();
				if(option == 'frame-material') {
					manageFrameMaterialImage('set', getFrameMaterialImage());
				}
			} else {
				$(`.single-${option}`).hide();
				if(option == 'frame-material') {
					manageFrameMaterialImage('unset', null);
				}
			}
		}

		function manageFrameMaterialImage(action = 'set', url = null) {
			if(action == 'set' && url != null) {
				var borderType = $(selectFrameMaterial).find(':selected').data('border-type');
				$(imageFrameMaterial).css('border-image', 'url(' + url + ') 45 / 1.5 / 0 round');
				$(imageFrameMaterial).removeClass();
		   		$(imageFrameMaterial).addClass('frame-material-image');
		   		$(imageFrameMaterial).addClass(borderType);
		   		setFrameMaterialFinalValue($(selectFrameMaterial).find(':selected').val());
		   		updateFrameMaterialSize(borderType);
			} else if(action == 'unset') {
				$(imageFrameMaterial).css('border-image', '');
				$(imageFrameMaterial).removeClass();
				$(imageFrameMaterial).addClass('frame-material-image');
				setFrameMaterialFinalValue('');
				updateFrameMaterialSize(null);
			}
		}

		function updateFrameMaterialSize(borderType) {
			if(borderType == 'thin') {
	   			updateBaseImageSize(4, 4, false);
	   		} else if(borderType == 'standard') {
	   			updateBaseImageSize(6, 6, false);
	   		} else if(borderType == 'large') {
	   			updateBaseImageSize(8, 8, false);
	   		} else if(borderType == 'square') {
	   			updateBaseImageSize(7, 7, false);
	   		} else if(borderType == null) {
	   			updateBaseImageSize(0, 0, false);
	   		}
		}

		function getFrameMaterialImage() {
			return $(selectFrameMaterial).find(':selected').data('image');
		}

		function isActiveFrameMaterial() {
			return $(selectFrame).find(':selected').data('frame_material');
		}

		function setFrameMaterialFinalValue(val) {
			if(val != '') {
				$(`${optionsResultRow}-framing`).removeClass('hide');
				$(`${optionsResultRow}-framing`).addClass('show');
			} else {
				$(`${optionsResultRow}-framing`).removeClass('show');
				$(`${optionsResultRow}-framing`).addClass('hide');
			}

			$(inputFinalFrameMaterial).val(val);
		}

		function updateWindowMount(text, value, colorCode, borderSize) {
			if(getFrameMaterialType() == 'framing' && getFramingOptionStatus($(selectFrame), 'window_mount') == 'yes' && value != '' && colorCode != '') {
				$(`${optionsResultRow}-window-mount`).removeClass('hide');
				$(`${optionsResultRow}-window-mount`).addClass('show');
				$(imageMountBoard).css('border', `${borderSize}px solid ${colorCode}`);
				$(imageMountBoard).css('background', `${colorCode}`);
				$(inputFinalWindowMount).val(value);
				$(inputFinalWindowMountSize).val(borderSize);
			} else {
				$(`${optionsResultRow}-window-mount`).removeClass('show');
				$(`${optionsResultRow}-window-mount`).addClass('hide');
				$(imageMountBoard).css('border', '');
				$(imageMountBoard).css('background', '');
				$(inputFinalWindowMount).val(0);
				$(inputFinalWindowMountSize).val(0);
			}
		}

		function updateBackground($this, url) {
			if($this != null) {
				$(noBackground).removeClass('background-selected');
				$(imageBackground).removeClass('background-selected');
				$this.addClass('background-selected');
				$(imageCanvasContainer).css('background-image', 'url('+ url +')');
			} else {
	    		$(imageCanvasContainer).css('background-image', '');
			}
		}

		function updateBaseImage($this, url) {
	    	if($this != null) {
	    		$(imageBase).removeClass('layer-image-selected');
	    		$this.addClass('layer-image-selected');
	    	}
	    	
			$(imageBaseLayer).attr('src', url);
			$(inputFinalImage).val(url);
		}

		function getFrameSize(unit) {
			let frameSize = 0;

			if(getFrameMaterialType() == 'framing') {
				var borderType = getBorderType();
	            if(borderType == 'thin') {
	                frameSize = convert(13, 'mm', unit);
	            } else if(borderType == 'standard') {
	                frameSize = convert(15, 'mm', unit);
	            } else if(borderType == 'large') {
	                frameSize = convert(22, 'mm', unit);
	            } else if(borderType == 'square') {
	                frameSize = convert(38, 'mm', unit);
	            }
	        }

	        return frameSize;
		}

		function updateUnits() {
			const unit = $(`${radioUnits}:checked`).val();
			var width = convert(getWidth(), getPreviousUnit(), unit).toFixed(2);
			var height = convert(getHeight(), getPreviousUnit(), unit).toFixed(2);

			updatePrintedArea('area', 'height', height);
			updatePrintedArea('area', 'width', width);

			updatePrintedArea('size', 'height', height);
			updatePrintedArea('size', 'width', width);

			updatePrintedArea('overall', 'height', height);
			updatePrintedArea('overall', 'width', width);

			$(inputPreviousUnit).val(unit);
			$(labelUnit).text(unit);
			$(inputFinalUnit).val(unit);
			updateWidth(width);
			updateHeight(height);
		}

		function updateDPI(dpi) {
	        dpi = Math.round(dpi);
	        if(dpi < 200 || !isFinite(dpi)) {
	        	$(labelDpiScore).text(dpi);
	        	$(inputFinalDpi).val(dpi);
	            if (dpi > 99) {
	            	$(labelDpiNotice).css('display', 'block');
	            	$(labelDpiNotice).removeClass('danger');
	            	$(labelDpiNotice).addClass('warning');
	                $(labelDpiNotice).text(publicScriptObj.messages.info.msg_1);
	                $(btnAddCartViewCart).removeClass('disabled');
	                $(accordianPrintSize).removeClass('danger');
	            } else {
	            	$(labelDpiNotice).css('display', 'block');
	            	$(labelDpiNotice).removeClass('warning');
	               	$(labelDpiNotice).addClass('danger');
	               	$(labelDpiNotice).text(publicScriptObj.messages.info.msg_2);
	               	$(btnAddCartViewCart).addClass('disabled');
	               	$(accordianPrintSize).addClass('danger');
	            }
	        }
	    }

	    function updatePrintedArea(option, parameter, value) {
			const unit = getCurrentUnit();

			if(option == 'area' && parameter == 'width') {
				$(inputFinalWidth).val(value);
			} else if(option == 'area' && parameter == 'height') {
				$(inputFinalHeight).val(value);
			} else if(option == 'size' && parameter == 'width') {
				value = (safeNum(value) + convert( (safeNum(getBorderSize('left')) + safeNum(getBorderSize('right')) ), 'cm', unit) ).toFixed(2);
				$(inputFinalPrintWidth).val(value);
			} else if(option == 'size' && parameter == 'height') {
				value = (safeNum(value) + convert( (safeNum(getBorderSize('top')) + safeNum(getBorderSize('bottom')) ), 'cm', unit) ).toFixed(2);
				$(inputFinalPrintHeight).val(value);
			} else if(option == 'overall' && parameter == 'width') {
				value = (safeNum(value) + convert(( safeNum(getBorderSize('left')) + safeNum(getBorderSize('right')) + safeNum(getWindowMountThickness()) * 2 ), 'cm', unit) + getFrameSize(unit) * 2 ).toFixed(2);
				$(inputFinalOverallWidth).val(value);
			} else if(option == 'overall' && parameter == 'height') {
				value = (safeNum(value) + convert(( safeNum(getBorderSize('top')) + safeNum(getBorderSize('bottom')) + safeNum(getWindowMountThickness()) * 2 ), 'cm', unit) + getFrameSize(unit) * 2 ).toFixed(2);
				$(inputFinalOverallHeight).val(value);
			}

			$(`.printed-${option}-${parameter}`).text(value); 
		}

	    function convert(value, unit, convertTo = 'in') {
			var conversions = {
				"mm": {
			      	"cm": {
			        	"formula": "divide",
			        	"value": 10
			      	},
			      	"in": {
			        	"formula": "divide",
			        	"value": 25.39999999999999857891452847979962825775146484375
			      	}
			    },
			    "cm": {
			      	"mm": {
			        	"formula": "multiply",
			        	"value": 10
			      	},
			      	"in": {
			        	"formula": "divide",
			        	"value": 2.54000000000000003552713678800500929355621337890625
			      	}
			    },
			    "in": {
			      	"cm": {
			        	"formula": "multiply",
			        	"value": 2.54000000000000003552713678800500929355621337890625
			      	},
			      	"mm": {
			        	"formula": "multiply",
			        	"value": 25.39999999999999857891452847979962825775146484375
			      	}
			    },
			    "px": {
			      	"mm": {
			        	"formula": "multiply",
			        	"value": 0.264583333300000000942731048780842684209346771240234375
			      	},
			      	"cm": {
			        	"formula": "multiply",
			        	"value": 0.02645833300000000054552629080717451870441436767578125
			      	},
			      	"in": {
			        	"formula": "multiply",
			        	"value": 0.010416666700000000445047732000602991320192813873291015625
			      	}
			    }
			};

			if (unit === convertTo) {
				return Math.round(value * 100) / 100;
			}

			if (conversions[unit][convertTo]) {
				const conversion = conversions[unit][convertTo];
				if (conversion.formula === 'multiply') {
					return value * conversion.value;
				} else if (conversion.formula === 'divide') {
					return value / conversion.value;
				}
			}
		}

		function hideShowWindowMount() {
	   		if(getFrameMaterialType() == 'framing' && getFramingOptionStatus($(selectFrame), 'window_mount') == 'yes') {
	   			if($(selectWindowMount).val() != '') {
	   				$(sectionMountBoard).show();
	   			} else {
		   			$(sectionMountBoard).hide();
		   		}
	   		} else {
	   			$(sectionMountBoard).hide();
	   		}
	   	}

	   	function manageBaseImageSize() {
	   		var borderTop 	 = $(inputBorderTop).val();
	   		var borderLeft 	 = $(inputBorderLeft).val();
	   		var borderRight  = $(inputBorderRight).val();
	   		var borderBottom = $(inputBorderBottom).val();
	   		
	   		var borderVer 	 = safeNum(borderTop) + safeNum(borderBottom);
	   		var borderHor 	 = safeNum(borderLeft) + safeNum(borderRight);

	   		if(getFrameMaterialType() == 'framing') {
		   		var borderSize = 0, borderHeight = 0, borderWidth = 0;

		   		if(getFramingOptionStatus($(selectFrame), 'window_mount') == 'yes' && $(selectWindowMount).val() != '') {
		   			borderSize = $(inputMountBoardSize).val();
		   		} else {
		   			borderSize = borderSize;
		   		}

		   		if(getFramingOptionStatus($(selectFrame), 'frame_material') == 'yes') {
		   			var borderTypeSize = 0;
		   			var borderType = $(selectFrameMaterial).find(':selected').data('border-type');

		   			if(borderType == 'thin') {
						borderTypeSize = 4;
					} else if(borderType == 'standard') {
						borderTypeSize = 6;
					} else if(borderType == 'large') {
						borderTypeSize = 8;
					} else if(borderType == 'square') {
						borderTypeSize = 7;
					} else if(borderType == null) {
						borderTypeSize = borderTypeSize;
					}
		   		} else {
		   			borderTypeSize = borderTypeSize;
		   		}

		   		borderHeight = safeNum(borderSize) + safeNum(borderTypeSize) + safeNum(borderVer / 2);
		   		borderWidth  = safeNum(borderSize) + safeNum(borderTypeSize) + safeNum(borderHor / 2);
				updateBaseImageSize(borderHeight, borderWidth, true);
			} else {
				updateBaseImageSize(safeNum(borderVer), safeNum(borderHor), false);
			}

			updateBorderSize('top', borderTop);
			updateBorderSize('bottom', borderBottom);
			updateBorderSize('left', borderLeft);
			updateBorderSize('right', borderRight);
	   	}

		function updateBaseImageSize(borderHeight, borderWidth, double = false) {
			var height = 0, width = 0, extraaSize = 0;

			if(double == true) {
				borderHeight = borderHeight * 2;
				borderWidth = borderWidth * 2;
			}

			if ($(".background.first.background-selected")[0]) {
				$(imageMountBoard).addClass('box-shadow');
				$(imageFrameMaterial).addClass('not-allowed');
				$(imageCanvasContainer).addClass('no-background');

				height = getConverted(25, borderHeight, 'h');
				width = getConverted(25, borderWidth, 'w');

				if(height > 550) {
					height = height / 2;
					width = width / 2;
				}
			} else {
				$(imageMountBoard).removeClass('box-shadow');
				$(imageFrameMaterial).removeClass('not-allowed');
				$(imageCanvasContainer).removeClass('no-background');

				height = getConverted(4, borderHeight, 'h');
				width = getConverted(4, borderWidth, 'w');
			}

			$(imageFrameMaterial).css({'height': `${height}px`}); 
			$(imageFrameMaterial).css({'width': `${width}px`});
		}

		function getConverted(extraaSize, border, para) {
			if(para == 'h') {
				return safeNum(convert(getHeight() * extraaSize, getPreviousUnit(), 'in') + border);
			} else if(para == 'w') {
				return safeNum(convert(getWidth() * extraaSize, getPreviousUnit(), 'in') + border);
			}
		}

		function updateBorderSize(type, borderSize) {
			$(imageBaseLayer).css(`border-${type}`, `${borderSize}px solid #ffffff`);
		}

		function updatePaperLabel(paper, paperval) {
			$(labelChosenPaper).text(paper); $(inputFinalPaper).val(paperval);
		}

		function updateGlassLabel(glass, glassval) {
			if(getFrameMaterialType() == 'framing' && getFramingOptionStatus($(selectFrame), 'glass') == 'yes' && glassval != '') {
				$(`${optionsResultRow}-glass`).removeClass('hide');
				$(`${optionsResultRow}-glass`).addClass('show');
				$(inputFinalGlass).val(glassval);
			} else {
				$(`${optionsResultRow}-glass`).removeClass('show');
				$(`${optionsResultRow}-glass`).addClass('hide');
				$(inputFinalGlass).val('');
			}
		}

		function updateFixtureLabel(fixture, fixtureval) {
			if(getFrameMaterialType() == 'framing' && getFramingOptionStatus($(selectFrame), 'fixture') == 'yes' && fixtureval != '') {
				$(`${optionsResultRow}-fixture`).removeClass('hide');
				$(`${optionsResultRow}-fixture`).addClass('show');
				$(labelChosenFixture).text(fixture);
				$(inputFinalFixture).val(fixtureval);
			} else {
				$(`${optionsResultRow}-fixture`).removeClass('show');
				$(`${optionsResultRow}-fixture`).addClass('hide');
				$(inputFinalFixture).val('');
			}
		}

		function updateMountingLabel(substrate, substrateval) {
			if(getFrameMaterialType() == 'mounting' && getFramingOptionStatus($(selectFrame), 'window_mount') == 'yes' && substrateval != '') {
				$(`${optionsResultRow}-mounting`).removeClass('hide');
				$(`${optionsResultRow}-mounting`).addClass('show');
				$(inputFinalSubstrate).val(substrateval);
			} else {
				$(`${optionsResultRow}-mounting`).removeClass('show');
				$(`${optionsResultRow}-mounting`).addClass('hide');
				$(inputFinalSubstrate).val('');
			}
		}

		function getDefaultBaseImage() {
			return $('img.layer-image-selected').attr('src');
		}

		function getBorderType() {
			return $(selectFrameMaterial).find(':selected').data('border-type');
		}

		function getCurrentUnit() {
			return $(`${radioUnits}:checked`).val();
		}

		function getWindowMountThickness() {
			if($(selectWindowMount).val() != '' && getFrameMaterialType() == 'framing') {
				return $(inputMountBoardSize).val();
			} else {
				return 0;
			}
		}

		function getBorderSize(type) {
			return $(`input[name="border_size_${type}"]`).val();
		}

		function getPreviousUnit() {
			return $(inputPreviousUnit).val();
		}

		function getFrameMaterialType() {
			return $(`${radioFrameMaterialType}:checked`).val();
		}

		function getHeight() {
			return $(inputHeight).val();
		}

		function getWidth() {
			return $(inputWidth).val();
		}

		function updateHeight(val) {
			$(inputHeight).val(val); $(inputFinalHeight).val(val);
		}

		function updateWidth(val) {
			$(inputWidth).val(val); $(inputFinalWidth).val(val);
		}

		function getFramingOptionStatus($this, option) {
			return $this.find(':selected').data(`${option}`);
		}

		function photoart_Accordian() {
			var i;
			var accordian = document.getElementsByClassName("photoart-accordion");
			for (i = 0; i < accordian.length; i++) {
			  	accordian[i].addEventListener("click", function() {
			  		$('.photoart-accordion').removeClass('active');
			  		$('.photoart-panel').hide();
			  		$(window).scrollTop(0);
				    this.classList.toggle("active");
				    var panel = this.nextElementSibling;
				    if (panel.style.display === "block") {
				      	panel.style.display = "none";
				    } else {
				      	panel.style.display = "block";
				    }
			  	});
			}
		}

		function safeNum(val) {
			val = parseFloat(val ?? 0); if(isNaN(val)) {
				return 0;
			} else {
				return val;
			}
		}

		function hideOrShow(element, action) {
			if(action == 'show') {
				$(`.${element}`).show();
			} else if(action == 'hide') {
				$(`.${element}`).hide();
			}
		}
	});
})( jQuery );