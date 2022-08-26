<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.10
 */

// Footer menu
$clothing69_menu_footer = clothing69_get_nav_menu('menu_footer');
if (!empty($clothing69_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php clothing69_show_layout($clothing69_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>