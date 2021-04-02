<?php
namespace SahelCore\CPT\Shortcodes\Process;

use SahelCore\Lib;

class ProcessItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_process_item';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Process Item', 'sahel-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by SAHEL', 'sahel-core' ),
					'icon'     => 'icon-wpb-process-item extended-custom-icon',
					'as_child' => array( 'only' => 'eltdf_process' ),
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'sahel-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'sahel-core' )
						),

                        array(
                            'type'       => 'attach_image',
                            'param_name' => 'process_image',
                            'heading'    => esc_html__( 'Process Item Image', 'sahel-core' ),
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'process_image_margin',
                            'heading'    => esc_html__( 'Process Image Margin (px)', 'sahel-core' ),
                            'description' => esc_html__( 'Set margin in this format - 10px 5px 10px 5px', 'sahel-core' ),
                            'dependency' => array( 'element' => 'process_image', 'not_empty' => true )
                        ),

						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'sahel-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'sahel-core' ),
							'value'       => array_flip( sahel_elated_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'sahel-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'sahel-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'sahel-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_top_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'sahel-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'     => '',
            'process_image'    => '',
            'process_image_margin'  => '',
			'title'            => '',
			'title_tag'        => 'h5',
			'title_color'      => '',
			'text'             => '',
			'text_color'       => '',
			'text_top_margin'  => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
        $params['process_image']  = $this->getProcessImage( $params );
		$params['title_tag']      = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']   = $this->getTitleStyles( $params );
		$params['text_styles']    = $this->getTextStyles( $params );
        $params['image_styles']    = $this->getImageStyles( $params );
		
		$html = sahel_core_get_shortcode_module_template_part( 'templates/process-item-template', 'process', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		return implode( ' ', $holderClasses );
	}

    private function getProcessImage( $params ){

        if(!empty($params['process_image'])){
            $id = $params['process_image'];
            $image = wp_get_attachment_image_src($id, 'full');

            return $image[0];
        }
    }
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . sahel_elated_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

    private function getImageStyles( $params ) {
        $styles = array();

        if ( $params['process_image_margin'] !== '' ) {
            $styles[] = 'margin: ' . $params['process_image_margin'];
        }

        return implode( ';', $styles );
    }

}
