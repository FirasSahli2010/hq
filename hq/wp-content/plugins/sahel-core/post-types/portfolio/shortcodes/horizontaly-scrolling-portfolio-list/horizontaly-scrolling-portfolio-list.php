<?php

namespace SahelCore\CPT\Shortcodes\Portfolio;

use SahelCore\Lib;

class HorizontalyScrollingPortfolioList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_horizontaly_scrolling_portfolio_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Portfolio category filter
		add_filter( 'vc_autocomplete_eltdf_horizontaly_scrolling_portfolio_list_category_callback', array( &$this, 'portfolioCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio category render
		add_filter( 'vc_autocomplete_eltdf_horizontaly_scrolling_portfolio_list_category_render', array( &$this, 'portfolioCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio selected projects filter
		add_filter( 'vc_autocomplete_eltdf_horizontaly_scrolling_portfolio_list_featured_project_callback', array( &$this, 'portfolioIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

		//Portfolio selected projects render
		add_filter( 'vc_autocomplete_eltdf_horizontaly_scrolling_portfolio_list_featured_project_render', array( &$this, 'portfolioIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)

		//Portfolio selected projects filter
		add_filter( 'vc_autocomplete_eltdf_horizontaly_scrolling_portfolio_list_selected_projects_callback', array( &$this, 'portfolioIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio selected projects render
		add_filter( 'vc_autocomplete_eltdf_horizontaly_scrolling_portfolio_list_selected_projects_render', array( &$this, 'portfolioIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)
		
		//Portfolio tag filter
		add_filter( 'vc_autocomplete_eltdf_horizontaly_scrolling_portfolio_list_tag_callback', array( &$this, 'portfolioTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio tag render
		add_filter( 'vc_autocomplete_eltdf_horizontaly_scrolling_portfolio_list_tag_render', array( &$this, 'portfolioTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'     => esc_html__( 'Horizontally Scrolling Portfolio List', 'sahel-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by SAHEL', 'sahel-core' ),
					'icon'     => 'icon-wpb-horizontaly-scrolling-portfolio-list extended-custom-icon',
					'params'   => array(
						array(
							'type'       => 'dropdown',
							'param_name' => 'item_type',
							'heading'    => esc_html__( 'Click Behavior', 'sahel-core' ),
							'value'      => array(
								esc_html__( 'Open portfolio single page on click', 'sahel-core' )   => '',
								esc_html__( 'Open gallery in Pretty Photo on click', 'sahel-core' ) => 'gallery'
							)
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Portfolios Per Page', 'sahel-core' ),
							'description' => esc_html__( 'Set number of items for your portfolio list. Enter -1 to show all.', 'sahel-core' ),
							'value'       => '-1'
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_proportions',
							'heading'     => esc_html__( 'Image Proportions', 'sahel-core' ),
							'value'       => array(
								esc_html__( 'Original', 'sahel-core' )  => 'full',
								esc_html__( 'Square', 'sahel-core' )    => 'square',
								esc_html__( 'Landscape', 'sahel-core' ) => 'landscape',
								esc_html__( 'Portrait', 'sahel-core' )  => 'portrait',
								esc_html__( 'Medium', 'sahel-core' )    => 'medium',
								esc_html__( 'Large', 'sahel-core' )     => 'large'
							),
							'description' => esc_html__( 'Set image proportions for your portfolio list.', 'sahel-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'featured_project',
							'heading'     => esc_html__( 'Choose Featured Project', 'sahel-core' ),
							'settings'    => array(
								'multiple'      => false,
								'sortable'      => true,
								'unique_values' => true
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'decrease_height_for_header',
							'heading'     => esc_html__( 'Decrease Height for Header Height', 'sahel-core' ),
							'value'       => array(
								esc_html__('Yes', 'sahel-core') => 'yes',
								esc_html__('No', 'sahel-core') => 'no',
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'decrease_height_for_content_bottom',
							'heading'     => esc_html__( 'Decrease Height for Content Bottom Widget Area', 'sahel-core' ),
							'value'       => array(
								esc_html__('Yes', 'sahel-core') => 'yes',
								esc_html__('No', 'sahel-core') => 'no',
							)
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'One-Category Portfolio List', 'sahel-core' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'sahel-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_projects',
							'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'sahel-core' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'sahel-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'tag',
							'heading'     => esc_html__( 'One-Tag Portfolio List', 'sahel-core' ),
							'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'sahel-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'sahel-core' ),
							'value'       => array_flip( sahel_elated_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'sahel-core' ),
							'value'       => array_flip( sahel_elated_get_query_order_array() ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_items'          => '-1',
			'image_proportions'        => 'full',
			'featured_project' 		   => '',
			'decrease_height_for_header'  => 'yes',
			'decrease_height_for_content_bottom' => 'yes',
			'category'                 => '',
			'selected_projects'        => '',
			'tag'                      => '',
			'orderby'                  => 'date',
			'order'                    => 'ASC'
		);
		$params = shortcode_atts( $args, $atts );
		
		/***
		 * @params query_results
		 * @params holder_data
		 * @params holder_classes
		 * @params holder_inner_classes
		 */
		$additional_params = array();
		
		$query_array                        = $this->getQueryArray( $params );
		$query_results                      = new \WP_Query( $query_array );
		$additional_params['query_results'] = $query_results;

		$additional_params['holder_classes']    = $this->getHolderClasses( $params, $args );
		$additional_params['holder_data']       = $this->getData( $params );

		$params['this_object'] = $this;
		
		$html = sahel_core_get_cpt_shortcode_module_template_part( 'portfolio', 'horizontaly-scrolling-portfolio-list', 'portfolio-holder', '', $params, $additional_params );
		
		return $html;
	}

	private function getData($params){
		$data = array();

		if ( $params['decrease_height_for_header'] == 'yes' ) {
			$data[] = 'data-header-decrease=yes';
		}

		if ( $params['decrease_height_for_content_bottom'] == 'yes' ) {
			$data[] = 'data-content-bottom-decrease=yes';
		}

		return implode(' ', $data);
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'portfolio-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);
		
		if ( ! empty( $params['category'] ) ) {
			$query_array['portfolio-category'] = $params['category'];
		}
		
		$project_ids = null;
		if ( ! empty( $params['selected_projects'] ) ) {
			$project_ids             = explode( ',', $params['selected_projects'] );
			$query_array['post__in'] = $project_ids;
		}

		//exclude featured project
		if ( ! empty( $params['featured_project'] ) ) {
			$query_array['post__not_in'] = array($params['featured_project']);
		}
		
		if ( ! empty( $params['tag'] ) ) {
			$query_array['portfolio-tag'] = $params['tag'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();

		$classes[] = ! empty( $params['featured_project'] ) ? 'eltdf-hsp-has-featured' : '';

		return implode( ' ', $classes );
	}
	
	public function getArticleClasses( $params ) {
		$classes = array();
		
		$article_classes = get_post_class( $classes );
		
		return implode( ' ', $article_classes );
	}
	
	public function getImageSize( $params ) {
		$thumb_size = 'full';
		
		if ( ! empty( $params['image_proportions'] ) ) {
			$image_size = $params['image_proportions'];
			
			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'sahel_elated_image_landscape';
					break;
				case 'portrait':
					$thumb_size = 'sahel_elated_image_portrait';
					break;
				case 'square':
					$thumb_size = 'sahel_elated_image_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}
		
		return $thumb_size;
	}
	
	public function getItemLink($params) {
		$item_id = $params['is_featured'] ? $params['featured_project'] : get_the_ID();

		$portfolio_link_meta = get_post_meta( $item_id, 'portfolio_external_link', true );
		$portfolio_link      = ! empty( $portfolio_link_meta ) ? $portfolio_link_meta : get_permalink( $item_id );
		
		return apply_filters( 'sahel_elated_filter_portfolio_external_link', $portfolio_link );
	}
	
	public function getItemLinkTarget($params) {
		$item_id = $params['is_featured'] ? $params['featured_project'] : get_the_ID();

		$portfolio_link_meta   = get_post_meta( $item_id, 'portfolio_external_link', true );
		$portfolio_link_target = ! empty( $portfolio_link_meta ) ? '_blank' : '_self';
		
		return apply_filters( 'sahel_elated_filter_portfolio_external_link_target', $portfolio_link_target );
	}
	
	/**
	 * Filter portfolio categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'sahel-core' ) . ': ' . $value['portfolio_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
			if ( is_object( $portfolio_category ) ) {
				
				$portfolio_category_slug  = $portfolio_category->slug;
				$portfolio_category_title = $portfolio_category->name;
				
				$portfolio_category_title_display = '';
				if ( ! empty( $portfolio_category_title ) ) {
					$portfolio_category_title_display = esc_html__( 'Category', 'sahel-core' ) . ': ' . $portfolio_category_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_category_slug;
				$data['label'] = $portfolio_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'sahel-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'sahel-core' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$portfolio = get_post( (int) $query );
			if ( ! is_wp_error( $portfolio ) ) {
				
				$portfolio_id    = $portfolio->ID;
				$portfolio_title = $portfolio->post_title;
				
				$portfolio_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$portfolio_title_display = ' - ' . esc_html__( 'Title', 'sahel-core' ) . ': ' . $portfolio_title;
				}
				
				$portfolio_id_display = esc_html__( 'Id', 'sahel-core' ) . ': ' . $portfolio_id;
				
				$data          = array();
				$data['value'] = $portfolio_id;
				$data['label'] = $portfolio_id_display . $portfolio_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolio tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'sahel-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
			if ( is_object( $portfolio_tag ) ) {
				
				$portfolio_tag_slug  = $portfolio_tag->slug;
				$portfolio_tag_title = $portfolio_tag->name;
				
				$portfolio_tag_title_display = '';
				if ( ! empty( $portfolio_tag_title ) ) {
					$portfolio_tag_title_display = esc_html__( 'Tag', 'sahel-core' ) . ': ' . $portfolio_tag_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_tag_slug;
				$data['label'] = $portfolio_tag_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}