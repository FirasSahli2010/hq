<div class="eltdf-image-highlight-holder <?php echo esc_attr($holder_classes); ?>">
    <?php if ( !empty($side_text) ) { ?>
        <div class="eltdf-ih-side-text-holder">
            <span class="eltdf-ih-side-text"><?php echo esc_html($side_text); ?></span>
        </div>
    <?php } ?>
    <div class="eltdf-image-highlight-holder-inner">
        <div class="eltdf-ih-image">
            <?php  if (!empty($link)) { ?>
                <a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($link_target) ?>"></a>
            <?php } ?>
            <?php if (is_array($image_size) && count($image_size)) : ?>
                <?php echo sahel_elated_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]); ?>
            <?php else: ?>
                <?php echo wp_get_attachment_image($image['image_id'], $image_size); ?>
            <?php endif; ?>
        </div>
        <div class="eltdf-ih-text-holder" <?php echo sahel_elated_get_inline_style($text_styles); ?>>
            <?php if (!empty($subtitle)) { ?>
                <h6 class="eltdf-ih-subtitle" <?php echo sahel_elated_get_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></h6>
            <?php } ?>
            <?php if (!empty($title)) { ?>
            <<?php echo esc_attr($title_tag); ?> class="eltdf-ih-title" <?php echo sahel_elated_get_inline_style($title_styles); ?>>
                <?php  if (!empty($link)) { ?>
                    <a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($link_target) ?>">
                <?php } ?>
                <?php echo esc_html($title); ?>
                <?php  if (!empty($link)) { ?>
                    </a>
                <?php } ?>
            </<?php echo esc_attr($title_tag); ?>>
        <?php } ?>
        </div>
    </div>
</div>