/* global jQuery:false */
/* global TRX_ADDONS_STORAGE:false */

// Switch tabs content in the collection
jQuery(document).on('action.ready_trx_addons', function() {

	"use strict";
	
	// Tabs with side titles and effects
	jQuery('.sc_collection_tabs:not(.inited)')
		.addClass('inited')
		.on('click', '.sc_collection_tabs_list_item:not(.sc_collection_tabs_list_item_active)', function(e) {
			jQuery(this).siblings().removeClass('sc_collection_tabs_list_item_active');
			jQuery(this).addClass('sc_collection_tabs_list_item_active');
			var content = jQuery(this).parent().siblings('.sc_collection_tabs_content');
			var items = content.find('.sc_collection_item');
			content.find('.sc_collection_item_active').addClass('sc_collection_item_flip').removeClass('sc_collection_item_active');
			items.eq(jQuery(this).index()).addClass('sc_collection_item_active');
			setTimeout(function() {
				content.find('.sc_collection_item_flip').addClass('trx_addons_hidden').removeClass('sc_collection_item_flip');
				items.removeClass('sc_collection_item_flipping');
				setTimeout(function() {
					items.removeClass('trx_addons_hidden');
				}, 600);
			}, 600);
			// Patch for Webkit - after the middle motion add class 'flipping' to move active item above old item
			// Attention! Latest versions of Firefox also need this patch!
			if (true || /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor)) {
				setTimeout(function() {
					content.find('.sc_collection_item_active').addClass('sc_collection_item_flipping');
				}, 250);
			}
			e.preventDefault();
			return false;
		});

	// Simple Tabs with top titles and excerpt
	jQuery('.sc_collection_tabs_simple:not(.inited)')
		.addClass('inited')
		.on('click', '.sc_collection_tabs_list_item:not(.sc_collection_tabs_list_item_active)', function(e) {
			jQuery(this).siblings().removeClass('sc_collection_tabs_list_item_active');
			jQuery(this).addClass('sc_collection_tabs_list_item_active');
			var content = jQuery(this).parent().siblings('.sc_collection_tabs_content');
			var items = content.find('.sc_collection_tabs_content_item');
			content.find('.sc_collection_tabs_content_item_active').addClass('sc_collection_item_flip').removeClass('sc_collection_tabs_content_item_active');
			items.eq(jQuery(this).index()).addClass('sc_collection_tabs_content_item_active');
			setTimeout(function() {
				content.find('sc_collection_item_flip').removeClass('sc_collection_item_flip');
			}, 600);
			e.preventDefault();
			return false;
		});
});