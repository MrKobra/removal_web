<?php
$class = '';
if(isset($args['class'])) {
    $class = $args['class'];
}
?>
<div class="items <?php echo $class; ?>">
    <div class="container">
        <?php if(isset($args['heading'])): ?>
            <div class="heading">
                <h2><?php echo $args['heading'] ?></h2>
                <?php if(is_front_page()): ?>
                    <div class="more-link">
                        <a href="<?php echo get_page_link(get_field('shop_page','options')) ?>">Смотреть весь каталог</a>
                    </div>
                <?php endif ?>
            </div>
        <?php endif ?>

        <?php
        $query_args = array(
            'post_type' => array('product'),
            'post_status' => 'publish',
            'posts_per_page' => 4,
            'tax_query' => array()
        );
        if(isset($args['posts_per_page'])) {
            $query_args['posts_per_page'] = $args['posts_per_page'];
        }
        if(isset($args['kind'])) {
            if($args['kind'] == 'popular') {
                $query_args['meta_key'] = 'total_sales';
                $query_args['orderby'] = 'meta_value_num';
            }
        }
        if(isset($args['orderby'])) {
            $query_args['orderby'] = $args['orderby'];
        }
        if(isset($args['cat'])) {
            $query_args['post__not_in'] = array(get_the_ID());
            array_push($query_args['tax_query'], [
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $args['cat']
            ]);
        }
        $query = new WP_Query($query_args);
        if($query->have_posts()):
            ?>
            <div class="items-container">
                <?php while($query->have_posts()) {
                    $query->the_post();
                    get_template_part('template-parts/catalog', 'card');
                } ?>
            </div>
        <?php endif;
        wp_reset_postdata(); ?>
    </div>
</div>