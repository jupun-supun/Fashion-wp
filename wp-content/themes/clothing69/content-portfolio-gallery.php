<?php
/**
 * The Gallery template to display posts
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
$clothing69_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_gallery post_layout_gallery_'.esc_attr($clothing69_columns).' post_format_'.esc_attr($clothing69_post_format) ); ?>
	<?php echo (!clothing69_is_off($clothing69_animation) ? ' data-animation="'.esc_attr(clothing69_get_animation_classes($clothing69_animation)).'"' : ''); ?>
	data-size="<?php if (!empty($clothing69_image[1]) && !empty($clothing69_image[2])) echo intval($clothing69_image[1]) .'x' . intval($clothing69_image[2]); ?>"
	data-src="<?php if (!empty($clothing69_image[0])) echo esc_url($clothing69_image[0]); ?>"
	>

	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$clothing69_image_hover = 'icon';
	if (in_array($clothing69_image_hover, array('icons', 'zoom'))) $clothing69_image_hover = 'dots';
	clothing69_show_post_featured(array(
		'hover' => $clothing69_image_hover,
		'thumb_size' => clothing69_get_thumb_size( strpos(clothing69_get_theme_option('body_style'), 'full')!==false || $clothing69_columns < 3 ? 'masonry-big' : 'masonry' ),
		'thumb_only' => true,
		'show_no_image' => true,
		'post_info' => '<div class="post_details">'
							. '<h2 class="post_title"><a href="'.esc_url(get_permalink()).'">'. esc_html(get_the_title()) . '</a></h2>'
							. '<div class="post_description">'
								. clothing69_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => true,
									'counters' => 'comments',
									'echo' => false
									))
								. '<div class="post_description_content">'
									. apply_filters('the_excerpt', get_the_excerpt())
								. '</div>'
								. '<a href="'.esc_url(get_permalink()).'" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__('Learn more', 'clothing69') . '</span></a>'
							. '</div>'
						. '</div>'
	));
	?>
</article>