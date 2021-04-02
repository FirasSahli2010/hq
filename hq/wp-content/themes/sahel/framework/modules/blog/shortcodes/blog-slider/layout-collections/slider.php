<?php
$image_meta = get_post_meta(get_the_ID(), 'eltdf_blog_list_featured_image_meta', true);
$has_featured = !empty($image_meta) || has_post_thumbnail();
$blog_list_image_id = !empty($image_meta) && sahel_elated_blog_item_has_link() ? sahel_elated_get_attachment_id_from_url($image_meta) : '';
?>
<li class="eltdf-blog-slider-item">
    <div class="eltdf-blog-slider-item-inner">
        <?php if ($has_featured) { ?>
            <div class="eltdf-item-image">
                <?php if (sahel_elated_blog_item_has_link()) { ?>
                <a itemprop="url" href="<?php echo get_permalink(); ?>">
                    <?php } ?>
                    <?php if (!empty($blog_list_image_id)) {
                        echo wp_get_attachment_image($blog_list_image_id, $image_size);
                    } else {
                        echo get_the_post_thumbnail(get_the_ID(), $image_size);
                    } ?>
                    <?php if (sahel_elated_blog_item_has_link()) { ?>
                </a>
            <?php } ?>
            </div>
        <?php } ?>
        <div class="eltdf-item-text-wrapper">
            <div class="eltdf-item-text-holder">
                <div class="eltdf-item-text-holder-inner">
                    <?php if ($post_info_category == 'yes') {
                        sahel_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params);
                    }
                    ?>

                    <?php sahel_elated_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>

                    <?php if ($post_info_date == 'yes' || $post_info_author == 'yes') { ?>
                        <div class="eltdf-item-info-section">
                            <?php
                            if ($post_info_date == 'yes') {
                                sahel_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params);
                            }

                            if ($post_info_author == 'yes') {
                                sahel_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params);
                            }
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</li>