<?php
namespace SahelCore\CPT\Shortcodes\ExpandingCarousel;

use SahelCore\Lib;

class ExpandingCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_expanding_carousel';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Expanding Carousel', 'sahel-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by SAHEL', 'sahel-core' ),
					'icon'                      => 'icon-wpb-expanding-carousel extended-custom-icon',
                    'allowed_container_element' => 'vc_row',
					'params'                    => array(
                        array(
                            'type' => 'param_group',
                            'heading' => esc_html__( 'Carousel Items', 'sahel-core' ),
                            'param_name' => 'carousel_items',
                            'params' => array(
                            	array(
                            	    'type'        => 'attach_image',
                            	    'param_name'  => 'item_image',
                            	    'heading'     => esc_html__( 'Item Image', 'sahel-core' ),
                            	),
                                array(
                                    'type'        => 'textfield',
                                    'param_name'  => 'item_title',
                                    'heading'     => esc_html__( 'Item Title', 'sahel-core' ),
                                    'admin_label' => true
                                ),
								array(
									'type'        => 'colorpicker',
									'param_name'  => 'item_title_color',
									'heading'     => esc_html__( 'Item Title Color', 'sahel-core' ),
									'admin_label' => true
								),
                                array(
                                    'type'       => 'textfield',
                                    'param_name' => 'item_link',
                                    'heading'    => esc_html__( 'Item Link', 'sahel-core' )
                                )
                            )
                        ),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'carousel_size',
							'heading'     => esc_html__( 'Carousel Size', 'sahel-core' ),
							'value'	      => array(
								esc_html__('Fullscreen','sahel-core') => 'fullscreen',
								esc_html__('Landscape','sahel-core') => 'landscape',
								esc_html__('Square','sahel-core') => 'square'
							),
							'admin_label' => true,
							'group'     => esc_html__( 'Layout and Behavior', 'sahel-core' ),
						),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'change_slides_on_scroll',
						    'heading'  => esc_html__( 'Change Slides On Scroll', 'sahel-core' ),
							'value'      => array_flip( sahel_elated_get_yes_no_select_array( false, true ) ),
						    'save_always' => true,
						    'admin_label' => true,
						    'group'     => esc_html__( 'Layout and Behavior', 'sahel-core' ),
						),
						array(
						    'type'        => 'dropdown',
						    'param_name'  => 'items_link_target',
						    'heading'     => esc_html__( 'Items Link Target', 'sahel-core' ),
						    'value'       => array_flip( sahel_elated_get_link_target_array() ),
						    'save_always' => true,
						    'group'     => esc_html__( 'Layout and Behavior', 'sahel-core' ),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_border',
							'heading'     => esc_html__( 'Enable Border', 'sahel-core' ),
							'value'      => array_flip( sahel_elated_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'     => esc_html__( 'Layout and Behavior', 'sahel-core' ),
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_navigation',
							'heading'     => esc_html__( 'Enable Navigation', 'sahel-core' ),
							'value'      => array_flip( sahel_elated_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'     => esc_html__( 'Layout and Behavior', 'sahel-core' ),
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'navigation_left_offset',
							'heading'     => esc_html__( 'Navigation Left Offset (px/%)', 'sahel-core' ),
							'group'       => esc_html__( 'Layout and Behavior', 'sahel-core' ),
							'dependency'  => array('element' => 'enable_navigation', 'value' => 'yes')
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'navigation_bottom_offset',
							'heading'     => esc_html__( 'Navigation Bottom Offset (px/%)', 'sahel-core' ),
							'group'       => esc_html__( 'Layout and Behavior', 'sahel-core' ),
							'dependency'  => array('element' => 'enable_navigation', 'value' => 'yes'),
							'description' => esc_html__('If this option set, navigation will not follow border', 'sahel-core')
						)
                    )
				)
			);
		}
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		$args = array(
            'carousel_items'            	=> '',
            'carousel_size'					=> 'fullscreen',
            'change_slides_on_scroll'		=> '',
            'items_link_target'     		=> '',
            'enable_border'          		=> 'yes',
            'enable_navigation'          	=> 'yes',
			'navigation_left_offset'		=> '',
			'navigation_bottom_offset'		=> ''
		);
		
		$params = shortcode_atts($args, $atts);
		$params['holder_classes'] = $this->getHolderClasses($params);
        $params['content'] = $content;
        $params['carousel_items'] = json_decode(urldecode($params['carousel_items']), true);
        $params['nav_style'] = $this->getNavStyle($params);

		$html = sahel_core_get_shortcode_module_template_part('templates/expanding-carousel-template', 'expanding-carousel', '', $params);
		
		return $html;
	}


	/**
	 * Generates holder classes
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getHolderClasses($params){
		$holderClasses = array();

		$holderClasses[] = 'eltdf-expanding-carousel-holder';

		if ($params['carousel_size'] !== '') {
			$holderClasses[] = 'eltdf-expanding-'.$params['carousel_size'];
		}

		if ($params['change_slides_on_scroll'] == 'yes') {
			$holderClasses[] = 'eltdf-esc-slide-on-scroll';
		}

		if (($params['enable_border']) == 'yes') {
			$holderClasses[] = 'eltdf-esc-with-border';
		}

		if (($params['enable_navigation']) == 'yes') {
			$holderClasses[] = 'eltdf-esc-with-nav';
		}

		return implode(' ', $holderClasses);
	}

	private function getNavStyle($params) {
		$style = array();

		if ($params['navigation_left_offset'] !== '') {
			$style[] = 'left: '.$params['navigation_left_offset'];
		}

		if ($params['navigation_bottom_offset'] !== '') {
			$style[] = 'bottom: '.$params['navigation_bottom_offset'];
		}

		return implode(';', $style);
	}
}