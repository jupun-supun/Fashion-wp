<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.10
 */

// Logo
if (clothing69_is_on(clothing69_get_theme_option('logo_in_footer'))) {
	$clothing69_logo_image = '';
	if (clothing69_get_retina_multiplier(2) > 1)
		$clothing69_logo_image = clothing69_get_theme_option( 'logo_footer_retina' );
	if (empty($clothing69_logo_image)) 
		$clothing69_logo_image = clothing69_get_theme_option( 'logo_footer' );
	$clothing69_logo_text   = get_bloginfo( 'name' );
	if (!empty($clothing69_logo_image) || !empty($clothing69_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($clothing69_logo_image)) {
					$clothing69_attr = clothing69_getimagesize($clothing69_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($clothing69_logo_image).'" class="logo_footer_image" alt="'.esc_attr__('logo', 'clothing69').'"'.(!empty($clothing69_attr[3]) ? sprintf(' %s', $clothing69_attr[3]) : '').'></a>' ;
				} else if (!empty($clothing69_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($clothing69_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>