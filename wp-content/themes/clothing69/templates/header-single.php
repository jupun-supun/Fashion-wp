<?php
/**
 * The template to display the featured image in the single post
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

if ( get_query_var('clothing69_header_image')=='' && is_singular() && has_post_thumbnail() && in_array(get_post_type(), array('post', 'page')) )  {
	$clothing69_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	if (!empty($clothing69_src[0])) {
		clothing69_sc_layouts_showed('featured', true);
		?><div class="sc_layouts_featured with_image <?php echo esc_attr(clothing69_add_inline_css_class('background-image:url('.esc_url($clothing69_src[0]).');')); ?>"></div><?php
	}
}
?>