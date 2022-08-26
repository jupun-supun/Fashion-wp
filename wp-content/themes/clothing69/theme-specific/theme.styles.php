<?php
/**
 * Generate custom CSS
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

// Return CSS with custom colors and fonts
if (!function_exists('clothing69_customizer_get_css')) {

	function clothing69_customizer_get_css($colors=null, $fonts=null, $remove_spaces=true, $only_scheme='') {

		$css = array(
			'fonts' => '',
			'colors' => ''
		);
		
		// Theme fonts
		//---------------------------------------------
		if ($fonts === null) {
			$fonts = clothing69_get_theme_fonts();
		}
		
		if ($fonts) {

			// Make theme-specific fonts rules
			$fonts = clothing69_customizer_add_theme_fonts($fonts);

			$rez = array();
			$rez['fonts'] = <<<CSS

body {
	{$fonts['p_font-family']}
	{$fonts['p_font-size']}
	{$fonts['p_font-weight']}
	{$fonts['p_font-style']}
	{$fonts['p_line-height']}
	{$fonts['p_text-decoration']}
	{$fonts['p_text-transform']}
	{$fonts['p_letter-spacing']}
}
p, ul, ol, dl, blockquote, address {
	{$fonts['p_margin-top']}
	{$fonts['p_margin-bottom']}
}

h1 {
	{$fonts['h1_font-family']}
	{$fonts['h1_font-size']}
	{$fonts['h1_font-weight']}
	{$fonts['h1_font-style']}
	{$fonts['h1_line-height']}
	{$fonts['h1_text-decoration']}
	{$fonts['h1_text-transform']}
	{$fonts['h1_letter-spacing']}
	{$fonts['h1_margin-top']}
	{$fonts['h1_margin-bottom']}
}
h2 {
	{$fonts['h2_font-family']}
	{$fonts['h2_font-size']}
	{$fonts['h2_font-weight']}
	{$fonts['h2_font-style']}
	{$fonts['h2_line-height']}
	{$fonts['h2_text-decoration']}
	{$fonts['h2_text-transform']}
	{$fonts['h2_letter-spacing']}
	{$fonts['h2_margin-top']}
	{$fonts['h2_margin-bottom']}
}
h3 {
	{$fonts['h3_font-family']}
	{$fonts['h3_font-size']}
	{$fonts['h3_font-weight']}
	{$fonts['h3_font-style']}
	{$fonts['h3_line-height']}
	{$fonts['h3_text-decoration']}
	{$fonts['h3_text-transform']}
	{$fonts['h3_letter-spacing']}
	{$fonts['h3_margin-top']}
	{$fonts['h3_margin-bottom']}
}
h4 {
	{$fonts['h4_font-family']}
	{$fonts['h4_font-size']}
	{$fonts['h4_font-weight']}
	{$fonts['h4_font-style']}
	{$fonts['h4_line-height']}
	{$fonts['h4_text-decoration']}
	{$fonts['h4_text-transform']}
	{$fonts['h4_letter-spacing']}
	{$fonts['h4_margin-top']}
	{$fonts['h4_margin-bottom']}
}
h5 {
	{$fonts['h5_font-family']}
	{$fonts['h5_font-size']}
	{$fonts['h5_font-weight']}
	{$fonts['h5_font-style']}
	{$fonts['h5_line-height']}
	{$fonts['h5_text-decoration']}
	{$fonts['h5_text-transform']}
	{$fonts['h5_letter-spacing']}
	{$fonts['h5_margin-top']}
	{$fonts['h5_margin-bottom']}
}
h6 {
	{$fonts['h6_font-family']}
	{$fonts['h6_font-size']}
	{$fonts['h6_font-weight']}
	{$fonts['h6_font-style']}
	{$fonts['h6_line-height']}
	{$fonts['h6_text-decoration']}
	{$fonts['h6_text-transform']}
	{$fonts['h6_letter-spacing']}
	{$fonts['h6_margin-top']}
	{$fonts['h6_margin-bottom']}
}

input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
textarea,
textarea.wp-editor-area,
.select_container,
.select2-container--default .select2-selection--single,
select,
.select_container select {
	{$fonts['input_font-family']}
	{$fonts['input_font-size']}
	{$fonts['input_font-weight']}
	{$fonts['input_font-style']}
	{$fonts['input_line-height']}
	{$fonts['input_text-decoration']}
	{$fonts['input_text-transform']}
	{$fonts['input_letter-spacing']}
}

button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.gallery_preview_show .post_readmore,
.more-link,
.clothing69_tabs .clothing69_tabs_titles li a {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
blockquote > a, blockquote > p > a, blockquote > cite, blockquote > p > cite,
blockquote:before,
.top_panel .slider_engine_revo .slide_title {
	{$fonts['h1_font-family']}
}
input[type="checkbox"] + .wpcf7-list-item-label,
body .mejs-container *,
blockquote {
	{$fonts['p_font-family']}
}
mark, ins,
.logo_text,
.post_price.price,
.theme_scroll_down {
	{$fonts['h5_font-family']}
}

.post_meta {
	{$fonts['info_font-family']}
	{$fonts['info_font-size']}
	{$fonts['info_font-weight']}
	{$fonts['info_font-style']}
	{$fonts['info_line-height']}
	{$fonts['info_text-decoration']}
	{$fonts['info_text-transform']}
	{$fonts['info_letter-spacing']}
	{$fonts['info_margin-top']}
	{$fonts['info_margin-bottom']}
}
.widget_area .post_item .post_info, .widget .post_item .post_info {
	{$fonts['info_font-family']}
}

em, i,
.post-date, .rss-date 
.post_date, .post_meta_item, .post_counters_item,
.comments_list_wrap .comment_date,
.comments_list_wrap .comment_time,
.comments_list_wrap .comment_counters,
.top_panel .slider_engine_revo .slide_subtitle,
.logo_slogan,
fieldset legend,
figure figcaption,
.post_item_single .post_content .post_meta,
.author_bio .author_link,
.comments_list_wrap .comment_posted,
.comments_list_wrap .comment_reply {
	{$fonts['info_font-family']}
}

.format-audio .post_featured .post_audio_author,
.trx_addons_audio_player .audio_author,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd,
.search_wrap .search_results .post_meta_item,
.search_wrap .search_results .post_counters_item {
	{$fonts['p_font-family']}
}

.logo_text {
	{$fonts['logo_font-family']}
	{$fonts['logo_font-size']}
	{$fonts['logo_font-weight']}
	{$fonts['logo_font-style']}
	{$fonts['logo_line-height']}
	{$fonts['logo_text-decoration']}
	{$fonts['logo_text-transform']}
	{$fonts['logo_letter-spacing']}
}
.logo_footer_text {
	{$fonts['logo_font-family']}
}

.menu_main_nav_area {
	{$fonts['menu_font-size']}
	{$fonts['menu_line-height']}
}
.menu_main_nav > li,
.menu_main_nav > li > a {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.menu_main_nav > li ul,
.menu_main_nav > li ul > li,
.menu_main_nav > li ul > li > a {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_line-height']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}
.menu_mobile .menu_mobile_nav_area > ul > li,
.menu_mobile .menu_mobile_nav_area > ul > li > a {
	{$fonts['menu_font-family']}
}
.menu_mobile .menu_mobile_nav_area > ul > li li,
.menu_mobile .menu_mobile_nav_area > ul > li li > a {
	{$fonts['submenu_font-family']}
}


/* Custom Headers */
.sc_layouts_row,
.sc_layouts_row input[type="text"] {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-size']}
	{$fonts['menu_font-style']}
	{$fonts['menu_line-height']}
}
footer .sc_layouts_row {
	{$fonts['p_font-size']}
	{$fonts['p_font-family']}
}
.sc_layouts_row .sc_button_wrap .sc_button {
	{$fonts['button_font-family']}
	{$fonts['button_font-size']}
	{$fonts['button_font-weight']}
	{$fonts['button_font-style']}
	{$fonts['button_line-height']}
	{$fonts['button_text-decoration']}
	{$fonts['button_text-transform']}
	{$fonts['button_letter-spacing']}
}
.sc_layouts_menu_nav > li,
.sc_layouts_menu_nav > li > a {
	{$fonts['menu_font-family']}
	{$fonts['menu_font-weight']}
	{$fonts['menu_font-style']}
	{$fonts['menu_text-decoration']}
	{$fonts['menu_text-transform']}
	{$fonts['menu_letter-spacing']}
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li,
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a,
.sc_layouts_menu_nav > li ul,
.sc_layouts_menu_nav > li ul > li,
.sc_layouts_menu_nav > li ul > li > a {
	{$fonts['submenu_font-family']}
	{$fonts['submenu_font-size']}
	{$fonts['submenu_font-weight']}
	{$fonts['submenu_font-style']}
	{$fonts['submenu_line-height']}
	{$fonts['submenu_text-decoration']}
	{$fonts['submenu_text-transform']}
	{$fonts['submenu_letter-spacing']}
}

.sc_layouts_title_breadcrumbs {
	{$fonts['p_font-family']}
}
body .minimal-light .esg-filterbutton,
body .minimal-light .esg-navigationbutton,
 body .minimal-light .esg-sortbutton,
 body .minimal-light .esg-cartbutton a,
.eg-collections-wrapper .eg-collections-content a,
.sc_promo_content .wpb_text_column strong,
.related_wrap .related_item_style_2 .post_meta .post_counters_number,
.related_wrap .related_item_style_2 .link_go,
.widget_calendar th,
.widget_product_tag_cloud a,
.widget_tag_cloud a,
ul.wp-block-page-list li,
ul.wp-block-archives-list li,
ul.wp-block-categories-list li,
ul.wp-block-categories__list li,
ul.wp-block-latest-posts:not(.is-grid) li,
.widget li,
.go_form {
	{$fonts['h1_font-family']}
}

CSS;
			$rez = apply_filters('clothing69_filter_get_css', $rez, false, $fonts, '');
			$css['fonts'] = $rez['fonts'];

			
			// Border radius
			//--------------------------------------
			$rad = clothing69_get_border_radius();
			$rad50 = ' '.$rad != ' 0' ? '50%' : 0;
			$css['fonts'] .= <<<CSS

/* Buttons */
button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.theme_button,
.post_item .more-link,
.gallery_preview_show .post_readmore,

/* Fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="password"],
input[type="search"],
select,
.select_container,
textarea,

/* Search fields */
.widget_search .search-field,
.woocommerce.widget_product_search .search_field,
.widget_display_search #bbp_search,
#bbpress-forums #bbp-search-form #bbp_search,

/* Comment fields */
.comments_wrap .comments_field input,
.comments_wrap .comments_field textarea,

/* Tags cloud */
.widget_product_tag_cloud a,
.widget_tag_cloud a {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}
.select_container:before {
	-webkit-border-radius: 0 {$rad} {$rad} 0;
	    -ms-border-radius: 0 {$rad} {$rad} 0;
			border-radius: 0 {$rad} {$rad} 0;
}
textarea.wp-editor-area {
	-webkit-border-radius: 0 0 {$rad} {$rad};
	    -ms-border-radius: 0 0 {$rad} {$rad};
			border-radius: 0 0 {$rad} {$rad};
}

/* Radius 50% or 0 */
.widget li a img {
	-webkit-border-radius: {$rad50};
	    -ms-border-radius: {$rad50};
			border-radius: {$rad50};
}

CSS;
		}


		// Theme colors
		//--------------------------------------
		if ($colors !== false) {
			$schemes = empty($only_scheme) ? array_keys(clothing69_get_list_schemes()) : array($only_scheme);
	
			if (count($schemes) > 0) {
				$rez = array();
				foreach ($schemes as $scheme) {
					// Prepare colors
					if (empty($only_scheme)) $colors = clothing69_get_scheme_colors($scheme);
	
					// Make theme-specific colors and tints
					$colors = clothing69_customizer_add_theme_colors($colors);
			
					// Make styles
					$rez['colors'] = <<<CSS

/* Common tags */
body {
	background-color: {$colors['bg_color']};
}
.scheme_self {
	color: {$colors['text']};
}
h1, h2, h3, h4, h5, h6,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
li a {
	color: {$colors['text_dark']};
}
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
li a:hover {
	color: {$colors['text_link']};
}

dt, b, strong, i, em, mark, ins {	
	color: {$colors['text_dark']};
}
s, strike, del {	
	color: {$colors['text_light']};
}

code {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
}
code a {
	color: {$colors['alter_link']};
}
code a:hover {
	color: {$colors['alter_hover']};
}

a {
	color: {$colors['text_link']};
}
a:hover {
	color: {$colors['text_hover']};
}

.sc_widget_instagram + .wpb_text_column a {
	color: {$colors['text_hover']};
}
.sc_widget_instagram + .wpb_text_column a:hover {
	color: {$colors['text_link']};
}

blockquote {
	color: {$colors['text']};
}
blockquote:before {
	color: {$colors['text_link']};
}
.sc_promo_content blockquote a {
	color: {$colors['text_hover']};
}
blockquote a {
	color: {$colors['text_light']};
}
blockquote a:hover {
	color: {$colors['text_link']};
}

table th, table th + th, table td + th  {
}
table td, table th + td, table td + td {
	color: {$colors['alter_dark']}; 
}
table th,
.comment_text table tbody th {
	color: {$colors['text_light']};
	background-color: {$colors['text_dark']};
}
table > tbody > tr:nth-child(2n+1) > td {
	background-color: {$colors['alter_bg_color_04']};
}
table > tbody > tr:nth-child(2n) > td {
	background-color: {$colors['alter_bg_color']};
}
table th a:hover,
table tbody th a:hover {
	color: {$colors['bg_color']};
}

hr {
	border-color: {$colors['bd_color']};
}
figure figcaption,
.wp-caption .wp-caption-text,
.wp-caption .wp-caption-dd,
.wp-caption-overlay .wp-caption .wp-caption-text,
.wp-caption-overlay .wp-caption .wp-caption-dd {
	color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
}
ul > li:before {
	color: {$colors['text_link']};
}


/* Form fields
-------------------------------------------------- */

.widget_search form:after,
.woocommerce.widget_product_search form:after,
.wp-block-woocommerce-product-search form .wc-block-product-search__fields:after,
.widget_display_search form:after,
#bbpress-forums #bbp-search-form:after {
	color: {$colors['input_text']};
}
.widget_search form:hover:after,
.woocommerce.widget_product_search form:hover:after,
.wp-block-woocommerce-product-search form .wc-block-product-search__fields:hover:after,
.widget_display_search form:hover:after,
#bbpress-forums #bbp-search-form:hover:after {
	color: {$colors['input_dark']};
}

.wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}


