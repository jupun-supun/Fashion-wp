<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

clothing69_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$clothing69_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$clothing69_sticky_out = clothing69_get_theme_option('sticky_style')=='columns' 
							&& is_array($clothing69_stickies) && count($clothing69_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($clothing69_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($clothing69_sticky_out && !is_sticky()) {
			$clothing69_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $clothing69_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($clothing69_sticky_out) {
		$clothing69_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	clothing69_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>