<?php

namespace WC\AU;

class Frontend{

     public function __construct() {
        // Enqueue custom script
        add_action('wp_enqueue_scripts', array($this, 'enqueue_custom_scripts'));
        // Handle AJAX request
        add_action('wp_ajax_update_cart_quantity', array($this, 'update_cart_quantity'));
        add_action('wp_ajax_nopriv_update_cart_quantity', array($this, 'update_cart_quantity'));
    }

    // Enqueue the custom JS script
    public function enqueue_custom_scripts() {
        if (is_product()) {
            wp_enqueue_script('wc-auto-update-cart', WCAU_URL . '/assets/js/wc-auto-update-cart.js', array('jquery'), '1.0', true);
            wp_localize_script('wc-auto-update-cart', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
        }
    }    

    // Handle the AJAX request to update the cart
    public function update_cart_quantity() {
        if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
            $product_id = intval($_POST['product_id']);
            $quantity = intval($_POST['quantity']);

            // Search for the cart item based on product ID
            $cart_item_key = WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product_id));

            if ($cart_item_key) {
                // Update the quantity if product already in cart
                if ($quantity > 0) {
                    WC()->cart->set_quantity($cart_item_key, $quantity);
                } else {
                    // Remove product if quantity is 0
                    WC()->cart->remove_cart_item($cart_item_key);
                }
            } else {
                // Add product to cart if not already added
                WC()->cart->add_to_cart($product_id, $quantity);
            }

            wp_send_json_success();
        }

        wp_send_json_error();
    }

    
}
