<?php

if ( ! function_exists( 'sahel_elated_map_post_link_meta' ) ) {
	function sahel_elated_map_post_link_meta() {
		$link_post_format_meta_box = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'sahel' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'sahel' ),
				'description' => esc_html__( 'Enter link', 'sahel' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_elated_map_post_link_meta', 24 );
}