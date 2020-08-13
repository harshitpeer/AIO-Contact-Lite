<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://profiles.wordpress.org/harshitpeer
 * @since      1.0.0
 *
 * @package    Aio_Contact_Lite
 * @subpackage Aio_Contact_Lite/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Aio_Contact_Lite
 * @subpackage Aio_Contact_Lite/public
 * @author     Harshit Peer <harshitpeer@gmail.com>
 */
class Aio_Contact_Lite_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aio_Contact_Lite_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aio_Contact_Lite_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'animate.css', plugins_url( $this->plugin_name ) . '/vendor/animate/animate.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'fontawesome-free', plugins_url( $this->plugin_name ) . '/vendor/fontawesome-free/all.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/aio-contact-lite-public.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aio_Contact_Lite_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aio_Contact_Lite_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/aio-contact-lite-public.min.js', array( 'jquery' ), $this->version, false );

	}

	public function load_aio_lite() {
		
		$items = json_decode(get_option( $this->plugin_name . '-items' ));
		$settings = get_option( $this->plugin_name . '-settings' );

		if(!is_array($settings)) {
			$settings = array();
		}

		$default_settings = new \stdClass;
		$default_settings->position = 'br';
		$default_settings->button_icon = 'fas fa-comment-alt';
		$default_settings->button_color = '#3047EC';
		$default_settings->button_icon_color = '#FFFFFF';

		foreach($default_settings as $key => $value) {
			if(!isset($settings[$key])) {
				$settings[$key] = $value;
			}
		}

		$aio_custom_css = "
		.aio-contact-parent .aio-contact-trigger { background: ".esc_attr($settings['button_color'])." }
		.aio-contact-parent .aio-contact-trigger i { color: ".esc_attr($settings['button_icon_color'])." }
		";

		if(esc_attr($settings['position']) == 'bl') {
			$aio_custom_css .= '
			.aio-contact-parent .aio-contact-trigger { left: 20px; }
			.aio-contact-parent .aio-contact-floating { left: 30px; right: unset; }
			.aio-contact-parent .aio-contact-floating.aio-contact-no-text { left: 7px; right: unset; }
			';
		}
		if(count($items) > 0) {
			include_once('partials/aio-contact-lite-public-display.php');
		}
	}

}
