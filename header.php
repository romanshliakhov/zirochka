<!DOCTYPE html>
<html class="fixed-block" <?php language_attributes(); ?>>

<head>
	<?php load_template( get_template_directory() . '/components/default/fonts.php', true ); ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<?php if (!function_exists('_wp_render_title_tag')): ?>
        <title><?php bloginfo('name'); wp_title('|', true, 'left'); ?></title>
	<?php endif; ?>
    <meta name="description" content="<?php
		if (is_singular() && has_excerpt()) {
			echo esc_attr(get_the_excerpt());
		} elseif (is_home() || is_front_page()) {
			echo esc_attr(get_bloginfo('description'));
		} else {
			echo esc_attr(wp_title('', false));
		}
	?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php load_template( get_template_directory() . '/components/custom_header.php', true ); ?>
<main>