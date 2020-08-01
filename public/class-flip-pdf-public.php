<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       Tuan Ha
 * @since      1.0.0
 *
 * @package    Flip_Pdf
 * @subpackage Flip_Pdf/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Flip_Pdf
 * @subpackage Flip_Pdf/public
 * @author     Tuan Ha <tuanhaviet22@gmail.com>
 */
class Flip_Pdf_Public {

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
		 * defined in Flip_Pdf_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flip_Pdf_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/flip-pdf-public.css', array(), $this->version, 'all' );

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
		 * defined in Flip_Pdf_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flip_Pdf_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
//        wp_enqueue_script('jquery3', plugin_dir_url( __FILE__ ) . 'js/jquery.js', array( 'jquery' ), $this->version, true );
        wp_enqueue_script('three-js', plugin_dir_url( __FILE__ ) . 'js/three.min.js', array( 'jquery' ), $this->version, true );
        wp_enqueue_script('pdf-js', plugin_dir_url( __FILE__ ) . 'js/pdf.min.js', array( 'jquery' ), $this->version, true );
        wp_enqueue_script('3dflipbook-js', plugin_dir_url( __FILE__ ) . 'js/3dflipbook.min.js', array( 'jquery' ), $this->version, true );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/flip-pdf-public.js', array( 'jquery' ), $this->version, true );
	}

}
