<?php

if ( ! function_exists( 'sahel_elated_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function sahel_elated_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$params_list['holder'] = 'eltdf-container';
		$params_list['inner']  = 'eltdf-container-inner clearfix';
		
		return $params_list;
	}
	
	add_filter( 'sahel_elated_filter_blog_holder_params', 'sahel_elated_get_blog_holder_params' );
}

if ( ! function_exists( 'sahel_elated_blog_part_params' ) ) {
	function sahel_elated_blog_part_params( $params ) {
		
		$part_params              = array();
		$part_params['title_tag'] = 'h1';
		
		return array_merge( $params, $part_params );
	}
	
	add_filter( 'sahel_elated_filter_blog_part_params', 'sahel_elated_blog_part_params' );
}