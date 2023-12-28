<?php
/**
 * Plugin Name: Custom Add to Cart Text
 * Description: A simple WooCommerce plugin to change the Add to Cart button text.
 * Version: 1.0
 * Author: Moshtafizur
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/class-custom-add-to-cart-text-plugin.php';

// Instantiate the class
$custom_add_to_cart_text_plugin = new Custom_Add_to_Cart_Text_Plugin();
