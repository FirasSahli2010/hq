<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="eltdf-post-content">
        <div class="eltdf-post-text">
            <div class="eltdf-post-text-inner">
                <div class="eltdf-post-heading">
                    <?php sahel_elated_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
                </div>
                <?php sahel_elated_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
                <?php sahel_elated_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                <div class="eltdf-post-info">
                    <?php sahel_elated_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php sahel_elated_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                </div>
                <div class="eltdf-post-text-main">
                    <?php sahel_elated_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    <?php sahel_elated_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>