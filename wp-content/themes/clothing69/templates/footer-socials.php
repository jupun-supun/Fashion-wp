<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.10
 */


// Socials
if ( clothing69_is_on(clothing69_get_theme_option('socials_in_footer')) && ($clothing69_output = clothing69_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php clothing69_show_layout($clothing69_output); ?>
		</div>
	</div>
	<?php
}
?>