<?php

if ( ! function_exists( 'sahel_elated_get_blog_list_types_options' ) ) {
	function sahel_elated_get_blog_list_types_options() {
		$blog_list_type_options = apply_filters( 'sahel_elated_filter_blog_list_type_global_option', $blog_list_type_options = array() );
		
		return $blog_list_type_options;
	}
}

if ( ! function_exists( 'sahel_elated_blog_options_map' ) ) {
	function sahel_elated_blog_options_map() {
		$blog_list_type_options = sahel_elated_get_blog_list_types_options();
		
		sahel_elated_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => esc_html__( 'Blog', 'sahel' ),
				'icon'  => 'fa fa-files-o'
			)
		);
		
		/**
		 * Blog Lists
		 */
		$panel_blog_lists = sahel_elated_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'sahel' )
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'blog_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'sahel' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for blog post lists. Default value is large', 'sahel' ),
				'options'     => sahel_elated_get_space_between_items_array( true ),
				'parent'      => $panel_blog_lists
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_list_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Blog Layout for Archive Pages', 'sahel' ),
				'description'   => esc_html__( 'Choose a default blog layout for archived blog post lists', 'sahel' ),
				'default_value' => 'standard',
				'parent'        => $panel_blog_lists,
				'options'       => $blog_list_type_options
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'archive_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout for Archive Pages', 'sahel' ),
				'description'   => esc_html__( 'Choose a sidebar layout for archived blog post lists', 'sahel' ),
				'default_value' => '',
				'parent'        => $panel_blog_lists,
                'options'       => sahel_elated_get_custom_sidebars_options(),
			)
		);
		
		$sahel_custom_sidebars = sahel_elated_get_custom_sidebars();
		if ( count( $sahel_custom_sidebars ) > 0 ) {
			sahel_elated_add_admin_field(
				array(
					'name'        => 'archive_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display for Archive Pages', 'sahel' ),
					'description' => esc_html__( 'Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'sahel' ),
					'parent'      => $panel_blog_lists,
					'options'     => sahel_elated_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_masonry_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Layout', 'sahel' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set masonry layout. Default is in grid.', 'sahel' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'sahel' ),
					'full-width' => esc_html__( 'Full Width', 'sahel' )
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_masonry_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Number of Columns', 'sahel' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for your masonry blog lists. Default value is 4 columns', 'sahel' ),
				'parent'        => $panel_blog_lists,
				'options'       => sahel_elated_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Space Between Items', 'sahel' ),
				'description'   => esc_html__( 'Set space size between posts for your masonry blog lists. Default value is normal', 'sahel' ),
				'default_value' => 'normal',
				'options'       => sahel_elated_get_space_between_items_array(),
				'parent'        => $panel_blog_lists
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_list_featured_image_proportion',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'sahel' ),
				'default_value' => 'fixed',
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'sahel' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'fixed'    => esc_html__( 'Fixed', 'sahel' ),
					'original' => esc_html__( 'Original', 'sahel' )
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_pagination_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'sahel' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'sahel' ),
				'parent'        => $panel_blog_lists,
				'default_value' => 'standard',
				'options'       => array(
					'standard'        => esc_html__( 'Standard', 'sahel' ),
					'load-more'       => esc_html__( 'Load More', 'sahel' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'sahel' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'sahel' )
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '40',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'sahel' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'sahel' ),
				'parent'        => $panel_blog_lists,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		sahel_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_tags_area_blog',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Blog Tags on Standard List', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will show tags on standard blog list', 'sahel' ),
				'parent'        => $panel_blog_lists
			)
		);
		
		/**
		 * Blog Single
		 */
		$panel_blog_single = sahel_elated_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'sahel' )
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'blog_single_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'sahel' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for Blog Single pages. Default value is large', 'sahel' ),
				'options'     => sahel_elated_get_space_between_items_array( true ),
				'parent'      => $panel_blog_single
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_single_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'sahel' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'sahel' ),
				'default_value' => '',
				'parent'        => $panel_blog_single,
                'options'       => sahel_elated_get_custom_sidebars_options()
			)
		);
		
		if ( count( $sahel_custom_sidebars ) > 0 ) {
			sahel_elated_add_admin_field(
				array(
					'name'        => 'blog_single_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'sahel' ),
					'description' => esc_html__( 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'sahel' ),
					'parent'      => $panel_blog_single,
					'options'     => sahel_elated_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		sahel_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_blog',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'sahel' ),
				'parent'        => $panel_blog_single,
				'options'       => sahel_elated_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);

        sahel_elated_add_admin_field(
            array(
                'name'          => 'blog_content_alignment',
                'type'          => 'select',
                'label'         => esc_html__( 'Blog Single Alignment', 'sahel' ),
                'description'   => esc_html__( 'Choose a type of alignment for Blog Single', 'sahel' ),
                'parent'        => $panel_blog_lists,
                'default_value' => 'default',
                'parent'      => $panel_blog_single,
                'options'       => array(
                    'left-aligned'        => esc_html__( 'Default', 'sahel' ),
                    'centered'       => esc_html__( 'Centered', 'sahel' )
                )
            )
        );
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_single_title_in_title_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Post Title in Title Area', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'sahel' ),
				'parent'        => $panel_blog_single,
				'dependency' => array(
					'hide' => array(
						'show_title_area_blog' => 'no'
					)
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_single_related_posts',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Related Posts', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will show related posts on single post pages', 'sahel' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'no'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'blog_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments Form', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will show comments form on single post pages', 'sahel' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'sahel' ),
				'description'   => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'sahel' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_navigation_container = sahel_elated_add_admin_container(
			array(
				'name'            => 'eltdf_blog_single_navigation_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_single_navigation' => 'yes'
					)
				)
			)
		);

        sahel_elated_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'blog_navigation_side_navigation',
                'default_value' => 'no',
                'label'         => esc_html__( 'Enable Side Navigation', 'sahel' ),
                'description'   => esc_html__( 'Enable blog navigation to be displayed on the left and right', 'sahel' ),
                'parent'        => $blog_single_navigation_container,
                'args'          => array(
                    'col_width' => 3
                )
            )
        );
		
		sahel_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Navigation Only in Current Category', 'sahel' ),
				'description'   => esc_html__( 'Limit your navigation only through current category', 'sahel' ),
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Info Box', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will display author name and descriptions on single post pages. Author biographic info field in Users section must contain some data', 'sahel' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_author_info_container = sahel_elated_add_admin_container(
			array(
				'name'            => 'eltdf_blog_single_author_info_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_author_info' => 'yes'
					)
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Author Email', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will show author email', 'sahel' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Social Icons', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will show author social icons on single post pages', 'sahel' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		do_action( 'sahel_elated_action_blog_single_options_map', $panel_blog_single );
	}
	
	add_action( 'sahel_elated_action_options_map', 'sahel_elated_blog_options_map', sahel_elated_set_options_map_position( 'blog' ) );
}