<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.10
 */

// Footer sidebar
$clothing69_footer_name = clothing69_get_theme_option('footer_widgets');
$clothing69_footer_present = !clothing69_is_off($clothing69_footer_name) && is_active_sidebar($clothing69_footer_name);
if ($clothing69_footer_present) { 
	clothing69_storage_set('current_sidebar', 'footer');
	$clothing69_footer_wide = clothing69_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($clothing69_footer_name) ) {
		dynamic_sidebar($clothing69_footer_name);
	}
	$clothing69_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($clothing69_out)) {
		$clothing69_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $clothing69_out);
		$clothing69_need_columns = true;
		if ($clothing69_need_columns) {
			$clothing69_columns = max(0, (int) clothing69_get_theme_option('footer_columns'));
			if ($clothing69_columns == 0) $clothing69_columns = min(6, max(1, substr_count($clothing69_out, '<aside ')));
			if ($clothing69_columns > 1)
				$clothing69_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($clothing69_columns).' widget ', $clothing69_out);
			else
				$clothing69_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($clothing69_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$clothing69_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($clothing69_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'clothing69_action_before_sidebar' );
				clothing69_show_layout($clothing69_out);
				do_action( 'clothing69_action_after_sidebar' );
				if ($clothing69_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$clothing69_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>