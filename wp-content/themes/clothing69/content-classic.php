<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_blog_style = explode('_', clothing69_get_theme_option('blog_style'));
$clothing69_columns = empty($clothing69_blog_style[1]) ? 2 : max(2, $clothing69_blog_style[1]);
$clothing69_expanded = !clothing69_sidebar_present() && clothing69_is_on(clothing69_get_theme_option('expand_content'));
$clothing69_post_format = get_post_format();
$clothing69_post_format = empty($clothing69_post_format) ? 'standard' : str_replace('post-format-', '', $clothing69_post_format);
$clothing69_animation = clothing69_get_theme_option('blog_animation');

?><div class="<?php echo esc_attr($clothing69_blog_style[0] == 'classic' ? 'column' : 'masonry_item masonry_item'); ?>-1_<?php echo esc_attr($clothing69_columns); ?>"><article id="post-<?php the_ID(); ?>"
	<?php post_class( 'post_item post_format_'.esc_attr($clothing69_post_format)
					. ' post_layout_classic post_layout_classic_'.esc_attr($clothing69_columns)
					. ' post_layout_'.esc_attr($clothing69_blog_style[0]) 
					. ' post_layout_'.esc_attr($clothing69_blog_style[0]).'_'.esc_attr($clothing69_columns)
					); ?>
	<?php echo (!clothing69_is_off($clothing69_animation) ? ' data-animation="'.esc_attr(clothing69_get_animation_classes($clothing69_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	clothing69_show_post_featured( array( 'thumb_size' => clothing69_get_thumb_size($clothing69_blog_style[0] == 'classic'
													? (strpos(clothing69_get_theme_option('body_style'), 'full')!==false 
															? ( $clothing69_columns > 2 ? 'big' : 'huge' )
															: (	$clothing69_columns > 2
																? ($clothing69_expanded ? 'med' : 'small')
																: ($clothing69_expanded ? 'big' : 'med')
																)
														)
													: (strpos(clothing69_get_theme_option('body_style'), 'full')!==false 
															? ( $clothing69_columns > 2 ? 'masonry-big' : 'full' )
															: (	$clothing69_columns <= 2 && $clothing69_expanded ? 'masonry-big' : 'masonry')
														)
								) ) );

	if ( !in_array($clothing69_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php 
			do_action('clothing69_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

			do_action('clothing69_action_before_post_meta'); 

			// Post meta
			clothing69_show_post_meta(array(
				'categories' => true,
				'date' => true,
				'edit' => $clothing69_columns < 3,
				'seo' => false,
				'share' => false,
				'counters' => 'comments',
				)
			);
			?>
		</div><!-- .entry-header -->
		<?php
	}		
	?>

	<div class="post_content entry-content">
		<div class="post_content_inner">
			<?php
			$clothing69_show_learn_more = false;
			if (has_excerpt()) {
				the_excerpt();
			} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
				the_content( '' );
			} else if (in_array($clothing69_post_format, array('link', 'aside', 'status', 'quote'))) {
				the_content();
			} else if (substr(get_the_content(), 0, 1)!='[') {
				the_excerpt();
			}
			?>
		</div>
		<?php
		// Post meta
		if (in_array($clothing69_post_format, array('link', 'aside', 'status', 'quote'))) {
			clothing69_show_post_meta(array(
				'share' => false,
				'counters' => 'comments'
				)
			);
		}
		// More button
		if ( $clothing69_show_learn_more ) {
			?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'clothing69'); ?></a></p><?php
		}
		?>
	</div><!-- .entry-content -->

</article></div>