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

/**
 * Enqueue the skills bars script.
 */
function tg_enqueue_skills_script() {
    wp_enqueue_script(
        'tg-skills-bars',
        get_stylesheet_directory_uri() . '/assets/js/skills-bars.js',
        array(),
        '1.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'tg_enqueue_skills_script' );

function tg_register_project_post_type() {
    register_post_type( 'project', array(
        'labels' => array(
            'name'          => 'Projects',
            'singular_name' => 'Project',
            'add_new_item'  => 'Add New Project',
        ),
        'public'       => true,
        'has_archive'  => false,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-portfolio',
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
        'rewrite'      => array( 'slug' => 'projects' ), 
    ) );
}
add_action( 'init', 'tg_register_project_post_type' );

function tg_project_tech_stack_shortcode() {
    $tech = get_field( 'tech_stack' );
    if ( ! $tech ) return '';
    $items = array_map( 'trim', explode( ',', $tech ) );
    $html = '<ul class="project-tech-stack">';
    foreach ( $items as $item ) {
        $html .= '<li>' . esc_html( $item ) . '</li>';
    }
    $html .= '</ul>';
    return $html;
}
add_shortcode( 'project_tech_stack', 'tg_project_tech_stack_shortcode' );

function tg_project_performance_shortcode() {
    $image = get_field( 'performance_image' );
    if ( ! $image ) return '';
    return '<img src="' . esc_url( $image['url'] ) . '" alt="' . esc_attr( $image['alt'] ) . '" class="project-performance-image" />';
}
add_shortcode( 'project_performance', 'tg_project_performance_shortcode' );


wp_enqueue_script(
    'tg-portfolio-reveal',
    get_stylesheet_directory_uri() . '/assets/js/portfolio-reveal.js',
    array(),
    '1.0',
    true
);

wp_enqueue_script(
    'tg-fade-in',
    get_stylesheet_directory_uri() . '/assets/js/fade-in.js',
    array(),
    '1.0',
    true
);