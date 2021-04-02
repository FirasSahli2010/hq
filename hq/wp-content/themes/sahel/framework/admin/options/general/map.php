<?php

if ( ! function_exists( 'sahel_elated_general_options_map' ) ) {
	/**
	 * General options page
	 */
	function sahel_elated_general_options_map() {
		
		sahel_elated_add_admin_page(
			array(
				'slug'  => '',
				'title' => esc_html__( 'General', 'sahel' ),
				'icon'  => 'fa fa-institution'
			)
		);
		
		$panel_design_style = sahel_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_design_style',
				'title' => esc_html__( 'Design Style', 'sahel' )
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'google_fonts',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Google Font Family', 'sahel' ),
				'description'   => esc_html__( 'Choose a default Google font for your site', 'sahel' ),
				'parent'        => $panel_design_style
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'additional_google_fonts',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Additional Google Fonts', 'sahel' ),
				'parent'        => $panel_design_style
			)
		);
		
		$additional_google_fonts_container = sahel_elated_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'additional_google_fonts_container',
				'dependency' => array(
					'show' => array(
						'additional_google_fonts'  => 'yes'
					)
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font1',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sahel' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sahel' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font2',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sahel' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sahel' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font3',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sahel' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sahel' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font4',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sahel' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sahel' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'additional_google_font5',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'sahel' ),
				'description'   => esc_html__( 'Choose additional Google font for your site', 'sahel' ),
				'parent'        => $additional_google_fonts_container
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'google_font_weight',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Style & Weight', 'sahel' ),
				'description'   => esc_html__( 'Choose a default Google font weights for your site. Impact on page load time', 'sahel' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'100'  => esc_html__( '100 Thin', 'sahel' ),
					'100i' => esc_html__( '100 Thin Italic', 'sahel' ),
					'200'  => esc_html__( '200 Extra-Light', 'sahel' ),
					'200i' => esc_html__( '200 Extra-Light Italic', 'sahel' ),
					'300'  => esc_html__( '300 Light', 'sahel' ),
					'300i' => esc_html__( '300 Light Italic', 'sahel' ),
					'400'  => esc_html__( '400 Regular', 'sahel' ),
					'400i' => esc_html__( '400 Regular Italic', 'sahel' ),
					'500'  => esc_html__( '500 Medium', 'sahel' ),
					'500i' => esc_html__( '500 Medium Italic', 'sahel' ),
					'600'  => esc_html__( '600 Semi-Bold', 'sahel' ),
					'600i' => esc_html__( '600 Semi-Bold Italic', 'sahel' ),
					'700'  => esc_html__( '700 Bold', 'sahel' ),
					'700i' => esc_html__( '700 Bold Italic', 'sahel' ),
					'800'  => esc_html__( '800 Extra-Bold', 'sahel' ),
					'800i' => esc_html__( '800 Extra-Bold Italic', 'sahel' ),
					'900'  => esc_html__( '900 Ultra-Bold', 'sahel' ),
					'900i' => esc_html__( '900 Ultra-Bold Italic', 'sahel' )
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'google_font_subset',
				'type'          => 'checkboxgroup',
				'default_value' => '',
				'label'         => esc_html__( 'Google Fonts Subset', 'sahel' ),
				'description'   => esc_html__( 'Choose a default Google font subsets for your site', 'sahel' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'latin'        => esc_html__( 'Latin', 'sahel' ),
					'latin-ext'    => esc_html__( 'Latin Extended', 'sahel' ),
					'cyrillic'     => esc_html__( 'Cyrillic', 'sahel' ),
					'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'sahel' ),
					'greek'        => esc_html__( 'Greek', 'sahel' ),
					'greek-ext'    => esc_html__( 'Greek Extended', 'sahel' ),
					'vietnamese'   => esc_html__( 'Vietnamese', 'sahel' )
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'first_color',
				'type'        => 'color',
				'label'       => esc_html__( 'First Main Color', 'sahel' ),
				'description' => esc_html__( 'Choose the most dominant theme color. Default color is #00bbb3', 'sahel' ),
				'parent'      => $panel_design_style
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'page_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'sahel' ),
				'description' => esc_html__( 'Choose the background color for page content. Default color is #ffffff', 'sahel' ),
				'parent'      => $panel_design_style
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'page_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Page Background Image', 'sahel' ),
				'description' => esc_html__( 'Choose the background image for page content', 'sahel' ),
				'parent'      => $panel_design_style
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'page_background_image_repeat',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Background Image Repeat', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will set the background image as a repeating pattern throughout the page, otherwise the image will appear as the cover background image', 'sahel' ),
				'parent'        => $panel_design_style
			)
		);

		sahel_elated_add_admin_field(
			array(
				'name'          => 'page_borders',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Page Left/Right Border', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will display page left and right border', 'sahel' ),
				'parent'        => $panel_design_style
			)
		);

		$borders_container = sahel_elated_add_admin_container(
			array(
				'parent'          => $panel_design_style,
				'name'            => 'borders_container',
				'dependency' => array(
					'show' => array(
						'page_borders'  => 'yes'
					)
				)
			)
		);

		sahel_elated_add_admin_field(
			array(
				'name'          => 'page_border_color',
				'type'          => 'color',
				'default_value' => '',
				'label'         => esc_html__( 'Page Border Color', 'sahel' ),
				'description'   => esc_html__( 'Choose page border color', 'sahel' ),
				'parent'        => $borders_container
			)
		);

		sahel_elated_add_admin_field(
			array(
				'name'          => 'page_border_offset',
				'type'          => 'text',
				'default_value' => '',
				'label'         => esc_html__( 'Page Border Offset', 'sahel' ),
				'description'   => esc_html__( 'Set border offset for left/right border', 'sahel' ),
				'parent'        => $borders_container,
				'args'			=> array(
					'col_width' => '3',
					'suffix' => 'px/%'
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'selection_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Text Selection Color', 'sahel' ),
				'description' => esc_html__( 'Choose the color users see when selecting text', 'sahel' ),
				'parent'      => $panel_design_style
			)
		);
		
		/***************** Passepartout Layout - begin **********************/
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'boxed',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Boxed Layout', 'sahel' ),
				'parent'        => $panel_design_style
			)
		);
		
			$boxed_container = sahel_elated_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'boxed_container',
					'dependency' => array(
						'show' => array(
							'boxed'  => 'yes'
						)
					)
				)
			);
		
				sahel_elated_add_admin_field(
					array(
						'name'        => 'page_background_color_in_box',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'sahel' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'sahel' ),
						'parent'      => $boxed_container
					)
				);
				
				sahel_elated_add_admin_field(
					array(
						'name'        => 'boxed_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'sahel' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'sahel' ),
						'parent'      => $boxed_container
					)
				);
				
				sahel_elated_add_admin_field(
					array(
						'name'        => 'boxed_pattern_background_image',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'sahel' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'sahel' ),
						'parent'      => $boxed_container
					)
				);
				
				sahel_elated_add_admin_field(
					array(
						'name'          => 'boxed_background_image_attachment',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'sahel' ),
						'description'   => esc_html__( 'Choose background image attachment', 'sahel' ),
						'parent'        => $boxed_container,
						'options'       => array(
							''       => esc_html__( 'Default', 'sahel' ),
							'fixed'  => esc_html__( 'Fixed', 'sahel' ),
							'scroll' => esc_html__( 'Scroll', 'sahel' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'paspartu',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Passepartout', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'sahel' ),
				'parent'        => $panel_design_style
			)
		);
		
			$paspartu_container = sahel_elated_add_admin_container(
				array(
					'parent'          => $panel_design_style,
					'name'            => 'paspartu_container',
					'dependency' => array(
						'show' => array(
							'paspartu'  => 'yes'
						)
					)
				)
			);
		
				sahel_elated_add_admin_field(
					array(
						'name'        => 'paspartu_color',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'sahel' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'sahel' ),
						'parent'      => $paspartu_container
					)
				);
				
				sahel_elated_add_admin_field(
					array(
						'name'        => 'paspartu_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'sahel' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'sahel' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				sahel_elated_add_admin_field(
					array(
						'name'        => 'paspartu_responsive_width',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'sahel' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'sahel' ),
						'parent'      => $paspartu_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				sahel_elated_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'disable_top_paspartu',
						'label'         => esc_html__( 'Disable Top Passepartout', 'sahel' )
					)
				);
		
				sahel_elated_add_admin_field(
					array(
						'parent'        => $paspartu_container,
						'type'          => 'yesno',
						'default_value' => 'no',
						'name'          => 'enable_fixed_paspartu',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'sahel' ),
						'description' => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'sahel' )
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Layout - begin **********************/
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'initial_content_width',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'sahel' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'sahel' ),
				'parent'        => $panel_design_style,
				'options'       => array(
					'eltdf-grid-1100' => esc_html__( '1100px - default', 'sahel' ),
					'eltdf-grid-1300' => esc_html__( '1300px', 'sahel' ),
					'eltdf-grid-1200' => esc_html__( '1200px', 'sahel' ),
					'eltdf-grid-1000' => esc_html__( '1000px', 'sahel' ),
					'eltdf-grid-800'  => esc_html__( '800px', 'sahel' )
				)
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'preload_pattern_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Preload Pattern Image', 'sahel' ),
				'description'   => esc_html__( 'Choose preload pattern image to be displayed until images are loaded', 'sahel' ),
				'parent'        => $panel_design_style
			)
		);
		
		/***************** Content Layout - end **********************/
		
		$panel_settings = sahel_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_settings',
				'title' => esc_html__( 'Settings', 'sahel' )
			)
		);
		
		/***************** Smooth Scroll Layout - begin **********************/
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'page_smooth_scroll',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Scroll', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)', 'sahel' ),
				'parent'        => $panel_settings
			)
		);
		
		/***************** Smooth Scroll Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'smooth_page_transitions',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Smooth Page Transitions', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'sahel' ),
				'parent'        => $panel_settings
			)
		);
		
			$page_transitions_container = sahel_elated_add_admin_container(
				array(
					'parent'          => $panel_settings,
					'name'            => 'page_transitions_container',
					'dependency' => array(
						'show' => array(
							'smooth_page_transitions'  => 'yes'
						)
					)
				)
			);
		
				sahel_elated_add_admin_field(
					array(
						'name'          => 'page_transition_preloader',
						'type'          => 'yesno',
						'default_value' => 'no',
						'label'         => esc_html__( 'Enable Preloading Animation', 'sahel' ),
						'description'   => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'sahel' ),
						'parent'        => $page_transitions_container
					)
				);
				
				$page_transition_preloader_container = sahel_elated_add_admin_container(
					array(
						'parent'          => $page_transitions_container,
						'name'            => 'page_transition_preloader_container',
						'dependency' => array(
							'show' => array(
								'page_transition_preloader'  => 'yes'
							)
						)
					)
				);
				
					sahel_elated_add_admin_field(
						array(
							'name'   => 'smooth_pt_bgnd_color',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'sahel' ),
							'parent' => $page_transition_preloader_container
						)
					);
					
					$group_pt_spinner_animation = sahel_elated_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation',
							'title'       => esc_html__( 'Loader Style', 'sahel' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'sahel' ),
							'parent'      => $page_transition_preloader_container
						)
					);
					
					$row_pt_spinner_animation = sahel_elated_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation',
							'parent' => $group_pt_spinner_animation
						)
					);
					
					sahel_elated_add_admin_field(
						array(
							'type'          => 'selectsimple',
							'name'          => 'smooth_pt_spinner_type',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Type', 'sahel' ),
							'parent'        => $row_pt_spinner_animation,
							'options'       => array(
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

					sahel_elated_add_admin_field(
					    array(
					        'type'          => 'textsimple',
					        'name'          => 'loading_title_text',
					        'default_value' => esc_html__('Sahel', 'sahel'),
					        'label'         => esc_html__('Loading Title Text', 'sahel'),
					        'parent'        => $row_pt_spinner_animation,
					        'dependency' => array(
					        	'show' => array(
					        		'smooth_pt_spinner_type' => 'loading_title'
				        		)
				        	)
					    )
					);
					
					sahel_elated_add_admin_field(
						array(
							'type'          => 'colorsimple',
							'name'          => 'smooth_pt_spinner_color',
							'default_value' => '',
							'label'         => esc_html__( 'Spinner Color', 'sahel' ),
							'parent'        => $row_pt_spinner_animation
						)
					);
					
					sahel_elated_add_admin_field(
						array(
							'name'          => 'page_transition_fadeout',
							'type'          => 'yesno',
							'default_value' => 'no',
							'label'         => esc_html__( 'Enable Fade Out Animation', 'sahel' ),
							'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'sahel' ),
							'parent'        => $page_transitions_container
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'show_back_button',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show "Back To Top Button"', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will display a Back to Top button on every page', 'sahel' ),
				'parent'        => $panel_settings
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'          => 'responsiveness',
				'type'          => 'yesno',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Responsiveness', 'sahel' ),
				'description'   => esc_html__( 'Enabling this option will make all pages responsive', 'sahel' ),
				'parent'        => $panel_settings
			)
		);
		
		$panel_custom_code = sahel_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_custom_code',
				'title' => esc_html__( 'Custom Code', 'sahel' )
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'custom_js',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom JS', 'sahel' ),
				'description' => esc_html__( 'Enter your custom Javascript here', 'sahel' ),
				'parent'      => $panel_custom_code
			)
		);
		
		$panel_google_api = sahel_elated_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => esc_html__( 'Google API', 'sahel' )
			)
		);
		
		sahel_elated_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => esc_html__( 'Google Maps Api Key', 'sahel' ),
				'description' => esc_html__( 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our to our documentation.', 'sahel' ),
				'parent'      => $panel_google_api
			)
		);
	}
	
	add_action( 'sahel_elated_action_options_map', 'sahel_elated_general_options_map', sahel_elated_set_options_map_position( 'general' ) );
}

if ( ! function_exists( 'sahel_elated_page_general_style' ) ) {
	/**
	 * Function that prints page general inline styles
	 */
	function sahel_elated_page_general_style( $style ) {
		$current_style = '';
		$page_id       = sahel_elated_get_page_id();
		$class_prefix  = sahel_elated_get_unique_page_class( $page_id );
		
		$boxed_background_style = array();
		
		$boxed_page_background_color = sahel_elated_get_meta_field_intersect( 'page_background_color_in_box', $page_id );
		if ( ! empty( $boxed_page_background_color ) ) {
			$boxed_background_style['background-color'] = $boxed_page_background_color;
		}
		
		$boxed_page_background_image = sahel_elated_get_meta_field_intersect( 'boxed_background_image', $page_id );
		if ( ! empty( $boxed_page_background_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_image ) . ')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat']   = 'no-repeat';
		}
		
		$boxed_page_background_pattern_image = sahel_elated_get_meta_field_intersect( 'boxed_pattern_background_image', $page_id );
		if ( ! empty( $boxed_page_background_pattern_image ) ) {
			$boxed_background_style['background-image']    = 'url(' . esc_url( $boxed_page_background_pattern_image ) . ')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat']   = 'repeat';
		}
		
		$boxed_page_background_attachment = sahel_elated_get_meta_field_intersect( 'boxed_background_image_attachment', $page_id );
		if ( ! empty( $boxed_page_background_attachment ) ) {
			$boxed_background_style['background-attachment'] = $boxed_page_background_attachment;
		}
		
		$boxed_background_selector = $class_prefix . '.eltdf-boxed .eltdf-wrapper';
		
		if ( ! empty( $boxed_background_style ) ) {
			$current_style .= sahel_elated_dynamic_css( $boxed_background_selector, $boxed_background_style );
		}
		
		$paspartu_style     = array();
		$paspartu_res_style = array();
		$paspartu_res_start = '@media only screen and (max-width: 1024px) {';
		$paspartu_res_end   = '}';
		
		$paspartu_header_selector                = array(
			'.eltdf-paspartu-enabled .eltdf-page-header .eltdf-fixed-wrapper.fixed',
			'.eltdf-paspartu-enabled .eltdf-sticky-header',
			'.eltdf-paspartu-enabled .eltdf-mobile-header.mobile-header-appear .eltdf-mobile-header-inner'
		);
		$paspartu_header_appear_selector         = array(
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-page-header .eltdf-fixed-wrapper.fixed',
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-sticky-header.header-appear',
			'.eltdf-paspartu-enabled.eltdf-fixed-paspartu-enabled .eltdf-mobile-header.mobile-header-appear .eltdf-mobile-header-inner'
		);
		
		$paspartu_header_style                   = array();
		$paspartu_header_appear_style            = array();
		$paspartu_header_responsive_style        = array();
		$paspartu_header_appear_responsive_style = array();
		
		$paspartu_color = sahel_elated_get_meta_field_intersect( 'paspartu_color', $page_id );
		if ( ! empty( $paspartu_color ) ) {
			$paspartu_style['background-color'] = $paspartu_color;
		}
		
		$paspartu_width = sahel_elated_get_meta_field_intersect( 'paspartu_width', $page_id );
		if ( $paspartu_width !== '' ) {
			if ( sahel_elated_string_ends_with( $paspartu_width, '%' ) || sahel_elated_string_ends_with( $paspartu_width, 'px' ) ) {
				$paspartu_style['padding'] = $paspartu_width;
				
				$paspartu_clean_width      = sahel_elated_string_ends_with( $paspartu_width, '%' ) ? sahel_elated_filter_suffix( $paspartu_width, '%' ) : sahel_elated_filter_suffix( $paspartu_width, 'px' );
				$paspartu_clean_width_mark = sahel_elated_string_ends_with( $paspartu_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_style['left']              = $paspartu_width;
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width;
			} else {
				$paspartu_style['padding'] = $paspartu_width . 'px';
				
				$paspartu_header_style['left']              = $paspartu_width . 'px';
				$paspartu_header_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_width ) . 'px)';
				$paspartu_header_appear_style['margin-top'] = $paspartu_width . 'px';
			}
		}
		
		$paspartu_selector = $class_prefix . '.eltdf-paspartu-enabled .eltdf-wrapper';
		
		if ( ! empty( $paspartu_style ) ) {
			$current_style .= sahel_elated_dynamic_css( $paspartu_selector, $paspartu_style );
		}
		
		if ( ! empty( $paspartu_header_style ) ) {
			$current_style .= sahel_elated_dynamic_css( $paspartu_header_selector, $paspartu_header_style );
			$current_style .= sahel_elated_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_style );
		}
		
		$paspartu_responsive_width = sahel_elated_get_meta_field_intersect( 'paspartu_responsive_width', $page_id );
		if ( $paspartu_responsive_width !== '' ) {
			if ( sahel_elated_string_ends_with( $paspartu_responsive_width, '%' ) || sahel_elated_string_ends_with( $paspartu_responsive_width, 'px' ) ) {
				$paspartu_res_style['padding'] = $paspartu_responsive_width;
				
				$paspartu_clean_width      = sahel_elated_string_ends_with( $paspartu_responsive_width, '%' ) ? sahel_elated_filter_suffix( $paspartu_responsive_width, '%' ) : sahel_elated_filter_suffix( $paspartu_responsive_width, 'px' );
				$paspartu_clean_width_mark = sahel_elated_string_ends_with( $paspartu_responsive_width, '%' ) ? '%' : 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width;
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_clean_width ) . $paspartu_clean_width_mark . ')';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width;
			} else {
				$paspartu_res_style['padding'] = $paspartu_responsive_width . 'px';
				
				$paspartu_header_responsive_style['left']              = $paspartu_responsive_width . 'px';
				$paspartu_header_responsive_style['width']             = 'calc(100% - ' . ( 2 * $paspartu_responsive_width ) . 'px)';
				$paspartu_header_appear_responsive_style['margin-top'] = $paspartu_responsive_width . 'px';
			}
		}
		
		if ( ! empty( $paspartu_res_style ) ) {
			$current_style .= $paspartu_res_start . sahel_elated_dynamic_css( $paspartu_selector, $paspartu_res_style ) . $paspartu_res_end;
		}
		
		if ( ! empty( $paspartu_header_responsive_style ) ) {
			$current_style .= $paspartu_res_start . sahel_elated_dynamic_css( $paspartu_header_selector, $paspartu_header_responsive_style ) . $paspartu_res_end;
			$current_style .= $paspartu_res_start . sahel_elated_dynamic_css( $paspartu_header_appear_selector, $paspartu_header_appear_responsive_style ) . $paspartu_res_end;
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'sahel_elated_filter_add_page_custom_style', 'sahel_elated_page_general_style' );
}