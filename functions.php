<?php
// Styles laden
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('theme-style', get_stylesheet_uri());
});

// Gutenberg uitzetten voor pages
add_filter('use_block_editor_for_post_type', function($use, $post_type) {
  if ($post_type === 'page') {
      return false;
  }
  return $use;
}, 10, 2);

// normale editor uitzetten voor pages
add_action('init', function() {
  remove_post_type_support('page', 'editor');
});

// register menu
add_action('after_setup_theme', function() {
  register_nav_menus([
      'primary' => 'Hoofdmenu'
  ]);
});