<?php

foreach ( glob( ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'sahel_elated_map_blog_meta' ) ) {
	function sahel_elated_map_blog_meta() {
		$eltdf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$eltdf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = sahel_elated_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'sahel' ),
				'name'  => 'blog_meta'
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'sahel' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'sahel' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltdf_blog_categories
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'sahel' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'sahel' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltdf_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'sahel' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'sahel' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'sahel' ),
					'in-grid'    => esc_html__( 'In Grid', 'sahel' ),
					'full-width' => esc_html__( 'Full Width', 'sahel' )
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'sahel' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'sahel' ),
				'parent'      => $blog_meta_box,
				'options'     => sahel_elated_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'sahel' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'sahel' ),
				'options'     => sahel_elated_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'sahel' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'sahel' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'sahel' ),
					'fixed'    => esc_html__( 'Fixed', 'sahel' ),
					'original' => esc_html__( 'Original', 'sahel' )
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'sahel' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'sahel' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'sahel' ),
					'standard'        => esc_html__( 'Standard', 'sahel' ),
					'load-more'       => esc_html__( 'Load More', 'sahel' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'sahel' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'sahel' )
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'eltdf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'sahel' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'sahel' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_elated_map_blog_meta', 30 );
}