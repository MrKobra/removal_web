<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package removal
 */

get_header();
get_template_part('template-parts/breadcrumbs');
if(have_posts()):
    the_post();
?>

    <div class="removal-kind">
        <div class="container">
            <div class="heading">
                <h2><?php the_title(); ?></h2>
            </div>
            <div class="removal-kind-content">
                <?php the_content(); ?>
            </div>
            <?php if(get_field('price_card')): ?>
            <div class="removal-cost">
                <?php if(get_field('block_heading')): ?>
                <h3><?php the_field('block_heading'); ?></h3>
                <?php endif; ?>
                <div class="removal-cost-container">
                    <?php while(has_sub_field('price_card')):
                        if(get_sub_field('block_type') == 'card'){ ?>
                        <div class="removal-cost-card">
                            <div class="removal-cost-card-container">
                                <div class="removal-cost-card-content">
                                    <h4><?php the_sub_field('heading'); ?></h4>
                                    <?php if(get_sub_field('price')): ?>
                                    <div class="price">
                                        <?php the_sub_field('price'); ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php the_sub_field('text'); ?>
                                </div>
                                <div class="removal-cost-card-btn">
                                    <a href="#request" data-marks="<?php the_sub_field('heading'); ?>" class="btn request">Заказать переезд</a>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="removal-cost-text">
                            <?php the_sub_field('text'); ?>
                        </div>
                        <?php } ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if(get_field('gallery')): ?>
            <div class="removal-gallery">
                <?php while(has_sub_field('gallery')):
                    $img = get_sub_field('img'); ?>
                    <div class="removal-gallery-card" style="background: url(<?php echo $img['url']; ?>)"></div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php
endif;

get_template_part('template-parts/request', 'form', ['heading' => 'Пригласить в тендер', 'subheading' => 'Вызвать менеджера на оценку переезда']);

get_footer();