/* Field set */
fieldset {
	border-color: {$colors['bd_color']};
}
fieldset legend {
	color: {$colors['text_dark']};
	background-color: {$colors['bg_color']};
}

/* Text fields */
::-webkit-input-placeholder { color: {$colors['text_light']}; opacity: 1; }
::-moz-placeholder          { color: {$colors['text_light']}; opacity: 1; }
:-ms-input-placeholder      { color: {$colors['text_light']}; opacity: 1; }

input[type="text"]::-webkit-input-placeholder { color: {$colors['input_text']}; opacity: 1; }
input[type="text"]::-moz-placeholder { color: {$colors['input_text']}; opacity: 1; }
input[type="text"]:-ms-input-placeholder { color: {$colors['input_text']}; opacity: 1; }

input[type="email"]::-webkit-input-placeholder { color: {$colors['input_text']}; opacity: 1; }
input[type="email"]::-moz-placeholder { color: {$colors['input_text']}; opacity: 1; }
input[type="email"]:-ms-input-placeholder { color: {$colors['input_text']}; opacity: 1; }

input[type="search"]::-webkit-input-placeholder { color: {$colors['input_text']}; opacity: 1; }
input[type="search"]::-moz-placeholder { color: {$colors['input_text']}; opacity: 1; }
input[type="search"]:-ms-input-placeholder { color: {$colors['input_text']}; opacity: 1; }

