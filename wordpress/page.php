<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package removal
 */

get_header();
get_template_part('template-parts/breadcrumbs');
?>

    <div class="page-template-standard">
        <div class="container">
            <div class="heading">
                <h2><?php the_title(); ?></h2>
            </div>
            <div class="page-template-standard-content">
                <?php
                    if(have_posts()) {
                        the_post();
                        the_content();
                    }
                ?>
            </div>
        </div>
    </div>

<?php
get_footer();
