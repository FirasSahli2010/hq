<?php
namespace SahelCore\CPT\Shortcodes\ElementsHolder;

use SahelCore\Lib;

class ElementsHolderItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_elements_holder_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Elements Holder Item', 'sahel-core' ),
					'base'                    => $this->base,
					'as_child'                => array( 'only' => 'eltdf_elements_holder' ),
					'as_parent'               => array( 'except' => 'vc_row, vc_accordion' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by SAHEL', 'sahel-core' ),
					'icon'                    => 'icon-wpb-elements-holder-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'sahel-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'sahel-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'sahel-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'background_image',
							'heading'    => esc_html__( 'Background Image', 'sahel-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding',
							'heading'     => esc_html__( 'Padding', 'sahel-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'sahel-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'horizontal_alignment',
							'heading'    => esc_html__( 'Horizontal Alignment', 'sahel-core' ),
							'value'      => array(
								esc_html__( 'Left', 'sahel-core' )   => 'left',
								esc_html__( 'Right', 'sahel-core' )  => 'right',
								esc_html__( 'Center', 'sahel-core' ) => 'center'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'vertical_alignment',
							'heading'    => esc_html__( 'Vertical Alignment', 'sahel-core' ),
							'value'      => array(
								esc_html__( 'Middle', 'sahel-core' ) => 'middle',
								esc_html__( 'Top', 'sahel-core' )    => 'top',
								esc_html__( 'Bottom', 'sahel-core' ) => 'bottom'
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'link',
							'heading'    => esc_html__( 'Link', 'sahel-core' ),
							'description' => esc_html__( 'Set link around elements holder item', 'sahel-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'target',
							'heading'    => esc_html__( 'Target', 'sahel-core' ),
							'value'      => array_flip( sahel_elated_get_link_target_array() ),
							'dependency' => array( 'element' => 'link', 'not_empty' => true ),
						),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'border_color',
                            'heading'    => esc_html__( 'Border Color', 'sahel-core' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'border_width',
                            'dependency' => array( 'element' => 'border_color', 'not_empty' => true ),
                            'heading'    => esc_html__( 'Border Width', 'sahel-core' )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'border_style',
                            'dependency' => array( 'element' => 'border_color', 'not_empty' => true ),
                            'heading'    => esc_html__( 'Border Style', 'sahel-core' ),
                            'value'      => array(
                                esc_html__( 'Solid', 'sahel-core' ) => 'solid',
                                esc_html__( 'Dashed', 'sahel-core' )    => 'dashed',
                                esc_html__( 'Dotted', 'sahel-core' ) => 'dotted'
                            )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'border_radius',
                            'heading'    => esc_html__( 'Border Radius', 'sahel-core' ),
                            'description' => esc_html__( 'Please insert value with px at the end', 'sahel-core' )
                        ),
						array(
							'type'       => 'dropdown',
							'param_name' => 'animation',
							'heading'    => esc_html__( 'Animation Type', 'sahel-core' ),
							'value'      => array(
								esc_html__( 'Default (No Animation)', 'sahel-core' )   => '',
								esc_html__( 'Element Grow In', 'sahel-core' )          => 'eltdf-grow-in',
								esc_html__( 'Element Fade In Down', 'sahel-core' )     => 'eltdf-fade-in-down',
								esc_html__( 'Element Fade In Up', 'sahel-core' )       => 'eltdf-fade-in-up',
								esc_html__( 'Element From Fade', 'sahel-core' )        => 'eltdf-element-from-fade',
								esc_html__( 'Element From Left', 'sahel-core' )        => 'eltdf-element-from-left',
								esc_html__( 'Element From Right', 'sahel-core' )       => 'eltdf-element-from-right',
								esc_html__( 'Element From Top', 'sahel-core' )         => 'eltdf-element-from-top',
								esc_html__( 'Element From Bottom', 'sahel-core' )      => 'eltdf-element-from-bottom',
								esc_html__( 'Element Flip In', 'sahel-core' )          => 'eltdf-flip-in',
								esc_html__( 'Element X Rotate', 'sahel-core' )         => 'eltdf-x-rotate',
								esc_html__( 'Element Z Rotate', 'sahel-core' )         => 'eltdf-z-rotate',
								esc_html__( 'Element Y Translate', 'sahel-core' )      => 'eltdf-y-translate',
								esc_html__( 'Element Fade In X Rotate', 'sahel-core' ) => 'eltdf-fade-in-left-x-rotate',
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__( 'Animation Delay (ms)', 'sahel-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1367_1600',
							'heading'     => esc_html__( 'Padding on screen size between 1367px-1600px', 'sahel-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left. For example 10px 0 10px 0', 'sahel-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'sahel-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_1025_1366',
							'heading'     => esc_html__( 'Padding on screen size between 1025px-1366px', 'sahel-core' ),
							'description' => esc_html__( 'Please insert padding in format top right bottom left. For example 10px 0 10px 0', 'sahel-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'sahel-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_769_1024',
							'heading'     => esc_html__( 'Padding on screen size between 768px-1024px', 'sahel-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'sahel-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'sahel-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_681_768',
							'heading'     => esc_html__( 'Padding on screen size between 680px-768px', 'sahel-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'sahel-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'sahel-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'item_padding_680',
							'heading'     => esc_html__( 'Padding on screen size bellow 680px', 'sahel-core' ),
							'description' => esc_html__( 'Please insert padding in format 0px 10px 0px 10px', 'sahel-core' ),
							'group'       => esc_html__( 'Width & Responsiveness', 'sahel-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'           => '',
			'background_color'       => '',
			'background_image'       => '',
			'item_padding'           => '',
			'horizontal_alignment'   => '',
			'vertical_alignment'     => '',
            'link'					 => '',
            'target'				 => '_self',
            'border_color'     		 => '',
            'border_width'     		 => '1px',
            'border_style'     		 => 'solid',
            'border_radius'          => '',
			'animation'              => '',
			'animation_delay'        => '',
			'item_padding_1367_1600' => '',
			'item_padding_1025_1366' => '',
			'item_padding_769_1024'  => '',
			'item_padding_681_768'   => '',
			'item_padding_680'       => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']           = $content;
		$params['holder_classes']    = $this->getHolderClasses( $params );
		$params['holder_rand_class'] = 'eltdf-eh-custom-' . mt_rand( 1000, 10000 );
		$params['holder_styles']     = $this->getHolderStyles( $params );
		$params['content_styles']    = $this->getContentStyles( $params );
		$params['holder_data']       = $this->getHolderData( $params );
		$params['target']          = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		$html = sahel_core_get_shortcode_module_template_part( 'templates/elements-holder-item-template', 'elements-holder', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['vertical_alignment'] ) ? 'eltdf-vertical-alignment-' . $params['vertical_alignment'] : '';
		$holderClasses[] = ! empty( $params['horizontal_alignment'] ) ? 'eltdf-horizontal-alignment-' . $params['horizontal_alignment'] : '';
		$holderClasses[] = ! empty( $params['link'] ) ? 'eltdf-ehi-with-link' : '';
		$holderClasses[] = ! empty( $params['animation'] ) ? $params['animation'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		if ( ! empty( $params['background_image'] ) ) {
			$styles[] = 'background-image: url(' . wp_get_attachment_url( $params['background_image'] ) . ')';
		}

        if ( ! empty( $params['border_color'] ) ) {
            $styles[] = 'border-color: ' . $params['border_color'];

            if ( ! empty( $params['border_width'] ) ) {
                $styles[] = 'border-width: ' . $params['border_width'];
            }
            if ( ! empty( $params['border_style'] ) ) {
                $styles[] = 'border-style: ' . $params['border_style'];
            }
        }

        if ( ! empty( $params['border_radius'] ) ) {
            $styles[] = 'border-radius: ' . $params['border_radius'];
        }
		
		return implode( ';', $styles );
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['item_padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['item_padding'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getHolderData( $params ) {
		$data                    = array();
		$data['data-item-class'] = $params['holder_rand_class'];
		
		if ( ! empty( $params['animation'] ) ) {
			$data['data-animation'] = $params['animation'];
		}
		
		if ( $params['animation_delay'] !== '' ) {
			$data['data-animation-delay'] = esc_attr( $params['animation_delay'] );
		}
		
		if ( $params['item_padding_1367_1600'] !== '' ) {
			$data['data-1367-1600'] = $params['item_padding_1367_1600'];
		}
		
		if ( $params['item_padding_1025_1366'] !== '' ) {
			$data['data-1025-1366'] = $params['item_padding_1025_1366'];
		}
		
		if ( $params['item_padding_769_1024'] !== '' ) {
			$data['data-769-1024'] = $params['item_padding_769_1024'];
		}
		
		if ( $params['item_padding_681_768'] !== '' ) {
			$data['data-681-768'] = $params['item_padding_681_768'];
		}
		
		if ( $params['item_padding_680'] !== '' ) {
			$data['data-680'] = $params['item_padding_680'];
		}
		
		return $data;
	}
}
