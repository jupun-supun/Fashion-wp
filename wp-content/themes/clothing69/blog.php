<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the WPBakery Page Builder to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$clothing69_content = '';
$clothing69_blog_archive_mask = '%%CONTENT%%';
$clothing69_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $clothing69_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($clothing69_content = apply_filters('the_content', get_the_content())) != '') {
		if (($clothing69_pos = strpos($clothing69_content, $clothing69_blog_archive_mask)) !== false) {
			$clothing69_content = preg_replace('/(\<p\>\s*)?'.$clothing69_blog_archive_mask.'(\s*\<\/p\>)/i', $clothing69_blog_archive_subst, $clothing69_content);
		} else
			$clothing69_content .= $clothing69_blog_archive_subst;
		$clothing69_content = explode($clothing69_blog_archive_mask, $clothing69_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) clothing69_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$clothing69_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$clothing69_args = clothing69_query_add_posts_and_cats($clothing69_args, '', clothing69_get_theme_option('post_type'), clothing69_get_theme_option('parent_cat'));
$clothing69_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($clothing69_page_number > 1) {
	$clothing69_args['paged'] = $clothing69_page_number;
	$clothing69_args['ignore_sticky_posts'] = true;
}
$clothing69_ppp = clothing69_get_theme_option('posts_per_page');
if ((int) $clothing69_ppp != 0)
	$clothing69_args['posts_per_page'] = (int) $clothing69_ppp;
// Make a new query
query_posts( $clothing69_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($clothing69_content) && count($clothing69_content) == 2) {
	set_query_var('blog_archive_start', $clothing69_content[0]);
	set_query_var('blog_archive_end', $clothing69_content[1]);
}

get_template_part('index');
?>