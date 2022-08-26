/* global jQuery:false */
/* global CLOTHING69_STORAGE:false */

jQuery(document).ready(function() {
	"use strict";

	var theme_init_counter = 0;
	var vc_resize = false;
	
	clothing69_init_actions();

	// Theme init actions
	function clothing69_init_actions() {

		if (CLOTHING69_STORAGE['vc_edit_mode'] && jQuery('.vc_empty-placeholder').length==0 && theme_init_counter++ < 30) {
			setTimeout(clothing69_init_actions, 200);
			return;
		}
	
		// Add resize on VC action vc-full-width-row
		// But we emulate 'action.resize_vc_row_start' and 'action.resize_vc_row_end'
		// to correct resize sliders and video inside 'boxed' pages
		jQuery(document).on('action.resize_vc_row_start', function(e, el) {
			vc_resize = true;
			clothing69_resize_actions();
		});
		
		// Check fullheight elements
		jQuery(document).on('action.init_hidden_elements', clothing69_stretch_height);
		jQuery(document).on('action.init_shortcodes', clothing69_stretch_height);
	
		// Resize handlers
		jQuery(window).resize(function() {
			if (!vc_resize) clothing69_resize_actions();
		});
		
		// Scroll handlers
		jQuery(window).scroll(function() {
			clothing69_scroll_actions();
		});
		
		// First call to init core actions
		clothing69_ready_actions();
		// Wait for VC init
		setTimeout(function() {
			if (!vc_resize) clothing69_resize_actions();
			clothing69_scroll_actions();
		}, 1);
	}
	
	
	
	// Theme first load actions
	//==============================================
	function clothing69_ready_actions() {
	
		// Add scheme class and js support
		//------------------------------------
		document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/,'js');
		if (document.documentElement.className.indexOf(CLOTHING69_STORAGE['site_scheme'])==-1)
			document.documentElement.className += ' ' + CLOTHING69_STORAGE['site_scheme'];

		// Init background video
		//------------------------------------
		// Use Bideo to play local video
		if (CLOTHING69_STORAGE['background_video'] && jQuery('.top_panel.with_bg_video').length > 0 && window.Bideo) {
			// Waiting 10ms after mejs init
			setTimeout(function() {
				jQuery('.top_panel.with_bg_video').prepend('<video id="background_video" loop muted></video>');
				var bv = new Bideo();
				bv.init({
					// Video element
					videoEl: document.querySelector('#background_video'),
					
					// Container element
					container: document.querySelector('.top_panel'),
					
					// Resize
					resize: true,
					
					// autoplay: false,
					
					isMobile: window.matchMedia('(max-width: 768px)').matches,
					
					playButton: document.querySelector('#background_video_play'),
					pauseButton: document.querySelector('#background_video_pause'),
					
					// Array of objects containing the src and type
					// of different video formats to add
					// For example:
					//	src: [
					//			{	src: 'night.mp4', type: 'video/mp4' }
					//			{	src: 'night.webm', type: 'video/webm;codecs="vp8, vorbis"' }
					//		]
					src: [
						{
							src: CLOTHING69_STORAGE['background_video'],
							type: 'video/'+clothing69_get_file_ext(CLOTHING69_STORAGE['background_video'])
						}
					],
					
				});
			}, 10);
		
		// Use Tubular to play video from Youtube
		} else if (jQuery.fn.tubular) {
			jQuery('div#background_video').each(function() {
				var youtube_code = jQuery(this).data('youtube-code');
				if (youtube_code) {
					jQuery(this).tubular({videoId: youtube_code});
					jQuery('#tubular-player').appendTo(jQuery(this)).show();
					jQuery('#tubular-container,#tubular-shield').remove();
				}
			});
		}
	
		// Tabs
		//------------------------------------
		if (jQuery('.clothing69_tabs:not(.inited)').length > 0 && jQuery.ui && jQuery.ui.tabs) {
			jQuery('.clothing69_tabs:not(.inited)').each(function () {
				// Get initially opened tab
				var init = jQuery(this).data('active');
				if (isNaN(init)) {
					init = 0;
					var active = jQuery(this).find('> ul > li[data-active="true"]').eq(0);
					if (active.length > 0) {
						init = active.index();
						if (isNaN(init) || init < 0) init = 0;
					}
				} else {
					init = Math.max(0, init);
				}
				// Init tabs
				jQuery(this).addClass('inited').tabs({
					active: init,
					show: {
						effect: 'fadeIn',
						duration: 300
					},
					hide: {
						effect: 'fadeOut',
						duration: 300
					},
					create: function( event, ui ) {
						if (ui.panel.length > 0) jQuery(document).trigger('action.init_hidden_elements', [ui.panel]);
					},
					activate: function( event, ui ) {
						if (ui.newPanel.length > 0) jQuery(document).trigger('action.init_hidden_elements', [ui.newPanel]);
					}
				});
			});
		}
		// AJAX loader for the tabs
		jQuery('.clothing69_tabs_ajax').on( "tabsbeforeactivate", function( event, ui ) {
			if (ui.newPanel.data('need-content')) clothing69_tabs_ajax_content_loader(ui.newPanel, 1, ui.oldPanel);
		});
		// AJAX loader for the pages in the tabs
		jQuery('.clothing69_tabs_ajax').on( "click", '.nav-links a', function(e) {
			var panel = jQuery(this).parents('.clothing69_tabs_content');
			var page = 1;
			var href = jQuery(this).attr('href');
			var pos = -1;
			if ((pos = href.lastIndexOf('/page/')) != -1 ) {
				page = Number(href.substr(pos+6).replace("/", ""));
				if (!isNaN(page)) page = Math.max(1, page);
			}
			clothing69_tabs_ajax_content_loader(panel, page);
			e.preventDefault();
			return false;
		});
	
		
		// Headers
		//----------------------------------------------
	
		var rows = jQuery('.clothing69_layouts_row_fixed');
		
		// If page contain fixed rows
		if (rows.length > 0) {
			
			// Add placeholders before each row
			rows.each(function() {
				if (!jQuery(this).next().hasClass('clothing69_layouts_row_fixed_placeholder'))
					jQuery(this).after('<div class="clothing69_layouts_row_fixed_placeholder"></div>');
			});
	
			jQuery(document).on('action.scroll_clothing69', function() {
				clothing69_fix_header(rows, false);
			});
			jQuery(document).on('action.resize_clothing69', function() {
				clothing69_fix_header(rows, true);
			});
		}
	
		// Menu
		//----------------------------------------------
	
		// Add TOC in the side menu
		if (jQuery('.menu_side_inner').length > 0 && jQuery('#toc_menu').length > 0)
			jQuery('#toc_menu').appendTo('.menu_side_inner');
	
		// Open/Close side menu
		jQuery('.menu_side_button').on('click', function(e){
			jQuery(this).parent().toggleClass('opened');
			e.preventDefault();
			return false;
		});
	
	
		// Add arrows to the mobile menu
		jQuery('.menu_mobile .menu-item-has-children > a').append('<span class="open_child_menu"></span>');
	
		// Open/Close mobile menu
		jQuery('.sc_layouts_menu_mobile_button > a,.menu_mobile_button,.menu_mobile_description').on('click', function(e) {
			if (jQuery(this).parent().hasClass('sc_layouts_menu_mobile_button_burger') && jQuery(this).next().hasClass('sc_layouts_menu_popup')) return;
			jQuery('.menu_mobile_overlay').fadeIn();
			jQuery('.menu_mobile').addClass('opened');
			jQuery(document).trigger('action.stop_wheel_handlers');
			e.preventDefault();
			return false;
		});
		jQuery(document).on('keypress', function(e) {
		"use strict";
			if (e.keyCode == 27) {
				if (jQuery('.menu_mobile.opened').length == 1) {
					jQuery('.menu_mobile_overlay').fadeOut();
					jQuery('.menu_mobile').removeClass('opened');
					jQuery(document).trigger('action.start_wheel_handlers');
					e.preventDefault();
					return false;
				}
			}
		});;
		jQuery('.menu_mobile_close, .menu_mobile_overlay').on('click', function(e){
		"use strict";
			jQuery('.menu_mobile_overlay').fadeOut();
			jQuery('.menu_mobile').removeClass('opened');
			jQuery(document).trigger('action.start_wheel_handlers');
			e.preventDefault();
			return false;
		});
	
		// Open/Close mobile submenu
		jQuery('.menu_mobile').on('click', 'li a, li a .open_child_menu', function(e) {
		"use strict";
			var $a = jQuery(this).hasClass('open_child_menu') ? jQuery(this).parent() : jQuery(this);
			if ($a.parent().hasClass('menu-item-has-children')) {
				if ($a.attr('href')=='#' || jQuery(this).hasClass('open_child_menu')) {
					if ($a.siblings('ul:visible').length > 0)
						$a.siblings('ul').slideUp().parent().removeClass('opened');
					else {
						jQuery(this).parents('li').siblings('li').find('ul:visible').slideUp().parent().removeClass('opened');
						$a.siblings('ul').slideDown().parent().addClass('opened');
					}
				}
			}
			if (!jQuery(this).hasClass('open_child_menu') && clothing69_is_local_link($a.attr('href')))
				jQuery('.menu_mobile_close').trigger('click');
			if (jQuery(this).hasClass('open_child_menu') || $a.attr('href')=='#') {
				e.preventDefault();
				return false;
			}
		});
	
		if (!CLOTHING69_STORAGE['trx_addons_exist'] || jQuery('.top_panel.top_panel_default .sc_layouts_menu_default').length > 0) {
			// Init superfish menus
			clothing69_init_sfmenu('.sc_layouts_menu:not(.inited) > ul:not(.inited)');
			// Show menu		
			jQuery('.sc_layouts_menu:not(.inited)').each(function() {
				if (jQuery(this).find('>ul.inited').length == 1) jQuery(this).addClass('inited');
			});
		}

		
		// Forms
		//----------------------------------------------
	
		// Wrap select with .select_container
		jQuery('select:not(#billing_state):not(#shipping_state):not(.esg-sorting-select):not(#billing_country):not(#shipping_country):not([class*="trx_addons_attrib_"])').each(function() {
			var s = jQuery(this);
			if (s.css('display') != 'none')
				s.wrap('<div class="select_container"></div>');
				// Bubble submit() up for widget "Categories"
				if ( s.parents( '.widget_categories' ).length > 0 ) {
					s.parent().get(0).submit = function() {
						jQuery(this).closest('form').submit();
					};
				}
		});
	
		// Comment form
		jQuery("form#commentform").submit(function(e) {
			var rez = clothing69_comments_validate(jQuery(this));
			if (!rez)
				e.preventDefault();
			return rez;
		});
	
		jQuery("form").on('keypress', '.error_field', function() {
			if (jQuery(this).val() != '')
				jQuery(this).removeClass('error_field');
		});
	
	
		// WooCommerce
		//----------------------------------------------
	
		// Change display mode
		jQuery('.woocommerce,.woocommerce-page').on('click', '.clothing69_shop_mode_buttons a', function(e) {
			var mode = jQuery(this).hasClass('woocommerce_thumbs') ? 'thumbs' : 'list';
			clothing69_set_cookie('clothing69_shop_mode', mode, 365);
			jQuery(this).siblings('input').val(mode).parents('form').get(0).submit();
			e.preventDefault();
			return false;
		});

		// Increment arrows on number input
		clothing69_wooc_style_arrows();
		jQuery( document.body ).on( 'updated_cart_totals', function () {
			clothing69_wooc_style_arrows();
		});

		// Make buttons from links
		var wishlist = jQuery('.woocommerce .product .yith-wcwl-add-to-wishlist');
		if (wishlist.length > 0) {
			wishlist.find('.add_to_wishlist').addClass('button');
			if (jQuery('.woocommerce .product .compare').length > 0) jQuery('.woocommerce .product .compare').insertBefore(wishlist);
		}
		// Add stretch behaviour to WooC tabs area
		jQuery('.single-product .woocommerce-tabs').wrap('<div class="trx-stretch-width"></div>');
		jQuery('.trx-stretch-width').wrap('<div class="trx-stretch-width-wrap scheme_default"></div>');
		jQuery('.trx-stretch-width').after('<div class="trx-stretch-width-original"></div>');
		clothing69_stretch_width();
			
	
		// Pagination
		//------------------------------------
	
		// Load more
		jQuery('.nav-links-more a').on('click', function(e) {
		"use strict";
		if (LAUNDRYCITY_STORAGE['load_more_link_busy']) return;
		LAUNDRYCITY_STORAGE['load_more_link_busy'] = true;
			var more = jQuery(this);
			var page = Number(more.data('page'));
			var max_page = Number(more.data('max-page'));
			if (page >= max_page) {
				more.parent().hide();
				return;
			}
			more.parent().addClass('loading');
			var panel = more.parents('.clothing69_tabs_content');
			if (panel.length == 0) {															// Load simple page content
				jQuery.get(location.href, {
					paged: page+1
				}).done(function(response) {
					// Get inline styles and add to the page styles
					var selector = 'clothing69-inline-styles-inline-css';
					var p1 = response.indexOf(selector);
					if (p1 < 0) {
						selector = 'trx_addons-inline-styles-inline-css';
						p1 = response.indexOf(selector);
					}
					if (p1 > 0) {
						p1 = response.indexOf('>', p1) + 1;
						var p2 = response.indexOf('</style>', p1);
						var inline_css_add = response.substring(p1, p2);
						var inline_css = jQuery('#'+selector);
						if (inline_css.length == 0)
							jQuery('body').append('<style id="'+selector+'" type="text/css">' + inline_css_add + '</style>');
						else
							inline_css.append(inline_css_add);
					}
					// Get new posts and append to the .posts_container
					clothing69_loadmore_add_items(jQuery('.content .posts_container').eq(0),
											   jQuery(response).find('.content .posts_container > article,'
											   						+'.content .posts_container > div[class*="column-"],'
																	+'.content .posts_container > .masonry_item')
												);
				});
			} else {																			// Load tab's panel content
				jQuery.post(CLOTHING69_STORAGE['ajax_url'], {
					nonce: CLOTHING69_STORAGE['ajax_nonce'],
					action: 'clothing69_ajax_get_posts',
					blog_template: panel.data('blog-template'),
					blog_style: panel.data('blog-style'),
					posts_per_page: panel.data('posts-per-page'),
					cat: panel.data('cat'),
					parent_cat: panel.data('parent-cat'),
					post_type: panel.data('post-type'),
					taxonomy: panel.data('taxonomy'),
					page: page+1
				}).done(function(response) {
					var rez = {};
					try {
						rez = JSON.parse(response);
					} catch (e) {
						rez = { error: CLOTHING69_STORAGE['strings']['ajax_error'] };
						console.log(response);
					}
					if (rez.error !== '') {
						panel.html('<div class="clothing69_error">'+rez.error+'</div>');
					} else {
						clothing69_loadmore_add_items(panel.find('.posts_container'), jQuery(rez.data).find('article'));
					}
				});
			}
			// Append items to the container
			function clothing69_loadmore_add_items(container, items) {
				if (container.length > 0 && items.length > 0) {
					container.append(items);
					if (container.hasClass('portfolio_wrap') || container.hasClass('masonry_wrap')) {
						container.masonry( 'appended', items );
						if (container.hasClass('gallery_wrap')) {
							CLOTHING69_STORAGE['GalleryFx'][container.attr('id')].appendItems();
						}
					}
					more.data('page', page+1).parent().removeClass('loading');
					// Remove TOC if exists (rebuild on init_shortcodes)
					jQuery('#toc_menu').remove();
					// Trigger actions to init new elements
					CLOTHING69_STORAGE['init_all_mediaelements'] = true;
					jQuery(document).trigger('action.init_shortcodes', [container.parent()]);
					jQuery(document).trigger('action.init_hidden_elements', [container.parent()]);
				}
				if (page+1 >= max_page)
					more.parent().hide();
				else
					CLOTHING69_STORAGE['load_more_link_busy'] = false;
				// Fire 'window.scroll' after clearing busy state
				jQuery( window ).trigger( 'scroll' );
				// Fire 'window.resize'
				jQuery( window ).trigger( 'resize' );
			}
			e.preventDefault();
			return false;
		});


		// Checkbox with "I agree..."
		if (jQuery('input[type="checkbox"][name="i_agree_privacy_policy"]:not(.inited),input[type="checkbox"][name="gdpr_terms"]:not(.inited),input[type="checkbox"][name="wpgdprc"]:not(.inited),#wpmtst-form input[type="checkbox"]:not(.inited),input[type="checkbox"][name="AGREE_TO_TERMS"]:not(.inited)').length > 0) {
			jQuery('input[type="checkbox"][name="i_agree_privacy_policy"]:not(.inited),input[type="checkbox"][name="gdpr_terms"]:not(.inited),input[type="checkbox"][name="wpgdprc"]:not(.inited),#wpmtst-form input[type="checkbox"]:not(.inited),input[type="checkbox"][name="AGREE_TO_TERMS"]:not(.inited)')
				.addClass('inited')
				.on('change', function(e) {
					if (jQuery(this).get(0).checked)
						jQuery(this).parents('form').find('button,input[type="submit"]').removeAttr('disabled');
					else
						jQuery(this).parents('form').find('button,input[type="submit"]').attr('disabled', 'disabled');
				}).trigger('change');
		}

		// CF7 checkboxes - add class to correct check/uncheck pseudoelement when input at right side of the label
		jQuery( '.wpcf7-checkbox > .wpcf7-list-item > .wpcf7-list-item-label,.wpcf7-radio > .wpcf7-list-item > .wpcf7-list-item-label,.wpcf7-wpgdprc > .wpcf7-list-item > .wpcf7-list-item-label' ).on(
			'click', function() {
				var chk = jQuery( this ).siblings( 'input[type="checkbox"],input[type="radio"]' );
				if (chk.attr( 'type' ) == 'radio') {
					jQuery( this ).parents( '.wpcf7-radio' )
						.find( '.wpcf7-list-item-label' ).removeClass( 'wpcf7-list-item-checked' )
						.find( 'input[type="radio"]' ).each(
						function(){
							this.checked = false;
						}
					);
				}
				if (chk.length > 0) {
					chk.get( 0 ).checked = chk.get( 0 ).checked ? false : true;
					jQuery( this ).toggleClass( 'wpcf7-list-item-checked', chk.get( 0 ).checked );
					chk.trigger('change');
				}
			}
		);

	
		// Infinite scroll
		jQuery(document).on('action.scroll_clothing69', function(e) {
			if (CLOTHING69_STORAGE['load_more_link_busy']) return;
			var container = jQuery('.content > .posts_container').eq(0);
			var inf = jQuery('.nav-links-infinite');
			if (inf.length == 0) return;
			if (container.offset().top + container.height() < jQuery(window).scrollTop() + jQuery(window).height()*1.5)
				inf.find('a').trigger('click');
		});
			
	
		// Other settings
		//------------------------------------
	
		jQuery(document).trigger('action.ready_clothing69');
	
		// Init post format specific scripts
		jQuery(document).on('action.init_hidden_elements', clothing69_init_post_formats);
	
		// Init hidden elements (if exists)
		jQuery(document).trigger('action.init_hidden_elements', [jQuery('body').eq(0)]);

		jQuery(document).on('afterAjaxSuccess.tribeEvents', function(){
			jQuery(document).trigger('action.init_hidden_elements', [jQuery('body').eq(0)]);
		});
		
	} //end ready
	
	
	// Scroll actions
	//==============================================
	
	// Do actions when page scrolled
	function clothing69_scroll_actions() {
	
		var scroll_offset = jQuery(window).scrollTop();
		var adminbar_height = Math.max(0, jQuery('#wpadminbar').height());
	
		// Call theme/plugins specific action (if exists)
		//----------------------------------------------
		jQuery(document).trigger('action.scroll_clothing69');
		
		// Fix/unfix sidebar
		clothing69_fix_sidebar();
	
		// Shift top and footer panels when header position equal to 'Under content'
		if (jQuery('body').hasClass('header_position_under') && !clothing69_browser_is_mobile()) {
			var delta = 50;
			var adminbar = jQuery('#wpadminbar');
			var adminbar_height = adminbar.length == 0 && adminbar.css('position') == 'fixed' ? 0 : adminbar.height();
			var header = jQuery('.top_panel');
			var header_height = header.height();
			var mask = header.find('.top_panel_mask');
			if (mask.length==0) {
				header.append('<div class="top_panel_mask"></div>');
				mask = header.find('.top_panel_mask');
			}
			if (scroll_offset > adminbar_height) {
				var offset = scroll_offset - adminbar_height;
				if (offset <= header_height) {
					var mask_opacity = Math.max(0, Math.min(0.8, (offset-delta)/header_height));
					// Don't shift header with Revolution slider in Chrome
					if ( !(/Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor)) || header.find('.slider_engine_revo').length == 0 )
						header.css('top', Math.round(offset/1.2)+'px');
					mask.css({
						'opacity': mask_opacity,
						'display': offset==0 ? 'none' : 'block'
					});
				} else if (parseInt(header.css('top')) != 0) {
					header.css('top', Math.round(offset/1.2)+'px');
				}
			} else if (parseInt(header.css('top')) != 0 || mask.css('display')!='none') {
				header.css('top', '0px');
				mask.css({
					'opacity': 0,
					'display': 'none'
				});
			}
			var footer = jQuery('.footer_wrap');
			var footer_height = Math.min(footer.height(), jQuery(window).height());
			var footer_visible = (scroll_offset + jQuery(window).height()) - (header.outerHeight() + jQuery('.page_content_wrap').outerHeight());
			if (footer_visible > 0) {
				mask = footer.find('.top_panel_mask');
				if (mask.length==0) {
					footer.append('<div class="top_panel_mask"></div>');
					mask = footer.find('.top_panel_mask');
				}
				if (footer_visible <= footer_height) {
					var mask_opacity = Math.max(0, Math.min(0.8, (footer_height - footer_visible)/footer_height));
					// Don't shift header with Revolution slider in Chrome
					if ( !(/Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor)) || footer.find('.slider_engine_revo').length == 0 )
						footer.css('top', -Math.round((footer_height - footer_visible)/1.2)+'px');
					mask.css({
						'opacity': mask_opacity,
						'display': footer_height - footer_visible <= 0 ? 'none' : 'block'
					});
				} else if (parseInt(footer.css('top')) != 0 || mask.css('display')!='none') {
					footer.css('top', 0);
					mask.css({
						'opacity': 0,
						'display': 'none'
					});
				}
			}
		}
	}
	
	
	// Resize actions
	//==============================================
	
	// Do actions when page scrolled
	function clothing69_resize_actions(cont) {
		clothing69_check_layout();
		clothing69_fix_sidebar();
		clothing69_fix_footer();
		clothing69_stretch_width(cont);
		clothing69_stretch_height(null, cont);
		clothing69_stretch_bg_video();
                clothing69_resize_video( cont );
		clothing69_vc_row_fullwidth_to_boxed(cont);
		if (CLOTHING69_STORAGE['menu_side_stretch']) clothing69_stretch_sidemenu();
	
		// Call theme/plugins specific action (if exists)
		//----------------------------------------------
		jQuery(document).trigger('action.resize_clothing69', [cont]);
	}
	
	// Stretch sidemenu (if present)
	function clothing69_stretch_sidemenu() {
		var toc_items = jQuery('.menu_side_wrap .toc_menu_item');
		if (toc_items.length < 5) return;
		var toc_items_height = jQuery(window).height() - jQuery('.menu_side_wrap .sc_layouts_logo').outerHeight() - toc_items.length;
		var th = Math.floor(toc_items_height / toc_items.length);
		var th_add = toc_items_height - th*toc_items.length;
		toc_items.find(".toc_menu_description,.toc_menu_icon").css({
			'height': th+'px',
			'lineHeight': th+'px'
		});
		toc_items.eq(0).find(".toc_menu_description,.toc_menu_icon").css({
			'height': (th+th_add)+'px',
			'lineHeight': (th+th_add)+'px'
		});
	}
	
	// Check for mobile layout
	function clothing69_check_layout() {
		if (jQuery('body').hasClass('no_layout'))
			jQuery('body').removeClass('no_layout');
		var w = window.innerWidth;
		if (w == undefined) 
			w = jQuery(window).width()+(jQuery(window).height() < jQuery(document).height() || jQuery(window).scrollTop() > 0 ? 16 : 0);
		if (CLOTHING69_STORAGE['mobile_layout_width'] >= w) {
			if (!jQuery('body').hasClass('mobile_layout')) {
				jQuery('body').removeClass('desktop_layout').addClass('mobile_layout');
			}
		} else {
			if (!jQuery('body').hasClass('desktop_layout')) {
				jQuery('body').removeClass('mobile_layout').addClass('desktop_layout');
				jQuery('.menu_mobile').removeClass('opened');
				jQuery('.menu_mobile_overlay').hide();
			}
		}
		if (CLOTHING69_STORAGE['mobile_device'] || clothing69_browser_is_mobile()) 
			jQuery('body').addClass('mobile_device');
	}
	
	// Stretch area to full window width
	function clothing69_stretch_width(cont) {
		if (cont===undefined) cont = jQuery('body');
		cont.find('.trx-stretch-width').each(function() {
			var $el = jQuery(this);
			var $el_cont = $el.parents('.page_wrap');
			var $el_cont_offset = 0;
			if ($el_cont.length == 0) 
				$el_cont = jQuery(window);
			else
				$el_cont_offset = $el_cont.offset().left;
			var $el_full = $el.next('.trx-stretch-width-original');
			var el_margin_left = parseInt( $el.css( 'margin-left' ), 10 );
			var el_margin_right = parseInt( $el.css( 'margin-right' ), 10 );
			var offset = $el_cont_offset - $el_full.offset().left - el_margin_left;
			var width = $el_cont.width();
			if (!$el.hasClass('inited')) {
				$el.addClass('inited invisible');
				$el.css({
					'position': 'relative',
					'box-sizing': 'border-box'
				});
			}
			$el.css({
				'left': offset,
				'width': $el_cont.width()
			});
			if ( !$el.hasClass('trx-stretch-content') ) {
				var padding = Math.max(0, -1*offset);
				var paddingRight = Math.max(0, width - padding - $el_full.width() + el_margin_left + el_margin_right);
				$el.css( { 'padding-left': padding + 'px', 'padding-right': paddingRight + 'px' } );
			}
			$el.removeClass('invisible');
		});
	}
	
	// Stretch area to the full window height
	function clothing69_stretch_height(e, cont) {
		if (cont===undefined) cont = jQuery('body');
		cont.find('.trx-stretch-height').each(function () {
			var fullheight_item = jQuery(this);
			// If item now invisible
			if (jQuery(this).parents('div:hidden,section:hidden,article:hidden').length > 0) {
				return;
			}
			var wh = 0;
			var fullheight_row = jQuery(this).parents('.vc_row-o-full-height');
			if (fullheight_row.length > 0) {
				wh = fullheight_row.height();
			} else {
				if (screen.width > 1000) {
					var adminbar = jQuery('#wpadminbar');
					wh = jQuery(window).height() - (adminbar.length > 0 ? adminbar.height() : 0);
				} else
					wh = 'auto';
			}
			if (wh=='auto' || wh > 0) fullheight_item.height(wh);
		});
	}
	
	// Stretch background video
	function clothing69_stretch_bg_video() {
		var video_wrap = jQuery('div#background_video');
		if (video_wrap.length == 0) return;
		var video = video_wrap.find('>iframe,>video'),
			w = video_wrap.width(),
			h = video_wrap.height();
		if (w/h < 16/9)
			w = h/9*16;
		else
			h = w/16*9;
		video
			.attr({'width': w, 'height': h})
			.css({'width': w, 'height': h});
	}
		
	// Recalculate width of the vc_row[data-vc-full-width="true"] when content boxed or menu_style=='left|right'
	function clothing69_vc_row_fullwidth_to_boxed(row) {
		if (jQuery('body').hasClass('body_style_boxed') || jQuery('body').hasClass('menu_style_side')) {
			if (row === undefined) row = jQuery('.vc_row[data-vc-full-width="true"]');
			var width_content = jQuery('.page_wrap').width();
			var width_content_wrap = jQuery('.page_content_wrap  .content_wrap').width();
			var indent = ( width_content - width_content_wrap ) / 2;
			var rtl = jQuery('html').attr('dir') == 'rtl';
			row.each( function() {
				var mrg = parseInt(jQuery(this).css('marginLeft'));
				jQuery(this).css({
					'width': width_content,
					'left': rtl ? 'auto' : -indent-mrg,
					'right': rtl ? -indent-mrg : 'auto',
					'padding-left': indent+mrg,
					'padding-right': indent+mrg
				});
				if (jQuery(this).attr('data-vc-stretch-content')) {
					jQuery(this).css({
						'padding-left': 0,
						'padding-right': 0
					});
				}
			});
		} else {

            if (row === undefined) row = jQuery('.vc_row[data-vc-full-width="true"]');
            var width_content = jQuery('.body_wrap').width();
            var width_content_wrap = jQuery('.page_content_wrap  .content_wrap').width();
            var indent = ( width_content - width_content_wrap ) / 2;
            var rtl = jQuery('html').attr('dir') == 'rtl';
            row.each( function() {
                var mrg = parseInt(jQuery(this).css('marginLeft'));
                jQuery(this).css({
                    'width': width_content,
                    'left': rtl ? 'auto' : -indent-mrg,
                    'right': rtl ? -indent-mrg : 'auto',
                    'padding-left': indent+mrg,
                    'padding-right': indent+mrg
                });
                if (jQuery(this).attr('data-vc-stretch-content')) {
                    jQuery(this).css({
                        'padding-left': 0,
                        'padding-right': 0
                    });
                }
            });

        }
	}
	
	
	// Fix/unfix header
	function clothing69_fix_header(rows, resize) {
		if (jQuery(window).width() <= 800) {
			rows.removeClass('clothing69_layouts_row_fixed_on').css({'top': 'auto'});
			return;
		}
		var scroll_offset = jQuery(window).scrollTop();
		var admin_bar = jQuery('#wpadminbar');
		var rows_offset = Math.max(0, admin_bar.length > 0 && admin_bar.css('position')=='fixed' ? admin_bar.height() : 0);
		
		rows.each(function() {
			var placeholder = jQuery(this).next();
			var offset = parseInt(jQuery(this).hasClass('clothing69_layouts_row_fixed_on') ? placeholder.offset().top : jQuery(this).offset().top);
			if (isNaN(offset)) offset = 0;
	
			// Fix/unfix row
			if (scroll_offset + rows_offset <= offset) {
				if (jQuery(this).hasClass('clothing69_layouts_row_fixed_on')) {
					jQuery(this).removeClass('clothing69_layouts_row_fixed_on').css({'top': 'auto'});
				}
			} else {
				var h = jQuery(this).outerHeight();
				if (!jQuery(this).hasClass('clothing69_layouts_row_fixed_on')) {
					if (rows_offset + h < jQuery(window).height() * 0.33) {
						placeholder.height(h);
						jQuery(this).addClass('clothing69_layouts_row_fixed_on').css({'top': rows_offset+'px'});
						h = jQuery(this).outerHeight();
					}
				} else if (resize && jQuery(this).hasClass('clothing69_layouts_row_fixed_on') && jQuery(this).offset().top != rows_offset) {
					jQuery(this).css({'top': rows_offset+'px'});
				}
				rows_offset += h;
			}
		});
	}
	
	
	// Fix/unfix footer
	function clothing69_fix_footer() {
		if (jQuery('body').hasClass('header_position_under') && !clothing69_browser_is_mobile()) {
			var ft = jQuery('.footer_wrap');
			if (ft.length > 0) {
				var ft_height = ft.outerHeight(false),
					pc = jQuery('.page_content_wrap'),
					pc_offset = pc.offset().top,
					pc_height = pc.height();
				if (pc_offset + pc_height + ft_height < jQuery(window).height()) {
					if (ft.css('position')!='absolute') {
						ft.css({
							'position': 'absolute',
							'left': 0,
							'bottom': 0,
							'width' :'100%'
						});
					}
				} else {
					if (ft.css('position')!='relative') {
						ft.css({
							'position': 'relative',
							'left': 'auto',
							'bottom': 'auto'
						});
					}
				}
			}
		}
	}
	
	
	// Fix/unfix sidebar
	function clothing69_fix_sidebar() {
		var sb = jQuery('.sidebar');
		var content = sb.siblings('.content');
		if (sb.length > 0) {
	
			// Unfix when sidebar is under content
			if (content.css('float') == 'none') {
				if (sb.css('position')!='static') {
					sb.css({
						'float': sb.hasClass('right') ? 'right' : 'left',
						'position': 'static'
					});
				}
	
			} else {
	
				var sb_height = sb.outerHeight();
				var content_height = content.outerHeight();
				var content_top = content.offset().top;
				var scroll_offset = jQuery(window).scrollTop();
				var top_panel_fixed_height = jQuery('.top_panel').length > 0 ? jQuery('.top_panel').outerHeight() : 0;
				if (jQuery('.sc_layouts_row_fixed_on').length > 0) {
					top_panel_fixed_height = 0;
					jQuery('.sc_layouts_row_fixed_on').each(function() {
						top_panel_fixed_height += jQuery(this).outerHeight();
					});
				}
	
				if (sb_height < content_height && 
					( (sb_height >= jQuery(window).height() && scroll_offset + jQuery(window).height() >= sb_height+30+content_top)
					  ||
					  (sb_height < jQuery(window).height() && scroll_offset >= content_top)
					)
				) {
					
					var sb_init = {
							'float': 'none',
							'position': 'fixed',
							'top': 'auto',
							'bottom' : 'auto'
							};
					
					// Fix when sidebar bottom appear
					if (sb.css('position')!=='fixed') {
						if (sb_height + 30 >= jQuery(window).height() - top_panel_fixed_height)
							sb_init.bottom = 30;
						else
							sb_init.top = top_panel_fixed_height;
					}
					
					// Detect horizontal position when resize
					var pos = jQuery('.page_content_wrap .content_wrap').position();
					pos = pos.left + Math.max(0, parseInt(jQuery('.page_content_wrap .content_wrap').css('paddingLeft'))) 
									+ Math.max(0, parseInt(jQuery('.page_content_wrap .content_wrap').css('marginLeft')));
					if (sb.hasClass('right'))
						sb_init.right = pos;
					else
						sb_init.left = pos;
					
					// Shift to top when footer appear
					var footer_top = 0;
					var footer_pos = jQuery('.footer_wrap').position();
					var widgets_below_page_pos = jQuery('.widgets_below_page_wrap').position();
					if (widgets_below_page_pos)
						footer_top = widgets_below_page_pos.top;
					else if (footer_pos)
						footer_top = footer_pos.top;
					if (footer_top > 0 && scroll_offset + jQuery(window).height() >= footer_top + 30) {
						sb_init.position = 'absolute';
						if (sb.hasClass('right'))
							sb_init.right = 0;
						else
							sb_init.left = 0;
						sb_init.bottom = 'auto';
						sb_init.top = (jQuery('.page_content_wrap .content_wrap').height() - sb_height) + 'px';
					}
					
					// Set position
					if (sb.css('position')!=sb_init.position)
						sb.css(sb_init);
	
				} else {
	
					// Unfix when page scrolling to top
					if (sb.css('position')!='static') {
						sb.css({
							'float': sb.hasClass('right') ? 'right' : 'left',
							'position': 'static',
							'top': 'auto',
							'left': 'auto',
							'right': 'auto'
						});
					}
	
				}
			}
		}
	}
	
	
	
	
	
	// Navigation
	//==============================================
	
	// Init Superfish menu
	function clothing69_init_sfmenu(selector) {
		jQuery(selector).show().each(function() {
			var animation_in = jQuery(this).parent().data('animation_in');
			if (animation_in == undefined) animation_in = "none";
			var animation_out = jQuery(this).parent().data('animation_out');
			if (animation_out == undefined) animation_out = "none";
			jQuery(this).addClass('inited').superfish({
				delay: 500,
				animation: {
					opacity: 'show'
				},
				animationOut: {
					opacity: 'hide'
				},
				speed: 		animation_in!='none' ? 500 : 200,
				speedOut:	animation_out!='none' ? 500 : 200,
				autoArrows: false,
				dropShadows: false,
				onBeforeShow: function(ul) {
					if (jQuery(this).parents("ul").length > 1){
						var w = jQuery(window).width();  
						var par_offset = jQuery(this).parents("ul").offset().left;
						var par_width  = jQuery(this).parents("ul").outerWidth();
						var ul_width   = jQuery(this).outerWidth();
						if (par_offset+par_width+ul_width > w-20 && par_offset-ul_width > 0)
							jQuery(this).addClass('submenu_left');
						else
							jQuery(this).removeClass('submenu_left');
					}
					if (animation_in!='none') {
						jQuery(this).removeClass('animated fast '+animation_out);
						jQuery(this).addClass('animated fast '+animation_in);
					}
				},
				onBeforeHide: function(ul) {
					if (animation_out!='none') {
						jQuery(this).removeClass('animated fast '+animation_in);
						jQuery(this).addClass('animated fast '+animation_out);
					}
				}
			});
		});
	}
	
	
	
	
	// Post formats init
	//=====================================================
	
	function clothing69_init_post_formats(e, cont) {
	
		// MediaElement init
		clothing69_init_media_elements(cont);
		
		// Video play button
		cont.find('.format-video .post_featured.with_thumb .post_video_hover:not(.inited)')
			.addClass('inited')
			.on('click', function(e) {
				jQuery(this).parents('.post_featured')
					.addClass('post_video_play')
					.find('.post_video').html(jQuery(this).data('video'));
				jQuery(window).trigger('resize');
				e.preventDefault();
				return false;
			});
	}
	
	
	function clothing69_init_media_elements(cont) {
		if (CLOTHING69_STORAGE['use_mediaelements'] && cont.find('audio:not(.inited),video:not(.inited)').length > 0) {
			if (window.mejs) {
				if (typeof window.mejs.MepDefaults != 'undefined') window.mejs.MepDefaults.enableAutosize = false;
				if (typeof window.mejs.MediaElementDefaults != 'undefined') window.mejs.MediaElementDefaults.enableAutosize = false;
				cont.find('audio:not(.inited),video:not(.inited)').each(function() {
					// If item now invisible
					if (jQuery(this).parents('div:hidden,section:hidden,article:hidden').length > 0) {
						return;
					}
					if (jQuery(this).parents('.mejs-mediaelement').length == 0
						&& jQuery( this ).parents( '.wp-block-video' ).length == 0
						&& ! jQuery( this ).hasClass( 'wp-block-cover__video-background' )
							&& (CLOTHING69_STORAGE['init_all_mediaelements'] 
								|| (!jQuery(this).hasClass('wp-audio-shortcode') 
									&& !jQuery(this).hasClass('wp-video-shortcode') 
									&& !jQuery(this).parent().hasClass('wp-playlist')))) {
						var media_tag = jQuery(this);
						var settings = {
							enableAutosize: true,
							videoWidth: -1,		// if set, overrides <video width>
							videoHeight: -1,	// if set, overrides <video height>
							audioWidth: '100%',	// width of audio player
							audioHeight: 30,	// height of audio player
							success: function(mejs) {
								var autoplay, loop;
								if ( 'flash' === mejs.pluginType ) {
									autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
									loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;
									autoplay && mejs.addEventListener( 'canplay', function () {
										mejs.play();
									}, false );
									loop && mejs.addEventListener( 'ended', function () {
										mejs.play();
									}, false );
								}
							}
						};
						jQuery(this).mediaelementplayer(settings);
					}
				});
			} else
				setTimeout(function() { clothing69_init_media_elements(cont); }, 400);
		}
}


