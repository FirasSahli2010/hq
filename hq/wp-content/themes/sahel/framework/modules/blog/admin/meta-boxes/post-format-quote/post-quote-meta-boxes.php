<?php

if ( ! function_exists( 'sahel_elated_map_post_quote_meta' ) ) {
	function sahel_elated_map_post_quote_meta() {
		$quote_post_format_meta_box = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'sahel' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'sahel' ),
				'description' => esc_html__( 'Enter Quote text', 'sahel' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'sahel' ),
				'description' => esc_html__( 'Enter Quote author', 'sahel' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_elated_map_post_quote_meta', 25 );
}