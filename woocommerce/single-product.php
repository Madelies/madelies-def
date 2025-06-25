<?php
/**
 * The Template for displaying all single products
 */

defined('ABSPATH') || exit;

get_header();
?>

<div class="container" style="margin-top: 120px; margin-bottom: 60px;">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo esc_url(home_url()); ?>">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">Shop</a>
            </li>
            <?php
            // Product categorieën toevoegen aan breadcrumbs
            $categories = get_the_terms(get_the_ID(), 'product_cat');
            if ($categories && !is_wp_error($categories)) {
                $main_category = $categories[0]; // Neem de eerste/hoofdcategorie
                ?>
                <li class="breadcrumb-item">
                    <a href="<?php echo esc_url(get_term_link($main_category)); ?>">
                        <?php echo esc_html($main_category->name); ?>
                    </a>
                </li>
            <?php } ?>
            <li class="breadcrumb-item active" aria-current="page">
                <?php the_title(); ?>
            </li>
        </ol>
    </nav>

    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        
        <?php 
        // Gebruik onze aangepaste template
        include(get_template_directory() . '/woocommerce/content-single-product.php'); 
        ?>
        
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>