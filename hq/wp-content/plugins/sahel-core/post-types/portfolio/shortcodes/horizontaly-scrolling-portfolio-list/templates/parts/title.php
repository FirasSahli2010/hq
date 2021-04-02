<?php
$item_id = $is_featured ? $featured_project : get_the_ID();
$title_tag = !empty($title_tag) ? $title_tag : 'h4';
?>

<<?php echo esc_attr($title_tag); ?> itemprop="name" class="eltdf-hspli-title entry-title">
    <?php echo esc_attr(get_the_title($item_id)); ?>
</<?php echo esc_attr($title_tag); ?>>
