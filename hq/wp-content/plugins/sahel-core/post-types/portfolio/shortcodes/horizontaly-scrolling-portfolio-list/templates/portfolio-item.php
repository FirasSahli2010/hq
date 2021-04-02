<article class="eltdf-hspl-item <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>">
    <div class="eltdf-hspl-item-inner">
        <div class="eltdf-hspl-item-holder-inner">
            <?php echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/image', '', $params); ?>
            <div class="eltdf-hspl-item-title-holder">
                <?php echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/title', '', $params); ?>
            </div>
            <div class="eltdf-hspli-category-side-holder">
                <?php echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/category', '', $params); ?>
            </div>
            <a itemprop="url" class="eltdf-hspli-link" href="<?php echo esc_url( $this_object->getItemLink($params) ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget($params) ); ?>"></a>
        </div>
    </div>
</article>