<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_post_id    = get_the_ID();
$clothing69_post_date  = clothing69_get_date();
$clothing69_post_title = get_the_title();
$clothing69_post_link  = get_permalink();
$clothing69_post_author_id   = get_the_author_meta('ID');
$clothing69_post_author_name = get_the_author_meta('display_name');
$clothing69_post_author_url  = get_author_posts_url($clothing69_post_author_id, '');

$clothing69_args = get_query_var('clothing69_args_widgets_posts');
$clothing69_show_date = isset($clothing69_args['show_date']) ? (int) $clothing69_args['show_date'] : 1;
$clothing69_show_image = isset($clothing69_args['show_image']) ? (int) $clothing69_args['show_image'] : 1;
$clothing69_show_author = isset($clothing69_args['show_author']) ? (int) $clothing69_args['show_author'] : 1;
$clothing69_show_counters = isset($clothing69_args['show_counters']) ? (int) $clothing69_args['show_counters'] : 1;
$clothing69_show_categories = isset($clothing69_args['show_categories']) ? (int) $clothing69_args['show_categories'] : 1;

$clothing69_output = clothing69_storage_get('clothing69_output_widgets_posts');

$clothing69_post_counters_output = '';
if ( $clothing69_show_counters ) {
	$clothing69_post_counters_output = '<span class="post_info_item post_info_counters">'
								. clothing69_get_post_counters('comments')
							. '</span>';
}


$clothing69_output .= '<article class="post_item with_thumb">';

if ($clothing69_show_image) {
	$clothing69_post_thumb = get_the_post_thumbnail($clothing69_post_id, clothing69_get_thumb_size('tiny'), array(
		'alt' => the_title_attribute( array( 'echo' => false ) )
	));
	if ($clothing69_post_thumb) $clothing69_output .= '<div class="post_thumb">' . ($clothing69_post_link ? '<a href="' . esc_url($clothing69_post_link) . '">' : '') . ($clothing69_post_thumb) . ($clothing69_post_link ? '</a>' : '') . '</div>';
}

$clothing69_output .= '<div class="post_content">'
			. ($clothing69_show_categories 
					? '<div class="post_categories">'
						. clothing69_get_post_categories()
						. $clothing69_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($clothing69_post_link ? '<a href="' . esc_url($clothing69_post_link) . '">' : '') . ($clothing69_post_title) . ($clothing69_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('clothing69_filter_get_post_info', 
								'<div class="post_info">'
									. ($clothing69_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($clothing69_post_link ? '<a href="' . esc_url($clothing69_post_link) . '" class="post_info_date">' : '') 
											. esc_html($clothing69_post_date) 
											. ($clothing69_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($clothing69_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'clothing69') . ' ' 
											. ($clothing69_post_link ? '<a href="' . esc_url($clothing69_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($clothing69_post_author_name) 
											. ($clothing69_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$clothing69_show_categories && $clothing69_post_counters_output
										? $clothing69_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
clothing69_storage_set('clothing69_output_widgets_posts', $clothing69_output);
?>