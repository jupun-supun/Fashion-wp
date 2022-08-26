<?php
/**
 * The template to display the collection's single page
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4
 */

global $TRX_ADDONS_STORAGE;

get_header();

while ( have_posts() ) { the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'collection_page itemscope' ); ?>
		itemscope itemtype="http://schema.org/Article">
		
		<section class="collection_page_header">

			<?php
			// Image
			if ( !trx_addons_sc_layouts_showed('featured') && has_post_thumbnail() ) {
				?><div class="collection_page_featured"><?php
					the_post_thumbnail( trx_addons_get_thumb_size('huge'), array(
								'alt' => get_the_title(),
								'itemprop' => 'image'
								)
							);
				?></div><?php
			}
			
			// Title
			if ( !trx_addons_sc_layouts_showed('title') ) {
				?><h2 class="collection_page_title"><?php the_title(); ?></h2><?php
			}
			?>

		</section>
		<?php

		// Post content
		?><section class="collection_page_content entry-content" itemprop="articleBody"><?php
			the_content( );
		?></section><!-- .entry-content --><?php

	// Taxonomies and share
	if ( is_single() && !is_attachment() ) {
		?>
		<div class="post_meta post_meta_single_coll"><div class="cat_wrap"><?php
			echo esc_html_e('Category:','trx_addons');
			// Post taxonomies
			trx_addons_sc_show_post_meta('sc_layouts', array(
				'date' => false,
				'categories' => true
				)
			);
			?>
			</div>
		</div>
	<?php
	}

	?></article><?php

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		//comments_template();
	}

	$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
	$first_title = isset($meta['first_col_title']) && !empty($meta['first_col_title']) ? $meta['first_col_title'] : false;
	$first_link = isset($meta['first_col_link']) && !empty($meta['first_col_link']) ? $meta['first_col_link'] : false;
	$second_title = isset($meta['second_col_title']) && !empty($meta['second_col_title']) ? $meta['second_col_title'] : false;
	$second_link = isset($meta['second_col_link']) && !empty($meta['second_col_link']) ? $meta['second_col_link'] : false;
	if(($first_title && $first_link) || ($second_title && $second_link)){
		echo '<div class="col_info_footer">';
		if($first_title && $first_title){?>
			<a class="first" href="<?php echo esc_url($first_link); ?>"><?php echo $first_title; ?></a>
		<?php }
		if($second_title && $second_link){?>
			<a class="second" href="<?php echo esc_url($second_link); ?>"><?php echo $second_title; ?></a>
		<?php }
		echo '</div>';
	}

}

get_footer();
?>