// Fit video frames to document width
function clothing69_resize_video(cont) {
	if (cont === undefined) {
		cont = jQuery( 'body' );
	}
	cont.find( 'video' ).each(
		function() {
			// If item now invisible
			if (jQuery( this ).hasClass( 'trx_addons_resize' ) || jQuery( this ).parents( 'div:hidden,section:hidden,article:hidden' ).length > 0) {
				return;
			}
			var video     = jQuery( this ).addClass( 'clothing69_resize' ).eq( 0 );
			var ratio     = (video.data( 'ratio' ) !== undefined ? video.data( 'ratio' ).split( ':' ) : [16,9]);
			ratio         = ratio.length != 2 || ratio[0] == 0 || ratio[1] == 0 ? 16 / 9 : ratio[0] / ratio[1];
			var mejs_cont = video.parents( '.mejs-video' ).eq(0);
			var w_attr    = video.data( 'width' );
			var h_attr    = video.data( 'height' );
			if ( ! w_attr || ! h_attr) {
				w_attr = video.attr( 'width' );
				h_attr = video.attr( 'height' );
				if ( ! w_attr || ! h_attr) {
					return;
				}
				video.data( {'width': w_attr, 'height': h_attr} );
			}
			var percent = ('' + w_attr).substr( -1 ) == '%';
			w_attr      = parseInt( w_attr, 10 );
			h_attr      = parseInt( h_attr, 10 );
			var w_real  = Math.round(
					mejs_cont.length > 0
						? Math.min( percent ? 10000 : w_attr, mejs_cont.parents( 'div,article' ).eq(0).width() )
						: Math.min( percent ? 10000 : w_attr, video.parents( 'div,article' ).eq(0).width() )
				),
				h_real      = Math.round( percent ? w_real / ratio : w_real / w_attr * h_attr );
			if (parseInt( video.attr( 'data-last-width' ), 10 ) == w_real) {
				return;
			}
			if (percent) {
				video.height( h_real );
			} else if (video.parents( '.wp-video-playlist' ).length > 0) {
				if (mejs_cont.length === 0) {
					video.attr( {'width': w_real, 'height': h_real} );
				}
			} else {
				video.attr( {'width': w_real, 'height': h_real} ).css( {'width': w_real + 'px', 'height': h_real + 'px'} );
				if (mejs_cont.length > 0) {
					clothing69_set_mejs_player_dimensions( video, w_real, h_real );
				}
			}
			video.attr( 'data-last-width', w_real );
		}
	);
	cont.find( '.video_frame iframe, iframe' ).each(
		function() {
			// If item now invisible
			if (jQuery( this ).hasClass( 'trx_addons_resize' ) || jQuery( this ).addClass( 'clothing69_resize' ).parents( 'div:hidden,section:hidden,article:hidden' ).length > 0) {
				return;
			}
			var iframe = jQuery( this ).eq( 0 );
			if (iframe.length === 0 || iframe.attr( 'src' ) === undefined || iframe.attr( 'src' ).indexOf( 'soundcloud' ) > 0) {
				return;
			}
			var ratio  = (iframe.data( 'ratio' ) !== undefined
					? iframe.data( 'ratio' ).split( ':' )
					: (iframe.parent().data( 'ratio' ) !== undefined
						? iframe.parent().data( 'ratio' ).split( ':' )
						: (iframe.find( '[data-ratio]' ).length > 0
							? iframe.find( '[data-ratio]' ).data( 'ratio' ).split( ':' )
							: [16,9]
					)
				)
			);
			ratio      = ratio.length != 2 || ratio[0] == 0 || ratio[1] == 0 ? 16 / 9 : ratio[0] / ratio[1];
			var w_attr = iframe.attr( 'width' );
			var h_attr = iframe.attr( 'height' );
			if ( ! w_attr || ! h_attr) {
				return;
			}
			var percent = ('' + w_attr).substr( -1 ) == '%';
			w_attr      = parseInt( w_attr, 10 );
			h_attr      = parseInt( h_attr, 10 );
			var par     = iframe.parents( 'div,section' ).eq(0),
				pw          = par.width(),
				ph          = par.height(),
				w_real      = pw,
				h_real      = Math.round( percent ? w_real / ratio : w_real / w_attr * h_attr );
			if (par.css( 'position' ) == 'absolute' && h_real > ph) {
				h_real = ph;
				w_real = Math.round( percent ? h_real * ratio : h_real * w_attr / h_attr )
			}
			if (parseInt( iframe.attr( 'data-last-width' ), 10 ) == w_real) {
				return;
			}
			iframe.css( {'width': w_real + 'px', 'height': h_real + 'px'} );
			iframe.attr( 'data-last-width', w_real );
		}
	);
}