textarea::-webkit-input-placeholder { color: {$colors['input_text']}; opacity: 1; }
textarea::-moz-placeholder { color: {$colors['input_text']}; opacity: 1; }
textarea:-ms-input-placeholder { color: {$colors['input_text']}; opacity: 1; }

.woocommerce.widget_product_search .search_field,
.wp-block-woocommerce-product-search form .wc-block-product-search__field,
.sidebar_inner .widget_search .search-field,
.sidebar_inner .wp-block-search .wp-block-search__input,
.sidebar_inner .wp-block-search.wp-block-search__button-inside .wp-block-search__inside-wrapper {
	color: {$colors['inverse_link']};
	border-color: {$colors['text_dark']};
	background-color: {$colors['text_dark']};
}
.woocommerce.widget_product_search .search_field:focus,
.wp-block-woocommerce-product-search form .wc-block-product-search__field:focus,
.sidebar_inner .widget_search .search-field:focus {
	color: {$colors['inverse_link']};
	border-color: {$colors['text_dark']};
	background-color: {$colors['text_dark']};
}

.sidebar_inner .widget_search input[type="search"]::-webkit-input-placeholder { color: {$colors['inverse_link']}; opacity: 1; }
.sidebar_inner .widget_search input[type="search"]::-moz-placeholder { color: {$colors['inverse_link']}; opacity: 1; }
.sidebar_inner .widget_search input[type="search"]:-ms-input-placeholder { color: {$colors['inverse_link']}; opacity: 1; }

.sidebar_inner .wp-block-search input[type="search"]::-webkit-input-placeholder { color: {$colors['inverse_link']}; opacity: 1; }
.sidebar_inner .wp-block-search input[type="search"]::-moz-placeholder { color: {$colors['inverse_link']}; opacity: 1; }
.sidebar_inner .wp-block-search input[type="search"]:-ms-input-placeholder { color: {$colors['inverse_link']}; opacity: 1; }

.woocommerce.widget_product_search input[type="text"]::-webkit-input-placeholder { color: {$colors['inverse_link']}; opacity: 1; }
.woocommerce.widget_product_search input[type="text"]::-moz-placeholder { color: {$colors['inverse_link']}; opacity: 1; }
.woocommerce.widget_product_search input[type="text"]:-ms-input-placeholder { color: {$colors['inverse_link']}; opacity: 1; }

.wp-block-woocommerce-product-search form input[type="search"]::-webkit-input-placeholder { color: {$colors['inverse_link']}; opacity: 1; }
.wp-block-woocommerce-product-search form input[type="search"]::-moz-placeholder { color: {$colors['inverse_link']}; opacity: 1; }
.wp-block-woocommerce-product-search form input[type="search"]:-ms-input-placeholder { color: {$colors['inverse_link']}; opacity: 1; }

.woocommerce.widget_product_search form:after,
.wp-block-woocommerce-product-search form .wc-block-product-search__fields:after,
.sidebar_inner .widget_search form:after {
	color: {$colors['inverse_link']};
}
.woocommerce.widget_product_search form:hover:after,
.wp-block-woocommerce-product-search form .wc-block-product-search__fields:hover:after,
.sidebar_inner .widget_search form:hover:after {
	color: {$colors['text_light']};
}

input[type="text"],
input[type="number"],
input[type="email"],
input[type="tel"],
input[type="search"],
input[type="password"],
.select_container,
.select2-container .select2-choice,
.select2-container .select2-selection--single .select2-selection__rendered .select2-selection__placeholder,
textarea,
textarea.wp-editor-area,
/* BB Press */
#buddypress .dir-search input[type="search"],
#buddypress .dir-search input[type="text"],
#buddypress .groups-members-search input[type="search"],
#buddypress .groups-members-search input[type="text"],
#buddypress .standard-form input[type="color"],
#buddypress .standard-form input[type="date"],
#buddypress .standard-form input[type="datetime-local"],
#buddypress .standard-form input[type="datetime"],
#buddypress .standard-form input[type="email"],
#buddypress .standard-form input[type="month"],
#buddypress .standard-form input[type="number"],
#buddypress .standard-form input[type="password"],
#buddypress .standard-form input[type="range"],
#buddypress .standard-form input[type="search"],
#buddypress .standard-form input[type="tel"],
#buddypress .standard-form input[type="text"],
#buddypress .standard-form input[type="time"],
#buddypress .standard-form input[type="url"],
#buddypress .standard-form input[type="week"],
#buddypress .standard-form select,
#buddypress .standard-form textarea,
#buddypress form#whats-new-form textarea,
/* Booked */
#booked-page-form input[type="email"],
#booked-page-form input[type="text"],
#booked-page-form input[type="password"],
#booked-page-form textarea,
.booked-upload-wrap,
.booked-upload-wrap input {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}

.sidebar input[type="text"],
.sidebar input[type="password"] {
    border-color: {$colors['bg_color']};
	background-color: {$colors['bg_color']};
}
.sidebar input[type="text"]:focus,
.sidebar input[type="password"]:focus {
    background-color: {$colors['bg_color']};
}
input[type="text"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="tel"]:focus,
input[type="search"]:focus,
input[type="password"]:focus,
.select_container:hover,
select option:hover,
select option:focus,
.select2-container .select2-choice:hover,
textarea:focus,
textarea.wp-editor-area:focus,
/* BB Press */
#buddypress .dir-search input[type="search"]:focus,
#buddypress .dir-search input[type="text"]:focus,
#buddypress .groups-members-search input[type="search"]:focus,
#buddypress .groups-members-search input[type="text"]:focus,
#buddypress .standard-form input[type="color"]:focus,
#buddypress .standard-form input[type="date"]:focus,
#buddypress .standard-form input[type="datetime-local"]:focus,
#buddypress .standard-form input[type="datetime"]:focus,
#buddypress .standard-form input[type="email"]:focus,
#buddypress .standard-form input[type="month"]:focus,
#buddypress .standard-form input[type="number"]:focus,
#buddypress .standard-form input[type="password"]:focus,
#buddypress .standard-form input[type="range"]:focus,
#buddypress .standard-form input[type="search"]:focus,
#buddypress .standard-form input[type="tel"]:focus,
#buddypress .standard-form input[type="text"]:focus,
#buddypress .standard-form input[type="time"]:focus,
#buddypress .standard-form input[type="url"]:focus,
#buddypress .standard-form input[type="week"]:focus,
#buddypress .standard-form select:focus,
#buddypress .standard-form textarea:focus,
#buddypress form#whats-new-form textarea:focus,
/* Booked */
#booked-page-form input[type="email"]:focus,
#booked-page-form input[type="text"]:focus,
#booked-page-form input[type="password"]:focus,
#booked-page-form textarea:focus,
.booked-upload-wrap:hover,
.booked-upload-wrap input:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
	background-color: {$colors['input_bg_hover']};
}

