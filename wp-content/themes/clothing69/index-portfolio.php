<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */

clothing69_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', clothing69_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'clothing69-gallery-script', clothing69_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$clothing69_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$clothing69_sticky_out = clothing69_get_theme_option('sticky_style')=='columns' 
							&& is_array($clothing69_stickies) && count($clothing69_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$clothing69_cat = clothing69_get_theme_option('parent_cat');
	$clothing69_post_type = clothing69_get_theme_option('post_type');
	$clothing69_taxonomy = clothing69_get_post_type_taxonomy($clothing69_post_type);
	$clothing69_show_filters = clothing69_get_theme_option('show_filters');
	$clothing69_tabs = array();
	if (!clothing69_is_off($clothing69_show_filters)) {
		$clothing69_args = array(
			'type'			=> $clothing69_post_type,
			'child_of'		=> $clothing69_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'number'		=> '',
			'taxonomy'		=> $clothing69_taxonomy,
			'pad_counts'	=> false
		);
		$clothing69_portfolio_list = get_terms($clothing69_args);
		if (is_array($clothing69_portfolio_list) && count($clothing69_portfolio_list) > 0) {
			$clothing69_tabs[$clothing69_cat] = esc_html__('All', 'clothing69');
			foreach ($clothing69_portfolio_list as $clothing69_term) {
				if (isset($clothing69_term->term_id)) $clothing69_tabs[$clothing69_term->term_id] = $clothing69_term->name;
			}
		}
	}
	if (count($clothing69_tabs) > 0) {
		$clothing69_portfolio_filters_ajax = true;
		$clothing69_portfolio_filters_active = $clothing69_cat;
		$clothing69_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters clothing69_tabs clothing69_tabs_ajax">
			<ul class="portfolio_titles clothing69_tabs_titles">
				<?php
				foreach ($clothing69_tabs as $clothing69_id=>$clothing69_title) {
					?><li><a href="<?php echo esc_url(clothing69_get_hash_link(sprintf('#%s_%s_content', $clothing69_portfolio_filters_id, $clothing69_id))); ?>" data-tab="<?php echo esc_attr($clothing69_id); ?>"><?php echo esc_html($clothing69_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$clothing69_ppp = clothing69_get_theme_option('posts_per_page');
			if (clothing69_is_inherit($clothing69_ppp)) $clothing69_ppp = '';
			foreach ($clothing69_tabs as $clothing69_id=>$clothing69_title) {
				$clothing69_portfolio_need_content = $clothing69_id==$clothing69_portfolio_filters_active || !$clothing69_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $clothing69_portfolio_filters_id, $clothing69_id)); ?>"
					class="portfolio_content clothing69_tabs_content"
					data-blog-template="<?php echo esc_attr(clothing69_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(clothing69_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($clothing69_ppp); ?>"
					data-post-type="<?php echo esc_attr($clothing69_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($clothing69_taxonomy); ?>"
					data-cat="<?php echo esc_attr($clothing69_id); ?>"
					data-parent-cat="<?php echo esc_attr($clothing69_cat); ?>"
					data-need-content="<?php echo (false===$clothing69_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($clothing69_portfolio_need_content) 
						clothing69_show_portfolio_posts(array(
							'cat' => $clothing69_id,
							'parent_cat' => $clothing69_cat,
							'taxonomy' => $clothing69_taxonomy,
							'post_type' => $clothing69_post_type,
							'page' => 1,
							'sticky' => $clothing69_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		clothing69_show_portfolio_posts(array(
			'cat' => $clothing69_cat,
			'parent_cat' => $clothing69_cat,
			'taxonomy' => $clothing69_taxonomy,
			'post_type' => $clothing69_post_type,
			'page' => 1,
			'sticky' => $clothing69_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>