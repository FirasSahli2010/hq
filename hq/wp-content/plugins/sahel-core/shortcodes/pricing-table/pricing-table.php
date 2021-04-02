<?php
namespace SahelCore\CPT\Shortcodes\PricingTable;

use SahelCore\Lib;

class PricingTable implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_pricing_table';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Pricing Table', 'sahel-core' ),
					'base'                    => $this->base,
					'as_parent'               => array( 'only' => 'eltdf_pricing_table_item' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by SAHEL', 'sahel-core' ),
					'icon'                    => 'icon-wpb-pricing-table extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'sahel-core' ),
							'value'       => array_flip( sahel_elated_get_number_of_columns_array( true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'border_skin',
							'heading'     => esc_html__( 'Border Skin', 'sahel-core' ),
							'value'       => array(
								esc_html__( 'Default', 'sahel-core' ) => '',
								esc_html__( 'Light', 'sahel-core' )   => 'light',
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'sahel-core' ),
							'value'       => array_flip( sahel_elated_get_space_between_items_array() ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_columns'   => 'three',
			'border_skin'   => '',
			'space_between_items' => 'normal'
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_class = $this->getHolderClasses( $params, $args );
		
		$html = '<div class="eltdf-pricing-tables eltdf-grid-list eltdf-disable-bottom-space clearfix  ' . esc_attr( $holder_class ) . '">';
			$html .= '<div class="eltdf-pt-wrapper eltdf-outer-space">';
				$html .= do_shortcode( $content );
			$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : 'eltdf-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : 'eltdf-' . $args['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['border_skin'] ) ? 'eltdf-border-' . $params['border_skin'] : '';
		
		return implode( ' ', $holderClasses );
	}
}