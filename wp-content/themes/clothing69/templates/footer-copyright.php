<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.10
 */

// Copyright area
$clothing69_footer_scheme =  clothing69_is_inherit(clothing69_get_theme_option('footer_scheme')) ? clothing69_get_theme_option('color_scheme') : clothing69_get_theme_option('footer_scheme');
$clothing69_copyright_scheme = clothing69_is_inherit(clothing69_get_theme_option('copyright_scheme')) ? $clothing69_footer_scheme : clothing69_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($clothing69_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div>
			<div class="copyright_text"><?php
				$clothing69_copyright = clothing69_prepare_macros(clothing69_get_theme_option('copyright'));
				if (!empty($clothing69_copyright)) {
					clothing69_show_layout(do_shortcode(str_replace(array('{{Y}}', '{Y}'), date('Y'), clothing69_get_theme_option('copyright'))));
				}
				?></div>
		</div>
	</div>
</div>
