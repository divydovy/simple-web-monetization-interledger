<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.divydovy.com
 * @since      1.0.0
 *
 * @package    Simple_Web_Monetization_Wordpress_Interledger
 * @subpackage Simple_Web_Monetization_Wordpress_Interledger/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Simple_Web_Monetization_Wordpress_Interledger
 * @subpackage Simple_Web_Monetization_Wordpress_Interledger/includes
 * @author     David Lockie <divydovy@gmail.com>
 */
class Simple_Web_Monetization_Wordpress_Interledger_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'simple-web-monetization-wordpress-interledger',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
