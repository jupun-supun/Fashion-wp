<?php
/**
 * The style "default" of the collection
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4
 */

$args = get_query_var('trx_addons_args_sc_collection');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();
$featured_position = !empty($args['featured_position']) ? $args['featured_position'] : 'top';
$svg_present = false;

if ($args['slider']) {
	?><div class="swiper-slide"><?php
} else if ((int)$args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?>"><?php
}
?>
<div class="sc_collection_item<?php
	echo isset($args['hide_excerpt']) && $args['hide_excerpt'] ? ' without_content' : ' with_content';
	echo empty($args['featured']) || $args['featured']=='image' 
					? ' with_image' 
					: ($args['featured']=='icon' ? ' with_icon' : ' with_number');
	echo ' sc_collection_item_featured_'.esc_attr($featured_position);
?>">
	<?php
	// Featured image
	?><div class="sc_collection_item_marker_bg"></div><?php
	if ( has_post_thumbnail() && (empty($args['featured']) || $args['featured']=='image')) {
		?><div class="sc_collection_item_thumb sc_collection_item_marker" style="background-image: url(<?php
			$trx_addons_attachment_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'masonry' );
			if (!empty($trx_addons_attachment_src[0]))
				echo esc_url($trx_addons_attachment_src[0]);
			?>);"></div><?php
		?><div class="sc_collection_item_thumb sc_collection_item_marker sc_collection_item_marker_back" style="background-image: url(<?php
			$trx_addons_attachment_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'masonry' );
			if (!empty($trx_addons_attachment_src[0]))
				echo esc_url($trx_addons_attachment_src[0]);
			?>);"></div><?php
	
	// Icon
	} else if ($args['featured']=='icon' && !empty($meta['icon'])) {
		$svg = '';
		if (!empty($args['icons_animation']) && (int)$args['icons_animation'] > 0 && ($svg = trx_addons_get_file_dir('css/svg-icons/'.trx_addons_esc($meta['icon']).'.svg')) != '') {
			$svg_present = true;
		}
		?><a href="<?php echo esc_url($link); ?>"
			 id="<?php echo esc_attr($args['id'].'_'.trim($meta['icon'])); ?>"
			 class="sc_collection_item_icon sc_collection_item_marker <?php echo empty($svg) ? esc_attr($meta['icon']) : 'sc_icon_type_svg'; ?>"
			 ><?php
			if (!empty($svg)) {
				trx_addons_show_layout(trx_addons_get_svg_from_file($svg));
			}
		?></a><?php
		?><a href="<?php echo esc_url($link); ?>"
			 id="<?php echo esc_attr($args['id'].'_'.trim($meta['icon'])); ?>"
			 class="sc_collection_item_icon sc_collection_item_marker sc_collection_item_marker_back <?php echo empty($svg) ? esc_attr($meta['icon']) : 'sc_icon_type_svg'; ?>"
			 ><?php
			if (!empty($svg)) {
				trx_addons_show_layout(trx_addons_get_svg_from_file($svg));
			}
		?></a><?php

	// Number
	} else {
		?><span class="sc_collection_item_number sc_collection_item_marker"><?php
			$number = get_query_var('trx_addons_args_item_number');
			printf("%02d", $number);
		?></span><?php
		?><span class="sc_collection_item_number sc_collection_item_marker sc_collection_item_marker_back"><?php
			$number = get_query_var('trx_addons_args_item_number');
			printf("%02d", $number);
		?></span><?php
	}
	?>	
	<div class="sc_collection_item_info">
		<div class="sc_collection_item_header">
			<h4 class="sc_collection_item_title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h4>
			<div class="sc_collection_item_subtitle"><?php trx_addons_show_layout(trx_addons_get_post_terms(', ', get_the_ID(), TRX_ADDONS_CPT_collection_TAXONOMY));?></div>
		</div>
		<?php if (!isset($args['hide_excerpt']) || (int)$args['hide_excerpt']==0) { ?>
			<div class="sc_collection_item_content"><?php the_excerpt(); ?></div>
			<div class="sc_collection_item_button sc_item_button"><a href="<?php echo esc_url($link); ?>" class="sc_button sc_button_simple"><?php esc_html_e('Learn more', 'trx_addons'); ?></a></div>
		<?php } ?>
	</div>
</div>
<?php
if ($args['slider'] || (int)$args['columns'] > 1) {
	?></div><?php
}
if (trx_addons_is_on(trx_addons_get_option('debug_mode')) && $svg_present) {
	wp_enqueue_script( 'vivus', trx_addons_get_file_url('shortcodes/icons/vivus.js'), array('jquery'), null, true );
	wp_enqueue_script( 'trx_addons-sc_icons', trx_addons_get_file_url('shortcodes/icons/icons.js'), array('jquery'), null, true );
}
?>