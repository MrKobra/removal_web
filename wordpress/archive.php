<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package removal
 */

get_header();
$term_id = get_queried_object_id();
get_template_part('template-parts/breadcrumbs');
if($term_id == get_field('stocks_cat', 'options')) {
    ?>
    <div class="stocks-page">
        <div class="container">
            <div class="heading">
                <h2>Акции</h2>
            </div>
            <div class="stocks-page-container">
                <?php if(have_posts()):
                    while(have_posts()):
                        the_post(); ?>
                            <div class="stocks-page-card">
                                <?php the_post_thumbnail(); ?>
                                <div class="stocks-page-request">
                                    <a href="#request" data-marks='Акция "<?php the_title(); ?>"' class="btn request">Заказать переезд</a>
                                </div>
                            </div>
                    <?php endwhile;
                    endif; ?>
            </div>
        </div>
    </div>
    <?php
} else if($term_id == get_field('car_cat', 'options')) {
    ?>
    <div class="our-car-page">
        <div class="container">
            <div class="heading">
                <h2>Наш автопарк</h2>
            </div>
            <div class="our-car-page-container">
                <?php
                if(have_posts()) {
                    while(have_posts()) {
                        the_post();
                        ?>
                        <div class="our-car-page-card">
                            <div class="our-car-page-card-container">
                                <h3><?php the_title(); ?></h3>
                                <div class="our-car-img">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <?php if(get_field('car_property', $post_id)): ?>
                                    <div class="our-car-property">
                                        <?php the_field('car_property', $post_id); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(get_field('car_price', $post_id)): ?>
                                    <div class="our-car-price">
                                        <?php the_field('car_price', $post_id); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if(get_field('car_pricelist', $post_id)): ?>
                                    <div class="our-car-price-list">
                                        <?php the_field('car_pricelist', $post_id); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="our-car-btn">
                                    <a href="#request" data-marks="<?php echo get_the_title($post_id); ?>" class="btn request">Заказать фургон</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php
} else if($term_id == get_field('kind_removal_cat', 'options')) {
    ?>
<div class="category-list category-list-page">
    <div class="container">
        <?php
        if(have_posts()) :
            while(have_posts()) :
                the_post();
            ?>
            <div class="category-list-card">
                <div class="category-list-card-img" style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) no-repeat center center;"></div>
                <a href="<?php the_permalink(); ?>">
                    <span><?php the_title(); ?></span>
                    <i><img src="<?php echo get_template_directory_uri(); ?>/assets/img/category-arrow.png" alt=""></i>
                </a>
            </div>
            <?php
            endwhile;
        endif;
        ?>
    </div>
</div>
<?php
}

get_template_part('template-parts/request', 'form', ['heading' => 'Пригласить в тендер', 'subheading' => 'Вызвать менеджера на оценку переезда']);

get_footer();
