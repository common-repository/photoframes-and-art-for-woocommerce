(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 */

	$(function() {
		var photoArtNotice = $('.photoart-notice');
		$('#general-settings').css('display', 'block');

		$('#form-general-settings').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_update_options', formData);
		});

		$('#form-backgrounds').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_background', formData);
		});

		$('#form-size-pricing').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_edit_size_pricing', formData);
		});

	    $('#form-paper-type').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_edit_paper_type', formData);
		});

		$('#form-paper').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_edit_paper', formData);
		});

		$('#form-framing').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_edit_framing', formData);
		});

		$('#form-frame-material').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_edit_frame_material', formData);
		});
		
		$('#form-fixture').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_edit_fixture', formData);
		});

		
		$('#form-glass').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_edit_glass', formData);
		});
		
		$('#form-window-mount').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_edit_window_mount', formData);
		});

		$('#form-substrate').submit(function( event ) {
	    	var formData = $(this).serialize();
		  	event.preventDefault($);
		  	AddEditAjax($(this), 'photoart_add_edit_substrate', formData);
		});

		$(document).on("click",".photoart-tbl-action",function() {
			if($(this).data('model') == 'size_pricing') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id'), height: $(this).data('height'), width: $(this).data('width'), price: $(this).data('price') };
			} else if($(this).data('model') == 'paper_type') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id'), paperType: $(this).data('value')};
			} else if($(this).data('model') == 'paper') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id'), paperTypeId: $(this).data('paper-type-id'), paperName: $(this).data('value') };
			} else if($(this).data('model') == 'frame') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id'), frame_name: $(this).data('frame_name'), frame_material: $(this).data('frame_material'), fixture: $(this).data('fixture'), glass: $(this).data('glass'), window_mount: $(this).data('window_mount'), mount_board_size: $(this).data('mount_board_size') };
			} else if($(this).data('model') == 'frame_material') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id'), material_name: $(this).data('name'), thin: $(this).data('thin'), standard: $(this).data('standard'), large: $(this).data('large'), square: $(this).data('square'), design: $(this).data('design') };
			} else if($(this).data('model') == 'fixture') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id'), fixtureName: $(this).data('value'), design: $(this).data('design') };
			} else if($(this).data('model') == 'glass') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id'), glassName: $(this).data('value'), design: $(this).data('design') };
			} else if($(this).data('model') == 'window_mount') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id'), glassName: $(this).data('value'), colorCode: $(this).data('color_code') };
			} else if($(this).data('model') == 'backgrounds') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id') };
			} else if($(this).data('model') == 'substrate') {
				var data = { action: $(this).data('action'), model: $(this).data('model'), id: $(this).data('id'), substrateName: $(this).data('value'), price: $(this).data('price') };
			}

	        editDeleteAction($(this), data);
	    });

		function AddEditAjax(form, action, formData) {
		    $.ajax({
		        type: 'POST',
		        dataType: 'json',
		        url: adminScriptObj.ajaxUrl,
		        data: { action: action, formData: formData },
		        beforeSend: function() {
		        	$("input[type=submit]", form).prop('disabled', true);
		        	$("input[type=submit]", form).val(adminScriptObj.loadingText);
			    },
		        success: function(response) {					
		            showNoticeMessage(response.status, response.msg);
		        },
		        error: function(jqXHR, textStatus, errorThrown){
		            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
		        }
		    });
		}

		function editDeleteAction(currentDeleteButton, data) {
			$(window).scrollTop(0);
			if(data.action != '') {
				if(data.action == 'edit') {
					if(data.model == 'size_pricing') {
						setSizePricingValues(data);
					} else if(data.model == 'paper_type') {
						setPaperTypeValues(data);
					} else if(data.model == 'paper') {
						setPaperValues(data);
					} else if(data.model == 'frame') {
						setFrameValues(data);
					} else if(data.model == 'frame_material') {
						setFrameMaterialValues(data);
					} else if(data.model == 'fixture') {
						setFixtureValues(data);
					} else if(data.model == 'glass') {
						setGlassValues(data);
					} else if(data.model == 'window_mount') {
						setWindowMountValues(data);
					} else if(data.model == 'substrate') {
						setSubstrateValues(data);
					}
			    } else if(data.action == 'delete') {
			    	deleteModelAjax('POST', 'json', data.id, data.model, currentDeleteButton);
			    }
			} else {
				showUnexpectedError();
			}
		}

		function deleteModelAjax(type, dataType, id, model, currentDeleteButton) {
			$.ajax({
		        type: type,
		        dataType: dataType,
		        url: adminScriptObj.ajaxUrl,
		        beforeSend: function() {
		        	currentDeleteButton.prop('disabled', true);
		        	currentDeleteButton.html(adminScriptObj.deletingText);
			    },
		        data: { action: 'photoart_action_delete', id: id, model: model },
		        success: function(response) {
		        	currentDeleteButton.parent('tr').remove();
		            showNoticeMessage(response.status, response.msg);
		        },
		        error: function(jqXHR, textStatus, errorThrown){
		            console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
		        }
		    });
		}
		
		function showNoticeMessage(status, message) {
			$(window).scrollTop(0);
			if(status == 'success') {
            	photoArtNotice.addClass('success');
            	photoArtNotice.text(message);
            } else {
            	photoArtNotice.addClass('failed');
            	photoArtNotice.text(message);
            }

            setTimeout(function() {
                photoArtNotice.fadeOut('fast');
                location.reload();
            }, 2000);
		}

		function showUnexpectedError() {
			alert(adminScriptObj.messages.error.msg_1);
			location.reload();
			return false;
		}
		
		function setSizePricingValues(data) {
			$('#form-size-pricing input[name=height]').val(data.height);
			$('#form-size-pricing input[name=width]').val(data.width);
			$('#form-size-pricing input[name=price]').val(data.price);
			$('#form-size-pricing input[name=size_pricing_id]').val(data.id);
			$('#form-size-pricing input[name=form_action]').val(data.action);
			$('#form-size-pricing input[name=submit]').val(adminScriptObj.updateBtnText);
		}

		function setPaperTypeValues(data) {
			$('#form-paper-type input[name=photoart_paper_type]').val(data.paperType);
			$('#form-paper-type input[name=paper_type_id]').val(data.id);
			$('#form-paper-type input[name=form_action]').val(data.action);
			$('#form-paper-type input[name=submit]').val(adminScriptObj.updateBtnText);
		}

		function setPaperValues(data) {
			$('#form-paper input[name=photoart_paper]').val(data.paperName);
			$('#form-paper select[name=paper_type]').val(data.paperTypeId);
			$('#form-paper input[name=paper_id]').val(data.id);
			$('#form-paper input[name=form_action]').val(data.action);
			$('#form-paper input[name=submit]').val(adminScriptObj.updateBtnText);
		}

		function setFrameValues(data) {
			$('#form-framing input[name=frame_id]').val(data.id);
			$('#form-framing input[name=frame_name]').val(data.frame_name);
			checkFrameModules('form-framing', data.frame_material, 'photoart_frame_material');
			checkFrameModules('form-framing', data.fixture, 'photoart_fixture');
			checkFrameModules('form-framing', data.glass, 'photoart_glass');
			checkFrameModules('form-framing', data.window_mount, 'photoart_window_mount');
			checkFrameModules('form-framing', data.mount_board_size, 'photoart_mount_board_size');
			$('#form-framing input[name=form_action]').val(data.action);
			$('#form-framing input[name=submit]').val(adminScriptObj.updateBtnText);
		}

		function setFrameMaterialValues(data) {
			$('#form-frame-material input[name=material_id]').val(data.id);
			$('#form-frame-material input[name=material_name]').val(data.material_name);
			$('#form-frame-material input[name=selected_design]').val(data.design);
			checkFrameModules('form-frame-material', data.thin, 'photoart_frame_material_thin');
			checkFrameModules('form-frame-material', data.standard, 'photoart_frame_material_standard');
			checkFrameModules('form-frame-material', data.large, 'photoart_frame_material_large');
			checkFrameModules('form-frame-material', data.square, 'photoart_frame_material_square');
			$('#form-frame-material input[name=form_action]').val(data.action);
			$('#form-frame-material input[name=submit]').val(adminScriptObj.updateBtnText);
		}

		function setFixtureValues(data) {
			$('#form-fixture input[name=fixture_name]').val(data.fixtureName);
			$('#form-fixture input[name=selected_design]').val(data.design);
			$('#form-fixture input[name=fixture_id]').val(data.id);
			$('#form-fixture input[name=form_action]').val(data.action);
			$('#form-fixture input[name=submit]').val(adminScriptObj.updateBtnText);
		}

		function setGlassValues(data) {
			$('#form-glass input[name=glass_name]').val(data.glassName);
			$('#form-glass input[name=selected_design]').val(data.design);
			$('#form-glass input[name=glass_id]').val(data.id);
			$('#form-glass input[name=form_action]').val(data.action);
			$('#form-glass input[name=submit]').val(adminScriptObj.updateBtnText);
		}

		function setWindowMountValues(data) {
			$('#form-window-mount input[name=window_mount_name]').val(data.glassName);
			$('#form-window-mount input[name=color_code]').val(data.colorCode);
			$('#form-window-mount input[name=window_mount_id]').val(data.id);
			$('#form-window-mount input[name=form_action]').val(data.action);
			$('#form-window-mount input[name=submit]').val(adminScriptObj.updateBtnText);
		}

		function setSubstrateValues(data) {
			$('#form-substrate input[name=substrate_name]').val(data.substrateName);
			$('#form-substrate input[name=price]').val(data.price);
			$('#form-substrate input[name=substrate_id]').val(data.id);
			$('#form-substrate input[name=form_action]').val(data.action);
			$('#form-substrate input[name=submit]').val(adminScriptObj.updateBtnText);
		}

		$(document).on("click","#form-frame-material input[name=upload_design]",function() {
	    	openMediaModal($(this).closest('form')[0].id);
	   	});

	   	$(document).on("click","#form-fixture input[name=upload_design]",function() {
	    	openMediaModal($(this).closest('form')[0].id);
	   	});

	   	$(document).on("click","#form-glass input[name=upload_design]",function() {
	    	openMediaModal($(this).closest('form')[0].id);
	   	});

	   	$(document).on("click","#form-backgrounds input[name=upload_background]",function() {
	    	openMediaModal($(this).closest('form')[0].id);
	   	});

	   	function openMediaModal(form) {
	   		var file_frame = '', attachment = '';
	        if ( file_frame ) { file_frame.open(); return; }

	        file_frame = wp.media.frames.file_frame = wp.media({
	            title: $( this ).data( 'Select Item Images' ),
	            button: {
	                text: $( this ).data( 'Select Image' ),
	            },
	            library: {
			       	type: ['image']
			    },
	            multiple: false,
	        });

	        file_frame.on( 'select', function() {
	            attachment = file_frame.state().get('selection').first().toJSON();
				$(`#${form} input[name=selected_design]`).val(attachment.id);
				$(`#${form} input[name=upload_design]`).val('Selected');

				$(`#${form} input[name=selected_background]`).val(attachment.id);
				$(`#${form} input[name=upload_background]`).val('Selected');
	        });

	        file_frame.open();
	   	}
		
		function checkFrameModules(form, isEnabled, checkElement) {
			if(isEnabled == 'yes') { 
				$(`#${form} input[name=${checkElement}]`).prop('checked', true); 
			} else { 
				$(`#${form} input[name=${checkElement}]`).prop('checked', false); 
			}
		}

		function updateQueryStringParameter(uri, key, value) {
	      	var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
	      	var separator = uri.indexOf('?') !== -1 ? "&" : "?";
	      	if (uri.match(re)) {
	        	return uri.replace(re, '$1' + key + "=" + value + '$2');
	      	}
	      	else {
	        	return uri + separator + key + "=" + value;
	      	}
	    }		

	});

})( jQuery );
