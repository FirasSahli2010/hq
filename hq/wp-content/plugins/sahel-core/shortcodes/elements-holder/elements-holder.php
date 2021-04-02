<?php
namespace SahelCore\CPT\Shortcodes\ElementsHolder;

use SahelCore\Lib;

class ElementsHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_elements_holder';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Elements Holder', 'sahel-core' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-elements-holder extended-custom-icon',
					'category'  => esc_html__( 'by SAHEL', 'sahel-core' ),
					'as_parent' => array( 'only' => 'eltdf_elements_holder_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'sahel-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'sahel-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'holder_full_height',
							'heading'     => esc_html__( 'Enable Holder Full Height', 'sahel-core' ),
							'value'       => array_flip( sahel_elated_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'sahel-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Columns', 'sahel-core' ),
							'value'       => array(
								esc_html__( '1 Column', 'sahel-core' )  => 'one-column',
								esc_html__( '2 Columns', 'sahel-core' ) => 'two-columns',
								esc_html__( '3 Columns', 'sahel-core' ) => 'three-columns',
								esc_html__( '4 Columns', 'sahel-core' ) => 'four-columns',
								esc_html__( '5 Columns', 'sahel-core' ) => 'five-columns',
								esc_html__( '6 Columns', 'sahel-core' ) => 'six-columns'
							),
							'save_always' => true
						),
						array(
							'type'       => 'checkbox',
							'param_name' => 'items_float_left',
							'heading'    => esc_html__( 'Items Float Left', 'sahel-core' ),
							'value'      => array( 'Make Items Float Left?' => 'yes' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'switch_to_one_column',
							'heading'     => esc_html__( 'Switch to One Column', 'sahel-core' ),
							'value'       => array(
								esc_html__( 'Default', 'sahel-core' )      => '',
								esc_html__( 'Below 1366px', 'sahel-core' ) => '1366',
								esc_html__( 'Below 1024px', 'sahel-core' ) => '1024',
								esc_html__( 'Below 768px', 'sahel-core' )  => '768',
								esc_html__( 'Below 680px', 'sahel-core' )  => '680',
								esc_html__( 'Below 480px', 'sahel-core' )  => '480',
								esc_html__( 'Never', 'sahel-core' )        => 'never'
							),
							'description' => esc_html__( 'Choose on which stage item will be in one column', 'sahel-core' ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'alignment_one_column',
							'heading'     => esc_html__( 'Choose Alignment In Responsive Mode', 'sahel-core' ),
							'value'       => array(
								esc_html__( 'Default', 'sahel-core' ) => '',
								esc_html__( 'Left', 'sahel-core' )    => 'left',
								esc_html__( 'Center', 'sahel-core' )  => 'center',
								esc_html__( 'Right', 'sahel-core' )   => 'right'
							),
							'description' => esc_html__( 'Alignment When Items are in One Column', 'sahel-core' ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'         => '',
			'holder_full_height'   => 'no',
			'background_color'     => '',
			'number_of_columns'    => 'one-column',
			'items_float_left'     => '',
			'switch_to_one_column' => '',
			'alignment_one_column' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_classes = $this->getHolderClasses( $params );
		$holder_styles  = $this->getHolderStyles( $params );
		
		$html = '<div ' . sahel_elated_get_class_attribute( $holder_classes ) . ' ' . sahel_elated_get_inline_attr( $holder_styles, 'style' ) . '>';
			$html .= do_shortcode( $content );
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array( 'eltdf-elements-holder' );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['holder_full_height'] === 'yes' ? 'eltdf-eh-full-height' : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] : '';
		$holderClasses[] = $params['items_float_left'] !== '' ? 'eltdf-ehi-float' : '';
		$holderClasses[] = ! empty( $params['switch_to_one_column'] ) ? 'eltdf-responsive-mode-' . $params['switch_to_one_column'] : 'eltdf-responsive-mode-768';
		$holderClasses[] = ! empty( $params['alignment_one_column'] ) ? 'eltdf-one-column-alignment-' . $params['alignment_one_column'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $styles );
	}
}
