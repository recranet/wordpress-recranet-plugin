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
    }

    /**
     * Register base tag and remove redirects
     *
     * @since    1.0.3
     */
    function register_base_tag() {
        global $post;

        // Add base tag to head for html5 mode
        if (get_option( 'recranet_html5mode' ) && is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'recranet_accommodations' ) ) {
            echo '<base href="' . get_permalink() . '" />';

            remove_action( 'template_redirect', 'redirect_canonical' );
        }
    }

    /**
     * Recranet accommodations
     *
     * @since    1.0.0
     */
    function recranet_accommodations( $atts ) {
        // Include partial
	    include_once( 'partials/recranet-accommodations.php' );
    }
}
