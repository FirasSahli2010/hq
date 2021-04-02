<?php
// this option doesn't exist
$show_related_posts = sahel_elated_options()->getOptionValue('portfolio_single_related_posts') == 'yes' ? true : false;

$post_id = get_the_ID();
$related_posts = sahel_core_get_portfolio_single_related_posts($post_id);
?>
<?php if($show_related_posts) { ?>
    <div class="eltdf-ps-related-posts-holder">
    	<div class="eltdf-ps-related-title-holder">
            <h3 class="eltdf-ps-related-title"><?php esc_html_e('Related projects', 'sahel-core'); ?></h3>
        </div>
        <div class="eltdf-ps-related-posts">
            <?php
	            if ( $related_posts && $related_posts->have_posts() ) :
	                while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                        <div class="eltdf-ps-related-post">
			                <?php if(has_post_thumbnail()) { ?>
		                        <div class="eltdf-ps-related-image">
			                        <a itemprop="url" href="<?php the_permalink(); ?>">
				                        <?php the_post_thumbnail('sahel_elated_image_square'); ?>
			                        </a>
			                        <div class="eltdf-ps-related-overlay">
					                	<div class="eltdf-ps-related-outer">
					                        <div class="eltdf-ps-related-text">
						                        <?php $categories = wp_get_post_terms($post_id, 'portfolio-category'); ?>
						                        <?php if(!empty($categories)) { ?>
							                        <div class="eltdf-ps-related-categories">
								                        <?php foreach ($categories as $cat) { ?>
									                        <a itemprop="url" class="eltdf-ps-related-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
								                        <?php } ?>
							                        </div>
						                        <?php } ?>
						                        <h4 itemprop="name" class="eltdf-ps-related-title entry-title">
							                        <a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						                        </h4>
					                        </div>
					                    </div>
			                        </div>
	                            </div>
			                <?php } ?>

                        </div>
	                <?php
	                endwhile;
	            endif;
            
                wp_reset_postdata();
            ?>
        </div>
    </div>
<?php } ?>
