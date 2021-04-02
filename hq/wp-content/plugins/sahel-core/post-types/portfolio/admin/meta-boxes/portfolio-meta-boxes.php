<?php

if ( ! function_exists( 'sahel_core_map_portfolio_meta' ) ) {
	function sahel_core_map_portfolio_meta() {
		global $sahel_elated_global_Framework;
		
		$sahel_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$sahel_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$sahel_portfolio_images = new SahelElatedClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'sahel-core' ), '', '', 'portfolio_images' );
		$sahel_elated_global_Framework->eltdMetaBoxes->addMetaBox( 'portfolio_images', $sahel_portfolio_images );
		
		$sahel_portfolio_image_gallery = new SahelElatedClassMultipleImages( 'eltdf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'sahel-core' ), esc_html__( 'Choose your portfolio images', 'sahel-core' ) );
		$sahel_portfolio_images->addChild( 'eltdf-portfolio-image-gallery', $sahel_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$sahel_portfolio_images_videos = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'sahel-core' ),
				'name'  => 'eltdf_portfolio_images_videos'
			)
		);
		sahel_elated_add_repeater_field(
			array(
				'name'        => 'eltdf_portfolio_single_upload',
				'parent'      => $sahel_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'sahel-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'sahel-core' ),
						'options' => array(
							'image' => esc_html__('Image','sahel-core'),
							'video' => esc_html__('Video','sahel-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'sahel-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'sahel-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'sahel-core'),
							'vimeo' => esc_html__('Vimeo', 'sahel-core'),
							'self' => esc_html__('Self Hosted', 'sahel-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'sahel-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'sahel-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'sahel-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$sahel_additional_sidebar_items = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'sahel-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		sahel_elated_add_repeater_field(
			array(
				'name'        => 'eltdf_portfolio_properties',
				'parent'      => $sahel_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'sahel-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'sahel-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'sahel-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'sahel-core' )
					)
				)
			)
		);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_core_map_portfolio_meta', 40 );
}