/* Select containers */
.select_container:before {
	color: {$colors['input_text']};
	background-color: {$colors['input_bg_color']};
}
.select_container:focus:before,
.select_container:hover:before {
	color: {$colors['input_dark']};
	background-color: {$colors['input_bg_hover']};
}
.select_container:after {
	color: {$colors['input_text']};
}
.select_container:focus:after,
.select_container:hover:after {
	color: {$colors['input_dark']};
}
.select_container select {
	color: {$colors['input_text']};
}
.select_container select:focus {
	color: {$colors['input_dark']};
	border-color: {$colors['input_bd_hover']};
}
.select2-results {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_hover']};
	background: {$colors['input_bg_color']};
}
.select2-results .select2-highlighted {
	color: {$colors['input_dark']};
	background: {$colors['input_bg_hover']};
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
	color: {$colors['input_text']};
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
.wpgdprc {
	color: {$colors['text']};
}
.wpcf7-not-valid-tip {
	color: {$colors['text_link']};
}
.wpcf7 form.invalid .wpcf7-response-output, .wpcf7 form.unaccepted .wpcf7-response-output, .wpcf7 form.payment-required .wpcf7-response-output {
	border-color: {$colors['text_link']};
}
input[type="radio"] + label:before,
input[type="radio"] + .wpcf7-list-item-label:before,
input[type="checkbox"] + label:before,
input[type="checkbox"] + .wpcf7-list-item-label:before,
.woocommerce form .form-row label.checkbox:before, 
.woocommerce-page form .form-row label.checkbox:before {
	border-color: {$colors['input_bd_color']};
	background-color: {$colors['input_bg_color']};
}
input[type="checkbox"]:checked + label:before,
input[type="checkbox"]:checked + .wpcf7-list-item-label:before,
.woocommerce form .form-row.woocommerce-validated label.checkbox:before, 
.woocommerce-page form .form-row.woocommerce-validated label.checkbox:before  {
	color: {$colors['text_link']};
}


/* Simple button */
.sc_button_simple:not(.sc_button_bg_image),
.sc_button_simple:not(.sc_button_bg_image):before,
.sc_button_simple:not(.sc_button_bg_image):after {
	color:{$colors['text_link']};
}
.sc_button_simple:not(.sc_button_bg_image):hover,
.sc_button_simple:not(.sc_button_bg_image):hover:before,
.sc_button_simple:not(.sc_button_bg_image):hover:after {
	color:{$colors['text_hover']} !important;
}


/* Bordered button */
.sc_action_item_default .sc_action_item_link,
.sc_button_bordered:not(.sc_button_bg_image) {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']} !important;
	border-color:{$colors['bd_color']}
}
.sc_action_item_default .sc_action_item_link:hover,
.sc_button_bordered:not(.sc_button_bg_image):hover {
	color:{$colors['inverse_link']} !important;
	border-color:{$colors['bd_color']} !important;
	background-color: {$colors['text_link']} !important;
}

/* Normal button */
button,
input[type="reset"],
input[type="submit"],
input[type="button"],
.more-link,
.comments_wrap .form-submit input[type="submit"],
/* BB & Buddy Press */
#buddypress .comment-reply-link,
#buddypress .generic-button a,
#buddypress a.button,
#buddypress button,
#buddypress input[type="button"],
#buddypress input[type="reset"],
#buddypress input[type="submit"],
#buddypress ul.button-nav li a,
a.bp-title-button,
/* Booked */
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button,
body #booked-profile-page .booked-profile-appt-list .appt-block .booked-cal-buttons .google-cal-button > a,
body #booked-profile-page input[type="submit"],
body #booked-profile-page button,
body .booked-list-view input[type="submit"],
body .booked-list-view button,
body table.booked-calendar input[type="submit"],
body table.booked-calendar button,
body .booked-modal input[type="submit"],
body .booked-modal button,
/* ThemeREX Addons */
.sc_button_default,
.sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image),
.sc_action_item_link,
.socials_share:not(.socials_type_drop) .social_icon,
/* Tribe Events */
#tribe-bar-form .tribe-bar-submit input[type="submit"],
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"],
#tribe-bar-views li.tribe-bar-views-option a,
#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a,
#tribe-events .tribe-events-button,
.tribe-events-button,
.tribe-events-cal-links a,
.tribe-events-sub-nav li a,
/* WooCommerce */
.wishlist_table .product-add-to-cart a.button,
.woocommerce #respond input#submit,
.woocommerce .button, .woocommerce-page .button,
.woocommerce a.button, .woocommerce-page a.button,
.woocommerce button.button, .woocommerce-page button.button,
.woocommerce input.button, .woocommerce-page input.button,
.woocommerce input[type="button"], .woocommerce-page input[type="button"],
.woocommerce input[type="submit"], .woocommerce-page input[type="submit"],
.woocommerce nav.woocommerce-pagination ul li a,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt,
.wp-block-button a.wp-block-button__link {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.theme_button {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']} !important;
}
.sc_price_link {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.wp-block-button a.wp-block-button__link:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}

button:hover,
button:focus,
input[type="submit"]:hover,
input[type="submit"]:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
input[type="button"]:hover,
input[type="button"]:focus,
.more-link:hover,
.comments_wrap .form-submit input[type="submit"]:hover,
.comments_wrap .form-submit input[type="submit"]:focus,
/* BB & Buddy Press */
#buddypress .comment-reply-link:hover,
#buddypress .generic-button a:hover,
#buddypress a.button:hover,
#buddypress button:hover,
#buddypress input[type="button"]:hover,
#buddypress input[type="reset"]:hover,
#buddypress input[type="submit"]:hover,
#buddypress ul.button-nav li a:hover,
a.bp-title-button:hover,
/* Booked */
.booked-calendar-wrap .booked-appt-list .timeslot .timeslot-people button:hover,
body #booked-profile-page .booked-profile-appt-list .appt-block .booked-cal-buttons .google-cal-button > a:hover,
body #booked-profile-page input[type="submit"]:hover,
body #booked-profile-page button:hover,
body .booked-list-view input[type="submit"]:hover,
body .booked-list-view button:hover,
body table.booked-calendar input[type="submit"]:hover,
body table.booked-calendar button:hover,
body .booked-modal input[type="submit"]:hover,
body .booked-modal button:hover,
/* ThemeREX Addons */
.sc_button_default:hover,
.sc_button:not(.sc_button_simple):not(.sc_button_bordered):not(.sc_button_bg_image):hover,
.sc_action_item_link:hover,
.socials_share:not(.socials_type_drop) .social_icon:hover,
/* Tribe Events */
#tribe-bar-form .tribe-bar-submit input[type="submit"]:hover,
#tribe-bar-form .tribe-bar-submit input[type="submit"]:focus,
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:hover,
#tribe-bar-form.tribe-bar-mini .tribe-bar-submit input[type="submit"]:focus,
#tribe-bar-views li.tribe-bar-views-option a:hover,
#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover,
#tribe-events .tribe-events-button:hover,
.tribe-events-button:hover,
.tribe-events-cal-links a:hover,
.tribe-events-sub-nav li a:hover,
/* WooCommerce */
.wishlist_table .product-add-to-cart a.button:hover,
.woocommerce #respond input#submit:hover,
.woocommerce .button:hover, .woocommerce-page .button:hover,
.woocommerce a.button:hover, .woocommerce-page a.button:hover,
.woocommerce button.button:hover, .woocommerce-page button.button:hover,
.woocommerce input.button:hover, .woocommerce-page input.button:hover,
.woocommerce input[type="button"]:hover, .woocommerce-page input[type="button"]:hover,
.woocommerce input[type="submit"]:hover, .woocommerce-page input[type="submit"]:hover,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}
.woocommerce #respond input#submit.alt:hover,
.woocommerce a.button.alt:hover,
.woocommerce button.button.alt:hover,
.woocommerce input.button.alt:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}
.theme_button:hover,
.theme_button:focus {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_hover']} !important;
}

.sc_price_link:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}

button[disabled],
input[type="submit"][disabled],
input[type="button"][disabled] {
    background-color: {$colors['text_light']} !important;
    color: {$colors['text']} !important;
}


/* Buttons in sidebars */

