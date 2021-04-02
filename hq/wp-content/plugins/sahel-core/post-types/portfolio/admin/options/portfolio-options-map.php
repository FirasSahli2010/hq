<?php

if ( ! function_exists( 'sahel_elated_portfolio_options_map' ) ) {
	function sahel_elated_portfolio_options_map() {
		
		sahel_elated_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'sahel-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = sahel_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'sahel-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'sahel-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'sahel-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'sahel-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'sahel-core' ),
				'parent'        => $panel_archive,
				'options'       => sahel_elated_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'sahel-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'sahel-core' ),
				'default_value' => 'normal',
				'options'       => sahel_elated_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'sahel-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'sahel-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'sahel-core' ),
					'landscape' => esc_html__( 'Landscape', 'sahel-core' ),
					'portrait'  => esc_html__( 'Portrait', 'sahel-core' ),
					'square'    => esc_html__( 'Square', 'sahel-core' )
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'sahel-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'sahel-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'sahel-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'sahel-core' )
				)
			)
		);
		
		$panel = sahel_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'sahel-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'sahel-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'sahel-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = sahel_elated_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'sahel-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'sahel-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => sahel_elated_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'sahel-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'sahel-core' ),
				'default_value' => 'normal',
				'options'       => sahel_elated_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = sahel_elated_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'sahel-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'sahel-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => sahel_elated_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'sahel-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'sahel-core' ),
				'default_value' => 'normal',
				'options'       => sahel_elated_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		sahel_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'sahel-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'sahel-core' ),
					'yes' => esc_html__( 'Yes', 'sahel-core' ),
					'no'  => esc_html__( 'No', 'sahel-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'sahel-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'sahel-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'sahel-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'sahel-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'sahel-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'sahel-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'sahel-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = sahel_elated_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'sahel-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'sahel-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);

        sahel_elated_add_admin_field(
            array(
                'name'          => 'portfolio_single_side_nav',
                'type'          => 'yesno',
                'label'         => esc_html__( 'Enable Side Pagination', 'sahel-core' ),
                'description'   => esc_html__( 'Enabling this option will move pagination links on the left and right side', 'sahel-core' ),
                'parent'        => $container_navigate_category,
                'default_value' => 'no'
            )
        );
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'sahel-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'sahel-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		sahel_elated_add_admin_field(
            array(
                'name' => 'portfolio_single_related_posts',
                'type' => 'yesno',
                'label' => esc_html__('Show Related Projects', 'sahel-core'),
                'description' => esc_html__('Enabling this option will display related projects on Single Project', 'sahel-core'),
                'parent' => $panel,
                'default_value' => 'yes'
            )
        );

		$featured_project_panel = sahel_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Featured Project Widget', 'sahel-core' ),
				'name'  => 'panel_portfolio_widgets',
				'page'  => '_portfolio'
			)
		);

		sahel_elated_add_admin_field(
			array(
				'parent'        => $featured_project_panel,
				'type'          => 'select',
				'name'          => 'featured_project_icon_source',
				'default_value' => 'predefined',
				'label'         => esc_html__('Select Featured Project Opener Icon Source', 'sahel-core'),
				'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'sahel-core'),
				'options'       => sahel_elated_get_icon_sources_array()
			)
		);

		$featured_project_icon_pack_container = sahel_elated_add_admin_container(
			array(
				'parent'     => $featured_project_panel,
				'name'       => 'featured_project_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'featured_project_icon_source' => 'icon_pack'
					)
				)
			)
		);

		sahel_elated_add_admin_field(
			array(
				'parent'        => $featured_project_icon_pack_container,
				'type'          => 'select',
				'name'          => 'featured_project_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__('Featured Project Opener Icon Pack', 'sahel-core'),
				'description'   => esc_html__('Choose icon pack for Featured Project Opener icon', 'sahel-core'),
				'options'       => sahel_elated_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
			)
		);

		$featured_project_svg_icons_container = sahel_elated_add_admin_container(
			array(
				'parent'     => $featured_project_panel,
				'name'       => 'featured_project_svg_icons_container',
				'dependency' => array(
					'show' => array(
						'featured_project_icon_source' => 'svg_path'
					)
				)
			)
		);

		sahel_elated_add_admin_field(
			array(
				'parent'      => $featured_project_svg_icons_container,
				'type'        => 'textarea',
				'name'        => 'featured_project_icon_svg_path',
				'label'       => esc_html__('Featured Project Opener Icon SVG Path', 'sahel-core'),
				'description' => esc_html__('Enter your Featured Project Opener icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'sahel-core'),
			)
		);

		sahel_elated_add_admin_field(
			array(
				'parent'      => $featured_project_svg_icons_container,
				'type'        => 'textarea',
				'name'        => 'featured_project_close_icon_svg_path',
				'label'       => esc_html__('Featured Project Opener Close Icon SVG Path', 'sahel-core'),
				'description' => esc_html__('Enter your Featured Project Opener close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'sahel-core'),
			)
		);

		$featured_project_icon_style_group = sahel_elated_add_admin_group(
			array(
				'parent'      => $featured_project_panel,
				'name'        => 'featured_project_icon_style_group',
				'title'       => esc_html__('Featured Project Opener Icon Style', 'sahel-core'),
				'description' => esc_html__('Define styles for Featured Project Opener icon', 'sahel-core')
			)
		);

		$featured_project_icon_style_row1 = sahel_elated_add_admin_row(
			array(
				'parent' => $featured_project_icon_style_group,
				'name'   => 'featured_project_icon_style_row1'
			)
		);

		sahel_elated_add_admin_field(
			array(
				'parent' => $featured_project_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'featured_project_icon_color',
				'label'  => esc_html__('Color', 'sahel-core')
			)
		);

		sahel_elated_add_admin_field(
			array(
				'parent' => $featured_project_icon_style_row1,
				'type'   => 'colorsimple',
				'name'   => 'featured_project_icon_hover_color',
				'label'  => esc_html__('Hover Color', 'sahel-core')
			)
		);

		$featured_project_icon_style_row2 = sahel_elated_add_admin_row(
			array(
				'parent' => $featured_project_icon_style_group,
				'name'   => 'featured_project_icon_style_row2',
				'next'   => true
			)
		);

		sahel_elated_add_admin_field(
			array(
				'parent' => $featured_project_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'featured_project_close_icon_color',
				'label'  => esc_html__('Close Icon Color', 'sahel-core')
			)
		);

		sahel_elated_add_admin_field(
			array(
				'parent' => $featured_project_icon_style_row2,
				'type'   => 'colorsimple',
				'name'   => 'featured_project_close_icon_hover_color',
				'label'  => esc_html__('Close Icon Hover Color', 'sahel-core')
			)
		);

		sahel_elated_add_admin_field(
			array(
				'parent'      => $featured_project_panel,
				'type'        => 'select',
				'name'        => 'featured_project_skin',
				'default_value' => 'dark',
				'label'       => esc_html__('Featured Projects Skin', 'sahel-core'),
				'description' => esc_html__('Choose a skin for Featured Project', 'sahel-core'),
				'options'	  => array(
					'dark' => esc_html__('Dark','sahel-core'),
					'light' => esc_html__('Light','sahel-core')
				)
			)
		);
	}
	
	add_action( 'sahel_elated_action_options_map', 'sahel_elated_portfolio_options_map', sahel_elated_set_options_map_position( 'portfolio' ) );
}