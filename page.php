<?php
/**
 * The template for displaying all pages
 *
 * @package Madelies
 */

get_header();
?>

<div class="container py-5 mt-5">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <h1 class="entry-title" data-aos="fade-up"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content" data-aos="fade-up" data-aos-delay="100">
                <?php
                the_content();
                ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php
get_footer();
