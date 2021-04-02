<?php
namespace SahelCore\CPT\Shortcodes\InteractiveLinkShowcase;

use SahelCore\Lib;

class InteractiveLinkShowcase implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_interactive_link_showcase';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Interactive Link Showcase', 'sahel-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by SAHEL', 'sahel-core' ),
					'icon'     => 'icon-wpb-interactive-link-showcase extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'skin',
							'heading'     => esc_html__( 'Link Skin', 'sahel-core' ),
							'value'       => array(
								esc_html__( 'Default', 'sahel-core' ) => '',
								esc_html__( 'Light', 'sahel-core' )   => 'light'
							),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'sahel-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'link_target',
							'heading'     => esc_html__( 'Link Target', 'sahel-core' ),
							'value'       => array_flip( sahel_elated_get_link_target_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'link_items',
							'heading'    => esc_html__( 'Link Items', 'sahel-core' ),
							'params'     => array(
								array(
                                    'type'       => 'textfield',
                                    'param_name' => 'title',
                                    'heading'    => esc_html__( 'Title', 'sahel-core' ),
                                ),

                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'subtitle',
                                    'heading'    => esc_html__( 'Subtitle', 'sahel-core' ),
                                ),

								array(
									'type'       => 'textfield',
									'param_name' => 'link',
									'heading'    => esc_html__( 'Link', 'sahel-core' )
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'image',
									'heading'     => esc_html__( 'Image', 'sahel-core' ),
									'description' => esc_html__( 'Select image from media library', 'sahel-core' )
								)
							)
						),

                        array(
                            'type'       => 'textfield',
                            'param_name' => 'title_font_size',
                            'heading'    => esc_html__( 'Title Font Size (px)', 'sahel-core' ),
                            'save_always' => true
                        ),

                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'title_color',
                            'heading'    => esc_html__( 'Title Color', 'sahel-core' ),
                            'save_always' => true
                        )
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'skin'             => '',
			'background_color' => '',
			'link_target'      => '_self',
			'link_items'       => '',
            'title_font_size'   => '',
            'title_color'      => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']      = $this->getHolderClasses( $params, $args );
		$params['image_holder_styles'] = $this->getImageHolderStyles( $params );
		$params['link_items']          = json_decode( urldecode( $params['link_items'] ), true );
		$params['link_target']         = ! empty( $params['link_target'] ) ? $params['link_target'] : $args['link_target'];
        $params['interactive_title_styles'] = $this->getInteractiveTitleStyles( $params );
		
		$html = sahel_core_get_shortcode_module_template_part( 'templates/interactive-link-showcase', 'interactive-link-showcase', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['skin'] ) ? 'eltdf-ils-skin-' . $params['skin'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getImageHolderStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}

		return implode( ';', $styles );
	}

    private function getInteractiveTitleStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['title_font_size'] ) ) {
            $styles[] = 'font-size: ' . sahel_elated_filter_px( $params['title_font_size'] ) . 'px';
        }

        if ( ! empty( $params['title_color'] ) ) {
            $styles[] = 'color: ' . $params['title_color'];
        }

        return implode( ';', $styles );
    }

}