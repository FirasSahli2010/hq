<li class="eltdf-bl-item eltdf-item-space">
	<div class="eltdf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			sahel_elated_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="eltdf-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="eltdf-bli-info">
	                <?php
		                if ( $post_info_category == 'yes' ) {
			                sahel_elated_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php sahel_elated_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>

            <?php if ($post_info_section == 'yes') { ?>
            <div class="eltdf-bli-info-bottom">
                <?php

                if ( $post_info_date == 'yes' ) {
                    sahel_elated_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
                }
                if ( $post_info_author == 'yes' ) {
                    sahel_elated_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
                }

                ?>
            </div>
	        <?php }?>
        </div>
	</div>
</li>