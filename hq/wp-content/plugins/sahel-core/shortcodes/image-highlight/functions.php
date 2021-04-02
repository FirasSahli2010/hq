<?php

if ( ! function_exists( 'sahel_core_add_image_highlight_shortcodes' ) ) {
	function sahel_core_add_image_highlight_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'SahelCore\CPT\Shortcodes\ImageHighlight\ImageHighlight'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'sahel_core_filter_add_vc_shortcode', 'sahel_core_add_image_highlight_shortcodes' );
}

if ( ! function_exists( 'sahel_core_set_image_highlight_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for image highlight shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function sahel_core_set_image_highlight_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-image-highlight';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'sahel_core_filter_add_vc_shortcodes_custom_icon_class', 'sahel_core_set_image_highlight_icon_class_name_for_vc_shortcodes' );
}