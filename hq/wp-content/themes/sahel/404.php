<?php get_header(); ?>
				<div class="eltdf-page-not-found">
					<?php
					$eltdf_title_image_404 = sahel_elated_options()->getOptionValue( '404_page_title_image' );
					$eltdf_title_404       = sahel_elated_options()->getOptionValue( '404_title' );
					$eltdf_subtitle_404    = sahel_elated_options()->getOptionValue( '404_subtitle' );
					$eltdf_text_404        = sahel_elated_options()->getOptionValue( '404_text' );
					$eltdf_button_label    = sahel_elated_options()->getOptionValue( '404_back_to_home' );
					$eltdf_button_style    = sahel_elated_options()->getOptionValue( '404_button_style' );
					$eltdf_search_form_skin = sahel_elated_options()->getOptionValue( '404_search_form_skin' );
					
					if ( ! empty( $eltdf_title_image_404 ) ) { ?>
						<div class="eltdf-404-title-image">
							<img src="<?php echo esc_url( $eltdf_title_image_404 ); ?>" alt="<?php esc_attr_e( '404 Title Image', 'sahel' ); ?>" />
						</div>
					<?php } ?>
					
					<h1 class="eltdf-404-title">
						<?php if ( ! empty( $eltdf_title_404 ) ) {
							echo esc_html( $eltdf_title_404 );
						} else {
							esc_html_e( '404', 'sahel' );
						} ?>
					</h1>
					
					<h3 class="eltdf-404-subtitle">
						<?php if ( ! empty( $eltdf_subtitle_404 ) ) {
							echo esc_html( $eltdf_subtitle_404 );
						} else {
							esc_html_e( 'Page not found', 'sahel' );
						} ?>
					</h3>
					
					<p class="eltdf-404-text">
						<?php if ( ! empty( $eltdf_text_404 ) ) {
							echo esc_html( $eltdf_text_404 );
						} else {
							esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'sahel' );
						} ?>
					</p>
					
					<?php
					$eltdf_form_class = 'eltdf-404-form';

					if ($eltdf_search_form_skin == 'light-style') {
						$eltdf_form_class .= ' eltdf-404-form-light';
					}
					?>

					<div <?php sahel_elated_class_attribute($eltdf_form_class);?>>
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>