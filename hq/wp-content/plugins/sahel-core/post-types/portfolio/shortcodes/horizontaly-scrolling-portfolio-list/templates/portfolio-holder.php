<div class="eltdf-horizontaly-scrolling-portfolio-holder-outer">
    <div class="eltdf-horizontaly-scrolling-portfolio-holder <?php echo esc_attr($holder_classes); ?>" <?php echo esc_attr($holder_data);?>>
        <div class="eltdf-hspl-lines-holder">
            <?php 
                for ($i = 1; $i <= 5; $i++) {
            ?>
            <span class="eltdf-lines-col"></span>
            <?php } ?>
        </div>
        <div class="eltdf-hspl-inner">
            <?php
            $params['is_featured'] = true;
            echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'featured-project', '', $params); ?>
            <?php
                if($query_results->have_posts()):
                    while ( $query_results->have_posts() ) : $query_results->the_post();
                        $params['is_featured'] = false;
                        echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'portfolio-item', '', $params);
                    endwhile;
                else:
                    echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/posts-not-found');
                endif;

                wp_reset_postdata();
            ?>
        </div>
    </div>
</div>