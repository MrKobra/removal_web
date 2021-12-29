<?php
// Template Name: Тарифы
get_header();
get_template_part('template-parts/breadcrumbs');
?>

    <div class="category-list category-list-page">
    <div class="container">
        <?php
        $posts = get_posts( array(
            'numberposts' => 3,
            'category'    => get_field('kind_removal_cat', 'options'),
            'orderby'     => 'date',
            'order'       => 'ASC',
            'post_type'   => 'post',
            'suppress_filters' => true,
        ) );

        foreach( $posts as $post ){
            setup_postdata($post);
            ?>
            <div class="category-list-card">
                <div class="category-list-card-img" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center center;"></div>
                <a href="<?php the_permalink(); ?>">
                    <span><?php the_title(); ?></span>
                    <i><img src="<?php echo get_template_directory_uri(); ?>/assets/img/category-arrow.png" alt=""></i>
                </a>
            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</div>

<?php

get_template_part('template-parts/request', 'form', ['heading' => 'Пригласить в тендер', 'subheading' => 'Вызвать менеджера на оценку переезда']);

get_footer();
