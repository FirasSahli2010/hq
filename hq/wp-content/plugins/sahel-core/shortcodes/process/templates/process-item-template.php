<div class="eltdf-process-item <?php echo esc_attr( $holder_classes ); ?>">
	<div class="eltdf-pi-content">
        <?php if(!empty($process_image)){?>
            <div class="eltdf-pi-image-holder" <?php echo sahel_elated_get_inline_style($image_styles);?>>
                <img src="<?php echo esc_url($process_image);?>" alt="<?php esc_attr_e('Process image', 'sahel-core'); ?>" />
            </div>
        <?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="eltdf-pi-title" <?php echo sahel_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="eltdf-pi-text" <?php echo sahel_elated_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>