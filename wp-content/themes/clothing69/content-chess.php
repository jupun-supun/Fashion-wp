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
$clothing69_columns = empty($clothing69_blog_style[1]) ? 1 : max(1, $clothing69_blog_style[1]);
$clothing69_expanded = !clothing69_sidebar_present() && clothing69_is_on(clothing69_get_theme_option('expand_content'));
$clothing69_post_format = get_post_format();
$clothing69_post_format = empty($clothing69_post_format) ? 'standard' : str_replace('post-format-', '', $clothing69_post_format);
$clothing69_animation = clothing69_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($clothing69_columns).' post_format_'.esc_attr($clothing69_post_format) ); ?>
	<?php echo (!clothing69_is_off($clothing69_animation) ? ' data-animation="'.esc_attr(clothing69_get_animation_classes($clothing69_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($clothing69_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.the_title_attribute( array( 'echo' => false ) ).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	clothing69_show_post_featured( array(
											'class' => $clothing69_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => clothing69_get_thumb_size(
																	strpos(clothing69_get_theme_option('body_style'), 'full')!==false
																		? ( $clothing69_columns > 1 ? 'huge' : 'original' )
																		: (	$clothing69_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('clothing69_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('clothing69_action_before_post_meta'); 

			// Post meta
			$clothing69_post_meta = clothing69_show_post_meta(array(
									'categories' => true,
									'date' => true,
									'edit' => $clothing69_columns == 1,
									'seo' => false,
									'share' => false,
									'counters' => $clothing69_columns < 3 ? 'comments' : '',
									'echo' => false
									)
								);
			clothing69_show_layout($clothing69_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$clothing69_show_learn_more = !in_array($clothing69_post_format, array('link', 'aside', 'status', 'quote'));
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
				clothing69_show_layout($clothing69_post_meta);
			}
			// More button
			if ( $clothing69_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'clothing69'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>