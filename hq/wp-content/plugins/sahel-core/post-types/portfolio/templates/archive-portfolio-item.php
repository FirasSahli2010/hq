<?php
get_header();
sahel_elated_get_title();
do_action( 'sahel_elated_action_before_main_content' ); ?>
<div class="eltdf-container eltdf-default-page-template">
	<?php do_action( 'sahel_elated_action_after_container_open' ); ?>
	<div class="eltdf-container-inner clearfix">
		<?php
			$sahel_taxonomy_id   = get_queried_object_id();
			$sahel_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$sahel_taxonomy      = ! empty( $sahel_taxonomy_id ) ? get_term_by( 'id', $sahel_taxonomy_id, $sahel_taxonomy_type ) : '';
			$sahel_taxonomy_slug = ! empty( $sahel_taxonomy ) ? $sahel_taxonomy->slug : '';
			$sahel_taxonomy_name = ! empty( $sahel_taxonomy ) ? $sahel_taxonomy->taxonomy : '';
			
			sahel_core_get_archive_portfolio_list( $sahel_taxonomy_slug, $sahel_taxonomy_name );
		?>
	</div>
	<?php do_action( 'sahel_elated_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
