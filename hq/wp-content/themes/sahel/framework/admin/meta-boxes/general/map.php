<?php

if ( ! function_exists( 'sahel_elated_map_general_meta' ) ) {
	function sahel_elated_map_general_meta() {
		
		$general_meta_box = sahel_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'sahel_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'sahel' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'sahel' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'sahel' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'sahel' ),
				'parent'        => $general_meta_box
			)
		);
		
		$eltdf_content_padding_group = sahel_elated_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'sahel' ),
				'description' => esc_html__( 'Define styles for Content area', 'sahel' ),
				'parent'      => $general_meta_box
			)
		);
		
			$eltdf_content_padding_row = sahel_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row',
					'parent' => $eltdf_content_padding_group
				)
			);
			
				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'sahel' ),
						'parent'      => $eltdf_content_padding_row
					)
				);
				
				sahel_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'sahel' ),
						'parent'        => $eltdf_content_padding_row
					)
				);

				sahel_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'sahel' ),
						'options'       => sahel_elated_get_yes_no_select_array(),
						'parent'        => $eltdf_content_padding_row
					)
				);

			$eltdf_content_padding_row_1 = sahel_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row_1',
					'next'   => true,
					'parent' => $eltdf_content_padding_group
				)
			);

				sahel_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_borders_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Left/Right Border', 'sahel' ),
						'options'       => sahel_elated_get_yes_no_select_array(),
						'parent'        => $eltdf_content_padding_row_1
					)
				);

				sahel_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_border_color_meta',
						'type'          => 'colorsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Border Color', 'sahel' ),
						'parent'        => $eltdf_content_padding_row_1,
						'dependency'	=> array(
							'show' => array(
								'eltdf_page_borders_meta' => 'yes'
							)
						)
					)
				);

				sahel_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_border_offset_meta',
						'type'          => 'textsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Border Offset', 'sahel' ),
						'parent'        => $eltdf_content_padding_row_1,
						'dependency'	=> array(
							'show' => array(
								'eltdf_page_borders_meta' => 'yes'
							)
						),
						'args'			=> array(
							'col_width' => '3',
							'suffix' => 'px/%'
						)
					)
				);
		
			$eltdf_content_padding_row_2 = sahel_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row_2',
					'next'   => true,
					'parent' => $eltdf_content_padding_group
				)
			);
		
				sahel_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'sahel' ),
						'parent' => $eltdf_content_padding_row_2,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				sahel_elated_create_meta_box_field(
					array(
						'name'    => 'eltdf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'sahel' ),
						'parent'  => $eltdf_content_padding_row_2,
						'args'        => array(
							'col_width' => 4
						)
					)
				);

				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_dynamic_background_color',
						'type'        => 'yesno',
						'default_value' => 'no',
						'label'       => esc_html__( 'Dynamic Background Color', 'sahel' ),
						'description' => esc_html__( 'Background color will change depending on the value set on the corresponding Row element - currently in viewport.', 'sahel' ),
						'parent'      => $general_meta_box
					)
				);
				
				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_initial_loading_animation',
						'type'        => 'yesno',
						'default_value' => 'no',
						'label'       => esc_html__( 'Initial Loading Animation', 'sahel' ),
						'description' => esc_html__( 'Enabling this option will trigger custom loading effect upon page load.', 'sahel' ),
						'parent'      => $general_meta_box
					)
				);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'sahel' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'sahel' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'sahel' ),
					'eltdf-grid-1300' => esc_html__( '1300px', 'sahel' ),
					'eltdf-grid-1200' => esc_html__( '1200px', 'sahel' ),
					'eltdf-grid-1100' => esc_html__( '1100px', 'sahel' ),
					'eltdf-grid-1000' => esc_html__( '1000px', 'sahel' ),
					'eltdf-grid-800'  => esc_html__( '800px', 'sahel' )
				)
			)
		);
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'sahel' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'sahel' ),
				'options'     => sahel_elated_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		sahel_elated_create_meta_box_field(
			array(
				'name'    => 'eltdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'sahel' ),
				'parent'  => $general_meta_box,
				'options' => sahel_elated_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = sahel_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'sahel' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'sahel' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'sahel' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'sahel' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'sahel' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'sahel' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				sahel_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'sahel' ),
						'description'   => esc_html__( 'Choose background image attachment', 'sahel' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'sahel' ),
							'fixed'  => esc_html__( 'Fixed', 'sahel' ),
							'scroll' => esc_html__( 'Scroll', 'sahel' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'sahel' ),
				'parent'        => $general_meta_box,
				'options'       => sahel_elated_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = sahel_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'eltdf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'sahel' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'sahel' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'sahel' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'sahel' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'sahel' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'sahel' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				sahel_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'sahel' ),
						'options'       => sahel_elated_get_yes_no_select_array(),
					)
				);
		
				sahel_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'sahel' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'sahel' ),
						'options'       => sahel_elated_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		sahel_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'sahel' ),
				'parent'        => $general_meta_box,
				'options'       => sahel_elated_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = sahel_elated_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				sahel_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'sahel' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'sahel' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => sahel_elated_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = sahel_elated_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'eltdf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					sahel_elated_create_meta_box_field(
						array(
							'name'   => 'eltdf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'sahel' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = sahel_elated_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'sahel' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'sahel' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = sahel_elated_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					sahel_elated_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'eltdf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'sahel' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'sahel' ),
								'loading_title'         => esc_html__( 'Loading Title', 'sahel' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'sahel' ),
								'pulse'                 => esc_html__( 'Pulse', 'sahel' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'sahel' ),
								'cube'                  => esc_html__( 'Cube', 'sahel' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'sahel' ),
								'stripes'               => esc_html__( 'Stripes', 'sahel' ),
								'wave'                  => esc_html__( 'Wave', 'sahel' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'sahel' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'sahel' ),
								'atom'                  => esc_html__( 'Atom', 'sahel' ),
								'clock'                 => esc_html__( 'Clock', 'sahel' ),
								'mitosis'               => esc_html__( 'Mitosis', 'sahel' ),
								'lines'                 => esc_html__( 'Lines', 'sahel' ),
								'fussion'               => esc_html__( 'Fussion', 'sahel' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'sahel' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'sahel' )
							)
						)
					);

					sahel_elated_create_meta_box_field(
					    array(
					        'type'          => 'textsimple',
					        'name'          => 'eltdf_loading_title_text_meta',
					        'default_value' => esc_html__('Sahel', 'sahel'),
					        'label'         => esc_html__('Loading Title Text', 'sahel'),
					        'parent'        => $row_pt_spinner_animation_meta,
					        'dependency' => array(
					        	'show' => array(
					        		'eltdf_smooth_pt_spinner_type_meta' => 'loading_title'
				        		)
				        	)
					    )
					);
					
					sahel_elated_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'eltdf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'sahel' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					sahel_elated_create_meta_box_field(
						array(
							'name'        => 'eltdf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'sahel' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'sahel' ),
							'options'     => sahel_elated_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		sahel_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'sahel' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'sahel' ),
				'parent'      => $general_meta_box,
				'options'     => sahel_elated_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'sahel_elated_action_meta_boxes_map', 'sahel_elated_map_general_meta', 10 );
}

