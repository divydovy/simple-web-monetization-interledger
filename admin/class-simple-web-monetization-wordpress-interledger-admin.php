<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.divydovy.com
 * @since      1.0.0
 *
 * @package    Simple_Web_Monetization_Wordpress_Interledger
 * @subpackage Simple_Web_Monetization_Wordpress_Interledger/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Simple_Web_Monetization_Wordpress_Interledger
 * @subpackage Simple_Web_Monetization_Wordpress_Interledger/admin
 * @author     David Lockie <divydovy@gmail.com>
 */
class Simple_Web_Monetization_Wordpress_Interledger_Admin {

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
	 * @since    	1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Simple_Web_Monetization_Wordpress_Interledger_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Simple_Web_Monetization_Wordpress_Interledger_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/simple-web-monetization-wordpress-interledger-admin.js', array( 'jquery' ), $this->version, false );

	}

}

/**
 * Based on WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class SimpleWebMonetizationForWordPressByInterledgerPluginSettings {
	private $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_page_init' ) );
	}

	public function simple_web_monetization_for_wordpress_by_interledger_plugin_settings_add_plugin_page() {
		add_options_page(
			'Simple Web Monetization for WordPress by Interledger - plugin settings', // page_title
			'Simple Web Monetization', // menu_title
			'manage_options', // capability
			'simple-web-monetization-for-wordpress-by-interledger-plugin-settings', // menu_slug
			array( $this, 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_create_admin_page' ) // function
		);
	}

	public function simple_web_monetization_for_wordpress_by_interledger_plugin_settings_create_admin_page() {
		$this->simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options = get_option( 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name' ); ?>

		<div class="wrap">
			<h2>Simple Web Monetization for WordPress by Interledger plugin settings</h2>
			<p>This page can be used to choose a charity to support, or to enter your own payment pointer.</p>
			<p>Once you have selected a payment pointer option and saved it, every front end page of your WordPress site will include the following source code in the <code>&lt;head&gt;</code> section. It'll look like this:</p>
			<pre>
				&lt;meta name="monetization" content="$ilp.uphold.com/XXXXXXXX" /&gt;
				&lt;link rel="monetization" href="https://ilp.uphold.com/XXXXXXXX" /&gt;
			</pre>
			<?php // settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_group' );
					do_settings_sections( 'simple-web-monetization-for-wordpress-by-interledger-plugin-settings-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function simple_web_monetization_for_wordpress_by_interledger_plugin_settings_page_init() {
		register_setting(
			'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_group', // option_group
			'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name', // option_name
			array( $this, 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_setting_section', // id
			'Settings', // title
			array( $this, 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_section_info' ), // callback
			'simple-web-monetization-for-wordpress-by-interledger-plugin-settings-admin' // page
		);

		add_settings_field(
			'pick_a_payment_pointer_0', // id
			'Pick a payment pointer	', // title
			array( $this, 'pick_a_payment_pointer_0_callback' ), // callback
			'simple-web-monetization-for-wordpress-by-interledger-plugin-settings-admin', // page
			'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_setting_section' // section
		);

		add_settings_field(
			'enter_your_own_custom_payment_pointer_1', // id
			'Enter a custom payment pointer', // title
			array( $this, 'enter_your_own_custom_payment_pointer_1_callback' ), // callback
			'simple-web-monetization-for-wordpress-by-interledger-plugin-settings-admin', // page
			'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_setting_section' // section
		);

		add_settings_field(
			'enable_web_monetization_on_this_site_2', // id
			'Enable Web Monetization', // title
			array( $this, 'enable_web_monetization_on_this_site_2_callback' ), // callback
			'simple-web-monetization-for-wordpress-by-interledger-plugin-settings-admin', // page
			'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_setting_section' // section
		);
	}

	public function simple_web_monetization_for_wordpress_by_interledger_plugin_settings_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['pick_a_payment_pointer_0'] ) ) {
			$sanitary_values['pick_a_payment_pointer_0'] = $input['pick_a_payment_pointer_0'];
		}

		if ( isset( $input['enter_your_own_custom_payment_pointer_1'] ) ) {
			$sanitary_values['enter_your_own_custom_payment_pointer_1'] = sanitize_text_field( $input['enter_your_own_custom_payment_pointer_1'] );
		}

		if ( isset( $input['enable_web_monetization_on_this_site_2'] ) ) {
			$sanitary_values['enable_web_monetization_on_this_site_2'] = $input['enable_web_monetization_on_this_site_2'];
		}

		return $sanitary_values;
	}

	public function simple_web_monetization_for_wordpress_by_interledger_plugin_settings_section_info() {
		
	}

	/**
	 * To manage the charities listed, just edit or create a new item in the array.
	 * Note that you need to change "charity-xxx" to "charity-xxx+1" for new items
	 */

	public function pick_a_payment_pointer_0_callback() {

		$charities = array(
		    "charity-one" => array(
		         "name" => "Critical Read",
		         "description" => "",
		         "payment-pointer" => "\$ilp.uphold.com/6WaPJ87LUaMB",
		         "link" => "https://criticalread.org/"
		         ),
		    "charity-two" => array(
		         "name" => "Defold Foundation",
		         "description" => "The Defold Foundation is managing the development of the free to use, source available, game engine Defold",
		         "payment-pointer" => "\$ilp.uphold.com/QkG86UgXzKq8",
		         "link" => "https://defold.com/foundation/"
		         ),
		    "charity-three" => array(
		         "name" => "freeCodeCamp",
		         "description" => "freeCodeCamp helps people learn to code for free through thousands of videos, articles, and interactive coding lessons - all freely available to the public.",
		         "payment-pointer" => "\$ilp.uphold.com/LJmbPn7WD4JB",
		         "link" => "https://freecodecamp.org/"
		         ),
		    "charity-four" => array(
		         "name" => "Internet Archive",
		         "description" => "The Internet Archive is a nonprofit library & home of the Wayback Machine. It's mission is Universal Access to All Knowledge.",
		         "payment-pointer" => "\$ilp.uphold.com/D7BwPKMQzBiD",
		         "link" => "https://archive.org/index.php"
		         ),
		    "charity-five" => array(
		         "name" => "S.T.O.P. (Surveillance Technology Oversight Project)",
		         "description" => "The Surveillance Technology Oversight Project advocates and litigates to abolish local governments’ systems of mass surveillance, highlighting the discriminatory impact of surveillance on Muslim Americans, immigrants, the LGBTQ+ community, Indigenous peoples, and communities of color, particularly the unique trauma of anti-Black policing.",
		         "payment-pointer" => "\$ilp.uphold.com/RHZ6KZx4mWQi",
		         "link" => "http://www.stopspying.org/"
		         ),
		    "charity-six" => array(
		         "name" => "Ushahidi",
		         "description" => "Ushahidi is a global non-profit technology company whose mission is to empower communities to thrive as a result of access to data and technology.",
		         "payment-pointer" => "\$ilp.uphold.com/kN2KHpqhNFiM",
		         "link" => "https://www.ushahidi.com/"
		         ),
		    "charity-seven" => array(
		         "name" => "Ballet Rising",
		         "description" => "Supporting ballet communities in the most unlikely places",
		         "payment-pointer" => "\$ilp.uphold.com/4hyPF8hgjKMw",
		         "link" => "https://balletrising.com/"
		         ),
		    "charity-eight" => array(
		         "name" => "Creative Living for Dancers",
		         "description" => "Led by international performing artist Briana Ashley Stuart, Creative Living for Dancers addresses the lack of dance entrepreneurial content made by dancers for dancers, challenges negative views and stereotypes of dancers, and provides career advice to build and sustain a successful life and career as a dance artist.",
		         "payment-pointer" => "\$ilp.uphold.com/FR7UfwWWfib3",
		         "link" => "https://creativelivingfordancers.com/"
		         ),
		    "charity-nine" => array(
		         "name" => "ITADI Coffee",
		         "description" => "ITADI strives to be a connector of generational traditions and modern solutions to a well-lived life. Our ethical practices positively affect the lives of our farmers, their families and the neighboring communities.",
		         "payment-pointer" => "\$ilp.uphold.com/kjMJqg7gH7JA",
		         "link" => "https://itadicoffee.com/"
		         ),
		    "charity-ten" => array(
		         "name" => "Wellness Through Mindfulness Course",
		         "description" => "Mindfulness Course designed to Expand Your Mindfulness Skills, So You Can Live Your Life More Empowered and Relaxed.",
		         "payment-pointer" => "\$ilp.gatehub.net/735653594",
		         "link" => "https://www.pamelajalexander.com/programs/wellness-through-mindfulness-course/"
		         )
		); ?>

		<fieldset>
			<?php
			$i = 0;
			foreach ($charities as $charity) { // Loops through the charities array and outputs and a radio select for each
				
				$checked = ( isset( $this->simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['pick_a_payment_pointer_0'] ) && $this->simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['pick_a_payment_pointer_0'] === $charity["payment-pointer"] ) ? 'checked' : '' ; ?>
					<label for="pick_a_payment_pointer_0-<?php echo esc_attr( $i ); ?>"><input type="radio" name="simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name[pick_a_payment_pointer_0]" id="pick_a_payment_pointer_0-<?php echo esc_attr( $i ); ?>" value="<?php echo esc_attr( $charity['payment-pointer'] ); ?>" <?php echo esc_attr( $checked ); ?>> <strong><?php echo esc_attr( $charity["name"] ); ?></strong> <a title="Find out more about <?php echo esc_attr( $charity["name"] ); ?>" href="<?php echo esc_url( $charity["link"] ); ?>">(website)</a></label><br><p class="description"><?php echo esc_attr( $charity["description"] ); ?></p>
				<?php 
				$i++;
			}

			// Then we add a final option for 'custom'
			$checked = ( isset( $this->simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['pick_a_payment_pointer_0'] ) && $this->simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['pick_a_payment_pointer_0'] === 'custom' ) ? 'checked' : '' ; ?>
				<label for="pick_a_payment_pointer_0-<?php echo esc_attr( $i ); ?>"><input type="radio" name="simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name[pick_a_payment_pointer_0]" id="pick_a_payment_pointer_0-<?php echo esc_attr( $i ); ?>" value="custom" <?php echo esc_attr( $checked ); ?>> <strong>Custom payment pointer</strong></label><br><p class="description">Select this option to input any payment pointer</p>
		</fieldset>

		<?php
	}

	public function enter_your_own_custom_payment_pointer_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name[enter_your_own_custom_payment_pointer_1]" id="enter_your_own_custom_payment_pointer_1" value="%s"><p class="description" id="custom-payment-pointer-description">Enter your pointer in this format: <code>$ilp.uphold.com/XXXXXXXXXXXX</code></p>',
			isset( $this->simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enter_your_own_custom_payment_pointer_1'] ) ? esc_attr( $this->simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enter_your_own_custom_payment_pointer_1']) : ''
		);
	}

	public function enable_web_monetization_on_this_site_2_callback() {
		printf(
			'<input type="checkbox" name="simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name[enable_web_monetization_on_this_site_2]" id="enable_web_monetization_on_this_site_2" value="enable_web_monetization_on_this_site_2" %s> <label for="enable_web_monetization_on_this_site_2">Check to enable Web Monetization on all front end pages served by this WordPress site.</label>',
			( isset( $this->simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enable_web_monetization_on_this_site_2'] ) && $this->simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enable_web_monetization_on_this_site_2'] === 'enable_web_monetization_on_this_site_2' ) ? 'checked' : ''
		);
	}

}
if ( is_admin() )
	$simple_web_monetization_for_wordpress_by_interledger_plugin_settings = new SimpleWebMonetizationForWordPressByInterledgerPluginSettings();

/* 
 * Retrieve values with:
 * $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options = get_option( 'simple_web_monetization_for_wordpress_by_interledger_plugin_settings_option_name' ); // Array of All Options
 * $pick_a_payment_pointer_0 = $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['pick_a_payment_pointer_0']; // Pick a payment pointer	
 * $enter_your_own_custom_payment_pointer_1 = $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enter_your_own_custom_payment_pointer_1']; // Enter your own custom payment pointer
 * $enable_web_monetization_on_this_site_2 = $simple_web_monetization_for_wordpress_by_interledger_plugin_settings_options['enable_web_monetization_on_this_site_2']; // Enable Web Monetization on this site
 */
