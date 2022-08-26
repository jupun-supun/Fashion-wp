<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_args = get_query_var('clothing69_logo_args');

// Site logo
$clothing69_logo_image  = clothing69_get_logo_image(isset($clothing69_args['type']) ? $clothing69_args['type'] : '');
$clothing69_logo_text   = clothing69_is_on(clothing69_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$clothing69_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($clothing69_logo_image) || !empty($clothing69_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($clothing69_logo_image)) {
			$clothing69_attr = clothing69_getimagesize($clothing69_logo_image);
			echo '<img src="'.esc_url($clothing69_logo_image).'" alt="'.esc_attr__('logo', 'clothing69').'"'.(!empty($clothing69_attr[3]) ? sprintf(' %s', $clothing69_attr[3]) : '').'>' ;
		} else {
			clothing69_show_layout(clothing69_prepare_macros($clothing69_logo_text), '<span class="logo_text">', '</span>');
			clothing69_show_layout(clothing69_prepare_macros($clothing69_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>