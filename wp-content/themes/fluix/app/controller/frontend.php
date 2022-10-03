<?php
namespace fluix\controller;
use fluix\helper\options;
use fluix\helper\media;
use fluix\helper\post;

/**
 * Frontend Controller
 **/
class frontend {

	private $_cache_time;

	/**
	 * Constructor
	 **/
	function __construct() {

		$this->_cache_time = FLUIX()->config['cache_time'];

		// header actions
		add_action( 'wp_head', [ $this, 'do_header_actions'] );

		// write critical css
		add_filter( 'wp_enqueue_scripts', [ $this, 'write_critical_css'], 1 );

		// move jquery to footer
		add_filter( 'wp_enqueue_scripts', [ $this, 'move_jquery'] );

		// load assets
		add_action( 'wp_print_styles', [ $this, 'load_scripts'], 15 );
		add_action( 'get_footer', [ $this, 'load_styles'], 15 );

		// Change excerpt dots
		add_filter( 'excerpt_more', [ $this, 'change_excerpt_more' ]);

		// Change excerpt length
		add_filter( 'excerpt_length', function() {
			return 30;
		});

		// Disable WP 5.5 lazy loading
		// add_filter( 'wp_lazy_loading_enabled', '__return_false' );

		// crop images from top
		// add_filter( 'image_resize_dimensions', [ $this, 'change_crop_position'], 10, 6 );

	}

	/**
	 * Header actions
	 */
	function do_header_actions() {

		// add site icon
		if ( function_exists( 'has_site_icon' ) && has_site_icon() ) {
			wp_site_icon();
		}

	}

	/**
	 * Critical css
	 */
	function write_critical_css( $title_tag_content ) {

		$critical_stylesheet = get_template_directory() . '/assets/css/critical-css.css';

		if( file_exists( $critical_stylesheet ) ) {

			ob_start();
			readfile( $critical_stylesheet );
			$critical_css = ob_get_clean();
			$critical_css = trim( str_replace( '/*# sourceMappingURL=critical-css.css.map */', '', $critical_css ) );

			echo '<style id="critical-css">' . $critical_css . '</style>';

		}

	}


	/**
	 * Move jquery to footer
	 */
	function move_jquery() {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
	}

	/**
	 * Load scripts
	 */
	function load_scripts() {

		wp_register_script(
			'fluix-libs',
			get_template_directory_uri() . '/assets/js/libs.min.js',
			false, $this->_cache_time, true
		);

		$deps = [
			'jquery',
			'fluix-libs'
		];

		wp_register_script(
			'fluix-app',
			get_template_directory_uri() . '/assets/js/app.min.js',
			$deps, $this->_cache_time, true
		);

		wp_enqueue_script( 'fluix-app' );

		wp_localize_script( 'fluix-app', 'themeVars', [
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'ajaxNonce' => wp_create_nonce( 'fluix_ajax_nonce'),
			'siteURL' => site_url('/')
		]);

		// add defer to all scripts
		add_filter( 'script_loader_tag', function( $tag, $handle ) {
			return str_replace( ' src', ' defer src', $tag );
		}, 10, 2);

	}

	/**
	 * Load styles
	 */
	function load_styles() {

		wp_register_style(
			'fluix-app',
			get_template_directory_uri() . '/assets/css/app.min.css',
			false, $this->_cache_time
		);

		wp_enqueue_style( 'fluix-app');

	}

	/**
	 * Deregister unused styles
	 */
	function deregister_styles() {

		wp_deregister_style( 'yarppWidgetCss');
		wp_deregister_style( 'yarppRelatedCss');

	}

	/**
	 * Change excerpt More text
	 */
	function change_excerpt_more( $more ) {
		return '…';
	}

	/**
	 * Change crop position
	 */
	function change_crop_position( $payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {

		// Change this to a conditional that decides whether you want to override the defaults for this image or not.
		if ( false ) {
			return $payload;
		}

		if ( $crop ) {
			// crop the largest possible portion of the original image that we can size to $dest_w x $dest_h
			$aspect_ratio = $orig_w / $orig_h;
			$new_w = min( $dest_w, $orig_w);
			$new_h = min( $dest_h, $orig_h);

			if ( !$new_w ) {
				$new_w = intval( $new_h * $aspect_ratio);
			}

			if ( !$new_h ) {
				$new_h = intval( $new_w / $aspect_ratio);
			}

			$size_ratio = max( $new_w / $orig_w, $new_h / $orig_h);

			$crop_w = round( $new_w / $size_ratio);
			$crop_h = round( $new_h / $size_ratio);

			$s_x = 0; // [[ formerly ]] ==> floor( ($orig_w - $crop_w) / 2 );
			$s_y = 0; // [[ formerly ]] ==> floor( ($orig_h - $crop_h) / 2 );

		} else {

			// don't crop, just resize using $dest_w x $dest_h as a maximum bounding box
			$crop_w = $orig_w;
			$crop_h = $orig_h;

			$s_x = 0;
			$s_y = 0;

			list( $new_w, $new_h ) = wp_constrain_dimensions( $orig_w, $orig_h, $dest_w, $dest_h );

		}

		// if the resulting image would be the same size or larger we don't want to resize it
		if ( $new_w >= $orig_w && $new_h >= $orig_h ) {
			return false;
		}

		// the return array matches the parameters to imagecopyresampled()
		// int dst_x, int dst_y, int src_x, int src_y, int dst_w, int dst_h, int src_w, int src_h
		return [ 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h ];

	}

}

?>
