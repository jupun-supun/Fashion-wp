<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_sidebar_position = clothing69_get_theme_option('sidebar_position');
if (clothing69_sidebar_present()) {
	ob_start();
	$clothing69_sidebar_name = clothing69_get_theme_option('sidebar_widgets');
	clothing69_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($clothing69_sidebar_name) ) {
		dynamic_sidebar($clothing69_sidebar_name);
	}
	$clothing69_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($clothing69_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($clothing69_sidebar_position); ?> widget_area<?php if (!clothing69_is_inherit(clothing69_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(clothing69_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'clothing69_action_before_sidebar' );
				clothing69_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $clothing69_out));
				do_action( 'clothing69_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>