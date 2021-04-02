<?php
namespace SahelCore\CPT\Shortcodes\ScrollingImage;

use SahelCore\Lib;

class ScrollingImage implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_scrolling_image';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Scrolling Image', 'sahel-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by SAHEL', 'sahel-core' ),
					'icon'                      => 'icon-wpb-scrolling-image extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'sahel-core' ),
							'description' => esc_html__( 'Select image from media library. Make sure the image is at least 700px wide.', 'sahel-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'scrolling_direction',
							'heading'    => esc_html__( 'Scrolling Direction', 'sahel-core' ),
							'value'      => array(
								esc_html__( 'Vertical', 'sahel-core' ) => 'vertical',
								esc_html__( 'Horizontal', 'sahel-core' ) => 'horizontal',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'sahel-core' ),
							'value'       => array_flip( sahel_elated_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'custom_link',
							'heading'    => esc_html__( 'Custom Link', 'sahel-core' ),
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'custom_link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'sahel-core' ),
							'value'      => array_flip( sahel_elated_get_link_target_array() ),
							'dependency' => Array( 'element' => 'custom_link', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'sahel-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'sahel-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title_top_margin',
							'heading'    => esc_html__( 'Title Top Margin (px)', 'sahel-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'image'               => '',
			'scrolling_direction' => 'vertical',
			'enable_image_shadow' => '',
			'custom_link'         => '',
			'custom_link_target'  => '_self',
			'title'               => '',
			'title_color'         => '',
			'title_top_margin'    => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['image']              = $this->getImage( $params );
		$params['title_styles']       = $this->getTitleStyles( $params );
		
		$html = sahel_core_get_shortcode_module_template_part( 'templates/scrolling-image-template', 'scrolling-image', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'eltdf-has-shadow' : '';
		$holderClasses[] = !empty($params['scrolling_direction']) ? 'eltdf-scrolling-'.$params['scrolling_direction'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getImage( $params ) {
		$image = array();
		
		if ( ! empty( $params['image'] ) ) {
			$id = $params['image'];
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
		}
		
		return $image;
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . sahel_elated_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}