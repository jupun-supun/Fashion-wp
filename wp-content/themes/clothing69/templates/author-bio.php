<?php
/**
 * The template to display the Author bio
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0
 */
?>

<div class="author_info author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$clothing69_mult = clothing69_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 200*$clothing69_mult );
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<h5 class="author_title" itemprop="name"><?php echo wp_kses_data(sprintf(__('About %s', 'clothing69'), '<a class="author_link" href='. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'>'.get_the_author().'</a>')); ?></h5>

		<div class="author_bio" itemprop="description">
			<?php echo wp_kses(wpautop(get_the_author_meta( 'description' )), 'clothing69_kses_content' ); ?>
			<?php do_action('clothing69_action_user_meta'); ?>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
