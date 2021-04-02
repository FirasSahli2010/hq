<?php

if ( ! function_exists( 'sahel_core_register_widgets' ) ) {
	function sahel_core_register_widgets() {
		$widgets = apply_filters( 'sahel_core_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'sahel_core_register_widgets' );
}