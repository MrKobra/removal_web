<div class="request-form">
    <div class="container">
        <div class="request-form-container">
            <div class="request-form-heading">
                <?php
                    if($args['heading']) {
                        ?>
                        <h2><?php echo $args['heading']; ?></h2>
                        <?php
                    }
                    if($args['subheading']) {
                        ?>
                        <p><?php echo $args['subheading']; ?></p>
                        <?php
                    }
                ?>
            </div>
            <?php echo do_shortcode('[contact-form-7 id="155" title="Форма обратной связи"]'); ?>
            <div class="warning">
                Нажимая кнопку, вы соглашаетесь с <a href="<?php echo get_page_link(3); ?>">условиями о передаче данных</a>
            </div>
        </div>
    </div>
</div>