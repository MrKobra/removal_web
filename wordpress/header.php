<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package removal
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <div class="loader">
        <div class="laoder-frame">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.svg" alt="" class="svg-loader">
        </div>
    </div>

    <header class="main-header <?php if(is_front_page()) { echo 'reverse absolute'; }?>">
        <div class="main-header-content">
			<div class="main-header-contact mob">
                    <?php if(get_field('whatsapp_link', 'options')): ?>
                    <div class="main-header-whatsapp">
                        <?php the_field('whatsapp_link', 'options'); ?>
                    </div>
                    <?php endif; ?>
                    <div class="main-header-phone">
                        <?php the_field('telephone_number', 'options'); ?>
                    </div>
                </div>
            <div class="container">
				
                <div class="logo">
                    <?php $logo = get_field('logo_dark', 'options'); ?>
                    <?php if($logo): ?>
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                    </a>
                    <?php endif; ?>
                </div>
                <div class="main-header-contact">
                    <div class="main-header-phone">
                        <?php the_field('telephone_number', 'options'); ?>
                        <?php the_field('work_time', 'options'); ?>
                    </div>
                    <?php if(get_field('email', 'options')): ?>
                        <div class="main-header-email">
                            <p>E-mail</p>
                            <?php the_field('email', 'options'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(get_field('mobile_tel', 'options')): ?>
                        <div class="main-header-mobilephone">
                            <?php the_field('mobile_tel', 'options'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(get_field('whatsapp_link', 'options')): ?>
                        <div class="main-header-whatsapp">
                            <p><a href="<?php the_field('whatsapp_link', 'options'); ?>">Узнать стоимость по What`s App</a></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="main-header-btn-container">
                <div class="container">
                    <div class="main-header-btn-block">
                        <span>Меню</span>
                        <div class="main-header-btn">
                            <span></span><span></span><span></span>
                        </div>
                    </div>
                    <?php removal_woocommerce_cart_link(); ?>
                </div>
            </div>
        </div>
        <nav class="main-header-nav">
            <div class="container">
                <div class="main-header-nav_container">
                    <?php
                    wp_nav_menu( [
                        'theme_location'  => 'menu',
                        'container'       => '',
                        'items_wrap'      => '<ul>%3$s</ul>',
                        'depth'           => 0,
                        'walker'          => '',
                    ] );
                    removal_woocommerce_cart_link();
                    ?>
                </div>
            </div>
        </nav>
    </header>