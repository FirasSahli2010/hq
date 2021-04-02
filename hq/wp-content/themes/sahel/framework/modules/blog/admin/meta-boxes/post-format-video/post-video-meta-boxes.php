<?php

if ( ! function_exists( 'sahel_elated_map_post_video_meta' ) ) {
	function sahel_elated_map_post_video_meta() {
		$video_post_format_meta_box = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'sahel' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'sahel' ),
				'description'   => esc_html__( 'Choose video type', 'sahel' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'sahel' ),
					'self'            => esc_html__( 'Self Hosted', 'sahel' )
				)
			)
		);
		
		$eltdf_video_embedded_container = sahel_elated_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'eltdf_video_embedded_container'
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'sahel' ),
				'description' => esc_html__( 'Enter Video URL', 'sahel' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'sahel' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'sahel' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'sahel' ),
				'description' => esc_html__( 'Enter video image', 'sahel' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_elated_map_post_video_meta', 22 );
}