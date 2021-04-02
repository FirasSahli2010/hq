<div <?php sahel_elated_class_attribute($holder_classes); ?>>
    <div class="eltdf-esc-outer-holder">
    <?php if(!empty($carousel_items)) { ?>
		<div class="eltdf-esc-prev-trigger"></div>
		<div class="eltdf-esc-next-trigger"></div>
		<div class="eltdf-esc-inner">
			<?php $i = 1; ?>
	            <?php foreach($carousel_items as $item):
                    $style = '';
                    if (isset($item['item_title_color'])) {
	                    $style .= 'color: '.$item['item_title_color'];
                    }
                    ?>
	            	<div class="eltdf-esc-item" data-index="<?php echo esc_attr($i); ?>">
	            		<div class="eltdf-esc-item-text-holder">
                            <?php if ($item['item_link'] !== '') { ?>
                                <a class="eltdf-esc-link" href="<?php echo esc_url($item['item_link']);?>" target="<?php echo esc_attr($items_link_target);?>"></a>
                            <?php } ?>
	            			<div class="eltdf-esc-item-text-holder-inner">
		            			<div class="eltdf-esc-item-text-holder-table">
			            			<div class="eltdf-esc-item-text-holder-cell">
				                		<?php if(!empty($item['item_title'])) { ?>
					                		<div class="eltdf-esc-item-title-holder">
                                                <h1 class="eltdf-esc-item-title" <?php sahel_elated_inline_style($style);?>><?php echo esc_attr($item['item_title']); ?></h1>
					                		</div>
				                		<?php } ?>
				                	</div>
			                	</div>
		                	</div>
		            	</div>
		            	<div class="eltdf-esc-item-image-holder">
			            	<?php 
			                	$bgrnd_img_style = '';

			            		if(!empty($item['item_image'])) {
			                		$bgrnd_img_style .= "background-image: url(" . wp_get_attachment_url($item['item_image']) . ");"; 
			                	}
			            	?>
		            		<div class="eltdf-esc-item-image" <?php echo sahel_elated_get_inline_style($bgrnd_img_style); ?>></div>
		            	</div>
	            	</div>
            	<?php $i++; ?>
            <?php endforeach; ?>
		</div>
        <?php if ($enable_navigation == 'yes') { ?>
            <div class="eltdf-esc-nav" <?php sahel_elated_inline_style($nav_style)?>>
                <span class="eltdf-esc-nav-prev lnr lnr-arrow-left"></span>
                <span class="eltdf-esc-nav-next lnr lnr-arrow-right"></span>
            </div>
        <?php } ?>
    <?php } ?>
    </div>
</div>