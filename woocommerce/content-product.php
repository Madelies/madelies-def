<?php
/**
 * The template for displaying product content within loops
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility
if (empty($product) || !$product->is_visible()) {
    return;
}
?>

<div class="col-lg-2 col-md-4 col-6 mb-4">
    <div class="card h-100 border-0">
        <div class="position-relative overflow-hidden">
            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="product-link">
                <?php
                $image_id = $product->get_image_id();
                $image_url = $image_id ? wp_get_attachment_image_src($image_id, 'large')[0] : wc_placeholder_img_src('large'); 
                ?>
                <img src="<?php echo esc_url($image_url); ?>" 
                     class="product-image img-fluid img-thumbnail" 
                     alt="<?php echo esc_attr($product->get_name()); ?>">
                
                <?php if ($product->is_on_sale()) : ?>
                    <span class="position-absolute top-0 start-0 m-2 badge bg-danger">Sale!</span>
                <?php endif; ?>
            </a>
        </div>
        <div class="card-body d-flex flex-column">
            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="product-link">
                <h5 class="card-title product-title"><?php echo esc_html($product->get_name()); ?></h5>
            </a>
            <p class="card-text product-price h5 mb-3"><?php echo $product->get_price_html(); ?></p>
        </div>
    </div>
</div>