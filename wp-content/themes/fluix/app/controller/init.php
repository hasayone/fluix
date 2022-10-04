<?php
namespace fluix\controller;
use fluix\helper\options;

/**
 * Init Controller
 **/
class init {

	/**
	 * Constructor
	 **/
	function __construct() {

		$this->add_theme_support();
		$this->register_settings();
		$this->register_menus();
		$this->register_cpt();

	}

	/**
	 * Add theme support
	 */
	function add_theme_support() {

		add_action( 'after_setup_theme', function() {
			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'html5', [ 'search-form', 'gallery', 'caption', 'script', 'style' ] );
		});

	}

	/**
	 * ACF
	 */
	function register_settings() {

		$api_keys = options::get( 'api_keys');

		// ACF Options Page
		if( function_exists( 'acf_add_options_page') ) {
			acf_add_options_page();
		}

		// ACF Google Maps API Key
		add_filter( 'acf/fields/google_map/api', function( $api ) use( $api_keys ) {

			if( isset( $api_keys['google_maps_api_key'] ) ) {
				$api['key'] = $api_keys['google_maps_api_key'];
			}
			
			return $api;
		});
		
	}

	/**
	 * Register nav menus
	 */
	function register_menus() {

		// register menus
		add_action( 'init', function() {
			register_nav_menus( [
				'header_menu' => __( 'Header menu', 'fluix' ),
				 'footer_menu_col_1' => __( 'Footer menu column 1', 'fluix' ),
				 'footer_menu_col_2' => __( 'Footer menu column 2', 'fluix' ),
				 'footer_menu_col_3' => __( 'Footer menu column 3', 'fluix' ),
				 'footer_menu_col_4' => __( 'Footer menu column 4', 'fluix' ),
			] );
		});

	}

	/**
	 * Register custom post types
	 */
	function register_cpt() {

		 FLUIX()->model->post->register_post_type();
		 FLUIX()->model->post->register_taxonomy();

	}


}

?>
