<?php
if ( get_post_type( $featured_project ) == 'portfolio-item') {
?>

<article class="eltdf-hspl-item eltdf-hspl-featured <?php echo esc_attr( implode(' ', get_post_class( '', $featured_project ) ) ); ?>">
	<div class="eltdf-hspl-item-inner">
        <div class="eltdf-hspl-item-holder-inner">
            <?php echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/image', '', $params); ?>

            <div class="eltdf-hspli-text-holder">
                <div class="eltdf-hspli-text-wrapper">
                    <div class="eltdf-hspli-text">
                        <?php echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/category', '', $params); ?>

                        <?php echo sahel_core_get_cpt_shortcode_module_template_part('portfolio', 'horizontaly-scrolling-portfolio-list', 'parts/title', '', $params); ?>
                    </div>
                </div>
            </div>
            <a itemprop="url" class="eltdf-hspli-link" href="<?php echo esc_url( $this_object->getItemLink($params) ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget($params) ); ?>"></a>
        </div>
	</div>
</article>
<?php } ?>