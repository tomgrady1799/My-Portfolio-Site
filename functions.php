<?php
/**
 * Blockbase Child Theme functions.php
 * Keep this file minimal — block themes do most work via theme.json + templates,
 * not PHP. You mainly need this for enqueuing styles and registering patterns.
 */

// Prevent direct access to this file for security
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue parent and child theme stylesheets.
 * Parent (Blockbase) styles load first, then your child style.css loads
 * after it, so anything you write in style.css can override the parent.
 */
function blockbase_child_enqueue_styles() {
	$parent_style = 'blockbase-style'; // Handle for the parent theme's stylesheet

	wp_enqueue_style(
		$parent_style,
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);

	wp_enqueue_style(
		'blockbase-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ), // Depends on parent style loading first
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'blockbase_child_enqueue_styles' );

/**
 * Register your child theme's block patterns folder (optional).
 * Any .php files you add inside /patterns/ will show up in the
 * pattern inserter in the block editor. Safe to leave even if empty.
 */
function blockbase_child_register_pattern_category() {
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'blockbase-child',
			array( 'label' => __( 'Portfolio Patterns', 'blockbase-child' ) )
		);
	}
}
add_action( 'init', 'blockbase_child_register_pattern_category' );

/**
 * Enqueue editor-only styles so the block editor preview matches
 * the live front-end styling (optional but recommended).
 */
function blockbase_child_editor_styles() {
	add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'blockbase_child_editor_styles' );