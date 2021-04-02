<div class="eltdf-testimonials-holder clearfix <?php echo esc_attr($holder_classes); ?>">
    <div class="eltdf-testimonials eltdf-owl-slider" <?php echo sahel_elated_get_inline_attrs( $data_attr ) ?>>

    <?php if ( $query_results->have_posts() ):
        while ( $query_results->have_posts() ) : $query_results->the_post();
            $title    = get_post_meta( get_the_ID(), 'eltdf_testimonial_title', true );
            $text     = get_post_meta( get_the_ID(), 'eltdf_testimonial_text', true );
            $author   = get_post_meta( get_the_ID(), 'eltdf_testimonial_author', true );
            $position = get_post_meta( get_the_ID(), 'eltdf_testimonial_author_position', true );

            $current_id = get_the_ID();
    ?>

            <div class="eltdf-testimonial-content" id="eltdf-testimonials-<?php echo esc_attr( $current_id ) ?>">
                <div class="eltdf-testimonial-text-holder">
                    <div class="eltdf-testimonials-separator">
                        <span class="eltdf-testimonials-separator-line"></span>
                        <span class="eltdf-testimonials-separator-line"></span>
                    </div>
                    <?php if ( ! empty( $title ) ) { ?>
                        <h1 itemprop="name" class="eltdf-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h1>
                    <?php } ?>
                    <?php if ( ! empty( $text ) ) { ?>
                        <p class="eltdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
                    <?php } ?>
                    <?php if ( ! empty( $author ) ) { ?>
                        <p class="eltdf-testimonial-author">
                            <span class="eltdf-testimonials-author-name"><?php echo esc_html( $author ).","; ?></span>
                            <?php if ( ! empty( $position ) ) { ?>
                                <span class="eltdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
                            <?php } ?>
                        </p>
                    <?php } ?>
                </div>
            </div>

    <?php
        endwhile;
    else:
        echo esc_html__( 'Sorry, no posts matched your criteria.', 'sahel-core' );
    endif;

    wp_reset_postdata();
    ?>

    </div>
</div>