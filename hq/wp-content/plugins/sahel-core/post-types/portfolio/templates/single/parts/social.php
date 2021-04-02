<?php if ( sahel_elated_options()->getOptionValue( 'enable_social_share' ) == 'yes' && sahel_elated_options()->getOptionValue( 'enable_social_share_on_portfolio_item' ) == 'yes' ) : ?>
	<div class="eltdf-ps-info-item eltdf-ps-social-share">
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */
		echo sahel_elated_get_social_share_html( array( 'type'  => 'list' ) ); ?>
	</div>
<?php endif; ?>