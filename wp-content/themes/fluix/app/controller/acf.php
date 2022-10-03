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

			/* Registering a Hero block. */
			acf_register_block_type(array(
				'name'						=> 'hero',
				'title'						=> __('Hero Block'),
				'description'			=> __('A custom Hero block.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/hero/hero.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/hero.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('hero', 'first', 'screen'),
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


			acf_register_block_type(array(
				'name'						=> 'hero',
				'title'						=> __('Hero Block'),
				'description'			=> __('A custom Hero block.'),
				'render_template'	=> get_theme_file_path("template-parts/blocks/hero/hero.php"),
				'enqueue_style'   => get_template_directory_uri() . '/assets/css/blocks/hero.css',
				'category' 				=> 'fluix',
				'keywords'				=> array('hero', 'first', 'screen'),
				'icon' 						=> svg_icons::get('logo')
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
