<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage CLOTHING69
 * @since CLOTHING69 1.0.1
 */
?>
<div class="update-nag" id="clothing69_admin_notice">
	<h3 class="clothing69_notice_title"><?php echo sprintf(esc_html__('Welcome to %s', 'clothing69'), wp_get_theme()->name); ?></h3>
	<?php
	if (!clothing69_exists_trx_addons()) {
		?><p><?php echo wp_kses_data(__('<b>Attention!</b> Plugin "ThemeREX Addons is required! Please, install and activate it!', 'clothing69')); ?></p><?php
	}
	?><p><?php
		if (clothing69_get_value_gp('page')!='tgmpa-install-plugins') {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=tgmpa-install-plugins'); ?>" class="button-primary"><i class="dashicons dashicons-admin-plugins"></i> <?php esc_html_e('Install plugins', 'clothing69'); ?></a>
			<?php
		}
		if (function_exists('clothing69_exists_trx_addons') && clothing69_exists_trx_addons()) {
			?>
			<a href="<?php echo esc_url(admin_url().'themes.php?page=trx_importer'); ?>" class="button-primary"><i class="dashicons dashicons-download"></i> <?php esc_html_e('One Click Demo Data', 'clothing69'); ?></a>
			<?php
		}
		?>
        <a href="<?php echo esc_url(admin_url().'customize.php'); ?>" class="button-primary"><i class="dashicons dashicons-admin-appearance"></i> <?php esc_html_e('Theme Customizer', 'clothing69'); ?></a>
        <a href="#" class="button clothing69_hide_notice"><i class="dashicons dashicons-dismiss"></i> <?php esc_html_e('Hide Notice', 'clothing69'); ?></a>
	</p>
</div>