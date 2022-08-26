<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_blog_style = explode('_', clothing69_get_theme_option('blog_style'));
$clothing69_columns = empty($clothing69_blog_style[1]) ? 2 : max(2, $clothing69_blog_style[1]);
$clothing69_post_format = get_post_format();
$clothing69_post_format = empty($clothing69_post_format) ? 'standard' : str_replace('post-format-', '', $clothing69_post_format);
$clothing69_animation = clothing69_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($clothing69_columns).' post_format_'.esc_attr($clothing69_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!clothing69_is_off($clothing69_animation) ? ' data-animation="'.esc_attr(clothing69_get_animation_classes($clothing69_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$clothing69_image_hover = clothing69_get_theme_option('image_hover');
	// Featured image
	clothing69_show_post_featured(array(
		'thumb_size' => clothing69_get_thumb_size(strpos(clothing69_get_theme_option('body_style'), 'full')!==false || $clothing69_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $clothing69_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $clothing69_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>