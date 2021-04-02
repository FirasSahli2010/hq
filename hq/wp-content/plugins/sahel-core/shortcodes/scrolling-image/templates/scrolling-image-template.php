<div class="eltdf-scrolling-image-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="eltdf-si-inner">
        <?php if (!empty($custom_link)) : ?>
    	            <a itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>"></a>
        <?php endif; ?>
        <div class="eltdf-si-frame">
            <img 
                src="<?php echo SAHEL_CORE_SHORTCODES_URL_PATH ?>/scrolling-image/assets/img/scrolling-image-frame.png" 
                alt="<?php esc_attr_e('Scrolling Image Frame', 'sahel-core') ?>" />
        </div>
        <div class="eltdf-si-wrapper">
            <?php echo wp_get_attachment_image($image['image_id'], 'full', "", ["class" => "eltdf-scrolling-image"] ); ?>
        </div>
    </div>
    <div class="eltdf-si-text-holder">
        <?php if (!empty($title)) : ?>
            <h6 class="eltdf-si-title" <?php echo sahel_elated_get_inline_style($title_styles); ?>>
                <?php if (!empty($custom_link)) : ?>
	                <a itemprop="url" href="<?php echo esc_url($custom_link); ?>" target="<?php echo esc_attr($custom_link_target); ?>">
                <?php endif; ?>
                    <?php echo esc_html($title); ?>
                <?php if (!empty($custom_link)) : ?>
	                </a>
                <?php endif; ?>
            </h6>
        <?php endif; ?>
    </div>
</div>