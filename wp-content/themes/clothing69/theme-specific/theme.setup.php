<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.22
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
if ( !function_exists('clothing69_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'clothing69_customizer_theme_setup1', 1 );
	function clothing69_customizer_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		clothing69_storage_set('load_fonts', array(
			// Google font
			array(
				'name'	 => 'Questrial',
				'family' => 'sans-serif',
				'styles' => '400'		// Parameter 'style' used only for the Google fonts
				),
			// Font-face packed with theme
			array(
				'name'   => 'Montserrat',
				'family' => 'sans-serif'
				)
		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		clothing69_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		clothing69_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'clothing69'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'clothing69'),
				'font-family'		=> 'Questrial, sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.62em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0.2px',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '5.625em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.1em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '-0.25px',
				'margin-top'		=> '1.025em',
				'margin-bottom'		=> '0.39em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '4.750em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.1111em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '-0.18px',
				'margin-top'		=> '1.1em',
				'margin-bottom'		=> '0.3em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '3.938em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.13em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.09em',
				'margin-bottom'		=> '0.4em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '3.000em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.13em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '-0.1px',
				'margin-top'		=> '1.3em',
				'margin-bottom'		=> '0.5em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '2.250em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '1.65em',
				'margin-bottom'		=> '0.66em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '1.188em',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.4706em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '2.98em',
				'margin-bottom'		=> '1.36em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'clothing69'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '1.6em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.5px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.4px'
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'clothing69'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '13px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'clothing69'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'clothing69'),
				'description'		=> esc_html__('Font settings of the main menu items', 'clothing69'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'clothing69'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'clothing69'),
				'font-family'		=> 'Questrial, sans-serif',
				'font-size' 		=> '16px',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		clothing69_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'clothing69'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#ffffff',
					'bd_color'				=> '#ebe9e6',
		
					// Text and links colors
					'text'					=> '#2c292c',
					'text_light'			=> '#aba9a5',
					'text_dark'				=> '#2c292c',
					'text_link'				=> '#c33442',
					'text_hover'			=> '#2c292c',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'		=> '#ebe9e6',
					'alter_bg_hover'		=> '#e6e8eb',
					'alter_bd_color'		=> '#e5e5e5',
					'alter_bd_hover'		=> '#dadada',
					'alter_text'			=> '#333333',
					'alter_light'			=> '#b7b7b7',
					'alter_dark'			=> '#1d1d1d',
					'alter_link'			=> '#c33442',
					'alter_hover'			=> '#2c292c',
		
					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'		=> '#2c292c',
					'extra_bg_hover'		=> '#28272e',
					'extra_bd_color'		=> '#313131',
					'extra_bd_hover'		=> '#3d3d3d',
					'extra_text'			=> '#ebe9e6',
					'extra_light'			=> '#969593',
					'extra_dark'			=> '#ffffff',
					'extra_link'			=> '#2c292c',
					'extra_hover'			=> '#e84c5c',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#ebe9e6',
					'input_bg_hover'		=> '#ebe9e6',
					'input_bd_color'		=> '#ebe9e6',
					'input_bd_hover'		=> '#e0e0e0',
					'input_text'			=> '#2c292c',
					'input_light'			=> '#2c292c',
					'input_dark'			=> '#2c292c',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#ffffff',
					'inverse_light'			=> '#333333',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#1d1d1d',
		
					// Additional accented colors (if used in the current theme)
				
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'clothing69'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#0e0d12',
					'bd_color'				=> '#1c1b1f',
		
					// Text and links colors
					'text'					=> '#b7b7b7',
					'text_light'			=> '#5f5f5f',
					'text_dark'				=> '#ffffff',
					'text_link'				=> '#fe7259',
					'text_hover'			=> '#c33442',
		
					// Alternative blocks (sidebar, tabs, alternative blocks, etc.)
					'alter_bg_color'		=> '#1e1d22',
					'alter_bg_hover'		=> '#28272e',
					'alter_bd_color'		=> '#313131',
					'alter_bd_hover'		=> '#3d3d3d',
					'alter_text'			=> '#a6a6a6',
					'alter_light'			=> '#5f5f5f',
					'alter_dark'			=> '#ffffff',
					'alter_link'			=> '#c33442',
					'alter_hover'			=> '#fe7259',

					// Extra blocks (submenu, tabs, color blocks, etc.)
					'extra_bg_color'		=> '#1e1d22',
					'extra_bg_hover'		=> '#28272e',
					'extra_bd_color'		=> '#313131',
					'extra_bd_hover'		=> '#3d3d3d',
					'extra_text'			=> '#a6a6a6',
					'extra_light'			=> '#5f5f5f',
					'extra_dark'			=> '#ffffff',
					'extra_link'			=> '#c33442',
					'extra_hover'			=> '#fe7259',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#2e2d32',
					'input_bg_hover'		=> '#2e2d32',
					'input_bd_color'		=> '#2e2d32',
					'input_bd_hover'		=> '#353535',
					'input_text'			=> '#b7b7b7',
					'input_light'			=> '#5f5f5f',
					'input_dark'			=> '#ffffff',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#1d1d1d',
					'inverse_light'			=> '#5f5f5f',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#1d1d1d',
				
					// Additional accented colors (if used in the current theme)
		
				)
			)
		
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('clothing69_customizer_add_theme_colors')) {
	function clothing69_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = clothing69_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = clothing69_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = clothing69_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = clothing69_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = clothing69_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = clothing69_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = clothing69_hex2rgba( $colors['alter_bg_color'], 0.4 );
			$colors['alter_bg_color_02']  = clothing69_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = clothing69_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['extra_bg_color_07']  = clothing69_hex2rgba( $colors['extra_bg_color'], 0.7 );
			$colors['text_dark_07']  = clothing69_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = clothing69_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = clothing69_hex2rgba( $colors['text_link'], 0.7 );
			$colors['text_link_blend'] = clothing69_hsb2hex(clothing69_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = clothing69_hsb2hex(clothing69_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['extra_bg_color_07'] = '{{ data.extra_bg_color_07 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('clothing69_customizer_add_theme_fonts')) {
	function clothing69_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !clothing69_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !clothing69_is_inherit($font['font-size'])
														? 'font-size:' . clothing69_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !clothing69_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !clothing69_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !clothing69_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !clothing69_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !clothing69_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !clothing69_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !clothing69_is_inherit($font['margin-top'])
														? 'margin-top:' . clothing69_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !clothing69_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . clothing69_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('clothing69_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'clothing69_customizer_theme_setup' );
	function clothing69_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('clothing69_filter_add_thumb_sizes', array(
			'clothing69-thumb-huge'		=> array(1170, 736, true),
			'clothing69-thumb-big' 		=> array( 765, 480, true),
			'clothing69-thumb-med' 		=> array( 370, 208, true),
			'clothing69-thumb-extra' 		=> array( 565, 565, true),
			'clothing69-thumb-tiny' 		=> array(  90,  90, true),
			'clothing69-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'clothing69-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = clothing69_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'clothing69_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('clothing69_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'clothing69_customizer_image_sizes' );
	function clothing69_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('clothing69_filter_add_thumb_sizes', array(
			'clothing69-thumb-huge'		=> esc_html__( 'Fullsize image', 'clothing69' ),
			'clothing69-thumb-big'			=> esc_html__( 'Large image', 'clothing69' ),
			'clothing69-thumb-med'			=> esc_html__( 'Medium image', 'clothing69' ),
			'clothing69-thumb-extra'		=> esc_html__( 'Extra image', 'clothing69' ),
			'clothing69-thumb-tiny'		=> esc_html__( 'Small square avatar', 'clothing69' ),
			'clothing69-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'clothing69' ),
			'clothing69-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'clothing69' ),
			)
		);
		$mult = clothing69_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'clothing69' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'clothing69_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'clothing69_customizer_trx_addons_add_thumb_sizes');
	function clothing69_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-extra',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'clothing69_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'clothing69_customizer_trx_addons_get_thumb_size');
	function clothing69_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-extra',
							'trx_addons-thumb-extra-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'clothing69-thumb-huge',
							'clothing69-thumb-huge-@retina',
							'clothing69-thumb-big',
							'clothing69-thumb-big-@retina',
							'clothing69-thumb-med',
							'clothing69-thumb-med-@retina',
							'clothing69-thumb-extra',
							'clothing69-thumb-extra-@retina',
							'clothing69-thumb-tiny',
							'clothing69-thumb-tiny-@retina',
							'clothing69-thumb-masonry-big',
							'clothing69-thumb-masonry-big-@retina',
							'clothing69-thumb-masonry',
							'clothing69-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}
?>