<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
$exclude = ['min_price', 'max_price', 'count', 'page', 'length', 'width', 'height', 'stock_status'];
?>
    <div class="catalog">
        <div class="container catalog-wrapper">
            <div class="catalog-container">
                <?php
                $offset = 0;
                $post_count = 15;
                if(isset($_GET['count'])) {
                    $post_count = $_GET['count'];
                }
                if(isset($_GET['page'])) {
                    $offset = $_GET['page'] * $post_count - $post_count;
                }
                $query_args = array(
                    'post_type' => array('product'),
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
                    'tax_query' => array(),
                    'meta_query' => array(
                        'relation' => 'AND'
                    )
                );

                if(is_tax()) {
                    array_push($query_args['tax_query'], [
                        'taxonomy' => 'product_cat',
                        'field' => 'id',
                        'terms' => get_queried_object()->term_id
                    ]);
                }
                $sidebar_args = $query_args;
                $query_args['posts_per_page'] = $post_count;
                $query_args['offset'] = $offset;
                if(isset($_GET['max_price'])) {
                    array_push($query_args['meta_query'], [
                        'key' => '_price',
                        'value' => array($_GET['min_price'], $_GET['max_price']),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'
                    ]);
                }
                foreach($_GET as $key => $value) {
                    if(!in_array($key, $exclude)) {
                        if(taxonomy_exists('pa_'.$key)) {
                            array_push($query_args['tax_query'], [
                                'taxonomy' => 'pa_' . $key,
                                'field' => 'id',
                                'terms' => explode(',', $value),
                            ]);
                        }
                    }
                }
                if(isset($_GET['width'])) {
                    array_push($query_args['tax_query'], [
                        'taxonomy' => 'pa_shirina',
                        'field' => 'id',
                        'terms' => explode(',', $_GET['width']),
                    ]);
                }
                if(isset($_GET['height'])) {
                    array_push($query_args['tax_query'], [
                        'taxonomy' => 'pa_vysota',
                        'field' => 'id',
                        'terms' => explode(',', $_GET['height']),
                    ]);
                }
                if(isset($_GET['length'])) {
                    array_push($query_args['tax_query'], [
                        'taxonomy' => 'pa_dlina',
                        'field' => 'id',
                        'terms' => explode(',', $_GET['length']),
                    ]);
                }
                if(isset($_GET['stock_status'])) {
                    array_push($query_args['meta_query'], [
                        'key' => '_stock_status',
                        'value' => $_GET['stock_status'],
                        'compare' => 'IN'
                    ]);
                }
                if(isset($_GET['sort'])) {
                    if($_GET['sort'] == 'popular') {
                        $query_args['meta_key'] = 'total_sales';
                        $query_args['orderby'] = 'meta_value_num';
                    } else {
                        $query_args['meta_key'] = '_price';
                        $query_args['orderby'] = 'meta_value_num';
                        $query_args['order'] = $_GET['sort'];
                    }
                }
                query_posts($query_args);
                global $wp_query;
                if (have_posts()) {

                    /**
                     * Hook: woocommerce_before_shop_loop.
                     *
                     * @hooked woocommerce_output_all_notices - 10
                     * @hooked woocommerce_result_count - 20
                     * @hooked woocommerce_catalog_ordering - 30
                     */
                    do_action( 'woocommerce_before_shop_loop' );

                    get_template_part('template-parts/sort', 'block');

                    woocommerce_product_loop_start();
                    while(have_posts()) {
                        the_post();
                        get_template_part('template-parts/catalog', 'card');
                    }

                    woocommerce_product_loop_end(); ?>

                    <div class="catalog-page-nav">
                        <?php get_template_part('template-parts/post', 'count'); ?>
                        <?php get_template_part('template-parts/post', 'nav', ['count' => $post_count, 'max_page' => $wp_query->found_posts]); ?>
                    </div>
                    <?php

                } else {
                    /**
                     * Hook: woocommerce_no_products_found.
                     *
                     * @hooked wc_no_products_found - 10
                     */
                    do_action( 'woocommerce_no_products_found' );
                }

                ?>
            </div>
            <?php
            /**
             * Hook: woocommerce_sidebar.
             *
             * @hooked woocommerce_get_sidebar - 10
             */
            do_action( 'woocommerce_sidebar' );
            get_sidebar('', ['query' => $sidebar_args]);

            ?>
        </div>
        <?php get_template_part('template-parts/stocks', 'content'); ?>
        <?php get_template_part('template-parts/request', 'form', ['heading' => 'Закажите обратный звонок и получите скидку -10% на переезд под ключ', 'subheading' => 'Наш менеджер свяжется с вами для расчета стоимости']); ?>
    </div>
<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
