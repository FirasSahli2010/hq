<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * sahel_elated_action_header_meta hook
	 *
	 * @see sahel_elated_header_meta() - hooked with 10
	 * @see sahel_elated_user_scalable_meta() - hooked with 10
	 * @see sahel_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'sahel_elated_action_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * sahel_elated_action_after_body_tag hook
	 *
	 * @see sahel_elated_get_side_area() - hooked with 10
	 * @see sahel_elated_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'sahel_elated_action_after_body_tag' ); ?>

	<div class="eltdf-wrapper">
		<div class="eltdf-wrapper-inner">
			<div class="eltdf-content">
				<div class="eltdf-content-inner">
					<?php get_template_part( 'slider' ); ?>
					<div class="eltdf-full-width">
						<div class="eltdf-full-width-inner">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>