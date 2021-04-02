<?php

if ( ! function_exists( 'sahel_elated_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function sahel_elated_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'sahel' );
		
		return $templates;
	}
	
	add_filter( 'sahel_elated_filter_register_blog_templates', 'sahel_elated_register_blog_standard_template_file' );
}

if ( ! function_exists( 'sahel_elated_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function sahel_elated_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'sahel' );
		
		return $options;
	}
	
	add_filter( 'sahel_elated_filter_blog_list_type_global_option', 'sahel_elated_set_blog_standard_type_global_option' );
}