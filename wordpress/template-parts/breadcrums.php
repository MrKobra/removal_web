<div class="breadcrumbs">
    <div class="container">
        <ul>
            <?php if(!is_front_page()){ ?>
                <li><a href="#">Главная</a><span>></span></li>
            <?php } ?>
            <?php if(is_archive()){ ?>
                <li><?php the_archive_title(); ?></li>
            <?php }?>
        </ul>
    </div>
</div>