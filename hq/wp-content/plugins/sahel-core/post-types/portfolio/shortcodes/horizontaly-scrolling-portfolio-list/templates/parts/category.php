<?php
$item_id = $is_featured ? $featured_project : get_the_ID();
$categories = wp_get_post_terms($item_id, 'portfolio-category');

if(!empty($categories)) { ?>
    <div class="eltdf-hspli-category-holder">
        <h6 class="eltdf-hspli-category-name">
        <?php foreach ($categories as $cat) { ?>
            <a itemprop="url" class="eltdf-hspli-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
        <?php } ?>
        </h6>
    </div>
<?php } ?>