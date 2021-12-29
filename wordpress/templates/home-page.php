<?php
//Template Name: Главная

    get_header();
    if(get_field('main_home_slider')):
        $i = 0; ?>
        <div class="main-home-slider">
        <?php while(has_sub_field('main_home_slider')):
            $img = get_sub_field('background'); ?>
            <div class="main-home-wrapper" style="background: url(<?php echo $img['url'] ?>) no-repeat center center">
                <div class="main-home">
                    <div class="container">
                        <div class="main-home-heading">
                            <?php the_sub_field('heading'); ?>
                        </div>
                        <div class="main-home-request">
                            <a href="#request" class="btn request">Перезвоните мне</a>
                        </div>
                        <?php if(get_sub_field('advantages')): ?>
                            <div class="main-home-advantages">
                                <?php while(has_sub_field('advantages')): ?>
                                <div class="main-home-advantages-card">
                                    <?php $img = get_sub_field('img'); ?>
                                    <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                                    <p><?php echo get_sub_field('text'); ?></p>
                                </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                        <?php $car = get_sub_field('graphic_img');
                        if($car): ?>
                            <div class="main-home-graphic">
                                <img src="<?php echo $car['url']; ?>" alt="<?php echo $car['alt']; ?>">
                            </div>
                        <?php endif;  ?>
                    </div>
                </div>
            </div>
    <?php   endwhile; ?>
            </div>
    <?php endif; ?>

    <div class="category-list">
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
    <?php $tariffs = get_field('tariffs_ID', 'options');
    if($tariffs): ?>
        <div class="tariffs">
            <div class="container">
                <div class="heading">
                    <h2>Цены на переезд под ключ</h2>
                    <a href="<?php echo get_page_link($tariffs); ?>" class="show-all">Весь прайс</a>
                </div>
                <div class="tariffs-container">
                    <?php if(get_field('tariffs', $tariffs)):
                        while(has_sub_field('tariffs', $tariffs)): ?>
                            <?php get_template_part('template-parts/tariffs-card'); ?>
                        <?php endwhile;
                    endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(get_field('our_adv')): ?>
    <div class="advantages">
        <div class="container">
            <div class="heading">
                <h2>Наши преимущества</h2>
            </div>
            <div class="advantages-container">
                <?php while(has_sub_field('our_adv')): ?>
                <div class="advantages-card">
                    <div class="advantages-card-container">
                        <?php $img = get_sub_field("img"); ?>
                        <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                        <?php echo get_sub_field('text'); ?>
                    </div>
                    <?php if(get_sub_field('notify')):
                        while(has_sub_field('notify')): ?>
                            <div id="<?php the_sub_field('id'); ?>" class="advantages-card-hinit">
                                <div class="advantages-card-hinit-container">
                                    <?php the_sub_field('text'); ?>
                                </div>
                            </div>
                        <?php endwhile;
                        endif; ?>
                </div>
                <?php endwhile;?>
            </div>
            <div class="advantages-graphic"></div>
        </div>
    </div>
    <?php endif; ?>

    <?php get_template_part('template-parts/catalog', 'items', ['posts_per_page' => 12, 'heading' => 'Упаковочный материал', 'class' => 'popular-items']) ?>

    <?php
    $about_company = get_field('about_company_ID', 'options');
    if($about_company): ?>
        <div class="about-company">
            <div class="container">
                <div class="about-company-advantages">
                    <?php if(get_field('adv', $about_company)): ?>
                        <?php while(has_sub_field('adv', $about_company)): ?>
                            <div class="about-company-advantages-card">
                                <?php $img = get_sub_field('img');
                                if($img): ?>
                                    <div class="about-company-advantages-img">
                                        <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                                    </div>
                                <?php endif;
                                if(get_sub_field('text')): ?>
                                    <div class="about-company-advantages-content">
                                        <p><?php the_sub_field('text'); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="about-company-content">
                    <?php echo get_field('home_text', $about_company); ?>
                    <a href="<?php echo get_page_link($about_company); ?>" class="btn">Подробнее</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="contact-form">
        <div class="container">
            <div class="heading">
                <h2>Рассчитайте стоимость переезда</h2>
            </div>
            <div class="contact-form-container">
                <?php echo do_shortcode('[contact-form-7 id="154" title="Рассчитать стоимость переезда"]'); ?>
            </div>
            <div class="contact-form-graphic"></div>
        </div>
    </div>
    <?php get_template_part('template-parts/stocks', 'content'); ?>
    <?php get_template_part('template-parts/request', 'form', ['heading' => 'Закажите обратный звонок и получите скидку -10% на переезд под ключ', 'subheading' => 'Наш менеджер свяжется с вами для расчета стоимости']); ?>
    <?php if(get_field('car_slider')): ?>
    <div class="our-car">
        <div class="container">
            <div class="heading">
                <h2>Наш автопарк</h2>
                <a href="<?php echo get_category_link(get_field('car_cat', 'options')); ?>" class="show-all">Весь автопарк</a>
            </div>
            <div class="our-car-slider">
                <?php while(has_sub_field('car_slider')):
                    $post_id = get_sub_field('post_id'); ?>
                    <div class="our-car-slide">
                        <div class="our-car-slide-container">
                            <h3><?php echo get_the_title($post_id); ?></h3>
                            <div class="our-car-img">
                                <?php echo get_the_post_thumbnail($post_id); ?>
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
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if(get_field('reviews_slider')): ?>
    <div class="reviews">
        <div class="container">
            <div class="heading">
                <h2>Отзывы</h2>
            </div>
            <div class="reviews-slider">
                <?php while(has_sub_field('reviews_slider')): ?>
                <div class="reviews-slide">
                    <div class="reviews-slide-container">
                        <?php if(get_sub_field('title')) : ?>
                            <h3><?php the_sub_field('title'); ?></h3>
                        <?php endif; ?>
                        <?php the_sub_field('text'); ?>
                        <?php if(get_sub_field('author')): ?>
                            <div class="author">
                                <?php the_sub_field('author'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

<?php
get_footer();