/* MailChimp */
.mc4wp-form input[type="submit"],
/* WooCommerce */
#btn-buy,
.woocommerce .woocommerce-message .button,
.woocommerce .woocommerce-error .button,
.woocommerce .woocommerce-info .button,
.widget.woocommerce .button,
.widget.woocommerce a.button,
.widget.woocommerce button.button,
.widget.woocommerce input.button,
.widget.woocommerce input[type="button"],
.widget.woocommerce input[type="submit"],
.widget.WOOCS_CONVERTER .button,
.widget.yith-woocompare-widget a.button,
.widget_product_search .search_button,
.sc_layouts_cart_widget .widget_shopping_cart_content .buttons a.button {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_link']};
}
.sc_layouts_cart_widget .widget_shopping_cart_content .buttons a.button:hover,
/* MailChimp */
.mc4wp-form input[type="submit"]:hover,
.mc4wp-form input[type="submit"]:focus,
/* WooCommerce */
#btn-buy:hover,
.woocommerce .woocommerce-message .button:hover,
.woocommerce .woocommerce-error .button:hover,
.woocommerce .woocommerce-info .button:hover,
.widget.woocommerce .button:hover,
.widget.woocommerce a.button:hover,
.widget.woocommerce button.button:hover,
.widget.woocommerce input.button:hover,
.widget.woocommerce input[type="button"]:hover,
.widget.woocommerce input[type="button"]:focus,
.widget.woocommerce input[type="submit"]:hover,
.widget.woocommerce input[type="submit"]:focus,
.widget.WOOCS_CONVERTER .button:hover,
.widget.yith-woocompare-widget a.button:hover,
.widget_product_search .search_button:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['alter_hover']};
}

/* Buttons in WP Editor */
.wp-editor-container input[type="button"] {
	background-color: {$colors['alter_bg_color']};
	border-color: {$colors['alter_bd_color']};
	color: {$colors['alter_dark']};
	-webkit-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
	    -ms-box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};
			box-shadow: 0 1px 0 0 {$colors['alter_bd_hover']};	
}
.wp-editor-container input[type="button"]:hover,
.wp-editor-container input[type="button"]:focus {
	background-color: {$colors['alter_bg_hover']};
	border-color: {$colors['alter_bd_hover']};
	color: {$colors['alter_link']};
}


/* WP Standard classes */
.sticky {
	border-color: {$colors['bd_color']};
}
.sticky .label_sticky {
	border-top-color: {$colors['text_link']};
}
	

/* Page */
#page_preloader,
.scheme_self.header_position_under .page_content_wrap,
.page_wrap {
	background-color: {$colors['bg_color']};
}
.preloader_wrap > div {
	background-color: {$colors['text_link']};
}

/* Header */
.scheme_self.top_panel.with_bg_image:before {
	background-color: {$colors['bg_color_07']};
}
.scheme_self.top_panel .slider_engine_revo .slide_subtitle,
.top_panel .slider_engine_revo .slide_subtitle {
	color: {$colors['text_link']};
}
.top_panel_default .top_panel_title,
.scheme_self.top_panel_default .top_panel_title {
	background-color: {$colors['alter_bg_color']};
}


/* Tabs */
.clothing69_tabs .clothing69_tabs_titles li a {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}
.clothing69_tabs .clothing69_tabs_titles li a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.clothing69_tabs .clothing69_tabs_titles li.ui-state-active a {
	color: {$colors['bg_color']};
	background-color: {$colors['text_dark']};
}

/* Post layouts */
.post_item {
	color: {$colors['text']};
}
.post_meta,
.post_meta_item,
.post_meta_item a,
.post_meta_item:before,
.post_meta_item:after,
.post_meta_item:hover:before,
.post_meta_item:hover:after,
.post_date a,
.post_date:before,
.post_date:after,
.post_info .post_info_item,
.post_info .post_info_item a,
.post_info_counters .post_counters_item,
.post_counters .socials_share .socials_caption:before,
.post_counters .socials_share .socials_caption:hover:before {
	color: {$colors['text_light']};
}
.post_date a:hover,
a.post_meta_item:hover,
a.post_meta_item:hover:before,
.post_meta_item a:hover,
.post_meta_item a:hover:before,
.post_info .post_info_item a:hover,
.post_info .post_info_item a:hover:before,
.post_info_counters .post_counters_item:hover,
.post_info_counters .post_counters_item:hover:before {
	color: {$colors['text_dark']};
}
.post_item .post_title a:hover,
.post_item .post_title a:hover em,
.post_item .post_title a:hover b {
	color: {$colors['text_link']};
}

.post_meta_item.post_categories,
.post_meta_item.post_categories a {}
.post_meta_item.post_categories a:hover {
	color: {$colors['text_hover']};
}

.post_meta_item .socials_share .social_items {
	background-color: {$colors['bg_color']};
}
.post_meta_item .social_items,
.post_meta_item .social_items:before {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_light']};
}
.nav-links, .page_links,
.post_layout_excerpt + .post_layout_excerpt:before {
	border-color: {$colors['bd_color']};
}
.post_layout_classic {
	border-color: {$colors['bd_color']};
}

.scheme_self.gallery_preview:before {
	background-color: {$colors['bg_color']};
}
.scheme_self.gallery_preview {
	color: {$colors['text']};
}


/* Post Formats */

/* Audio */
.format-audio .post_featured .post_audio_author {
	color: {$colors['text_dark']};
}
.format-audio .post_featured.without_thumb .post_audio {
	border-color: {$colors['bd_color']};
}
.format-audio .post_featured.without_thumb .post_audio_title,
.without_thumb .mejs-controls .mejs-currenttime,
.without_thumb .mejs-controls .mejs-duration {
	color: {$colors['text_dark']};
}
.format-audio .post_featured.without_thumb .post_audio,
.trx_addons_audio_player.without_cover {
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color']};
}
.trx_addons_audio_player.with_cover .audio_caption {
	color: {$colors['inverse_link']};
}
.trx_addons_audio_player.without_cover .audio_author {
	color: {$colors['text_dark']};
}
.trx_addons_audio_player .mejs-container .mejs-controls .mejs-time {
	color: {$colors['alter_dark']};
}
.trx_addons_audio_player.with_cover .mejs-container .mejs-controls .mejs-time {
	color: {$colors['inverse_link']};
}


.mejs-container,
.mejs-container .mejs-controls,
.mejs-embed,
.mejs-embed body {
	background: {$colors['alter_bg_color']};
}
.mejs-container .mejs-controls .mejs-time {
	color: {$colors['text_dark']};
}

.mejs-controls .mejs-button,
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	color: {$colors['inverse_link']};
	background: {$colors['text_link']};
}
.mejs-controls .mejs-button:hover {
	color: {$colors['inverse_link']};
	background: {$colors['text_hover']};
}
.mejs-controls .mejs-time-rail .mejs-time-total,
.mejs-controls .mejs-time-rail .mejs-time-loaded,
.mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
	background: {$colors['text_link_02']};
}

.sidebar_inner .widget .mejs-container .mejs-controls {
	background: {$colors['bg_color']};
}

/* Aside */
.format-aside .post_content_inner {
	color: {$colors['alter_dark']};
	background-color: {$colors['alter_bg_color']};
}

/* Link and Status */
.format-link .post_content_inner,
.format-status .post_content_inner {
	color: {$colors['text_dark']};
}

/* Chat */
.format-chat p > b,
.format-chat p > strong {
	color: {$colors['text_dark']};
}

/* Video */
.trx_addons_video_player.with_cover .video_hover,
.format-video .post_featured.with_thumb .post_video_hover {
	color: {$colors['bd_color']};
	border-color: {$colors['bd_color']};
}
.trx_addons_video_player.with_cover .video_hover,
.format-video .post_featured.with_thumb .post_video_hover {
	background-color: {$colors['text_link']};
}
.trx_addons_video_player.with_cover .video_hover:hover,
.format-video .post_featured.with_thumb .post_video_hover:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}


/* Chess */
.post_layout_chess .post_content_inner:after {
	background: linear-gradient(to top, {$colors['bg_color']} 0%, {$colors['bg_color_0']} 100%) no-repeat scroll right top / 100% 100% {$colors['bg_color_0']};
}
.post_layout_chess_1 .post_meta:before {
	background-color: {$colors['bd_color']};
}

/* Pagination */
.nav-links-old {
	color: {$colors['text_dark']};
}
.nav-links-old a:hover {
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
}

.page_links > a,
.comments_pagination .page-numbers,
.nav-links .page-numbers {
	color: {$colors['text_light']};
}
.page_links > a:hover,
.page_links > span:not(.page_links_title),
.comments_pagination a.page-numbers:hover,
.comments_pagination .page-numbers.current,
.nav-links a.page-numbers:hover,
.nav-links .page-numbers.current {
	color: {$colors['text_dark']};
}

