<?php

if ( ! function_exists( 'sahel_core_register_featured_projects_widget' ) ) {
	/**
	 * Function that register featured projects widget
	 */
	function sahel_core_register_featured_projects_widget( $widgets ) {

		$widgets[] = 'SahelElatedClassFeaturedProjectsWidget';
		
		return $widgets;
	}

	if ( sahel_elated_core_plugin_installed() ) {
		add_filter('sahel_core_filter_register_widgets', 'sahel_core_register_featured_projects_widget');
	}
}