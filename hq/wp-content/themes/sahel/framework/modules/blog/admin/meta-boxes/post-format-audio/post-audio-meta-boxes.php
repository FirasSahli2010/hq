<?php

if ( ! function_exists( 'sahel_elated_map_post_audio_meta' ) ) {
	function sahel_elated_map_post_audio_meta() {
		$audio_post_format_meta_box = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'sahel' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'sahel' ),
				'description'   => esc_html__( 'Choose audio type', 'sahel' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'sahel' ),
					'self'            => esc_html__( 'Self Hosted', 'sahel' )
				)
			)
		);
		
		$eltdf_audio_embedded_container = sahel_elated_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'eltdf_audio_embedded_container'
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'sahel' ),
				'description' => esc_html__( 'Enter audio URL', 'sahel' ),
				'parent'      => $eltdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'sahel' ),
				'description' => esc_html__( 'Enter audio link', 'sahel' ),
				'parent'      => $eltdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_elated_map_post_audio_meta', 23 );
}