/* Single post */
.post_item_single .post_header .post_date {
	color: {$colors['text_light']};
}
.post_item_single .post_header .post_categories,
.post_item_single .post_header .post_categories a {
	color: {$colors['text_link']};
}
.post_item_single .post_header .post_meta_item,
.post_item_single .post_header .post_meta_item:before,
.post_item_single .post_header .post_meta_item:hover:before,
.post_item_single .post_header .post_meta_item a,
.post_item_single .post_header .post_meta_item a:before,
.post_item_single .post_header .post_meta_item a:hover:before,
.post_item_single .post_header .post_meta_item .socials_caption,
.post_item_single .post_header .post_meta_item .socials_caption:before,
.post_item_single .post_header .post_edit a {
	color: {$colors['text_light']};
}
.post_item_single .post_meta_item:hover,
.post_item_single .post_meta_item > a:hover,
.post_item_single .post_meta_item .socials_caption:hover,
.post_item_single .post_edit a:hover {
	color: {$colors['text_hover']};
}
.post_item_single .post_content .post_meta_label,
.post_item_single .post_content .post_meta_item:hover .post_meta_label {
	color: {$colors['text_dark']};
}
.post_item_single .post_content .post_tags,
.post_item_single .post_content .post_tags a {
	color: {$colors['text_link']};
}
.post_item_single .post_content .post_tags a:hover {
	color: {$colors['text_hover']};
}
.post_meta_single_coll.post_meta .post_share .social_item .social_icon,
.post_item_single .post_content .post_meta .post_share .social_item .social_icon {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_hover']};
}
.post_meta_single_coll.post_meta .post_share .social_item:hover .social_icon,
.post_item_single .post_content .post_meta .post_share .social_item:hover .social_icon {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']};
}


.post_item_single .post_content .post_tags a {
	color: {$colors['text_hover']};
	background-color: {$colors['alter_bg_color']};
}
.post_item_single .post_content .post_tags a:hover {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_link']};
}
.post_item_single .post_content .post_tags a:after {
	background-color: {$colors['text_hover']};
}
.post_item_single .post_content .post_tags a:hover:after {
	background-color: {$colors['inverse_link']};
}


.post-password-form input[type="submit"] {
	border-color: {$colors['text_dark']};
}
.post-password-form input[type="submit"]:hover,
.post-password-form input[type="submit"]:focus {
	color: {$colors['bg_color']};
}

/* Single post navi */
.nav-links-single .nav-links {
	border-color: {$colors['bd_color']};
}
.nav-links-single .nav-links a .meta-nav {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a .post_date {
	color: {$colors['text_light']};
}
.nav-links-single .nav-links a:hover .meta-nav,
.nav-links-single .nav-links a:hover .post_date {
	color: {$colors['text_dark']};
}
.nav-links-single .nav-links a:hover .post-title {
	color: {$colors['text_link']};
}

/* Author info */
.author_info {
	color: {$colors['text']};
	background-color: {$colors['alter_bg_color']};
}
.author_info .author_title {
	color: {$colors['text_link']};
}
.author_info .author_title a {
	color: {$colors['text_hover']};
}
.author_info .author_title a:hover {
	color: {$colors['text_link']};
}
.author_info a {
	color: {$colors['text_link']};
}
.author_info a:hover {
	color: {$colors['text_hover']};
}

/* Related posts */
.related_wrap .related_item_style_1 .post_header {
	background-color: {$colors['bg_color_07']};
}
.related_wrap .related_item_style_1:hover .post_header {
	background-color: {$colors['bg_color']};
}
.related_wrap .related_item_style_1 .post_date a {
	color: {$colors['text']};
}
.related_wrap .related_item_style_1:hover .post_date a {
	color: {$colors['text_light']};
}
.related_wrap .related_item_style_1:hover .post_date a:hover {
	color: {$colors['text_dark']};
}

.related_wrap .related_item_style_2 .post_meta .post_meta_item:before,
.related_wrap .related_item_style_2 .post_meta .post_meta_item {
	color: {$colors['text_hover']};
}
.related_wrap .related_item_style_2 .post_meta .post_meta_item:hover:before,
.related_wrap .related_item_style_2 .post_meta .post_meta_item:hover {
	color: {$colors['text_link']};
}

/* Comments */
.comments_list_wrap,
.comments_list_wrap > ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap li + li,
.comments_list_wrap li ul {
	border-color: {$colors['bd_color']};
}
.comments_list_wrap .comment_info {
	color: {$colors['text_dark']};
}
.comments_list_wrap .comment_counters a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:before {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_counters a:hover:before,
.comments_list_wrap .comment_counters a:hover {
	color: {$colors['text_hover']};
}
.comments_list_wrap .comment_text {
	color: {$colors['text']};
}
.comments_list_wrap .comment_reply a {
	color: {$colors['text_link']};
}
.comments_list_wrap .comment_reply a:hover {
	color: {$colors['text_hover']};
}
.comments_form_wrap {
	border-color: {$colors['bd_color']};
}
.comments_wrap .comments_notes {
	color: {$colors['text_light']};
}


/* Page 404 */
.post_item_404 .page_title {
	color: {$colors['text_light']};
}
.post_item_404 .page_description {
	color: {$colors['text_link']};
}
.post_item_404 .go_home {
	border-color: {$colors['text_dark']};
}

/* Sidebar */
.sidebar_inner .widget {
	background-color: {$colors['alter_bg_color']};
}
.sidebar_inner .widget + .widget .widget_title,
.sidebar_inner .widget + .widget .widgettitle {
	background-color: {$colors['bg_color']};
}
.sidebar_inner .widget + .widget {
	border-color: {$colors['bd_color']};
}


/* Widgets */
.widget ul > li:before {
	color: {$colors['text_hover']};
}
.widget ul > li:hover:before {
	color: {$colors['text_link']};
}

.sidebar a {
	color: {$colors['alter_link']};
}
.sidebar a:hover {
	color: {$colors['alter_hover']};
}
.sidebar li > a,
.sidebar .post_title > a {
	color: {$colors['alter_dark']};
}
.sidebar li > a:hover,
.sidebar .post_title > a:hover {
	color: {$colors['alter_link']};
}


/* Archive */
.scheme_self.sidebar .widget_archive li {
	color: {$colors['alter_dark']};
}

/* Calendar */
.widget_calendar caption,
.widget_calendar tbody td a,
.wp-calendar-table caption,
.wp-calendar-table tbody td a {
	color: {$colors['text_dark']};
}
.scheme_self.sidebar .widget_calendar caption,
.scheme_self.sidebar .widget_calendar tbody td a,
.scheme_self.sidebar .wp-calendar-table caption,
.scheme_self.sidebar .wp-calendar-table tbody td a {
	color: {$colors['alter_dark']};
}
.widget_calendar th,
.scheme_self.sidebar .widget_calendar th,
.wp-calendar-table th,
.scheme_self.sidebar .wp-calendar-table th {
	color: {$colors['text_dark']};
}
.widget_calendar tbody td,
.wp-calendar-table tbody td {
	color: {$colors['text']} !important;
}
.scheme_self.sidebar .widget_calendar tbody td,
.scheme_self.sidebar .wp-calendar-table tbody td {
	color: {$colors['alter_text']} !important;
}
.widget_calendar tbody td a:hover,
.wp-calendar-table tbody td a:hover {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar tbody td a:hover,
.scheme_self.sidebar .wp-calendar-table tbody td a:hover {
	color: {$colors['alter_link']};
}
.widget_calendar tbody td a:after,
.wp-calendar-table tbody td a:after {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar tbody td a:after,
.scheme_self.sidebar .wp-calendar-table tbody td a:after {
	background-color: {$colors['alter_link']};
}
.widget_calendar td#today,
.wp-calendar-table td#today {
	color: {$colors['inverse_link']} !important;
}
.widget_calendar td#today a,
.wp-calendar-table td#today a {
	color: {$colors['inverse_link']};
}
.widget_calendar td#today a:hover,
.wp-calendar-table td#today a:hover {
	color: {$colors['inverse_hover']};
}
.widget_calendar td#today:before,
.wp-calendar-table td#today:before {
	background-color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_calendar td#today:before,
.scheme_self.sidebar .wp-calendar-table td#today:before {
	background-color: {$colors['alter_link']};
}
.widget_calendar td#today a:after,
.wp-calendar-table td#today a:after {
	background-color: {$colors['inverse_link']};
}
.widget_calendar td#today a:hover:after,
.wp-calendar-table td#today a:hover:after {
	background-color: {$colors['inverse_hover']};
}
.widget_calendar #prev a,
.widget_calendar #next a,
.wp-calendar-table #prev a,
.wp-calendar-table #next a,
.wp-block-calendar .wp-calendar-nav-prev a,
.wp-block-calendar .wp-calendar-nav-next a,
.widget_calendar .wp-calendar-nav-prev a,
.widget_calendar .wp-calendar-nav-next a  {
	color: {$colors['text_link']};
}
.widget_calendar #prev a:hover,
.widget_calendar #next a:hover,
.wp-calendar-table #prev a:hover,
.wp-calendar-table #next a:hover,
.wp-block-calendar .wp-calendar-nav-prev a:hover,
.wp-block-calendar .wp-calendar-nav-next a:hover,
.widget_calendar .wp-calendar-nav-prev a:hover,
.widget_calendar .wp-calendar-nav-next a:hover {
	color: {$colors['text_hover']};
}
.widget_calendar td#prev a:before,
.widget_calendar td#next a:before,
.wp-calendar-table td#prev a:before,
.wp-calendar-table td#next a:before,
.wp-block-calendar .wp-calendar-nav-prev a:before,
.wp-block-calendar .wp-calendar-nav-next a:before,
.widget_calendar .wp-calendar-nav-prev a:before,
.widget_calendar .wp-calendar-nav-next a:before {
	background-color: {$colors['bg_color']};
}

