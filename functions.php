<?php

// Enqueue frontend styles
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
});

// Enqueue compiled stylesheet in the block editor too
add_action('enqueue_block_editor_assets', function() {
    wp_enqueue_style('theme-editor-style', get_stylesheet_uri());
});

// Load Tailwind CDN inside the editor block-preview iframe
add_action('enqueue_block_assets', function() {
    if (is_admin()) {
        wp_enqueue_script('tailwindcss-block-editor', 'https://cdn.tailwindcss.com', [], null, false);
    }
});

// Theme setup
add_action('after_setup_theme', function() {
    // Navigation menus
    register_nav_menus([
        'primary' => 'Hoofdmenu',
    ]);

    // Editor support
    add_theme_support('editor-styles');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');

    // HTML5 markup
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style']);
});

// Register custom block category
add_filter('block_categories_all', function($categories) {
    array_unshift($categories, [
        'slug'  => 'startgreen',
        'title' => 'StartGreen',
        'icon'  => null,
    ]);
    return $categories;
});

// Register ACF Blocks
add_action('acf/init', function() {
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    acf_register_block_type([
        'name'            => 'hero',
        'title'           => 'Hero',
        'description'     => 'Hero sectie met titel, intro en achtergrondkleur.',
        'render_template' => get_template_directory() . '/blocks/hero/render.php',
        'category'        => 'startgreen',
        'icon'            => 'cover-image',
        'keywords'        => ['hero', 'banner', 'header'],
        'mode'            => 'auto',
        'supports'        => ['align' => false],
    ]);

    acf_register_block_type([
        'name'            => 'two-columns',
        'title'           => 'Twee Kolommen',
        'description'     => 'Twee kolommen met tekst en afbeelding.',
        'render_template' => get_template_directory() . '/blocks/two-columns/render.php',
        'category'        => 'startgreen',
        'icon'            => 'columns',
        'keywords'        => ['kolommen', 'afbeelding', 'tekst'],
        'mode'            => 'auto',
        'supports'        => ['align' => false],
    ]);

    acf_register_block_type([
        'name'            => 'faq',
        'title'           => 'FAQ',
        'description'     => 'Veelgestelde vragen met accordion.',
        'render_template' => get_template_directory() . '/blocks/faq/render.php',
        'category'        => 'startgreen',
        'icon'            => 'editor-help',
        'keywords'        => ['faq', 'vragen', 'accordion'],
        'mode'            => 'auto',
        'supports'        => ['align' => false],
    ]);

    acf_register_block_type([
        'name'            => 'form',
        'title'           => 'Formulier',
        'description'     => 'Gravity Forms formulier blok.',
        'render_template' => get_template_directory() . '/blocks/form/render.php',
        'category'        => 'startgreen',
        'icon'            => 'feedback',
        'keywords'        => ['formulier', 'form', 'contact'],
        'mode'            => 'auto',
        'supports'        => ['align' => false],
    ]);
});
