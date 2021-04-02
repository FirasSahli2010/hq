<div class="eltdf-ils-holder <?php echo esc_attr( $holder_classes ); ?>">
	<?php if ( ! empty( $link_items ) ) { ?>
		<div class="eltdf-ils-image-holder" <?php sahel_elated_inline_style( $image_holder_styles ); ?>>
			<?php foreach ( $link_items as $link_item ): ?>
				<?php if ( isset( $link_item['image'] ) ) { ?>
					<?php
						$item_style   = array();
						$item_style[] = 'background-image: url(' . wp_get_attachment_url( $link_item['image'] ) . ')';
					?>
					<div class="eltdf-ils-item-image" <?php sahel_elated_inline_style( $item_style ); ?>>
						<?php echo wp_get_attachment_image( $link_item['image'], 'full' ); ?>
					</div>
				<?php } ?>
			<?php endforeach; ?>
		</div>
		<div class="eltdf-ils-content-holder">
			<div class="eltdf-ils-content-inner">
				<div class="eltdf-ils-item-content">
					<?php
						$i = 0;

						foreach ( $link_items as $link_item ): ?>
						<?php if ( isset( $link_item['title'] ) ) { ?>
							<a itemprop="url" class="eltdf-ils-item-link" data-index="<?php echo esc_attr($i); ?>" href="<?php echo esc_url( $link_item['link'] ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                               <?php if(!empty($link_item['subtitle'])){?>
                                <h6 class="eltdf-ils-item-subtitle"><?php echo esc_html( $link_item['subtitle'] ); ?></h6>
                               <?php }?>
                                <h1 class="eltdf-ils-item-title" <?php sahel_elated_inline_style( $interactive_title_styles ); ?>><?php echo esc_html( $link_item['title'] ); ?></h1>
                            </a>
						<?php
						$i++;
						} ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>