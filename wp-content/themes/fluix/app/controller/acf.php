<?php

namespace fluix\controller;

use fluix\helper\svg_icons;

/**
 * ACF Controller
 **/
class acf
{

	/**
	 * Constructor
	 **/
	function __construct()
	{

		/* A hook that is called when ACF is initialized. */
		add_action('acf/init', [$this, 'set_acf_init']);

		// Custom place to save ACF options
		add_filter('acf/settings/save_json', [$this, 'set_acf_json_save_point']);
		add_filter('acf/settings/load_json', [$this, 'set_acf_json_load_point']);
	}


	function set_acf_init()
	{
		// check function exists
		if (function_exists('acf_register_block_type')) {

			// Hero block.
			acf_register_block_type(array(
				'name'						=> 'hero',
				'title'						=> __('Hero Block'),
				'description'			=> __('A custom Hero block.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/hero/hero.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/hero.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('hero', 'first', 'screen', 'fluix'),
				'icon' 						=> svg_icons::get('logo'),
				// For Preview & Example
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							'is_example' => true,
						],
					]
				]
			));

			// Three columns Block
			acf_register_block_type(array(
				'name'						=> 'three-columns',
				'title'						=> __('Three columns Block'),
				'description'			=> __('A custom fluix block. Title & three columns with content.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/three-columns/three-columns.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/three-columns.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('three', 'columns', 'screen', 'fluix'),
				'icon' 						=> svg_icons::get('logo'),
				// For Preview & Example
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							'is_example' => true,
						],
					]
				]
			));

			// CTA Block
			acf_register_block_type(array(
				'name'						=> 'cta',
				'title'						=> __('CTA Block'),
				'description'			=> __('A custom CTA block.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/cta/cta.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/cta.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('cta', 'fluix'),
				'icon' 						=> svg_icons::get('logo'),
				// For Preview & Example
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							'is_example' => true,
						],
					]
				]
			));

			// Features Block
			acf_register_block_type(array(
				'name'						=> 'features',
				'title'						=> __('Features Block'),
				'description'			=> __('A custom Features block.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/features/features.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/features.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('features', 'fluix'),
				'icon' 						=> svg_icons::get('logo'),
				// For Preview & Example
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							'is_example' => true,
						],
					]
				]
			));

			// First Four Blocks 
			acf_register_block_type(array(
				'name'						=> 'first-four-blocks',
				'title'						=> __('First Four Blocks'),
				'description'			=> __('A custom First Four Blocks.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/first-four-blocks/first-four-blocks.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/first-four-blocks.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('first', 'four', 'fluix'),
				'icon' 						=> svg_icons::get('logo'),
				// For Preview & Example
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							'is_example' => true,
						],
					]
				]
			));

			// Highlight Block
			acf_register_block_type(array(
				'name'						=> 'highlight',
				'title'						=> __('Highlight Block'),
				'description'			=> __('A custom Highlight block.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/highlight/highlight.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/highlight.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('highlight', 'fluix'),
				'icon' 						=> svg_icons::get('logo'),
				// For Preview & Example
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							'is_example' => true,
						],
					]
				]
			));
		
			// Numbers Block
			acf_register_block_type(array(
				'name'						=> 'numbers',
				'title'						=> __('Numbers Block'),
				'description'			=> __('A custom Numbers block.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/numbers/numbers.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/numbers.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('numbers', 'fluix'),
				'icon' 						=> svg_icons::get('logo'),
				// For Preview & Example
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							'is_example' => true,
						],
					]
				]
			));
				
			// Learn more links Block
			acf_register_block_type(array(
				'name'						=> 'learn-more-links',
				'title'						=> __('Learn more links'),
				'description'			=> __('A custom Learn more links block.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/learn-more-links/learn-more-links.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/learn-more-links.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('learn', 'more', 'links', 'fluix'),
				'icon' 						=> svg_icons::get('logo'),
				// For Preview & Example
				'example' => [
					'attributes' => [
						'mode' => 'preview',
						'data' => [
							'is_example' => true,
						],
					]
				]
			));
		
			

		}
	}

	// Save json folder
	function set_acf_json_save_point()
	{

		// update path
		$path = get_stylesheet_directory() . '/app/options';

		// return
		return $path;
	}

	// Load json
	function set_acf_json_load_point()
	{

		// remove original path (optional)
		// unset($paths[0]);

		// append path
		$paths[] = get_stylesheet_directory() . '/app/options';

		// return
		return $paths;
	}
}
