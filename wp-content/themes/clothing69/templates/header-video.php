<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.14
 */
$clothing69_header_video = clothing69_get_header_video();
$clothing69_embed_video = '';
if (!empty($clothing69_header_video) && !clothing69_is_from_uploads($clothing69_header_video)) {
	if (clothing69_is_youtube_url($clothing69_header_video) && preg_match('/[=\/]([^=\/]*)$/', $clothing69_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$clothing69_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($clothing69_header_video) . '[/embed]' ));
			$clothing69_embed_video = clothing69_make_video_autoplay($clothing69_embed_video);
		} else {
			$clothing69_header_video = str_replace('/watch?v=', '/embed/', $clothing69_header_video);
			$clothing69_header_video = clothing69_add_to_url($clothing69_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$clothing69_embed_video = '<iframe src="' . esc_url($clothing69_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php clothing69_show_layout($clothing69_embed_video); ?></div><?php
	}
}
?>