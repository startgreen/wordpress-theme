<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<nav>
    <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'menu_class' => 'flex space-x-4 p-4']); ?>
</nav>
