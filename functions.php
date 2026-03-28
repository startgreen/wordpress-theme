<?php

// Enqueue frontend styles
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
});

// ACF JSON sync pad instellen
add_filter('acf/settings/save_json', function() {
    return get_template_directory() . '/acf-json';
});
add_filter('acf/settings/load_json', function($paths) {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
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

// Register Section block (vanilla register_block_type voor InnerBlocks support)
add_action('init', function() {
    register_block_type(__DIR__ . '/blocks/section');
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
        'enqueue_assets'  => function() {
            wp_enqueue_script(
                'startgreen-faq',
                get_template_directory_uri() . '/blocks/faq/faq.js',
                [],
                null,
                true // in de footer laden
            );
        },
    ]);

    acf_register_block_type([
        'name'            => 'team',
        'title'           => 'Team',
        'description'     => 'Teamleden grid met inline expand.',
        'render_template' => get_template_directory() . '/blocks/team/render.php',
        'category'        => 'startgreen',
        'icon'            => 'groups',
        'keywords'        => ['team', 'mensen', 'medewerkers'],
        'mode'            => 'preview',
        'supports'        => ['align' => false],
        'enqueue_assets'  => function() {
            wp_enqueue_script(
                'startgreen-team',
                get_template_directory_uri() . '/blocks/team/team.js',
                [],
                null,
                true
            );
        },
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

// Add custom columns to the 'Team' custom post type list
function add_team_columns($columns) {
    $new_columns = [];
    
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns[$key] = $value;
            $new_columns['team_category'] = __('Team Category', 'textdomain');
        } elseif ($key === 'date') {
            $new_columns['team_volgorde'] = __('Team Volgorde', 'textdomain');
            $new_columns[$key] = $value;
        } else {
            $new_columns[$key] = $value;
        }
    }
    
    return $new_columns;
}
add_filter('manage_edit-team_columns', 'add_team_columns');

// Populate the custom columns
function populate_team_columns($column, $post_id) {
    if ($column === 'team_volgorde') {
        $team_volgorde = get_post_meta($post_id, 'team_volgorde', true);
        echo esc_html($team_volgorde);
    } elseif ($column === 'team_category') {
        $terms = get_the_terms($post_id, 'team-category');
        if ($terms && !is_wp_error($terms)) {
            $term_names = wp_list_pluck($terms, 'name');
            echo esc_html(implode(', ', $term_names));
        } else {
            echo '-';
        }
    }
}
add_action('manage_team_posts_custom_column', 'populate_team_columns', 10, 2);

// make sure theme supports featured images
add_theme_support('post-thumbnails');

// make team members draggable to reorder
add_post_type_support('team', 'page-attributes');