// Set Media Elements player dimensions
function clothing69_set_mejs_player_dimensions(video, w, h) {
	if (mejs) {
		for (var pl in mejs.players) {
			if (mejs.players[pl].media.src == video.attr( 'src' )) {
				if (mejs.players[pl].media.setVideoSize) {
					mejs.players[pl].media.setVideoSize( w, h );
				} else if (mejs.players[pl].media.setSize) {
					mejs.players[pl].media.setSize( w, h );
				}
				mejs.players[pl].setPlayerSize( w, h );
				mejs.players[pl].setControlsSize();
			}
		}
	}
}



// Load the tab's content
function laundrycity_tabs_ajax_content_loader(panel, page, oldPanel) {
	"use strict";
		if (panel.html().replace(/\s/g, '')=='') {
			var height = oldPanel === undefined ? panel.height() : oldPanel.height();
			if (isNaN(height) || height < 100) height = 100;
			panel.html('<div class="clothing69_tab_holder" style="min-height:'+height+'px;"></div>');
		} else
			panel.find('> *').addClass('clothing69_tab_content_remove');
		panel.data('need-content', false).addClass('clothing69_loading');
		jQuery.post(CLOTHING69_STORAGE['ajax_url'], {
			nonce: CLOTHING69_STORAGE['ajax_nonce'],
			action: 'clothing69_ajax_get_posts',
			blog_template: panel.data('blog-template'),
			blog_style: panel.data('blog-style'),
			posts_per_page: panel.data('posts-per-page'),
			cat: panel.data('cat'),
			parent_cat: panel.data('parent-cat'),
			post_type: panel.data('post-type'),
			taxonomy: panel.data('taxonomy'),
			page: page
		}).done(function(response) {
			panel.removeClass('clothing69_loading');
			var rez = {};
			try {
				rez = JSON.parse(response);
			} catch (e) {
				rez = { error: CLOTHING69_STORAGE['strings']['ajax_error'] };
				console.log(response);
			}
			if (rez.error !== '') {
				panel.html('<div class="clothing69_error">'+rez.error+'</div>');
			} else {
				panel.prepend(rez.data).fadeIn(function() {
					jQuery(document).trigger('action.init_shortcodes', [panel]);
					jQuery(document).trigger('action.init_hidden_elements', [panel]);
					jQuery(window).trigger('scroll');
					setTimeout(function() {
						panel.find('.clothing69_tab_holder,.clothing69_tab_content_remove').remove();
						jQuery(window).trigger('scroll');
					}, 600);
				});
			}
		});
	}
	
	
	// Forms validation
	//-------------------------------------------------------
	
	// Comments form
	function clothing69_comments_validate(form) {
		form.find('input').removeClass('error_field');
		var comments_args = {
			error_message_text: CLOTHING69_STORAGE['strings']['error_global'],	// Global error message text (if don't write in checked field)
			error_message_show: true,									// Display or not error message
			error_message_time: 4000,									// Error message display time
			error_message_class: 'clothing69_messagebox clothing69_messagebox_style_error',	// Class appended to error message block
			error_fields_class: 'error_field',							// Class appended to error fields
			exit_after_first_error: false,								// Cancel validation and exit after first error
			rules: [
				{
					field: 'comment',
					min_length: { value: 1, message: CLOTHING69_STORAGE['strings']['text_empty'] },
					max_length: { value: CLOTHING69_STORAGE['comment_maxlength'], message: CLOTHING69_STORAGE['strings']['text_long']}
				}
			]
		};
		if (form.find('.comments_author input[aria-required="true"]').length > 0) {
			comments_args.rules.push(
				{
					field: 'author',
					min_length: { value: 1, message: CLOTHING69_STORAGE['strings']['name_empty']},
					max_length: { value: 60, message: CLOTHING69_STORAGE['strings']['name_long']}
				}
			);
		}
		if (form.find('.comments_email input[aria-required="true"]').length > 0) {
			comments_args.rules.push(
				{
					field: 'email',
					min_length: { value: 1, message: CLOTHING69_STORAGE['strings']['email_empty']},
					max_length: { value: 60, message: CLOTHING69_STORAGE['strings']['email_long']},
					mask: { value: CLOTHING69_STORAGE['email_mask'], message: CLOTHING69_STORAGE['strings']['email_not_valid']}
				}
			);
		}
		var error = clothing69_form_validate(form, comments_args);
		return !error;
	}

	// Increment arrows on number input
	function clothing69_wooc_style_arrows() {
		"use strict";
		// Add buttons to quantity
		jQuery('.woocommerce div.quantity,.woocommerce-page div.quantity').append('<span class="q_inc"></span><span class="q_dec"></span>');
		jQuery('.woocommerce div.quantity').on('click', '>span', function(e) {
			var f = jQuery(this).siblings('input');
			if (jQuery(this).hasClass('q_inc')) {
				f.val(Math.max(0, parseInt(f.val()))+1);
			} else {
				f.val(Math.max(1, Math.max(0, parseInt(f.val()))-1));
			}
			e.preventDefault();
			jQuery(f).trigger('change');
			return false;
		});
	}

});