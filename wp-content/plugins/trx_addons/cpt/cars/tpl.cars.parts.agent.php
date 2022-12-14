<?php
/**
 * The template's part to display the car's owner, agent or author info and contact form
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.3
 */

$trx_addons_args = get_query_var('trx_addons_args_cars_agent');
$trx_addons_meta = $trx_addons_args['meta'];
$trx_addons_agent = trx_addons_cars_get_agent_data($trx_addons_meta);

// Agent's photo (avatar)
if (!empty($trx_addons_agent['image_id']) || !empty($trx_addons_agent['image'])) {
	?><div class="cars_page_agent_avatar"><?php
		if (!empty($trx_addons_agent['image_id'])) {
			$trx_addons_agent['image'] = trx_addons_get_attachment_url($trx_addons_agent['image_id'], trx_addons_get_thumb_size('masonry'));
		}
		if (!empty($trx_addons_agent['image'])) {
			$attr = trx_addons_getimagesize($trx_addons_agent['image']);
			?><img src="<?php echo esc_url($trx_addons_agent['image']); ?>" alt=""<?php
				if (!empty($attr[3])) echo ' '.trim($attr[3]);
			?>><?php
		}
	?></div><?php
}

// Agent's info
?><div class="cars_page_agent_info"><?php
	?><h5 class="cars_page_agent_info_name"><?php 
		echo esc_html($trx_addons_agent['name']);
		if (!empty($trx_addons_agent['posts_link']))
			echo '<a href="'.esc_url($trx_addons_agent['posts_link']).'">'.esc_attr__('View all my offers', 'trx_addons').'</a>';
	?></h5><?php
	if (!empty($trx_addons_agent['position'])) {
		?><div class="cars_page_agent_info_position"><?php echo esc_html($trx_addons_agent['position']); ?></div><?php
	}
	if (!empty($trx_addons_agent['description'])) {
		?><div class="cars_page_agent_info_description"><?php
			echo wp_kses_post($trx_addons_agent['description']);
		?></div><?php
	}
	if (!empty($trx_addons_agent['phone_mobile']) || !empty($trx_addons_agent['phone_office']) || !empty($trx_addons_agent['phone_fax'])) {
		?><div class="cars_page_agent_info_phones"><?php
			if (!empty($trx_addons_agent['phone_mobile'])) {
				?><span class="cars_page_agent_info_phones_mobile"><?php echo esc_html($trx_addons_agent['phone_mobile']); ?></span> <?php
			}
			if (!empty($trx_addons_agent['phone_office'])) {
				?><span class="cars_page_agent_info_phones_office"><?php echo esc_html($trx_addons_agent['phone_office']); ?></span> <?php
			}
			if (!empty($trx_addons_agent['phone_fax'])) {
				?><span class="cars_page_agent_info_phones_fax"><?php echo esc_html($trx_addons_agent['phone_fax']); ?></span><?php
			}
		?></div><?php
	}
	if (!empty($trx_addons_agent['address'])) {
		?><div class="cars_page_agent_info_address"><?php
			echo esc_html($trx_addons_agent['address']);
		?></div><?php
	}
	$trx_addons_socials = trx_addons_cars_get_agent_socials($trx_addons_agent);
	if (count($trx_addons_socials) > 0) {
		?><div class="cars_page_agent_info_profiles socials_wrap"><?php
			trx_addons_show_layout(trx_addons_get_socials_links_custom($trx_addons_socials));
		?></div><?php
	}
?></div><?php

// Contact form
trx_addons_get_template_part('cpt/cars/tpl.cars.parts.form.php',
								'trx_addons_args_cars_form',
								array(
									'meta' => $trx_addons_meta,
									'agent' => $trx_addons_agent
								)
							);
