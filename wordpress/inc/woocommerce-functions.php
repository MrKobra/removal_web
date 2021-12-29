<?php
// Форматирование цены товара
function format_price($num) {
    $price = number_format((float)$num, 0, '', ' ');
    $price = $price.' ₽';
    return $price;
}

function get_current_price($product_id, $quantity) {
    $price = 0;
    if(get_field('item_price', $product_id)) {
        $i = 0;
        while(has_sub_field('item_price', $product_id)) {
            if($quantity >= (int)get_sub_field('start')) {
                $i++;
                $_price = (int)get_sub_field('price');
                if($i == 1 || $price > $_price) {
                    $price = $_price;
                }
            }
        }
    }
    return $price;
}

function get_current_cost_delivery($total) {
    $cost = 0;
    if(get_field('price_delivery', 'options')) {
        $i = 0;
        while(has_sub_field('price_delivery', 'options')) {
            $i++;
            $_cost = (int)get_sub_field('cost');
            if($total >= (int)get_sub_field('lower_range')) {
                if($i == 1 || $cost > $_cost) {
                    $cost = $_cost;
                }
            }
        }
    }
    return $cost;
}

function get_boundary_price($query_args) {
    $max = 0;
    $min = 0;
    $query = new WP_Query($query_args);
    if($query->have_posts()) {
        $i = 0;
        while($query->have_posts()) {
            $i++;
            $query->the_post();
            global $product;
            if($i == 1) {
                $max = (int)$product->get_price();
                $min = (int)$product->get_price();
            } else {
                if($max < (int)$product->get_price()) {
                    $max = (int)$product->get_price();
                }
                if($min > (int)$product->get_price()) {
                    $min = (int)$product->get_price();
                }
            }
        }
        return [$min, $max];
    } else {
        return [0, 0];
    }
}

function get_boundary_attribute($query_args, $attribute_name) {
    $query = new WP_Query($query_args);
    $all_value = [];
    $result = [];
    if($query->have_posts()) {
        $i = 0;
        while($query->have_posts()) {
            $i++;
            $query->the_post();
            global $product;
            $all_value[$product->get_attributes()[$attribute_name]['options'][0]] = (int)$product->get_attribute($attribute_name);
        }
        $min = min($all_value);
        $max = max($all_value);
        foreach ($all_value as $key => $value) {
            if($value <= $max && $value >= $min) {
                $result[$key] = $value;
            }
        }
        return [min($all_value), max($all_value), $result];
    } else {
        return [0, 0, [0]];
    }
}

function get_key($array, $name) {
    $result = 0;
    foreach($array as $key => $value) {
        if($name == $value) {
            $result = $key;
            break;
        }
    }
    return $result;
}

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'custom_loop_item_thumbnail', 10);
function custom_loop_item_thumbnail() {
    ?>
    <div class="items-card-img">
        <?php echo woocommerce_get_product_thumbnail(); ?>
    </div>
    <?php
}
remove_action('woocommerce_template_loop_rating', 'woocommerce_after_shop_loop_item_title', 5);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
//remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices' );
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
remove_action('woocommerce_checkout_terms_and_conditions','wc_checkout_privacy_policy_text', 20);

add_filter( 'wc_add_to_cart_message_html', 'add_to_cart_msg', 10, 3 );
function add_to_cart_msg( $message, $products, $show_qty ) {
    return 'Вы успешно отложили товар в <a href="'.wc_get_cart_url().'">корзину</a>';
}
/*
add_action('woocommerce_before_checkout_form', 'change_notice_wrapper', 20);
function change_notice_wrapper() {
    ?>
    <script>
        if($('.notice-wrapper').length != 0) {
            var elem = $('.woocommerce-notices-wrapper').not('.notice-wrapper .woocommerce-notices-wrapper');
            $('.notice-wrapper .woocommerce-notices-wrapper').html(elem.html());
            elem.remove();
        }
    </script>
    <?php
} */

// Скидка в зависимости от количества
add_action( 'woocommerce_before_calculate_totals', 'quantity_price' );
function quantity_price( $cart_object ) {

    foreach ( $cart_object->get_cart() as $cart_id => $cart_item ) {

        $new_price = get_current_price($cart_item['product_id'], $cart_item['quantity']);

        $cart_item['data']->set_price( $new_price );

    }

}

// Стоимость доставки
add_action( 'woocommerce_cart_calculate_fees', 'delivery_set_cost', 25 );
function delivery_set_cost($cart) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
        return;
    }

    $value = WC()->session->get( 'delivery_radio' );

    $total = 0;
    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        $total  += get_current_price($_product->get_ID(), $cart_item['quantity']) * $cart_item['quantity'];
    }

    if($value == 'delivery') {
        $cost = get_current_cost_delivery($total);
        $cart->add_fee('Доставка', (int)$cost);
    } else {
        $cart->add_fee('Доставка', 0);
    }
}
