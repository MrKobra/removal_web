<?php if(get_field('stocks_slider', get_field('home_ID', 'options'))): ?>
    <div class="stocks">
        <div class="container">
            <div class="heading">
                <h2>Акции</h2>
                <a href="<?php echo get_category_link(get_field('stocks_cat','options')); ?>" class="show-all">Все акции</a>
            </div>
            <div class="stocks-slider">
                <?php while(has_sub_field('stocks_slider', get_field('home_ID', 'options'))): ?>
                    <div class="stocks-slide">
                        <?php $img = get_the_post_thumbnail(get_sub_field('post_id')); ?>
                        <div class="stocks-slide-container">
                            <?php echo $img; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php endif; ?>