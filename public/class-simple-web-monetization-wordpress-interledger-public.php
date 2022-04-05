<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.divydovy.com
 * @since      1.0.0
 *
 * @package    Simple_Web_Monetization_Wordpress_Interledger
 * @subpackage Simple_Web_Monetization_Wordpress_Interledger/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Simple_Web_Monetization_Wordpress_Interledger
 * @subpackage Simple_Web_Monetization_Wordpress_Interledger/public
 * @author     David Lockie <divydovy@gmail.com>
 */

class Simple_Web_Monetization_Wordpress_Interledger_Public {
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
	 * Output the Web Monetization header meta
	 *
	 * @since    1.0.0
	 */
	public function add_wm_header_meta() {

		/**
		 * Responsible for actually outputting the wm header based on the settings
		 * 
		 * Retrieve values with:
		 * $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options = get_option( 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name' ); // Array of All Options
		 * $pick_a_payment_pointer_0 = $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['pick_a_payment_pointer_0']; // Pick a payment pointer	
		 * $enter_your_own_custom_payment_pointer_1 = $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enter_your_own_custom_payment_pointer_1']; // Enter your own custom payment pointer
		 * $enable_web_monetization_on_this_site_2 = $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enable_web_monetization_on_this_site_2']; // Enable Web Monetization on this site
		 */

		$simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options = get_option( 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name' ); // Array of All Options	
		$pick_a_payment_pointer_0 = $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['pick_a_payment_pointer_0']; // Gets current radio option selected
		$enable_web_monetization_on_this_site_2 = $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enable_web_monetization_on_this_site_2']; // Is WM enabled?
		$payment_pointer = $pick_a_payment_pointer_0; // By default, set the payment pointer to be whichever is selected from the radio options

		if ( $enable_web_monetization_on_this_site_2 ) {

			if ( $pick_a_payment_pointer_0 === 'custom' ) { // But if this is the custom payment pointer option, instead set the value to that of the custom field
				$payment_pointer = $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enter_your_own_custom_payment_pointer_1'];
			} 

			//wp_die(var_dump($simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options));

			echo '<meta name="monetization" content="' . esc_attr( $payment_pointer ) . '" />' . PHP_EOL;
			echo '<link rel="monetization" href="https://' . substr( esc_attr( $payment_pointer ), 1 ) . '" />' . PHP_EOL;
		} // End if WM is enabled

	} // End add_wm_header_meta
	
}
