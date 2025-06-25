<?php
/**
 * The Template for displaying product archives, including the main shop page
 * Directe HTML-versie zonder WooCommerce hooks
 */

defined('ABSPATH') || exit;

get_header();
?>

<div class="container woocommerce-section" style="margin-top: 20px;">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo esc_url(home_url()); ?>">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Shop
            </li>
        </ol>
    </nav>



    <?php if (woocommerce_product_loop()) : ?>
        
        <!-- Shop Controls -->
        <div class="d-flex  align-items-center mb-4 p-3  rounded">
         
            <div class="shop-sorting">
                <select class="form-select" onchange="location = this.value;">
                    <option value="<?php echo esc_url(remove_query_arg('orderby')); ?>">Standaard sortering</option>
                    <option value="<?php echo esc_url(add_query_arg('orderby', 'popularity')); ?>" <?php selected(isset($_GET['orderby']) && $_GET['orderby'] == 'popularity'); ?>>Populariteit</option>
                    <option value="<?php echo esc_url(add_query_arg('orderby', 'date')); ?>" <?php selected(isset($_GET['orderby']) && $_GET['orderby'] == 'date'); ?>>Nieuwste eerst</option>
                    <option value="<?php echo esc_url(add_query_arg('orderby', 'price')); ?>" <?php selected(isset($_GET['orderby']) && $_GET['orderby'] == 'price'); ?>>Prijs: laag naar hoog</option>
                    <option value="<?php echo esc_url(add_query_arg('orderby', 'price-desc')); ?>" <?php selected(isset($_GET['orderby']) && $_GET['orderby'] == 'price-desc'); ?>>Prijs: hoog naar laag</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row">
            <?php
            if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();
                    wc_get_template_part('content', 'product');
                }
            }
            ?>
        </div>

        <!-- Pagination -->
        <?php
        $total_pages = wc_get_loop_prop('total_pages');
        if ($total_pages > 1) {
            echo '<nav class="woocommerce-pagination mt-4">';
            echo paginate_links(array(
                'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'format'    => '?paged=%#%',
                'current'   => max(1, get_query_var('paged')),
                'total'     => $total_pages,
                'prev_text' => '&laquo; Vorige',
                'next_text' => 'Volgende &raquo;',
                'type'      => 'list',
                'end_size'  => 3,
                'mid_size'  => 3,
            ));
            echo '</nav>';
        }
        ?>

    <?php else : ?>
        <div class="alert alert-info">
            <p>Geen producten gevonden.</p>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>