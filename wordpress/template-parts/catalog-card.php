<?php
global $product;
?>
<div class="items-card">
    <div class="items-card-container">
        <div class="items-card-img">
            <?php the_post_thumbnail(); ?>
        </div>
        <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php if($product->get_attribute('dlina') && $product->get_attribute('shirina') && $product->get_attribute('vysota')) {
            ?>
            <div class="items-card-size">
                Размер (д/ш/в): <?php echo $product->get_attribute('dlina').'*'.$product->get_attribute('shirina').'*'.$product->get_attribute('vysota').' мм'; ?>
            </div>
            <?php
        } ?>
        <div class="items-card-btn_wrapper">
            <div class="items-card-price">
                <p>Цена:</p>
                <strong><?php echo format_price($product->get_price()); ?></strong>
            </div>
            <div class="items-card-btn">
                <a href="<?php the_permalink(); ?>" class="btn">Подробнее</a>
            </div>
        </div>
    </div>
</div>