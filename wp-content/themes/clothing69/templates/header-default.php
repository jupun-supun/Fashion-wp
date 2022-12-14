<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_header_css = $clothing69_header_image = '';
$clothing69_header_video = clothing69_get_header_video();
if (true || empty($clothing69_header_video)) {
	$clothing69_header_image = get_header_image();
	if (clothing69_is_on(clothing69_get_theme_option('header_image_override')) && apply_filters('clothing69_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($clothing69_cat_img = clothing69_get_category_image()) != '')
				$clothing69_header_image = $clothing69_cat_img;
		} else if (is_singular() || clothing69_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$clothing69_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($clothing69_header_image)) $clothing69_header_image = $clothing69_header_image[0];
			} else
				$clothing69_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default<?php
					echo !empty($clothing69_header_image) || !empty($clothing69_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($clothing69_header_video!='') echo ' with_bg_video';
					if ($clothing69_header_image!='') echo ' '.esc_attr(clothing69_add_inline_css_class('background-image: url('.esc_url($clothing69_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (clothing69_is_on(clothing69_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(clothing69_is_inherit(clothing69_get_theme_option('header_scheme')) 
													? clothing69_get_theme_option('color_scheme') 
													: clothing69_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($clothing69_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (clothing69_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>