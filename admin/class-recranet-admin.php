<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://recranet.com/
 * @since      1.0.0
 *
 * @package    Recranet
 * @subpackage Recranet/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Recranet
 * @subpackage Recranet/admin
 * @author     Recranet <info@recranet.com>
 */
class Recranet_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_plugin_admin_menu() {
        /*
         * Add a settings page for this plugin to the Settings menu.
         *
         * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
         *
         *        Administration Menus: http://codex.wordpress.org/Administration_Menus
         *
         */
        add_options_page( 'Recranet Instellingen', 'Recranet', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page') );
    }

     /**
      * Add settings action link to the plugins page.
      *
      * @since    1.0.0
      */
    public function add_action_links( $links ) {
       /*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
       $settings_link = array(
           '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
       );
       return array_merge( $settings_link, $links );

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_setup_page() {
        include_once( 'partials/recranet-admin-display.php' );
    }

    /**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function recranet_general_cb() {
		echo '<p>Hier kunt u de algemene Recranet instellingen aanpassen.</p>';
	}

    /**
	 * Render the organization input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function recranet_organization_cb() {
		echo '<input type="text" name="' . $this->plugin_name . '_organization" id="' . $this->plugin_name . '_organization" value="' . get_option( $this->plugin_name . '_organization' ) . '">';
	}

    /**
     * Render the breakpoint small input for this plugin
     *
     * @since  1.0.0
     */
    public function recranet_breakpoint_small_cb() {
        echo '<input type="text" name="' . $this->plugin_name . '_breakpoint_small" id="' . $this->plugin_name . '_breakpoint_small" value="' . get_option( $this->plugin_name . '_breakpoint_small', 720 ) . '">';
    }

    /**
     * Render the breakpoint medium input for this plugin
     *
     * @since  1.0.0
     */
    public function recranet_breakpoint_medium_cb() {
        echo '<input type="text" name="' . $this->plugin_name . '_breakpoint_medium" id="' . $this->plugin_name . '_breakpoint_medium" value="' . get_option( $this->plugin_name . '_breakpoint_medium', 940 ) . '">';
    }

    /**
     * Render the breakpoint large input for this plugin
     *
     * @since  1.0.0
     */
    public function recranet_breakpoint_large_cb() {
        echo '<input type="text" name="' . $this->plugin_name . '_breakpoint_large" id="' . $this->plugin_name . '_breakpoint_large" value="' . get_option( $this->plugin_name . '_breakpoint_large', 1120 ) . '">';
    }

    /**
	 * Render the radio input fields for this plugin
	 *
	 * @since  1.0.0
	 */
	public function recranet_html5mode_cb() {
		$html5Mode = get_option( $this->plugin_name . '_html5mode' );
		?>
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->plugin_name . '_html5mode' ?>" value="0" <?php checked( $html5Mode, 0 ); ?>>
                    Gebruik de location hash (#) voor de routing van Recranet
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->plugin_name . '_html5mode' ?>" value="1" <?php checked( $html5Mode, 1 ); ?>>
                    Gebruik de HTML5 routing mode. Let op: hiervoor zijn aanvullende mod_rewrite regels vereist!
				</label>
			</fieldset>
		<?php
	}

    /**
     * Register settings
     *
     * @since    1.0.0
     */
    public function register_settings() {
        register_setting( $this->plugin_name, $this->plugin_name . '_organization', 'intval' );
        register_setting( $this->plugin_name, $this->plugin_name . '_breakpoint_small', 'intval' );
        register_setting( $this->plugin_name, $this->plugin_name . '_breakpoint_medium', 'intval' );
        register_setting( $this->plugin_name, $this->plugin_name . '_breakpoint_large', 'intval' );
        register_setting( $this->plugin_name, $this->plugin_name . '_html5mode', 'intval' );

        add_settings_section(
    		$this->plugin_name . '_general',
    		'Algemene instellingen',
    		array( $this, $this->plugin_name . '_general_cb' ),
    		$this->plugin_name
    	);

        add_settings_field(
            $this->plugin_name . '_organization',
            'Organisatie ID',
            array( $this, $this->plugin_name . '_organization_cb' ),
            $this->plugin_name,
            $this->plugin_name . '_general',
            array( 'label_for' => $this->plugin_name . '_organization' )
        );

        add_settings_field(
            $this->plugin_name . '_breakpoint_small',
            'Breakpoint (small)',
            array( $this, $this->plugin_name . '_breakpoint_small_cb' ),
            $this->plugin_name,
            $this->plugin_name . '_general',
            array( 'label_for' => $this->plugin_name . '_breakpoint_small' )
        );

        add_settings_field(
            $this->plugin_name . '_breakpoint_medium',
            'Breakpoint (medium)',
            array( $this, $this->plugin_name . '_breakpoint_medium_cb' ),
            $this->plugin_name,
            $this->plugin_name . '_general',
            array( 'label_for' => $this->plugin_name . '_breakpoint_medium' )
        );

        add_settings_field(
            $this->plugin_name . '_breakpoint_large',
            'Breakpoint (large)',
            array( $this, $this->plugin_name . '_breakpoint_large_cb' ),
            $this->plugin_name,
            $this->plugin_name . '_general',
            array( 'label_for' => $this->plugin_name . '_breakpoint_large' )
        );

        add_settings_field(
            $this->plugin_name . '_html5mode',
            'HTML5 routing mode',
            array( $this, $this->plugin_name . '_html5mode_cb' ),
            $this->plugin_name,
            $this->plugin_name . '_general',
            array( 'label_for' => $this->plugin_name . '_html5mode' )
        );
    }
}
