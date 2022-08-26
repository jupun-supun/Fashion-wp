<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.10
 */

$clothing69_footer_scheme =  clothing69_is_inherit(clothing69_get_theme_option('footer_scheme')) ? clothing69_get_theme_option('color_scheme') : clothing69_get_theme_option('footer_scheme');
?>
<footer class="footer_wrap footer_default scheme_<?php echo esc_attr($clothing69_footer_scheme); ?>">
	<?php

	// Footer widgets area
	get_template_part( 'templates/footer-widgets' );

	// Logo
	get_template_part( 'templates/footer-logo' );

	// Socials
	get_template_part( 'templates/footer-socials' );

	// Menu
	get_template_part( 'templates/footer-menu' );

	// Copyright area
	get_template_part( 'templates/footer-copyright' );
	
	?>
</footer><!-- /.footer_wrap -->
