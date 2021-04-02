<div class="eltdf-eh-item <?php echo esc_attr($holder_classes); ?>" <?php echo sahel_elated_get_inline_style($holder_styles); ?> <?php echo sahel_elated_get_inline_attrs($holder_data); ?>>
	<div class="eltdf-eh-item-inner">
		<div class="eltdf-eh-item-content <?php echo esc_attr($holder_rand_class); ?>" <?php echo sahel_elated_get_inline_style($content_styles); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
    <?php if ($link !== '') { ?>
        <a href="<?php echo esc_url($link) ?>" class="eltdf-eh-link" target="<?php echo esc_attr($target)?>"></a>
    <?php } ?>
</div>