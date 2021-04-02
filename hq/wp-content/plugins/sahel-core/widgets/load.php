<?php

if ( ! function_exists( 'sahel_core_load_widget_class' ) ) {
    /**
     * Loades widget class file.
     */
    function sahel_core_load_widget_class() {
        include_once 'widget-class.php';
    }

    add_action( 'sahel_elated_action_before_options_map', 'sahel_core_load_widget_class' );
}

if ( ! function_exists( 'sahel_core_load_widgets' ) ) {
    /**
     * Loades all widgets by going through all folders that are placed directly in widgets folder
     * and loads load.php file in each. Hooks to sahel_elated_action_before_options_map_map action
     */
    function sahel_core_load_widgets() {

        if ( sahel_core_theme_installed() ) {
            foreach ( glob( ELATED_FRAMEWORK_ROOT_DIR . '/modules/widgets/*/load.php' ) as $widget_load ) {
                include_once $widget_load;
            }
        }

        include_once 'widget-loader.php';
    }

    add_action( 'sahel_elated_action_before_options_map', 'sahel_core_load_widgets' );
}