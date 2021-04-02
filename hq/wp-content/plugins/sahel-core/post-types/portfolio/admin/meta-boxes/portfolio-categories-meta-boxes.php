<?php

if ( ! function_exists( 'sahel_elated_portfolio_category_additional_fields' ) ) {
	function sahel_elated_portfolio_category_additional_fields() {
		
		$fields = sahel_elated_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		sahel_elated_add_taxonomy_field(
			array(
				'name'   => 'eltdf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'sahel-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'sahel_elated_action_custom_taxonomy_fields', 'sahel_elated_portfolio_category_additional_fields' );
}