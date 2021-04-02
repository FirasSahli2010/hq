<?php if(sahel_elated_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>
    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = sahel_elated_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    $side_nav = sahel_elated_options()->getOptionValue('portfolio_single_side_nav') == 'yes';

    $side_nav_class = '';

    if ($side_nav) {
        $side_nav_class = 'eltdf-ps-navigation-floated';
    }

    ?>
    <div class="eltdf-ps-navigation <?php echo esc_attr($side_nav_class);?>">
        <?php if(get_previous_post() !== '') : ?>
            <div class="eltdf-ps-prev">
                <?php if($nav_same_category) {
	                previous_post_link('%link', esc_html__( 'previous project', 'sahel-core' ), true, '', 'portfolio-category');
                } else {
	                previous_post_link('%link', esc_html__( 'previous project', 'sahel-core' ));
                } ?>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="eltdf-ps-back-btn">
                <a itemprop="url" href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="17px" height="17px" viewBox="0 0 17 17" style="enable-background:new 0 0 17 17;" xml:space="preserve"><style type="text/css">.st0{fill:#231F20;}</style><g><rect x="9" class="st0" width="8" height="8"/><rect class="st0" width="8" height="8"/><rect x="9" y="9" class="st0" width="8" height="8"/><rect y="9" class="st0" width="8" height="8"/></g></svg>

                </a>
            </div>
        <?php endif; ?>

        <?php if(get_next_post() !== '') : ?>
            <div class="eltdf-ps-next">
                <?php if($nav_same_category) {
                    next_post_link('%link', esc_html__( 'next project', 'sahel-core' ), true, '', 'portfolio-category');
                } else {
                    next_post_link('%link', esc_html__( 'next project', 'sahel-core' ));
                } ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>