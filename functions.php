<?php
/**
 * StartGreen Theme Functions
 *
 * @package StartGreen
 * @version 1.0.0
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// Theme Constants
// ---------------------------------------------------------------------------

define( 'STARTGREEN_VERSION', '1.0.0' );
define( 'STARTGREEN_DIR', get_template_directory() );
define( 'STARTGREEN_URI', get_template_directory_uri() );

// ---------------------------------------------------------------------------
// Theme Setup
// ---------------------------------------------------------------------------

add_action( 'after_setup_theme', 'startgreen_setup' );

function startgreen_setup(): void {
	// Make theme available for translation.
	load_theme_textdomain( 'startgreen', STARTGREEN_DIR . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Enable support for the block editor.
	add_theme_support( 'wp-block-styles' );

	// Enable wide and full alignment in the block editor.
	add_theme_support( 'align-wide' );

	// Enable editor styles so the compiled CSS loads in the block editor.
	add_theme_support( 'editor-styles' );

	// Enable custom colour palette support.
	add_theme_support( 'custom-colors' );

	// Enable HTML5 markup for search form, comment form, etc.
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);

	// Register nav menus.
	register_nav_menus(
		[
			'primary' => __( 'Primary Navigation', 'startgreen' ),
			'footer'  => __( 'Footer Navigation', 'startgreen' ),
		]
	);
}

// ---------------------------------------------------------------------------
// Enqueue Front-End Assets
// ---------------------------------------------------------------------------

add_action( 'wp_enqueue_scripts', 'startgreen_enqueue_assets' );

function startgreen_enqueue_assets(): void {
	$css_path = STARTGREEN_DIR . '/assets/css/app.css';
	$css_uri  = STARTGREEN_URI . '/assets/css/app.css';

	// Use filemtime for cache-busting; fall back to theme version if file missing.
	$version = file_exists( $css_path )
		? (string) filemtime( $css_path )
		: STARTGREEN_VERSION;

	wp_enqueue_style(
		'startgreen-styles',
		$css_uri,
		[],
		$version
	);
}

// ---------------------------------------------------------------------------
// Enqueue Block Editor Assets
// ---------------------------------------------------------------------------

add_action( 'after_setup_theme', 'startgreen_editor_styles' );

function startgreen_editor_styles(): void {
	// This path is relative to the theme root and is passed to the block editor.
	add_editor_style( 'assets/css/app.css' );
}

// ---------------------------------------------------------------------------
// ACF Block Category
// ---------------------------------------------------------------------------

add_filter( 'block_categories_all', 'startgreen_register_block_categories', 10, 2 );

function startgreen_register_block_categories( array $categories, WP_Block_Editor_Context $context ): array {
	return array_merge(
		[
			[
				'slug'  => 'startgreen-blocks',
				'title' => __( 'StartGreen Blocks', 'startgreen' ),
				'icon'  => 'screenoptions',
			],
		],
		$categories
	);
}

// ---------------------------------------------------------------------------
// Auto-register ACF Blocks & Include Field Definitions
// ---------------------------------------------------------------------------

add_action( 'init', 'startgreen_register_acf_blocks' );

function startgreen_register_acf_blocks(): void {
	$blocks_dir = STARTGREEN_DIR . '/blocks';

	if ( ! is_dir( $blocks_dir ) ) {
		return;
	}

	$block_dirs = glob( $blocks_dir . '/*', GLOB_ONLYDIR );

	if ( empty( $block_dirs ) ) {
		return;
	}

	foreach ( $block_dirs as $block_dir ) {
		$block_json = $block_dir . '/block.json';
		$fields_php = $block_dir . '/fields.php';

		// Skip if no block.json exists.
		if ( ! file_exists( $block_json ) ) {
			continue;
		}

		// Decode the block manifest so we can check for ACF metadata.
		$manifest = json_decode( (string) file_get_contents( $block_json ), true );

		if ( ! is_array( $manifest ) ) {
			continue;
		}

		// Only process blocks that declare ACF metadata.
		if ( empty( $manifest['acf'] ) ) {
			continue;
		}

		/*
		 * ACF 6.x registers the block automatically when it encounters a
		 * block.json with an "acf" key — no manual acf_register_block_type()
		 * call is required.  We still need to tell WordPress about the block
		 * directory so it can find the manifest.
		 */
		register_block_type( $block_dir );

		// Include the field group definitions for this block.
		if ( file_exists( $fields_php ) ) {
			require_once $fields_php;
		}
	}
}

// ---------------------------------------------------------------------------
// Disable the Gutenberg block editor for specific post types (optional hook)
// ---------------------------------------------------------------------------
// Uncomment the lines below if you need to disable the block editor globally
// or for specific post types.
//
// add_filter( 'use_block_editor_for_post_type', '__return_false' );
