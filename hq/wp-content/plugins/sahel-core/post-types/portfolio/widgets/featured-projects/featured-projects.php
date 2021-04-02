<?php

class SahelElatedClassFeaturedProjectsWidget extends SahelCoreClassWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_featured_projects_widget',
			esc_html__( 'Sahel Featured Projects Widget', 'sahel-core' ),
			array( 'description' => esc_html__( 'Display a list of your featured portfolios', 'sahel-core' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'textfield',
				'name'		  => 'selected_projects',
				'title'       => esc_html__( 'Show Projects with Listed IDs', 'sahel-core' ),
				'description' => esc_html__( 'Delimit ID numbers by comma', 'sahel-core' )
			),
			array(
				'type'        => 'dropdown',
				'name' 		  => 'number_of_columns',
				'title'       => esc_html__( 'Number of Columns', 'sahel-core' ),
				'options'     => sahel_elated_get_number_of_columns_array( true ),
				'description' => esc_html__( 'Default value is four', 'sahel-core' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_items',
				'title'   => esc_html__( 'Space Between Items', 'sahel-core' ),
				'options' => sahel_elated_get_space_between_items_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_tag',
				'title'   => esc_html__( 'Title Tag', 'sahel-core' ),
				'options' => sahel_elated_get_title_tag( true )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$instance['image_proportions']        = 'square';

		if ($instance['number_of_columns'] == '') {
			$instance['number_of_columns'] = 'four';
		}
		
		// Filter out all empty params
		$instance         = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		$params = '';
		//generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}

		$opener_classes[] = sahel_elated_get_icon_sources_class( 'featured_project', 'eltdf-fpo-button-opener' );
		$classes = array();

        $skin = sahel_elated_options()->getOptionValue( 'featured_project_skin' );
		$classes[] = ( $skin !== '') ? 'eltdf-fpw-skin-'.$skin : '';

		?>
		<div class="widget eltdf-featured-projects-widget">
			<div class="eltdf-featured-project-opener <?php echo implode(' ', $opener_classes); ?>">
				<span class="eltdf-fpo-icon">
				<?php
					echo sahel_elated_get_icon_sources_html( 'featured_project' );
				?>
				</span>
			</div>
			<div class="eltdf-featured-project-holder <?php echo implode(' ', $classes); ?>">
				<span class="eltdf-featured-project-close">
					<?php echo sahel_elated_get_icon_sources_html( 'featured_project', true ); ?>
				</span>
                <div class="eltdf-fp-holder-table">
                    <div class="eltdf-fp-holder-table-cell">
                        <?php
                            echo do_shortcode( "[eltdf_portfolio_list $params]" ); // XSS OK
                        ?>
                    </div>
                </div>
			</div>
		</div>
		<?php
	}
}