<?php

/**
 * Provide the functionality for the API Call
 *
 * Pulls in contracts based on the paramters set below.
 *
 * @link       https://twitter.com/Inu3219
 * @since      1.0.0
 *
 * @package    Wp_Contracts_Finder
 * @subpackage Wp_Contracts_Finder/admin
 */

class Wp_Contracts_Finder_Admin_Api {
	/**
	 * The API endpoint URL.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $endpoint    The API endpoint URL.
	 */
    public $endpoint;

    public function __construct() {

        $this->endpoint = 'https://www.contractsfinder.service.gov.uk/api/rest/2/search_notices/json';

    }

    public function wp_cf_api_request() {

        $options = [
            'body'        => $this->request_body(),
            'headers'     => [
                'Content-Type' => 'application/json',
            ],
        ];

        $response = wp_remote_post( $this->endpoint, $options );
        $responseCode = wp_remote_retrieve_response_code($response);

        if ( $responseCode != 200) {
            wp_send_json_error("Error, Something went wrong. Response Code: $responseCode");
        } else {
            $response = json_decode($response['body'], true);
            $this->create_posts_from_api_request($response);
        }
    }

    public function request_body() {

        $date = date('Y-m-d');
        $body = array(
            'searchCriteria' => array(
                'types'    		=> array('Contract'),
                'statuses'  	=> array('Open'),
				'PublishedFrom'	=> $date,
				'ValueFrom'		=> 500000.0
			),
			'size' => 25
		);

        $body = wp_json_encode( $body );

        return $body;

    }

    public function create_posts_from_api_request($response) {
        $data = $response['noticeList'];

        foreach ($data as $content) {

			$post_arr = array(
				'post_type'		=> 'contracts',
				'post_title'   	=> $content['item']['title'],
				'post_content' 	=> $content['item']['description'],
				'post_status'  	=> 'publish',
				'post_author'  	=> get_current_user_id(),
				'meta_input'   	=> array(
					'contract_id' 		        => $content['item']['id'],
                    'organisationname'	        => $content['item']['organisationName'],
                    'publisheddate'             => $content['item']['publishedDate'],
                    'deadlinedate'              => $content['item']['deadlineDate'],
                    'startDate'                 => $content['item']['start'],
                    'endDate'                   => $content['item']['end'],
                    'valuelow'                  => $content['item']['valueLow'],
                    'valuehigh'                 => $content['item']['valueHigh'],
                    'cpvdescription'            => $content['item']['cpvDescription'],
                    'cpvdescriptionexpanded'    => $content['item']['cpvDescriptionExpanded'],
                    'cpvcodes'                  => $content['item']['cpvCodes'],
                    'cpvcodesextended'          => $content['item']['cpvCodesExtended']
				),
			);

			// Check for duplicates
			$args = array(
				'post_type'		=> 'contracts',
				'post_status'	=> ['draft', 'publish'],
				'meta_query'	=> array(
					array(
						'key'     => 'contract_id',
						'value'   => $content['item']['id'],
						'compare' => '='
					)
				)
			);

            $posts = get_posts($args);

			// If not duplicate then insert post
			if (empty($posts)) {

                // Adds a post and saves the post ID to the variable
                $newPostID = wp_insert_post( $post_arr, true );

                write_log('new post created with title of ' . get_the_title($newPostID));

            } else {

                write_log('duplicate post found ' . $content['item']['title']);

            }

        }

        wp_send_json_success($response);
    }

    public function remove_expired_posts() {
        // Args to fetch all contracts
        $args = array(
          'post_type'    => 'contracts',
          'post_status'  => ['draft', 'publish'],
          'orderby' => 'post_date',
          'order' => 'DESC',
          'numberposts' => -1
        );
        // Fetch all contracts
        $posts = get_posts($args);

        // Loop through all posts
        foreach ($posts as $post) :
            // Get all post meta data
            $post_meta = get_post_meta($post->ID);
            // Get deadlinedate Object
            $deadlinedate_obj = $post_meta['deadlinedate'][0];
            // Convert deadlinedate to timestamp
            $deadlinedate_timestamp = strtotime($deadlinedate_obj);
            // Convert timestamp to date
            $deadlinedate = date('Y/m/d', $deadlinedate_timestamp);
            // Get current date
            $date_now = date('Y/m/d');

            // Compare dates
            if ($date_now >= $deadlinedate) {
                // move to trash > output to log deleted post.
                wp_trash_post($post->ID);
                write_log('Expired contract post with title of "' . $post->post_title . '" moved to trash.');
            };
        endforeach;
    }
}