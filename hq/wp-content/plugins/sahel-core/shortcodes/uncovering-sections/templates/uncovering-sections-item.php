<li class="eltdf-uss-item <?php echo esc_attr($holder_classes); ?>" <?php echo sahel_elated_get_inline_attrs($holder_data); ?>>
    <div class="eltdf-uss-image-holder" <?php echo sahel_elated_get_inline_attrs($image_data); ?> <?php sahel_elated_inline_style($holder_styles); ?>></div>
    <div class="eltdf-uss-item-outer">
        <div class="eltdf-uss-item-inner" <?php sahel_elated_inline_style($item_inner_styles); ?>>
            <?php echo do_shortcode($content); ?>
        </div>
	</div>
	<?php if(!empty($link)) { ?>
		<a itemprop="url" class="eltdf-uss-item-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($link_target); ?>"></a>
	<?php } ?>
</li>