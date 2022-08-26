<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$clothing69_post_format = get_post_format();
$clothing69_post_format = empty($clothing69_post_format) ? 'standard' : str_replace('post-format-', '', $clothing69_post_format);
$clothing69_animation = clothing69_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($clothing69_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($clothing69_post_format) ); ?>
	<?php echo (!clothing69_is_off($clothing69_animation) ? ' data-animation="'.esc_attr(clothing69_get_animation_classes($clothing69_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	clothing69_show_post_featured(array(
		'thumb_size' => clothing69_get_thumb_size($clothing69_columns==1 ? 'big' : ($clothing69_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($clothing69_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			clothing69_show_post_meta();
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>