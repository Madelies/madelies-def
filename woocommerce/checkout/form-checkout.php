<?php

/**
 * Checkout Form
 */

defined('ABSPATH') || exit;

// Do not allow direct access to the checkout if cart is empty.
if (WC()->cart->is_empty() && !is_wc_endpoint_url('order-received')) {
    do_action('woocommerce_cart_is_empty');
    return;
}

// Filter hook for including new pages inside the payment method
do_action('woocommerce_checkout_before_customer_details');
?>

<div class="row" id="customer_details">
    <div class="col-lg-7">
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4"><?php esc_html_e('Billing &amp; Shipping', 'woocommerce'); ?></h3>
                <?php do_action('woocommerce_checkout_billing'); ?>
                <?php do_action('woocommerce_checkout_shipping'); ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title"><?php esc_html_e('Your order', 'woocommerce'); ?></h3>
                <?php do_action('woocommerce_checkout_before_order_review'); ?>
                
                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>
                
                <?php do_action('woocommerce_checkout_after_order_review'); ?>
            </div>
        </div>
    </div>
</div>