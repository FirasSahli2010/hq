<?php
/*
Plugin Name: Sahel Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Elated Themes
Version: 2.0.1
*/
define('SAHEL_INSTAGRAM_FEED_VERSION', '2.0.1');
define('SAHEL_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('SAHEL_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));
define( 'SAHEL_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'SAHEL_INSTAGRAM_ASSETS_PATH', SAHEL_INSTAGRAM_ABS_PATH . '/assets' );
define( 'SAHEL_INSTAGRAM_ASSETS_URL_PATH', SAHEL_INSTAGRAM_URL_PATH . 'assets' );
define( 'SAHEL_INSTAGRAM_SHORTCODES_PATH', SAHEL_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'SAHEL_INSTAGRAM_SHORTCODES_URL_PATH', SAHEL_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'sahel_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function sahel_instagram_theme_installed() {
        return defined( 'ELATED_ROOT' );
    }
}

if ( ! function_exists( 'sahel_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function sahel_instagram_feed_text_domain() {
		load_plugin_textdomain( 'sahel-instagram-feed', false, SAHEL_INSTAGRAM_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'sahel_instagram_feed_text_domain' );
}
