<?php
// Template Name: Тарифы
get_header();
get_template_part('template-parts/breadcrumbs');
?>

    <div class="tariffs-page">
        <div class="container">
            
            <?php if(have_posts()):
                the_post();
                if(get_field('tariffs')): ?>
                   
                <?php endif; ?>
            <div class="tariffs-page-price">
                <div class="heading">
                    <h2>Прайс на наши услуги</h2>
                </div>
                <?php the_content(); ?>
            </div>
			<div class="heading">
                <h2>Популярные тарифы</h2>
            </div>
			 <div class="tariffs-container">
                        <?php while(has_sub_field('tariffs')):
                            get_template_part('template-parts/tariffs-card');
                        endwhile; ?>
                    </div>
            <?php endif; ?>
			
        </div>
    </div>

<?php

get_template_part('template-parts/request', 'form', ['heading' => 'Пригласить в тендер', 'subheading' => 'Вызвать менеджера на оценку переезда']);

get_footer();
