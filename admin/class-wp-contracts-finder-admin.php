<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://twitter.com/Inu3219
 * @since      1.0.0
 *
 * @package    Wp_Contracts_Finder
 * @subpackage Wp_Contracts_Finder/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Contracts_Finder
 * @subpackage Wp_Contracts_Finder/admin
 * @author     Inayat Cassambai <inayat.cassambai@gmail.com>
 */
class Wp_Contracts_Finder_Admin {

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
	 * The class that's responsible for adding the html to the admin page of
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wp_Contracts_Finder_Admin_Display
	 */
	protected $plugin_admin_view;	


	/**
	 * The class that's responsible for the Cron Job which pulls
	 * in the contracts.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wp_Contracts_Finder_Admin_Scheduler
	 */
	protected $plugin_admin_scheduler;		

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

		$this->load_dependencies();
	}

	/**
	 * Load the required dependencies for the admin view.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for outputting the admin area view of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-contracts-finder-admin-display.php';

		/**
		 * The class responsible for outputting the API call which pulls in the contracts.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-contracts-finder-admin-api.php';

		/**
		 * The class responsible for setting up the cron job.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-contracts-finder-scheduler.php';
		

		$this->plugin_admin_view = new Wp_Contracts_Finder_Admin_Display();
		$this->plugin_admin_scheduler = new Wp_Contracts_Finder_Admin_Scheduler();
	}
		

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * Uses $hook to check if the current page hook matches the page hook of our page.
	 * This wll ensure the styles only loads on our page.
	 * 
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

		if ($hook == 'settings_page_'.$this->plugin_name.'') {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-contracts-finder-admin.css', array(), $this->version, 'all' );
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * Uses $hook to check if the current page hook matches the page hook of our page.
	 * This wll ensure the scripts only loads on our page.
	 * 
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

		if ($hook == 'settings_page_'.$this->plugin_name.'') {
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-contracts-finder-admin.js', array(), $this->version, true );

			$args = array(
                'url'   => admin_url( 'admin-ajax.php' )
            );
            wp_localize_script( $this->plugin_name, 'wp_contracts_finder_ajax', $args );
		}

	}

	/**
	 * Creates an admin page for the plugin
	 *
	 * @since    1.0.0
	 */
	public function add_settings_page() {
        add_options_page(
            __( 'WordPress Contracts Finder', 'wp-contracts-finder' ),
            __( 'WordPress Contracts Finder', 'wp-contracts-finder' ),
            'manage_options',
            $this->plugin_name,
            array($this->plugin_admin_view, 'settings_page_html')
        );
	}
}
