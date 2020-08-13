(function( $ ) {
	'use strict'
	
	$(function() {

		$('.color-picker').wpColorPicker()
		$('body').removeClass('mobile')

		$( function() {
			$( "#sortable" ).sortable({
				handle: '.aio-contact-item-text',
				update: function( event, ui ) {
					let items = $( "#sortable" ).sortable( "toArray" )
					let items_id = []
					items.forEach(item => {
						if(item.replace('aio-contact-item-', ''))
						items_id.push(item.replace('aio-contact-item-', ''))
						if(item == items[items.length - 1]) {
							sortItems(items_id)
						}
					})
				}
			  })
			$( "#sortable" ).disableSelection()
		} )

		function sortItems(items_id) {
			let items = JSON.parse(document.getElementById('aio-contact-items').innerHTML)
			let sorted_items = []
			items_id.forEach(item_id => {
				sorted_items.push(items[item_id])
				if(item_id == items_id[items_id.length - 1]) {
					document.getElementById('aio-contact-items').innerHTML = JSON.stringify(sorted_items)
					$('#aio-contact-save-items').trigger( "click" )
				}
			})
		}

		$(document.body).on('click', '.aio-contact-item-add-trigger', (e) => {
			$('#itemOptions').modal('hide')
			$('.aio_contact_custom_fields').hide()
			$(`#aio_field`).show()
			$('#item_modal_title').html('New Item')
			$('#item_modal_action').html('Add Item')
			$('#item_icon').iconpicker()
			$('#item_icon').iconpicker('setIcon', 'empty')
			$('#addEditItem').modal('show')
			$('#addEditItem').on('shown.bs.modal', function () {
				$(document).off('focusin.modal')
				$('#item_title').trigger('focus')
			})
			$('#addEditItem').on('hide.bs.modal', function () {
				$('#addEditItem .wp-picker-clear').trigger('click')
			})
		})

		$(document.body).on('click', '.aio-contact-item-action-edit', (e) => {
			let items = JSON.parse(document.getElementById('aio-contact-items').innerHTML)
			let item = items[$(e.currentTarget).attr('data-id')]
			$('#item_modal_title').html(`${item.title} - Edit`)
			$('#item_modal_action').html('Edit Item')
			$('#item_modal_action').attr('data-id', $(e.currentTarget).attr('data-id'))

			$('.aio_contact_custom_fields').hide()
			$(`#aio_field`).show()

			//Setting values of Modal - Items
			$('#item_title').val(item.title)
			$('#item_icon').iconpicker()
			$('#item_icon').iconpicker('setIcon', item.icon)
			$('#item_color').wpColorPicker('color', item.color)
			$('#item_url').val(item.url)

			$('#addEditItem').modal('show')
			$('#addEditItem').on('shown.bs.modal', function () {
				$(document).off('focusin.modal')
				$('#item_title').trigger('focus')
			})
			$('#addEditItem').on('hide.bs.modal', function () {
				$('#addEditItem .wp-picker-clear').trigger('click')
				$('#item_modal_action').removeAttr('data-id')
			})
		})

	})

})( jQuery )
