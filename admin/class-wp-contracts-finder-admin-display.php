<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://twitter.com/Inu3219
 * @since      1.0.0
 *
 * @package    Wp_Contracts_Finder
 * @subpackage Wp_Contracts_Finder/admin
 */

 class Wp_Contracts_Finder_Admin_Display {

    public function settings_page_html() {  ?>
        <div class="wrap">
            <section>
                <h1> <?php _e('WordPress Contracts Finder', 'wp-contracts-finder'); ?> </h1>
            </section>

            <section>
                <form class="cf-form" id="contracts-api-form" method="post"> 
                    <input type="hidden" name="action" value="pull_contracts_from_api">

                    <table class="form-table" role="presentation">
                        <tbody>
                            <h2> <?php _e('API Settings', 'wp-contracts-finder'); ?> </h2>
                            <p> <?php _e('Detailed explanation for the API settings can be found in the API documentation', 'wp-contracts-finder'); ?> <a href="https://www.contractsfinder.service.gov.uk/apidocumentation/Notices/2/POST-rest-searches-search" title="<?php _e('Contracts Finder Search API', 'wp-contracts-finder'); ?>" target="_blank"> <?php _e('here', 'wp-contracts-finder'); ?>. </a> </p>

                            <tr>
                                <th> <?php _e('Types', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Types', 'wp-contracts-finder'); ?> </span> </legend>
                                            <label for="type-contract">
                                                <input name="types[]" type="checkbox" id="type-contract" value="Contract" checked="checked">
                                                <?php _e('Contract', 'wp-contracts-finder'); ?>
                                            </label>

                                            </br>

                                            <label for="type-preprocurement">
                                                <input name="types[]" type="checkbox" value="PreProcurement" id="type-preprocurement">
                                                <?php _e('PreProcurement', 'wp-contracts-finder'); ?> 
                                            </label>

                                            </br>

                                            <label for="type-pipeline">
                                                <input name="types[]" type="checkbox" value="Pipeline" id="type-pipeline">
                                                <?php _e('Pipeline', 'wp-contracts-finder'); ?> 
                                            </label>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr>
                                <th> <?php _e('Statuses', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Statuses', 'wp-contracts-finder'); ?> </span> </legend>
                                            <label for="status-open">
                                                <input name="status[]" type="checkbox" id="status-open" value="Open" checked="checked">
                                                <?php _e('Open', 'wp-contracts-finder'); ?>
                                            </label>

                                            </br>

                                            <label for="type-closed">
                                                <input name="status[]" type="checkbox" value="Closed" id="type-closed">
                                                <?php _e('Closed', 'wp-contracts-finder'); ?> 
                                            </label>

                                            </br>

                                            <label for="type-withdrawn">
                                                <input name="status[]" type="checkbox" value="Withdrawn" id="type-withdrawn">
                                                <?php _e('Withdrawn', 'wp-contracts-finder'); ?> 
                                            </label>

                                            </br>

                                            <label for="type-awarded">
                                                <input name="status[]" type="checkbox" value="Awarded" id="type-awarded">
                                                <?php _e('Awarded', 'wp-contracts-finder'); ?> 
                                            </label>

                                            </br>

                                            <label for="type-draft">
                                                <input name="status[]" type="checkbox" value="Draft" id="type-draft">
                                                <?php _e('Draft', 'wp-contracts-finder'); ?> 
                                            </label>                                                                                        
                                    </fieldset>
                                </td>
                            </tr>

                            <tr> 
                                <th> <?php _e('Keyword', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Keyword', 'wp-contracts-finder'); ?> </span> </legend>
                                        <input name="keyword" type="text" placeholder="Window Cleaning" /> 
                                    </fieldset>
                                </td>
                            </tr>

                            <tr> 
                                <th> <?php _e('Regions', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Regions', 'wp-contracts-finder'); ?> </span> </legend>
                                        <input name="regions" type="text" placeholder="Wales,South East" /> 
                                    </fieldset>
                                </td>
                            </tr>

                            <tr> 
                                <th> <?php _e('Value From', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Value From', 'wp-contracts-finder'); ?> </span> </legend>
                                        <input name="valueFrom" type="number" placeholder="500000.0" /> 
                                    </fieldset>
                                </td>
                            </tr> 

                            <tr> 
                                <th> <?php _e('Value To', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Value To', 'wp-contracts-finder'); ?> </span> </legend>
                                        <input name="valueTo" type="number" placeholder="1000000.0" /> 
                                    </fieldset>
                                </td>
                            </tr>

                            <tr>
                                <th> <?php _e('Published From', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Published From', 'wp-contracts-finder'); ?> </span> </legend>
                                        <input type="date" id="datepicker" name="publishedFrom" />
                                    </fieldset>
                                </td>                            
                            </tr>     

                            <tr>
                                <th> <?php _e('Published To', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Published To', 'wp-contracts-finder'); ?> </span> </legend>
                                        <input type="date" id="datepicker" name="publishedTo" />
                                    </fieldset>
                                </td>                            
                            </tr>                                                                                    

                            <tr> 
                                <th> <?php _e('Suitable for small suppliers?', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Suitable for small suppliers?', 'wp-contracts-finder'); ?> </span> </legend>
                                        <input name="suitableForSme" type="checkbox" /> 
                                    </fieldset>
                                </td>
                            </tr>

                            <tr> 
                                <th> <?php _e('Suitable for voluntary sector?', 'wp-contracts-finder'); ?> </th>
                                <td>
                                    <fieldset>
                                        <legend class="screen-reader-text"> <span> <?php _e('Suitable for voluntary sector?', 'wp-contracts-finder'); ?> </span> </legend>
                                        <input name="suitableForVco" type="checkbox" /> 
                                    </fieldset>
                                </td>
                            </tr>                             

                        </tbody>
                    </table>
                    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Submit"></p>
                </form>
            </section>
        </div>

    <?php }
 }



