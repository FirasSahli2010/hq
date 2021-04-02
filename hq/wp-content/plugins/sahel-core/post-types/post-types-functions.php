<?php

if ( ! function_exists( 'sahel_core_include_custom_post_types_files' ) ) {
	/**
	 * Loads all custom post types by going through all folders that are placed directly in post types folder
	 */
	function sahel_core_include_custom_post_types_files() {
		if ( sahel_core_theme_installed() ) {
			foreach ( glob( SAHEL_CORE_CPT_PATH . '/*/load.php' ) as $cpt ) {
				if ( sahel_elated_is_customizer_item_enabled( $cpt, 'sahel_performance_disable_cpt_' ) ) {
					include_once $cpt;
				}
			}
		}
	}
	
	add_action( 'after_setup_theme', 'sahel_core_include_custom_post_types_files', 1 );
}

if ( ! function_exists( 'sahel_core_include_custom_post_types_meta_boxes' ) ) {
	/**
	 * Loads all meta boxes functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function sahel_core_include_custom_post_types_meta_boxes() {
		if ( sahel_core_theme_installed() ) {
			foreach ( glob( SAHEL_CORE_CPT_PATH . '/*/admin/meta-boxes/*.php' ) as $option ) {
				$cpt_relative_path = str_replace( SAHEL_CORE_CPT_PATH . '/', '', $option );
				$cpt_name          = substr( $cpt_relative_path, 0, strpos( $cpt_relative_path, '/' ) );
				
				if ( sahel_elated_is_customizer_item_enabled( $cpt_name, 'sahel_performance_disable_cpt_', true ) ) {
					include_once $option;
				}
			}
		}
	}
	
	add_action( 'sahel_elated_action_before_meta_boxes_map', 'sahel_core_include_custom_post_types_meta_boxes' );
}

if ( ! function_exists( 'sahel_core_include_custom_post_types_global_options' ) ) {
	/**
	 * Loads all global otpions functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function sahel_core_include_custom_post_types_global_options() {
		if ( sahel_core_theme_installed() ) {
			foreach ( glob( SAHEL_CORE_CPT_PATH . '/*/admin/options/*.php' ) as $option ) {
				$cpt_relative_path = str_replace( SAHEL_CORE_CPT_PATH . '/', '', $option );
				$cpt_name          = substr( $cpt_relative_path, 0, strpos( $cpt_relative_path, '/' ) );
				
				if ( sahel_elated_is_customizer_item_enabled( $cpt_name, 'sahel_performance_disable_cpt_', true ) ) {
					include_once $option;
				}
			}
		}
	}
	
	add_action( 'sahel_elated_action_before_options_map', 'sahel_core_include_custom_post_types_global_options', 1 );
}

if ( ! function_exists( 'sahel_core_load_cpt_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to sahel_elated_action_after_options_map action
	 */
	function sahel_core_load_cpt_widgets() {

		foreach ( glob( SAHEL_CORE_CPT_PATH . '/*/widgets/*/load.php' ) as $widget_load ) {
			include_once $widget_load;
		}
	}

	add_action( 'sahel_elated_action_before_options_map', 'sahel_core_load_cpt_widgets' );
}