<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Madelies
 */

get_header();
?>

<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto text-center">
            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title" data-aos="fade-up"><?php esc_html_e('Oeps! De pagina is niet gevonden.', 'madelies'); ?></h1>
                </header><!-- .page-header -->
            </section><!-- .error-404 -->
        </div>
    </div>
</div>

<?php
get_footer();
