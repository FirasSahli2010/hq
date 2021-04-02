<?php

/*** Post Settings ***/

if ( ! function_exists( 'sahel_elated_map_post_meta' ) ) {
	function sahel_elated_map_post_meta() {
		
		$post_meta_box = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'sahel' ),
				'name'  => 'post-meta'
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'sahel' ),
				'parent'        => $post_meta_box,
				'options'       => sahel_elated_get_yes_no_select_array()
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'sahel' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'sahel' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => sahel_elated_get_custom_sidebars_options( true )
			)
		);
		
		$sahel_custom_sidebars = sahel_elated_get_custom_sidebars();
		if ( count( $sahel_custom_sidebars ) > 0 ) {
			sahel_elated_create_meta_box_field( array(
				'name'        => 'eltdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'sahel' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'sahel' ),
				'parent'      => $post_meta_box,
				'options'     => sahel_elated_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'sahel' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'sahel' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('sahel_elated_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_elated_map_post_meta', 20 );
}
