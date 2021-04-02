<?php

if ( ! function_exists( 'sahel_core_add_swapping_image_gallery_shortcodes' ) ) {
	function sahel_core_add_swapping_image_gallery_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'SahelCore\CPT\Shortcodes\SwappingImageGallery\SwappingImageGallery'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'sahel_core_filter_add_vc_shortcode', 'sahel_core_add_swapping_image_gallery_shortcodes' );
}

if ( ! function_exists( 'sahel_core_set_swapping_image_gallery_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for swapping image gallery shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function sahel_core_set_swapping_image_gallery_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-swapping-image-gallery';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'sahel_core_filter_add_vc_shortcodes_custom_icon_class', 'sahel_core_set_swapping_image_gallery_icon_class_name_for_vc_shortcodes' );
}