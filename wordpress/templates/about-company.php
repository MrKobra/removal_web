<?php
// Template Name: О компании
get_header();
get_template_part('template-parts/breadcrumbs');
?>

    <div class="about-company">
        <div class="container">
            <div class="about-company-advantages">
                <?php if(get_field('adv')): ?>
                    <?php while(has_sub_field('adv')): ?>
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
                <?php echo get_field('home_text'); ?>
            </div>
        </div>
    </div>

<?php

get_template_part('template-parts/request', 'form', ['heading' => 'Пригласить в тендер', 'subheading' => 'Вызвать менеджера на оценку переезда']);

get_footer();
