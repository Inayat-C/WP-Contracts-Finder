<?php

/**
 * Provide the functionality to call the API via a cron job
 *
 *
 * @link       https://twitter.com/Inu3219
 * @since      1.0.0
 *
 * @package    Wp_Contracts_Finder
 * @subpackage Wp_Contracts_Finder/admin
 */

class Wp_Contracts_Finder_Admin_Scheduler {

    /**
     * Creates the cron event.
     *
     * This function is run on plugin activation.
     *
     * @since    1.0.0
    */

    public function setup_cron_event() {
        wp_schedule_event( time(), 'hourly', 'contracts_api_cron' );
    }

    /**
     * Deletes the cron event.
     *
     * This function is run on plugin de-activation.
     *
     * @since    1.0.0
    */    

    public function delete_cron_event() {
        wp_clear_scheduled_hook( 'contracts_api_cron' );
    }
}