.scheme_self.sidebar .widget_calendar #prev a:hover,
.scheme_self.sidebar .widget_calendar #next a:hover,
.scheme_self.sidebar .wp-calendar-table #prev a:hover,
.scheme_self.sidebar .wp-calendar-table #next a:hover,
.scheme_self.sidebar .wp-block-calendar .wp-calendar-nav-prev a:hover,
.scheme_self.sidebar .wp-block-calendar .wp-calendar-nav-next a:hover,
.scheme_self.sidebar .widget_calendar .wp-calendar-nav-prev a:hover,
.scheme_self.sidebar .widget_calendar .wp-calendar-nav-next a:hover {
	color: {$colors['alter_hover']};
}
.scheme_self.sidebar .widget_calendar #prev a,
.scheme_self.sidebar .widget_calendar #next a,
.scheme_self.sidebar .wp-calendar-table #prev a,
.scheme_self.sidebar .wp-calendar-table #next a,
.scheme_self.sidebar .wp-block-calendar .wp-calendar-nav-prev a,
.scheme_self.sidebar .wp-block-calendar .wp-calendar-nav-next a,
.scheme_self.sidebar .widget_calendar .wp-calendar-nav-prev a,
.scheme_self.sidebar .widget_calendar .wp-calendar-nav-next a {
	color: {$colors['alter_link']};
}

.widget_calendar td#prev a:before,
.widget_calendar td#next a:before,
.wp-calendar-table td#prev a:before,
.wp-calendar-table td#next a:before,
.wp-block-calendar .wp-calendar-nav-prev a:before,
.wp-block-calendar .wp-calendar-nav-next a:before,
.widget_calendar .wp-calendar-nav-prev a:before,
.widget_calendar .wp-calendar-nav-next a:before {
	background-color: {$colors['alter_bg_color']};
}

/* Categories */
.widget_categories li {
	color: {$colors['text_dark']};
}


/* Tag cloud */
.widget_product_tag_cloud a:after,
.widget_tag_cloud a:after,
.wp-block-tag-cloud a:after {
	background-color: {$colors['inverse_link']};
}
.widget_product_tag_cloud a,
.widget_tag_cloud a,
.wp-block-tag-cloud a {
	color: {$colors['inverse_link']};
	background-color: {$colors['text_hover']};
}
.widget_product_tag_cloud a:hover,
.widget_tag_cloud a:hover,
.wp-block-tag-cloud a:hover {
	color: {$colors['inverse_link']} !important;
	background-color: {$colors['text_link']};
}


