<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://recranet.com/
 * @since      1.0.0
 *
 * @package    Recranet
 * @subpackage Recranet/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Recranet
 * @subpackage Recranet/public
 * @author     Recranet <info@recranet.com>
 */
class Recranet_Public {

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
     * Register shortcodes
     *
     * @since    1.0.0
     */
    public function register_shortcodes() {
        add_shortcode( 'recranet_accommodations', array($this, 'recranet_accommodations') );
        add_shortcode( 'recranet_packages', array($this, 'recranet_packages') );
        add_shortcode( 'recranet_accommodation_reservation_form', array($this, 'recranet_accommodation_reservation_form') );
        add_shortcode( 'recranet_search_form', array($this, 'recranet_search_form') );
    }

    /**
     * Register base tag and remove redirects
     *
     * @since    1.0.3
     */
    function register_base_tag() {
        global $post;

        // Add base tag to head for html5 mode
        if ( get_option( 'recranet_html5mode' ) && is_a( $post, 'WP_Post' ) &&
            ( has_shortcode( $post->post_content, 'recranet_accommodations' ) || has_shortcode( $post->post_content, 'recranet_packages' ) ) ) {
            echo '<base href="' . get_permalink() . '" />';
        }
    }

    /**
     * Recranet accommodations
     *
     * @since    1.0.0
     */
    function recranet_accommodations( $atts ) {
	    include_once( 'partials/recranet-accommodations.php' );
    }

    /**
     * Recranet packages
     *
     * @since    1.0.0
     */
    function recranet_packages( $atts ) {
	    include_once( 'partials/recranet-packages.php' );
    }

    /**
     * Recranet accommodation reservation form
     *
     * @since    1.0.0
     */
    function recranet_accommodation_reservation_form( $atts ) {
	    include_once( 'partials/recranet-accommodation-reservation-form.php' );
    }

    /**
     * Recranet search form
     *
     * @since    1.0.4
     */
    function recranet_search_form( $atts ) {
	    include_once( 'partials/recranet-search-form.php' );
    }
}
