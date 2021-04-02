<div class="eltdf-portfolio-list-holder eltdf-grid-list eltdf-disable-bottom-space <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/filter', '', $params); ?>
	<div class="eltdf-pl-inner eltdf-outer-space <?php echo esc_attr($holder_inner_classes); ?> clearfix">
        <?php
		if (is_array($title_params_array) && count($title_params_array)){
			echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-section-title-item', '', $params);
		}
		?>
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'portfolio-item', $item_type, $params);
				endwhile;
			else:
				echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	
	<?php echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'pagination/'.$pagination_type, '', $params, $additional_params); ?>
</div>