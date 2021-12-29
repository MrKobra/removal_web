<div class="tariffs-card">
    <div class="tariffs-card-container">
        <?php if(get_sub_field('title')): ?>
            <h3><?php the_sub_field('title'); ?></h3>
        <?php endif;
        if(get_sub_field('price')): ?>
            <div class="price">
                <?php the_sub_field('price'); ?>
            </div>
        <?php endif; ?>
        <?php the_sub_field('text'); ?>
        <div class="request-btn">
			<a href="https://wapp.click/79771188483" class="btn ">Заказать переезд</a>
            <!--<a href="#request" data-marks="<?php the_sub_field('title'); ?>" class="btn request">Заказать переезд</a>-->
        </div>
    </div>
</div>