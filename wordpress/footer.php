<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package removal
 */

?>

<footer class="main-footer">
    <div class="container">
        <div class="main-footer-container">
            <div class="main-footer-social">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>">
                        <?php $logo = get_field('logo_light', 'options'); ?>
                        <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                    </a>
                </div>
                <ul>
                    <?php if(get_field('telegram_link', 'options')): ?>
                    <li>
                        <a href="<?php the_sub_field('telegram_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/telegram.png" alt=""></a>
                    </li>
                    <?php endif;
                    if(get_field('instagram_link', 'options')): ?>
                    <li>
                        <a href="<?php the_field("instagram_link", 'options'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/instagram.png" alt=""></a>
                    </li>
                    <?php endif;
                    if(get_field('whatsapp_link', 'options')): ?>
                    <li>
                        <a href="<?php the_field('whatsapp_link', 'options'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/whatsapp-small.png" alt=""></a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
            <nav class="main-footer-nav">
                <?php
                wp_nav_menu( [
                    'theme_location'  => 'menu',
                    'container'       => '',
                    'items_wrap'      => '<ul>%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => '',
                ] );
                ?>
            </nav>
            <div class="main-footer-contact">
                <?php if(get_field('telephone_number', 'options')): ?>
                <div class="main-footer-phone">
                    <?php the_field('telephone_number', 'options'); ?>
                </div>
                <?php endif;
                if(get_field('email', 'options')): ?>
                <div class="main-footer-mail">
                    <?php the_field('email', 'options')?>
                </div>
                <?php endif; ?>
                <?php if(get_field('address', 'options')): ?>
                <div class="main-footer-address">
                    <p><?php the_field('address','options'); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if(get_field('site_copy', 'options')): ?>
        <div class="main-footer-copy">
            <?php the_field('site_copy', 'options'); ?>
        </div>
        <?php endif; ?>
    </div>
</footer>

<div class="request-popup" id="request">
    <div class="request-popup-content">
        <div class="form-heading">
            <p>Пожалуйста, оставьте ваше имя и телефон, мы перезвоним вам в течение 5 минут</p>
        </div>
        <?php echo do_shortcode('[contact-form-7 id="158" title="Форма обратной связи (попап)"]'); ?>
        <div class="warning">
            Нажимая кнопку, вы соглашаетесь с <a href="<?php echo get_page_link(3); ?>">условиями о передаче данных</a>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
<script src="//code-ya.jivosite.com/widget/bICZbwGGFw" async></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(85176685, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/85176685" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
