<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_link = get_permalink();
$clothing69_post_format = get_post_format();
$clothing69_post_format = empty($clothing69_post_format) ? 'standard' : str_replace('post-format-', '', $clothing69_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($clothing69_post_format) ); ?>><?php
	clothing69_show_post_featured(array(
		'thumb_size' => clothing69_get_thumb_size( 'big' ),
		'show_no_image' => false,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . clothing69_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($clothing69_link) . '">' . wp_kses( get_the_title(), 'clothing69_kses_content' ) . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($clothing69_link) . '">' . clothing69_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>