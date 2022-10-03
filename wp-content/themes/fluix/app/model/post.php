<?php
namespace fluix\model;
use fluix\helper\options;
use fluix\helper\front;

/**
 * Post model
 */
class post extends database {

	/**
	 * Get posts
	 */
	function get( $args = [], $nocache = false ) {

		$default_args = [
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => get_option( 'posts_per_page')
		];

		$query_args = array_merge( $default_args, $args );

		$query = new \WP_Query( $query_args );

		return $query;

	}

	/**
	 * Get blog posts only, not reviews
	 */
	function get_blog_posts( $args = [] ) {
		
		$blog_settings = \fluix\helper\options::get( 'blog' );

		$default_args = [
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => get_option( 'posts_per_page'),
		];

		if( ! isset( $args['cat'] ) ) {
			$default_args['category__in'] = $blog_settings['blog_cats_in'];
			$default_args['category__not_in'] = $blog_settings['blog_cats_not_in'];
		}

		$query_args = array_merge( $default_args, $args );

		$query = new \WP_Query( $query_args );

		return $query;

	}

	/**
	 * Get posts by taxonomies
	 */
	function get_posts_by_tax( $args ) {

		$query = [];

		if( isset( $args['posts_per_page'] ) ) {
			$query = [
				'posts_per_page' => $args['posts_per_page']
			];
		}
	
		if( ! empty( $args['include_cats'] ) ) {
			$query['tax_query'][] = [
				'taxonomy' 	=> 'category',
				'terms' 		=> $args['include_cats'],
				'operator' 	=> 'IN'
			];
		}
	
		if( ! empty( $args['exclude_cats'] ) ) {
			$query['tax_query'][] = [
				'taxonomy' 	=> 'category',
				'terms' 		=> $args['exclude_cats'],
				'operator' 	=> 'NOT IN'
			];
		}
	
		if( ! empty( $args['include_tags'] ) ) {
			$query['tax_query'][] = [
				'taxonomy' 	=> 'post_tag',
				'terms' 		=> $args['include_tags'],
				'operator' 	=> 'IN'
			];
		}
	
		if( ! empty( $args['exclude_tags'] ) ) {
			$query['tax_query'][] = [
				'taxonomy' 	=> 'post_tag',
				'terms' 		=> $args['exclude_tags'],
				'operator' 	=> 'NOT IN'
			];
		}
	
		if( isset( $args['featured'] ) && $args['featured'] ) {
			$query['meta_query'][] = [
				'key' 		=> 'featured_post',
				'value' 	=> 1
			];
		}

		if( isset( $query['tax_query'] ) && count( $query['tax_query'] ) > 1 ) {
			$query['tax_query']['relation'] = 'AND';
		}

		return $this->get( $query );

	}

	/**
	 * Get posts by IDs
	 */
	function get_posts_by_ids( $ids = [] ) {

		if( empty( $ids ) ) {
			return false;
		}

		$query = [
			'post_type' => ['post', 'page'],
			'post__in' => $ids,
			'orderby' => 'post__in'
		];

		return $this->get( $query );
	}

}

?>