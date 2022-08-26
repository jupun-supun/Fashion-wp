<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('clothing69_mailchimp_get_css')) {
	add_filter('clothing69_filter_get_css', 'clothing69_mailchimp_get_css', 10, 4);
	function clothing69_mailchimp_get_css($css, $colors, $fonts, $scheme='') {
		
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS

CSS;
		
			
			$rad = clothing69_get_border_radius();
			$css['fonts'] .= <<<CSS

.mc4wp-form .mc4wp-form-fields input[type="email"],
.mc4wp-form .mc4wp-form-fields input[type="submit"] {
	-webkit-border-radius: {$rad};
	    -ms-border-radius: {$rad};
			border-radius: {$rad};
}

CSS;
		}

		
		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

.mc4wp-form input[type="email"] {
	background-color: {$colors['alter_dark']};
	border-color: {$colors['alter_dark']};
	color: {$colors['bg_color']};
}
.mc4wp-form input[type="email"]:focus {
	border-color: {$colors['input_bd_hover']};
}
.mc4wp-form input[type="email"]::-webkit-input-placeholder { color: {$colors['bg_color']}; opacity: 1; }
.mc4wp-form input[type="email"]::-moz-placeholder { color: {$colors['bg_color']}; opacity: 1; }
.mc4wp-form input[type="email"]:-ms-input-placeholder { color: {$colors['bg_color']}; opacity: 1; }


CSS;
		}

		return $css;
	}
}
?>