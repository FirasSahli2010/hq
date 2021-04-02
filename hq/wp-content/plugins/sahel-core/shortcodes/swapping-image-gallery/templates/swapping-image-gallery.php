<div class="eltdf-sig-holder clearfix">
    <?php if ( ! empty( $image_items ) ) { ?>
       

        <div class="eltdf-sig-info clearfix">
            <div class="eltdf-sig-headline">
                <h1><?php echo esc_html($title); ?></h1>
                <div class="eltdf-sig-description">
                    <?php echo esc_html($description); ?>
                </div>
            </div>

            <div class="eltdf-sig-thumbnails-holder clearfix">
                <?php foreach ( $image_items as $image_item ): ?>
                    <div class="eltdf-sig-thumbnail">
                        <div class="eltdf-sig-inner">
                            <?php echo wp_get_attachment_image($image_item['thumbnail'], 'full'); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

         <div class="eltdf-sig-image-holder" <?php echo sahel_elated_get_inline_attrs($slider_data); ?>>
            <?php foreach ( $image_items as $image_item ): ?>
                <?php echo wp_get_attachment_image($image_item['gallery_image'], 'full'); ?>
            <?php endforeach; ?>
        </div>

        

    <?php } ?>
</div>