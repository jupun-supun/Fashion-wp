<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

// Page (category, tag, archive, author) title

if ( clothing69_need_page_title() ) {
	clothing69_sc_layouts_showed('title', true);
	clothing69_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								clothing69_show_post_meta(array(
									'date' => true,
									'categories' => true,
									'seo' => true,
									'share' => false,
									'counters' => 'views,comments,likes'
									)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$clothing69_blog_title = clothing69_get_blog_title();
							$clothing69_blog_title_text = $clothing69_blog_title_class = $clothing69_blog_title_link = $clothing69_blog_title_link_text = '';
							if (is_array($clothing69_blog_title)) {
								$clothing69_blog_title_text = $clothing69_blog_title['text'];
								$clothing69_blog_title_class = !empty($clothing69_blog_title['class']) ? ' '.$clothing69_blog_title['class'] : '';
								$clothing69_blog_title_link = !empty($clothing69_blog_title['link']) ? $clothing69_blog_title['link'] : '';
								$clothing69_blog_title_link_text = !empty($clothing69_blog_title['link_text']) ? $clothing69_blog_title['link_text'] : '';
							} else
								$clothing69_blog_title_text = $clothing69_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($clothing69_blog_title_class); ?>"><?php
								$clothing69_top_icon = clothing69_get_category_icon();
								if (!empty($clothing69_top_icon)) {
									$clothing69_attr = clothing69_getimagesize($clothing69_top_icon);
									?><img src="<?php echo esc_url($clothing69_top_icon); ?>" alt="'.esc_attr__('icon', 'clothing69').'" <?php if (!empty($clothing69_attr[3])) clothing69_show_layout($clothing69_attr[3]);?>><?php
								}
								echo wp_kses($clothing69_blog_title_text, 'clothing69_kses_content');
							?></h1>
							<?php
							if (!empty($clothing69_blog_title_link) && !empty($clothing69_blog_title_link_text)) {
								?><a href="<?php echo esc_url($clothing69_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($clothing69_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'clothing69_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>