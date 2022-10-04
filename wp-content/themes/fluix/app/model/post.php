<?php

namespace fluix\model;

use fluix\helper\options;
use fluix\helper\front;

/**
 * Post model
 */
class post extends database
{

	/**
	 * Get posts
	 */
	function get($args = [], $nocache = false)
	{

		$default_args = [
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => get_option('posts_per_page')
		];

		$query_args = array_merge($default_args, $args);

		$query = new \WP_Query($query_args);

		return $query;
	}


	/**
	 * Register custom post type Features
	 */
	function register_post_type()
	{
		// Features
		register_post_type(
			'features',
			[
				'label'             	=> __('Features', 'fluix'),
				'description'       	=> '',
				'show_in_rest' 				=> false,
				'public'            	=> true,
				'show_ui'           	=> true,
				'show_in_menu'      	=> true,
				'show_in_nav_menus' 	=> false,
				'menu_icon'						=> 'dashicons-admin-site-alt2',
				'capability_type'   	=> 'post',
				'hierarchical'      	=> false,
				'supports'          	=> ['title', 'custom-fields', 'revisions'],
				'rewrite'           	=> ['slug' => 'features', 'with_front' => false],
				'has_archive'       	=> true,
				'query_var'         	=> true,
				'exclude_from_search'	=> false,
				'menu_position'     => 25,
				'capabilities'      => [
					'publish_posts'       => 'edit_posts',
					'edit_posts'					=> 'edit_posts',
					'edit_others_posts'   => 'edit_pages',
					'delete_posts'        => 'edit_pages',
					'delete_others_posts' => 'edit_pages',
					'read_private_posts'  => 'edit_pages',
					'edit_post'           => 'edit_posts',
					'delete_post'         => 'edit_posts',
					'read_post'           => 'edit_posts',
				],
				'labels'            => [
					'name'               => __('Features', 'fluix'),
					'singular_name'      => __('Feature', 'fluix'),
					'menu_name'          => __('Features', 'fluix'),
					'add_new'            => __('Add Feature', 'fluix'),
					'add_new_item'       => __('Add New Feature', 'fluix'),
					'all_items'          => __('All Features', 'fluix'),
					'edit_item'          => __('Edit Feature', 'fluix'),
					'new_item'           => __('New Feature', 'fluix'),
					'view_item'          => __('View Feature', 'fluix'),
					'search_items'       => __('Search Features', 'fluix'),
					'not_found'          => __('No Features found', 'fluix'),
					'not_found_in_trash' => __('No Features found in trasn', 'fluix'),
					'parent_item_colon'  => __('Parent Feature', 'fluix'),
				]
			]
		);
	}

	/**
	 * Register taxonomy
	 */
	function register_taxonomy()
	{

		register_taxonomy(
			'features-list',
			'features',
			[
				'hierarchical'      => false,
				'show_ui'           => true,
				'query_var'         => true,
				'show_in_nav_menus' => true,
				'rewrite'           => false,
				'show_admin_column' => true,
				'tax_position' 			=> true,
				'labels'            => [
					'name'          => _x('Features list', 'taxonomy general name', 'fluix'),
					'singular_name' => _x('Features item', 'taxonomy singular name', 'fluix'),
					'search_items'  => __('Search in features list', 'fluix'),
					'all_items'     => __('All features items', 'fluix'),
					'edit_item'     => __('Edit features item', 'fluix'),
					'update_item'   => __('Update features item', 'fluix'),
					'add_new_item'  => __('Add new features item', 'fluix'),
					'new_item_name' => __('New features item', 'fluix'),
					'menu_name'     => __('Features list', 'fluix')
				]
			]
		);
	}
}
