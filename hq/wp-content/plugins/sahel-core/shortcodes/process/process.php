<?php
namespace SahelCore\CPT\Shortcodes\Process;

use SahelCore\Lib;

class Process implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_process';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Process', 'sahel-core' ),
					'base'            => $this->base,
					'icon'            => 'icon-wpb-process extended-custom-icon',
					'category'        => esc_html__( 'by SAHEL', 'sahel-core' ),
					'as_parent'       => array( 'only' => 'eltdf_process_item' ),
					'content_element' => true,
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'sahel-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'sahel-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number Of Columns', 'sahel-core' ),
							'value'       => array_flip( sahel_elated_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'switch_to_one_column',
							'heading'     => esc_html__( 'Switch to One Column', 'sahel-core' ),
							'value'       => array(
								esc_html__( 'Default None', 'sahel-core' ) => '',
								esc_html__( 'Below 1366px', 'sahel-core' ) => '1366',
								esc_html__( 'Below 1024px', 'sahel-core' ) => '1024',
								esc_html__( 'Below 768px', 'sahel-core' )  => '768',
								esc_html__( 'Below 680px', 'sahel-core' )  => '680',
								esc_html__( 'Below 480px', 'sahel-core' )  => '480'
							),
							'description' => esc_html__( 'Choose on which stage item will be in one column', 'sahel-core' ),
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
			'number_of_columns'    => 'three',
			'switch_to_one_column' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']  = $this->getHolderClasses( $params, $args );
		$params['number_of_items'] = $this->getNumberOfItems( $params['number_of_columns'] );
		$params['content']         = $content;
		
		$html = sahel_core_get_shortcode_module_template_part( 'templates/process-template', 'process', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : 'eltdf-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['switch_to_one_column'] ) ? 'eltdf-responsive-' . $params['switch_to_one_column'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getNumberOfItems( $params ) {
		$number = 3;
		
		switch ($params) {
			case 'two':
				$number = 2;
				break;
			case 'three':
				$number = 3;
				break;
			case 'four':
				$number = 4;
				break;
		}
		
		return $number;
	}
}
