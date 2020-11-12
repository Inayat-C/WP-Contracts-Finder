<?php

/**
 * Fired during plugin activation
 *
 * @link       https://twitter.com/Inu3219
 * @since      1.0.0
 *
 * @package    Wp_Contracts_Finder
 * @subpackage Wp_Contracts_Finder/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Contracts_Finder
 * @subpackage Wp_Contracts_Finder/includes
 * @author     Inayat Cassambai <inayat.cassambai@gmail.com>
 */
class Wp_Contracts_Finder_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		/**
		 * The class responsible for setting up the cron job.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-contracts-finder-scheduler.php';

		$cron = new Wp_Contracts_Finder_Admin_Scheduler();
		$cron->setup_cron_event();
 
	}

}
