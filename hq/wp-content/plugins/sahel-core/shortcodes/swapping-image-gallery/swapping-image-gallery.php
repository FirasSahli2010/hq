<?php
namespace SahelCore\CPT\Shortcodes\SwappingImageGallery;

use SahelCore\Lib;

class SwappingImageGallery implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_swapping_image_gallery';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Swapping Image Gallery', 'sahel-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by SAHEL', 'sahel-core' ),
					'icon'     => 'icon-wpb-swapping-image-gallery extended-custom-icon',
					'params'   => array(
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'sahel-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'description',
							'heading'    => esc_html__( 'Description', 'sahel-core' )
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'image_items',
							'heading'    => esc_html__( 'Image Items', 'sahel-core' ),
							'params'     => array(
								array(
									'type'        => 'attach_image',
									'param_name'  => 'gallery_image',
									'heading'     => esc_html__( 'Main Image', 'sahel-core' ),
									'description' => esc_html__( 'Select image from media library', 'sahel-core' )
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'thumbnail',
									'heading'     => esc_html__( 'Thumbnail', 'sahel-core' ),
									'description' => esc_html__( 'Select image from media library', 'sahel-core' )
								)
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'title'				=> '',
			'description'		=> '',
			'image_items'       => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['slider_data']			= $this->getSliderData( $params );
		$params['image_items']          = json_decode( urldecode( $params['image_items'] ), true );
		
		$html = sahel_core_get_shortcode_module_template_part( 'templates/swapping-image-gallery', 'swapping-image-gallery', '', $params );
		
		return $html;
	}

	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-slider-animate-in'] 	= 'fadeIn';
		
		return $slider_data;
	}
}