<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_post_format = get_post_format();
$clothing69_post_format = empty($clothing69_post_format) ? 'standard' : str_replace('post-format-', '', $clothing69_post_format);
$clothing69_full_content = clothing69_get_theme_option('blog_content') != 'excerpt' || in_array($clothing69_post_format, array('link', 'aside', 'status', 'quote'));
$clothing69_animation = clothing69_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($clothing69_post_format) ); ?>
	<?php echo (!clothing69_is_off($clothing69_animation) ? ' data-animation="'.esc_attr(clothing69_get_animation_classes($clothing69_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	clothing69_show_post_featured(array( 'thumb_size' => clothing69_get_thumb_size( strpos(clothing69_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));
	?>
	<div class="wrap_post_single">
	<?php
	if ( false && is_sticky() && !is_paged() ) {
		?><div class="post_sticky_wrap"><?php
	}

	// Title and post meta
	if (get_the_title() != '') {
		?>
		<div class="post_header entry-header">
			<?php
			do_action('clothing69_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

			?>
		</div><!-- .post_header --><?php
	}
	
	// Post content
	?><div class="post_content entry-content"><?php
		if ($clothing69_full_content) {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'clothing69' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'clothing69' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$clothing69_show_learn_more = !in_array($clothing69_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($clothing69_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php



			do_action('clothing69_action_before_post_meta');

			// Post meta
			clothing69_show_post_meta(array(
					'categories' => true,
					'date' => true,
					'edit' => false,
					'seo' => false,
					'share' => false,
					'counters' => 'comments'	//comments,likes,views - comma separated in any combination
				)
			);


			// More button
			if ( $clothing69_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('more info', 'clothing69'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
	<?php
	if ( false && is_sticky() && !is_paged() ) {
	?></div><?php
	} ?>
	</div>
</article>