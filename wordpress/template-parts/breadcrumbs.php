<div class="breadcrumbs">
    <?php /*
    <div class="container">
        <ul>
            <?php if(!is_front_page()){ ?>
                <li><a href="#">Главная</a><span>></span></li>
            <?php } ?>
            <?php if(is_archive()){ ?>
                <li><?php echo strip_tags(get_the_archive_title()); ?></li>
            <?php } else if(is_single()) {
                $cat = get_the_category();
                ?>
                <li><a href="<?php echo get_category_link($cat[0]->term_id); ?>"><?php echo $cat[0]->name; ?></a><span>></span></li>
                <li><?php the_title(); ?></li>
            <?php
            } else if(is_page()) { ?>
                <li><?php the_title(); ?></li>
            <?php } ?>
        </ul>
    </div> */ ?>
</div>