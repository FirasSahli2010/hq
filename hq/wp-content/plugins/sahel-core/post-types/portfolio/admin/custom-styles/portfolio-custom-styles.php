<?php
if ( ! function_exists( 'sahel_core_featured_projects_icon_styles' ) ) {
	function sahel_core_featured_projects_icon_styles() {
		$icon_color       = sahel_elated_options()->getOptionValue( 'featured_project_icon_color' );
		$icon_hover_color = sahel_elated_options()->getOptionValue( 'featured_project_icon_hover_color' );
		
		$icon_hover_selector = array(
			'.eltdf-featured-project-opener:hover'
		);
		
		if ( ! empty( $icon_color ) ) {
			echo sahel_elated_dynamic_css( '.eltdf-featured-project-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo sahel_elated_dynamic_css( $icon_hover_selector, array(
				'color' => $icon_hover_color . '!important'
			) );
		}
		
		$close_icon_color       = sahel_elated_options()->getOptionValue( 'featured_project_close_icon_color' );
		$close_icon_hover_color = sahel_elated_options()->getOptionValue( 'featured_project_close_icon_hover_color' );

		$close_icon_selector = array(
			'.widget.eltdf-featured-projects-widget .eltdf-featured-project-holder.eltdf-fpw-skin-dark .eltdf-featured-project-close',
			'.widget.eltdf-featured-projects-widget .eltdf-featured-project-holder.eltdf-fpw-skin-light .eltdf-featured-project-close',
		);

		$close_icon_hover_selector = array(
			'.widget.eltdf-featured-projects-widget .eltdf-featured-project-holder.eltdf-fpw-skin-dark .eltdf-featured-project-close:hover',
			'.widget.eltdf-featured-projects-widget .eltdf-featured-project-holder.eltdf-fpw-skin-light .eltdf-featured-project-close:hover',
		);
		
		if ( ! empty( $close_icon_color ) ) {
			echo sahel_elated_dynamic_css( $close_icon_selector, array(
				'color' => $close_icon_color
			) );
		}
		
		if ( ! empty( $close_icon_hover_color ) ) {
			echo sahel_elated_dynamic_css( $close_icon_hover_selector, array(
				'color' => $close_icon_hover_color . '!important'
			) );
		}
	}
	
	add_action( 'sahel_elated_action_style_dynamic', 'sahel_core_featured_projects_icon_styles' );
}