<?php
// Обновление цены
add_action('wp_ajax_update_price', 'item_update_price');
add_action('wp_ajax_nopriv_update_price', 'item_update_price');

function item_update_price(){
    check_ajax_referer( 'myajax-nonce', 'nonce_code' );

    $quantity = $_POST['quantity'];
    $product_id = $_POST['id'];

    $price = get_current_price($product_id, $quantity);

    echo json_encode(format_price($price * $quantity));
    wp_die();
}

// Обновление итоговой стоимости
add_action('wp_ajax_update_total', 'cart_update_total');
add_action('wp_ajax_nopriv_update_total', 'cart_update_total');

function cart_update_total(){
    check_ajax_referer( 'myajax-nonce', 'nonce_code' );
    $total = 0;

    $items = $_POST['items'];
    $items = explode(',', $items);

    foreach($items as $item) {
        $str = explode('=', $item);

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
            if($product_id == $str[0]) {
                WC()->cart->set_quantity($cart_item_key, $str[1]);
            }
        }

        $total += get_current_price($str[0], $str[1]) * $str[1];
    }

    echo json_encode(format_price($total));
    wp_die();
}

// Установка цены за доставку
add_action('wp_ajax_set_delivery_cost', 'set_delivery_cost');
add_action('wp_ajax_nopriv_set_delivery_cost', 'set_delivery_cost');

function set_delivery_cost(){
    check_ajax_referer( 'myajax-nonce', 'nonce_code' );
    WC()->session->set( 'delivery_radio', $_POST['delivery'] );
    wp_die();
}