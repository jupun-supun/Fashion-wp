<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

$clothing69_link = get_permalink();
$clothing69_post_format = get_post_format();
$clothing69_post_format = empty($clothing69_post_format) ? 'standard' : str_replace('post-format-', '', $clothing69_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_'.esc_attr($clothing69_post_format) ); ?>><?php
	clothing69_show_post_featured(array(
		'thumb_size' => clothing69_get_thumb_size( 'extra' ),
		'show_no_image' => false,
		'singular' => false
		)
	);
	?><div class="post_header entry-header">
		<h6 class="post_title entry-title"><a href="<?php echo esc_url($clothing69_link); ?>"><?php echo the_title(); ?></a></h6>

<?php
	if ( in_array(get_post_type(), array( 'post', 'attachment' ) ) ) {
		// Post meta
		clothing69_show_post_meta(array(
				'categories' => false,
				'date' => false,
				'edit' => false,
				'seo' => false,
				'share' => false,
				'counters' => 'comments'	//comments,likes,views - comma separated in any combination
			)
		);
	}
	echo '<a class="link_go" href="' . esc_url($clothing69_link) . '">' . esc_html__('Read More','clothing69') . '</a>';
?>
	</div>
</div>