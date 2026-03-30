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
        'example'         => ['attributes' => ['mode' => 'preview', 'data' => [
            'hero_subheading'   => 'Impact Investment Platform',
            'hero_heading1'     => 'Investing in',
            'hero_heading2'     => 'a better future',
        ]]],
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
        'example'         => ['attributes' => ['mode' => 'preview', 'data' => [
            'faq_achtergrond'   => 'green',
            'faq_heading_deel1' => 'Veelgestelde',
            'faq_heading_deel2' => 'vragen',
        ]]],
        'enqueue_assets'  => function() {
            wp_enqueue_script(
                'startgreen-faq',
                get_template_directory_uri() . '/blocks/faq/faq.js',
                [],
                null,
                true
            );
        },
    ]);

    acf_register_block_type([
        'name'            => 'contact',
        'title'           => 'Contact',
        'description'     => 'Volledig scherm contactsectie met nieuwsbrief formulier.',
        'render_template' => get_template_directory() . '/blocks/contact/render.php',
        'category'        => 'startgreen',
        'icon'            => 'email',
        'keywords'        => ['contact', 'formulier', 'nieuwsbrief'],
        'mode'            => 'preview',
        'supports'        => ['align' => false],
        'example'         => ['attributes' => ['mode' => 'preview']],
    ]);

    acf_register_block_type([
        'name'            => 'impact',
        'title'           => 'Impact',
        'description'     => 'Heading + tekst kolommen, genummerde blokken en optionele knop.',
        'render_template' => get_template_directory() . '/blocks/impact/render.php',
        'category'        => 'startgreen',
        'icon'            => 'lightbulb',
        'keywords'        => ['impact', 'blokken', 'cijfers', 'resultaten'],
        'mode'            => 'auto',
        'supports'        => ['align' => false],
        'example'         => ['attributes' => ['mode' => 'preview', 'data' => [
            'impact_heading_italic' => 'Wat onze impact',
            'impact_heading_bold'   => 'mogelijk maakt.',
            'impact_tekst'          => '<p>De fondsen en financieringsstructuren die wij ontwikkelen, vertalen zich in concrete resultaten.</p>',
        ]]],
    ]);

    acf_register_block_type([
        'name'            => 'tekst',
        'title'           => 'Tekst',
        'description'     => 'Tekstblok met italic/bold heading, optionele subheading en alinea\'s.',
        'render_template' => get_template_directory() . '/blocks/tekst/render.php',
        'category'        => 'startgreen',
        'icon'            => 'text',
        'keywords'        => ['tekst', 'heading', 'intro', 'alinea'],
        'mode'            => 'auto',
        'supports'        => ['align' => false],
        'example'         => ['attributes' => ['mode' => 'preview', 'data' => [
            'tekst_achtergrond'    => 'white',
            'tekst_heading_italic' => 'Eén platform,',
            'tekst_heading_bold'   => 'Meerdere routes naar impact',
            'tekst_body'           => 'Binnen StartGreen komen verschillende financieringsbenaderingen samen.',
        ]]],
    ]);

    acf_register_block_type([
        'name'            => 'stats',
        'title'           => 'Stats',
        'description'     => 'Twee kolommen: tekst links, 2×2 statistieken raster rechts.',
        'render_template' => get_template_directory() . '/blocks/stats/render.php',
        'category'        => 'startgreen',
        'icon'            => 'chart-bar',
        'keywords'        => ['stats', 'statistieken', 'cijfers', 'impact'],
        'mode'            => 'auto',
        'supports'        => ['align' => false],
        'example'         => ['attributes' => ['mode' => 'preview', 'data' => [
            'stats_heading_deel1' => 'Impact als onderdeel van',
            'stats_heading_deel2' => 'uw investering.',
            'stats_intro'         => 'Onze impactmeting is geen bijlage.',
            'stats_button_tekst'  => 'Lees impactrapportages',
        ]]],
    ]);

    acf_register_block_type([
        'name'            => 'cta-rows',
        'title'           => 'CTA Rows',
        'description'     => 'Donkergroene sectie met heading en klikbare rijen.',
        'render_template' => get_template_directory() . '/blocks/cta-rows/render.php',
        'category'        => 'startgreen',
        'icon'            => 'list-view',
        'keywords'        => ['cta', 'rijen', 'links', 'navigatie'],
        'mode'            => 'auto',
        'supports'        => ['align' => false],
        'example'         => ['attributes' => ['mode' => 'preview', 'data' => [
            'cta_heading_deel1' => 'Samen werken aan',
            'cta_heading_deel2' => 'investeerbare transities?',
        ]]],
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
        'example'         => ['attributes' => ['mode' => 'preview']],
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
        'name'            => 'big-stats',
        'title'           => 'Big Stats',
        'description'     => 'Grote statistieken in rijen met getal links en omschrijving rechts.',
        'render_template' => get_template_directory() . '/blocks/big-stats/render.php',
        'category'        => 'startgreen',
        'icon'            => 'chart-line',
        'keywords'        => ['stats', 'statistieken', 'cijfers', 'big', 'impact'],
        'mode'            => 'auto',
        'supports'        => ['align' => false],
        'example'         => ['attributes' => ['mode' => 'preview', 'data' => [
            'big_stats_button_tekst' => 'Lees ons volledige impactrapport 2024',
        ]]],
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