/* RSS */
.widget_rss .widget_title a:first-child {
	color: {$colors['text_link']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child {
	color: {$colors['alter_link']};
}
.widget_rss .widget_title a:first-child:hover {
	color: {$colors['text_hover']};
}
.scheme_self.sidebar .widget_rss .widget_title a:first-child:hover {
	color: {$colors['alter_hover']};
}
.widget_rss .rss-date {
	color: {$colors['text_light']};
}
.scheme_self.sidebar .widget_rss .rss-date {
	color: {$colors['alter_light']};
}

/* Footer */
.scheme_self.footer_wrap,
.footer_wrap .scheme_self.vc_row {
	color: {$colors['alter_text']};
}
.scheme_self.footer_wrap .widget,
.scheme_self.footer_wrap .sc_content .wpb_column,
.footer_wrap .scheme_self.vc_row .widget,
.footer_wrap .scheme_self.vc_row .sc_content .wpb_column {
	border-color: {$colors['alter_bd_color']};
}
.scheme_self.footer_wrap h1, .scheme_self.footer_wrap h2, .scheme_self.footer_wrap h3,
.scheme_self.footer_wrap h4, .scheme_self.footer_wrap h5, .scheme_self.footer_wrap h6,
.scheme_self.footer_wrap h1 a, .scheme_self.footer_wrap h2 a, .scheme_self.footer_wrap h3 a,
.scheme_self.footer_wrap h4 a, .scheme_self.footer_wrap h5 a, .scheme_self.footer_wrap h6 a,
.footer_wrap .scheme_self.vc_row h1, .footer_wrap .scheme_self.vc_row h2, .footer_wrap .scheme_self.vc_row h3,
.footer_wrap .scheme_self.vc_row h4, .footer_wrap .scheme_self.vc_row h5, .footer_wrap .scheme_self.vc_row h6,
.footer_wrap .scheme_self.vc_row h1 a, .footer_wrap .scheme_self.vc_row h2 a, .footer_wrap .scheme_self.vc_row h3 a,
.footer_wrap .scheme_self.vc_row h4 a, .footer_wrap .scheme_self.vc_row h5 a, .footer_wrap .scheme_self.vc_row h6 a {
	color: {$colors['alter_dark']};
}
.scheme_self.footer_wrap h1 a:hover, .scheme_self.footer_wrap h2 a:hover, .scheme_self.footer_wrap h3 a:hover,
.scheme_self.footer_wrap h4 a:hover, .scheme_self.footer_wrap h5 a:hover, .scheme_self.footer_wrap h6 a:hover,
.footer_wrap .scheme_self.vc_row h1 a:hover, .footer_wrap .scheme_self.vc_row h2 a:hover, .footer_wrap .scheme_self.vc_row h3 a:hover,
.footer_wrap .scheme_self.vc_row h4 a:hover, .footer_wrap .scheme_self.vc_row h5 a:hover, .footer_wrap .scheme_self.vc_row h6 a:hover {
	color: {$colors['alter_link']};
}

.scheme_self.footer_wrap a,
.footer_wrap .scheme_self.vc_row a {
}
.scheme_self.footer_wrap a:hover,
.footer_wrap .scheme_self.vc_row a:hover {
}

.footer_logo_inner {
	border-color: {$colors['alter_bd_color']};
}
.footer_logo_inner:after {
	background-color: {$colors['alter_text']};
}
.footer_socials_inner .social_item .social_icon {
	color: {$colors['alter_text']};
}
.footer_socials_inner .social_item:hover .social_icon {
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a {
	color: {$colors['alter_dark']};
}
.menu_footer_nav_area ul li a:hover {
	color: {$colors['alter_link']};
}
.menu_footer_nav_area ul li+li:before {
	border-color: {$colors['alter_light']};
}

.footer_copyright_inner {
	background-color: {$colors['bg_color']};
	border-color: {$colors['bd_color']};
	color: {$colors['text_dark']};
}
.footer_copyright_inner a {
	color: {$colors['text_dark']};
}
.footer_copyright_inner a:hover {
	color: {$colors['text_link']};
}
.footer_copyright_inner .copyright_text {
	color: {$colors['text']};
}


/* Third-party plugins */

.mfp-bg {
	background-color: {$colors['bg_color_07']};
}
.mfp-image-holder .mfp-close,
.mfp-iframe-holder .mfp-close,
.mfp-close-btn-in .mfp-close {
	color: {$colors['text_dark']};
	background-color: transparent;
}
.mfp-image-holder .mfp-close:hover,
.mfp-iframe-holder .mfp-close:hover,
.mfp-close-btn-in .mfp-close:hover {
	color: {$colors['text_link']};
}



.breadcrumbs a:hover,
.breadcrumbs a.breadcrumbs_item:hover {
	color: {$colors['text_link']} !important;
}

.minimal-light .esg-navigationbutton:hover, .minimal-light .esg-filterbutton:hover, .minimal-light .esg-sortbutton:hover, .minimal-light .esg-sortbutton-order:hover, .minimal-light .esg-cartbutton a:hover, .minimal-light .esg-filterbutton.selected {
	background-color: {$colors['text_link']} !important;
}


.post_item_404 .search_submit {
	color: {$colors['text_dark']};
}
.post_item_404 .search_submit:hover,
.post_item_404 .search_submit:focus {
	color: {$colors['text_link']};
}

.mc4wp-form .mc4wp-form-fields input[type="email"]:focus {
	border-color: {$colors['text_dark']};
}

.wpb-js-composer .vc_tta-color-grey.vc_tta-style-flat .vc_tta-panel.vc_active .vc_tta-panel-title > a {
	color: {$colors['text_link']};
}

.sidebar_inner .widget .select_container:before,
.sidebar_inner .widget .select_container {
	background-color: {$colors['alter_light']};
}


/* Submenu */
.sc_layouts_menu_popup .sc_layouts_menu_nav,
.sc_layouts_menu_nav > li ul {
	background-color: {$colors['extra_bg_color']};
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a,
.sc_layouts_menu_nav > li li > a {
	color: {$colors['extra_text']} !important;
}
.sc_layouts_menu_popup .sc_layouts_menu_nav > li > a:hover,
.sc_layouts_menu_popup .sc_layouts_menu_nav > li.sfHover > a,
.sc_layouts_menu_nav > li li > a:hover,
.sc_layouts_menu_nav > li li.sfHover > a {
	color: {$colors['extra_hover']} !important;
}
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children > a:hover,
.sc_layouts_menu_nav li[class*="columns-"] li.menu-item-has-children.sfHover > a {
	color: {$colors['extra_text']} !important;
	background-color: transparent;
}
.sc_layouts_menu_nav > li li[class*="icon-"]:before {
	color: {$colors['extra_hover']};
}
.sc_layouts_menu_nav > li li[class*="icon-"]:hover:before,
.sc_layouts_menu_nav > li li[class*="icon-"].shHover:before {
	color: {$colors['extra_hover']};
}
.sc_layouts_menu_nav > li li.current-menu-item > a,
.sc_layouts_menu_nav > li li.current-menu-parent > a,
.sc_layouts_menu_nav > li li.current-menu-ancestor > a {
	color: {$colors['extra_hover']} !important;
}
.sc_layouts_menu_nav > li li.current-menu-item:before,
.sc_layouts_menu_nav > li li.current-menu-parent:before,
.sc_layouts_menu_nav > li li.current-menu-ancestor:before {
	color: {$colors['extra_hover']} !important;
}

/* Mobile menu */
.scheme_self.menu_side_wrap .menu_side_button {
	color: {$colors['alter_dark']};
	border-color: {$colors['alter_bd_color']};
	background-color: {$colors['alter_bg_color_07']};
}
.scheme_self.menu_side_wrap .menu_side_button:hover {
	color: {$colors['inverse_hover']};
	border-color: {$colors['alter_hover']};
	background-color: {$colors['alter_link']};
}
.menu_side_inner,
.menu_mobile_inner {
	color: {$colors['alter_text']};
	background-color: {$colors['alter_bg_color']};
}
.menu_mobile_button {
	color: {$colors['text_dark']};
}
.menu_mobile_button:hover {
	color: {$colors['text_link']};
}
.menu_mobile_close:before,
.menu_mobile_close:after {
	border-color: {$colors['alter_dark']};
}
.menu_mobile_close:hover:before,
.menu_mobile_close:hover:after {
	border-color: {$colors['alter_link']};
}
.menu_mobile_inner a,
.menu_mobile_inner .menu_mobile_nav_area li:before {
	color: {$colors['alter_dark']};
}
.menu_mobile_inner a:hover,
.menu_mobile_inner .current-menu-ancestor > a,
.menu_mobile_inner .current-menu-item > a,
.menu_mobile_inner .menu_mobile_nav_area li:hover:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-ancestor:before,
.menu_mobile_inner .menu_mobile_nav_area li.current-menu-item:before {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .search_mobile .search_submit {
	color: {$colors['input_light']};
}
.menu_mobile_inner .search_mobile .search_submit:focus,
.menu_mobile_inner .search_mobile .search_submit:hover {
	color: {$colors['input_dark']};
}

.menu_mobile_inner .social_item .social_icon {
	color: {$colors['alter_link']};
}
.menu_mobile_inner .social_item:hover .social_icon {
	color: {$colors['alter_dark']};
}


.footer_wrap.footer_default .widget .widget_title:after,
.footer_wrap.footer_default .widget .widgettitle:after {
	background-color: {$colors['bd_color']};
}
.footer_wrap.footer_default .widget {
	background-color: {$colors['inverse_link']};
}
.footer_wrap.footer_default {
	background-color: {$colors['bd_color']};
}

.sticky {
	background-color: {$colors['alter_bg_color']};
}


.post_layout_excerpt.sticky,
.post_layout_excerpt.sticky .wrap_post_single {
	background-color: {$colors['text_dark']};
	color: {$colors['inverse_text']};
}
.post_layout_excerpt.sticky .post_meta_item a:hover,
.post_layout_excerpt.sticky .post_meta_item a:hover:before {
	color: {$colors['inverse_text']};
}
.post_layout_excerpt.sticky .post_title a {
	color: {$colors['inverse_text']};
}
.post_layout_excerpt.sticky .post_title a:hover {
	color: {$colors['text_link']};
}
.post_layout_excerpt.sticky .more-link:hover {
	color: {$colors['text_link']};
	background-color: {$colors['inverse_text']};
}

.post_layout_excerpt,
.wrap_post_single {
	background-color: {$colors['alter_bg_color']};
}

.ua_ie .style_text > *,
.ua_ie .post_item_404 .page_title,
.ua_ie .post_item_none_search .page_title,
.ua_ie .post_item_none_archive .page_title,
.ua_ie h2.sc_item_title.sc_item_title_style_default:not(.sc_item_title_tag),
.ua_ie .trx_addons_dropcap.trx_addons_dropcap_style_1,
.ua_ie .sc_layouts_title_caption,
.ua_ie .style_slider_text{
	color: {$colors['text_dark']} !important;
}




CSS;
				
					$rez = apply_filters('clothing69_filter_get_css', $rez, $colors, false, $scheme);
					$css['colors'] .= $rez['colors'];
				}
			}
		}
				
		$css_str = (!empty($css['fonts']) ? $css['fonts'] : '')
				. (!empty($css['colors']) ? $css['colors'] : '');
		return apply_filters( 'clothing69_filter_prepare_css', $css_str, $remove_spaces );
	}
}
?>