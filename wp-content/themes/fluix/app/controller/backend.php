<?php

namespace fluix\controller;

/**
 * Backend Controller
 **/
class backend
{

	/**
	 * Constructor
	 **/
	function __construct()
	{

		// load admin assets
		add_action('admin_enqueue_scripts', [$this, 'load_assets']);

		// add custom columns to admin
		add_filter('manage_post_posts_columns', [$this, 'add_admin_list_columns'], 10);
		add_action('manage_post_posts_custom_column', [$this, 'print_admin_list_columns'], 10, 2);

		// Adding a new category to the block editor. 
		add_filter('block_categories_all', function ($categories, $post) {
			return array_merge(
				$categories,
				array(
					array(
						'slug'  => 'fluix',
						'title' => 'Fluix Blocks',
					),
				)
			);
		}, 10, 2);


		// add editor style
		$this->add_editor_styles();
	}

	/**
	 * Load admin assets
	 **/
	function load_assets()
	{

		$current_screen = get_current_screen();
		wp_enqueue_style('fluix-admin', get_template_directory_uri() . '/assets/css/admin.css', false, FLUIX()->config['cache_time']);

		wp_enqueue_script(
			'fluix-admin',
			get_template_directory_uri() . '/assets/js/admin/admin.min.js',
			['jquery'],
			FLUIX()->config['cache_time'],
			true
		);
	}

	/**
	 * Add custom editor styles
	 */
	function add_editor_styles()
	{

		add_action('init', function () {
			add_editor_style('assets/css/admin-editor-style.css');
		});

		add_filter('tiny_mce_before_init', function ($mce_init) {
			$mce_init['cache_suffix'] = 'v=' . FLUIX()->config['cache_time'];
			return $mce_init;
		});
	}

	/**
	 * Add custom columns to the list
	 */
	function add_admin_list_columns($columns)
	{

		// Thumb
		$id_col = ['thumb' => __('Preview', 'fluix')];
		$columns = array_slice($columns, 0, 1, true) + $id_col + array_slice($columns, 1, NULL, true);

		return $columns;
	}

	/**
	 * Print custom columns
	 */
	function print_admin_list_columns($column_name, $post_ID)
	{

		$view_data = ['post_id' => $post_ID];

		switch ($column_name) {

			case 'thumb':

				if (has_post_thumbnail($post_ID)) {
					echo get_the_post_thumbnail($post_ID, 'thumbnail');
				}

				break;
		}
	}
}
