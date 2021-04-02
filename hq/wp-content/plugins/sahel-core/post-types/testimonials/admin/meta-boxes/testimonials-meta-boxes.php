<?php

if ( ! function_exists( 'sahel_core_map_testimonials_meta' ) ) {
	function sahel_core_map_testimonials_meta() {
		$testimonial_meta_box = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'sahel-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'sahel-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'sahel-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'sahel-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'sahel-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'sahel-core' ),
				'description' => esc_html__( 'Enter author name', 'sahel-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'sahel-core' ),
				'description' => esc_html__( 'Enter author job position', 'sahel-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_core_map_testimonials_meta', 95 );
}