<?php

if ( ! function_exists( 'sahel_core_add_dropcaps_shortcodes' ) ) {
	function sahel_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'SahelCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'sahel_core_filter_add_vc_shortcode', 'sahel_core_add_dropcaps_shortcodes' );
}