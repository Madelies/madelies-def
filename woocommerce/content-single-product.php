<?php
/**
 * The template for displaying single product content
 */

defined('ABSPATH') || exit;

global $product;
?>

<div class="row">
    <!-- Productafbeeldingen -->
    <div class="col-md-6">
        <?php
        $image_id = $product->get_image_id();
        $gallery_images = $product->get_gallery_image_ids();
        $image_url = wp_get_attachment_image_url($image_id, 'full');
        $main_img = $image_url ?: wc_placeholder_img_src('full');
        ?>
        
        <div class="border rounded p-2 mb-3 text-center">
            <img src="<?php echo esc_url($main_img); ?>" 
                 class="main-product-image img-fluid" 
                 id="main-product-image"
                 
                 alt="<?php echo esc_attr($product->get_name()); ?>">
        </div>
        
        <?php if ($image_id || !empty($gallery_images)) : ?>
        <div class="row">
            <?php
            if ($image_id) {
                echo '<div class="col-3 mb-2"><img src="' . esc_url($main_img) . '" 
                     class="img-fluid thumbnail active border rounded p-1" 
                     data-image="' . esc_url($main_img) . '" 
                     alt="thumbnail"></div>';
            }
            
            if (!empty($gallery_images)) {
                foreach ($gallery_images as $thumb_id) {
                    $thumb_url = wp_get_attachment_image_url($thumb_id, 'thumbnail');
                    $full_url = wp_get_attachment_image_url($thumb_id, 'full');
                    
                    echo '<div class="col-3 mb-2"><img src="' . esc_url($thumb_url) . '" 
                         class="img-fluid thumbnail border rounded p-1" 
                         data-image="' . esc_url($full_url) . '" 
                         alt="thumbnail"></div>';
                }
            }
            ?>
        </div>
        <?php endif; ?>
    </div>

    <!-- Productinformatie -->
    <div class="col-md-6">
        <h1 class="display-5 mb-3 green"><?php the_title(); ?></h1>
        
        <div class="product-price h3 mb-3"><?php echo $product->get_price_html(); ?></div>
        
        <?php if ($product->get_short_description()) : ?>
        <div class="mb-4">
            <?php echo wpautop($product->get_short_description()); ?>
        </div>
        <?php endif; ?>
        
        <div class="mb-3">
            <?php if ($product->is_in_stock()) : ?>
                <span class="badge bg-success">Op voorraad</span>
            <?php else : ?>
                <span class="badge bg-danger">Uitverkocht</span>
            <?php endif; ?>
        </div>
        
        <?php if ($product->is_in_stock()) : ?>
        <form class="cart mb-4" method="post">
            <div class="row align-items-center mb-3">
                <div class="col-auto">
                    <label for="quantity" class="form-label">Aantal:</label>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary quantity-btn btn-decrease">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" class="form-control">
                        <button type="button" class="btn btn-outline-secondary quantity-btn btn-increase">+</button>
                    </div>
                </div>
            </div>
            
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" 
                    class="btn btn-primary btn-lg">In winkelwagen</button>
        </form>
        <?php endif; ?>
        
        <div class="border-top pt-3 mt-4">
            <?php if ($product->get_sku()) : ?>
            <p><strong>SKU:</strong> <?php echo esc_html($product->get_sku()); ?></p>
            <?php endif; ?>
            
            <?php
            $categories = get_the_terms($product->get_id(), 'product_cat');
            if ($categories && !is_wp_error($categories)) {
                echo '<p><strong>Categorieën:</strong> ';
                $cat_links = array();
                foreach ($categories as $category) {
                    $cat_links[] = '<a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
                }
                echo implode(', ', $cat_links) . '</p>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Gerelateerde producten -->
<?php
$related_products = array_filter(array_map('wc_get_product', wc_get_related_products($product->get_id(), 4)));

if ($related_products) : ?>
<section class="mt-5">
    <h2 class="mb-4">Gerelateerde producten</h2>
    
    <div class="row">
        <?php foreach ($related_products as $related_product) : ?>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
                <a href="<?php echo esc_url(get_permalink($related_product->get_id())); ?>" class="product-link">
                    <?php
                    $image_id = $related_product->get_image_id();
                    $image_url = $image_id ? wp_get_attachment_image_src($image_id, 'medium')[0] : wc_placeholder_img_src('medium');
                    ?>
                    <img src="<?php echo esc_url($image_url); ?>" 
                         class="card-img-top product-image p-3" 
                         alt="<?php echo esc_attr($related_product->get_name()); ?>">
                    
                    <div class="card-body">
                        <h5 class="card-title product-title"><?php echo esc_html($related_product->get_name()); ?></h5>
                        <p class="card-text product-price h6"><?php echo $related_product->get_price_html(); ?></p>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<script>
// Thumbnails functionality
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.getElementById('main-product-image');
    
    thumbnails.forEach(function(thumb) {
        thumb.addEventListener('click', function() {
            thumbnails.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            const newImageUrl = this.getAttribute('data-image');
            mainImage.src = newImageUrl;
        });
    });
    
    // Quantity buttons
    const decreaseBtn = document.querySelector('.btn-decrease');
    const increaseBtn = document.querySelector('.btn-increase');
    const quantityInput = document.getElementById('quantity');
    
    if (decreaseBtn && increaseBtn && quantityInput) {
        decreaseBtn.addEventListener('click', function() {
            let currentVal = parseInt(quantityInput.value);
            if (currentVal > 1) {
                quantityInput.value = currentVal - 1;
            }
        });
        
        increaseBtn.addEventListener('click', function() {
            let currentVal = parseInt(quantityInput.value);
            quantityInput.value = currentVal + 1;
        });
    }
});
</script>