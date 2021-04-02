<?php

if ( ! function_exists( 'sahel_elated_include_blog_shortcodes' ) ) {
	function sahel_elated_include_blog_shortcodes() {
		foreach ( glob( ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( sahel_elated_core_plugin_installed() ) {
		add_action( 'sahel_core_action_include_shortcodes_file', 'sahel_elated_include_blog_shortcodes' );
	}
}
