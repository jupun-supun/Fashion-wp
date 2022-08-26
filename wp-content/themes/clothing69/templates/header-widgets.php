<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

// Header sidebar
$clothing69_header_name = clothing69_get_theme_option('header_widgets');
$clothing69_header_present = !clothing69_is_off($clothing69_header_name) && is_active_sidebar($clothing69_header_name);
if ($clothing69_header_present) { 
	clothing69_storage_set('current_sidebar', 'header');
	$clothing69_header_wide = clothing69_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($clothing69_header_name) ) {
		dynamic_sidebar($clothing69_header_name);
	}
	$clothing69_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($clothing69_widgets_output)) {
		$clothing69_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $clothing69_widgets_output);
		$clothing69_need_columns = strpos($clothing69_widgets_output, 'columns_wrap')===false;
		if ($clothing69_need_columns) {
			$clothing69_columns = max(0, (int) clothing69_get_theme_option('header_columns'));
			if ($clothing69_columns == 0) $clothing69_columns = min(6, max(1, substr_count($clothing69_widgets_output, '<aside ')));
			if ($clothing69_columns > 1)
				$clothing69_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($clothing69_columns).' widget ', $clothing69_widgets_output);
			else
				$clothing69_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($clothing69_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$clothing69_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($clothing69_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'clothing69_action_before_sidebar' );
				clothing69_show_layout($clothing69_widgets_output);
				do_action( 'clothing69_action_after_sidebar' );
				if ($clothing69_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$clothing69_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>