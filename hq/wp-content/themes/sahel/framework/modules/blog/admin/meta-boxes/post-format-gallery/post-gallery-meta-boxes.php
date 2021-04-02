<?php

if ( ! function_exists( 'sahel_elated_map_post_gallery_meta' ) ) {
	
	function sahel_elated_map_post_gallery_meta() {
		$gallery_post_format_meta_box = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'sahel' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		sahel_elated_add_multiple_images_field(
			array(
				'name'        => 'eltdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'sahel' ),
				'description' => esc_html__( 'Choose your gallery images', 'sahel' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_elated_map_post_gallery_meta', 21 );
}
