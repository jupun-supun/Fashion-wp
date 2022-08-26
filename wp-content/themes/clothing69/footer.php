<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

						// Widgets area inside page content
						clothing69_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					clothing69_create_widgets_area('widgets_below_page');

					$clothing69_body_style = clothing69_get_theme_option('body_style');
					if ($clothing69_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$clothing69_footer_style = clothing69_get_theme_option("footer_style");
			if (strpos($clothing69_footer_style, 'footer-custom-')===0) $clothing69_footer_style = 'footer-custom';
			get_template_part( "templates/{$clothing69_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (clothing69_is_on(clothing69_get_theme_option('debug_mode')) && clothing69_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(clothing69_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>