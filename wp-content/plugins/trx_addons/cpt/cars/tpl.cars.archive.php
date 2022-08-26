<?php
/**
 * The template to display the cars archive
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.3
 */

get_header(); 

trx_addons_get_template_part('cpt/cars/tpl.cars.parts.loop.php');

get_footer();
?>