<?php
// Template Name: Страница Woocommerce
get_header();

if(have_posts()) {
    the_post();
    the_content();
}

get_footer();
