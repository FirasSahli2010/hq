<?php
namespace SahelCore\CPT\Shortcodes\ImageHighlight;

use SahelCore\Lib;

class ImageHighlight implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_image_highlight';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Image Highlight', 'sahel-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by SAHEL', 'sahel-core' ),
					'icon'                      => 'icon-wpb-image-highlight extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'sahel-core' ),
							'description' => esc_html__( 'Select image from media library', 'sahel-core' )
						),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'image_size',
                            'heading'     => esc_html__( 'Image Size', 'sahel-core' ),
                            'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'sahel-core' )
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
							'value'       => array_flip( sahel_elated_get_title_tag( true, array('span' => 'span') ) ),
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
							'type'       => 'textfield',
							'param_name' => 'title_top_margin',
							'heading'    => esc_html__( 'Title Top Margin (px)', 'sahel-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true )
						),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'subtitle',
                            'heading'    => esc_html__( 'Subtitle', 'sahel-core' )
                        ),
                        array(
                            'type'       => 'colorpicker',
                            'param_name' => 'subtitle_color',
                            'heading'    => esc_html__( 'Subtitle Color', 'sahel-core' ),
                            'dependency' => array( 'element' => 'subtitle', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'subtitle_top_margin',
                            'heading'    => esc_html__( 'Subtitle Top Margin (px)', 'sahel-core' ),
                            'dependency' => array( 'element' => 'subtitle', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'side_text',
                            'heading'    => esc_html__( 'Side Text', 'sahel-core' )
                        ),
                        array(
                            'type'       => 'textfield',
                            'param_name' => 'link',
                            'heading'    => esc_html__( 'Link', 'sahel-core' ),
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'link_target',
                            'heading'    => esc_html__( 'Link Target', 'sahel-core' ),
                            'value'      => array_flip( sahel_elated_get_link_target_array() ),
                            'dependency'  => array( 'element' => 'link', 'not_empty' => true )
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'alignment',
                            'heading'    => esc_html__( 'Content Alignment', 'sahel-core' ),
                            'value'      => array(
                                esc_html__( 'Default', 'sahel-core' ) => '',
                                esc_html__( 'Left', 'sahel-core' )    => 'left',
                                esc_html__( 'Right', 'sahel-core' )   => 'right',
                                esc_html__( 'Center', 'sahel-core' )  => 'center'
                            )
						),
						array(
							'type'        => 'dropdown',
							'param_name' => 'enable_loading_animation',
							'heading'    => esc_html__( 'Loading Animation', 'sahel-core' ),
							'value'      => array_flip( sahel_elated_get_yes_no_select_array( false, true ) ),
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'image'               => '',
            'image_size'          => 'full',
			'title'               => '',
			'title_tag'           => 'h3',
			'title_color'         => '',
			'title_top_margin'    => '',
			'subtitle'                => '',
			'subtitle_color'          => '',
			'subtitle_top_margin'     => '',
            'side_text'               => '',
            'link'             => '',
            'link_target'      => '_self',
			'alignment'        => 'left',
			'enable_loading_animation' => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['image']              = $this->getImage( $params );
        $params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['title_tag']          = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['title_styles']       = $this->getTitleStyles( $params );
		$params['subtitle_styles']        = $this->getSubtitleStyles( $params );
		$params['text_styles']            = $this->getContentStyles($params);
		
		$html = sahel_core_get_shortcode_module_template_part( 'templates/image-highlight', 'image-highlight', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['link'] ) ? 'eltdf-ih-with-link' : '';
		$holderClasses[] = $params['enable_loading_animation'] == 'yes' ? 'eltdf-ih-with-animation' : '';
		
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

    private function getImageSize( $image_size ) {
        $image_size = trim( $image_size );
        //Find digits
        preg_match_all( '/\d+/', $image_size, $matches );
        if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
            return $image_size;
        } elseif ( ! empty( $matches[0] ) ) {
            return array(
                $matches[0][0],
                $matches[0][1]
            );
        } else {
            return 'thumbnail';
        }
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
	
	private function getSubtitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}
		
		if ( $params['subtitle_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . sahel_elated_filter_px( $params['subtitle_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}

    private function getContentStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['alignment'] ) ) {
            $styles[] = 'text-align: ' . $params['alignment'];
        }

        return implode( ';', $styles );
    }
}