if ( ! function_exists( 'sahel_elated_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function sahel_elated_container_background_style( $style ) {
		$page_id      = sahel_elated_get_page_id();
		$class_prefix = sahel_elated_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .eltdf-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'eltdf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'eltdf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'eltdf_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = sahel_elated_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'sahel_elated_filter_add_page_custom_style', 'sahel_elated_container_background_style' );
}

if ( ! function_exists( 'sahel_elated_content_border_style' ) ) {
	/**
	 * Function that return container style
	 */
	function sahel_elated_content_border_style( $style ) {
		$page_id      = sahel_elated_get_page_id();
		$class_prefix = sahel_elated_get_unique_page_class( $page_id, true );

		$page_border_color  = get_post_meta( $page_id, 'eltdf_page_border_color_meta', true );
		$page_border_offset = get_post_meta( $page_id, 'eltdf_page_border_offset_meta', true );

		$current_style = '';
		if ( $page_border_color !== '' || $page_border_offset !== '' ) {
			$page_border_left_style = array();
			$page_border_right_style = array();

			if ( $page_border_color !== '' ) {
				$page_border_left_style['background-color'] = $page_border_color;
				$page_border_right_style['background-color'] = $page_border_color;
			}

			if ( $page_border_offset !== '' ) {
				$page_border_left_style['left'] = $page_border_offset;
				$page_border_right_style['right'] = $page_border_offset;
			}

			$current_style .= sahel_elated_dynamic_css( $class_prefix . ' .eltdf-page-border-left', $page_border_left_style );
			$current_style .= sahel_elated_dynamic_css( $class_prefix . ' .eltdf-page-border-right', $page_border_right_style );
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter( 'sahel_elated_filter_add_page_custom_style', 'sahel_elated_content_border_style' );
}