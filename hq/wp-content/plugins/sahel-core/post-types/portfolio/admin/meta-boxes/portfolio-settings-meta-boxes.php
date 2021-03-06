<?php

if ( ! function_exists( 'sahel_core_map_portfolio_settings_meta' ) ) {
	function sahel_core_map_portfolio_settings_meta() {
		$meta_box = sahel_elated_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'sahel-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		sahel_elated_create_meta_box_field( array(
			'name'        => 'eltdf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'sahel-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'sahel-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'sahel-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'sahel-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'sahel-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'sahel-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'sahel-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'sahel-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'sahel-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'sahel-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'sahel-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'sahel-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'sahel-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'sahel-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = sahel_elated_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'eltdf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'sahel-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'sahel-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => sahel_elated_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'sahel-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'sahel-core' ),
				'default_value' => '',
				'options'       => sahel_elated_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = sahel_elated_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'eltdf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'sahel-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'sahel-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => sahel_elated_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'sahel-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'sahel-core' ),
				'default_value' => '',
				'options'       => sahel_elated_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'sahel-core' ),
				'parent'        => $meta_box,
				'options'       => sahel_elated_get_yes_no_select_array()
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'sahel-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'sahel-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'sahel-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'sahel-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'sahel-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'sahel-core' ),
				'parent'      => $meta_box
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'sahel-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'sahel-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'sahel-core' ),
					'small'              => esc_html__( 'Small', 'sahel-core' ),
					'large-width'        => esc_html__( 'Large Width', 'sahel-core' ),
					'large-height'       => esc_html__( 'Large Height', 'sahel-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'sahel-core' )
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'sahel-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'sahel-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'sahel-core' ),
					'large-width' => esc_html__( 'Large Width', 'sahel-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'sahel-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'sahel-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_core_map_portfolio_settings_meta', 41 );
}