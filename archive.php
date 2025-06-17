<?php
/**
 * The template for displaying archive pages
 *
 * @package Madelies
 */

get_header();
?>

<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-lg-8">
            <header class="page-header mb-5">
                <?php
                the_archive_title('<h1 class="page-title" data-aos="fade-up">', '</h1>');
                the_archive_description('<div class="archive-description" data-aos="fade-up">', '</div>');
                ?>
            </header>

            <?php if (have_posts()) : ?>

                <div class="row">
                    <?php
                    /* Start the Loop */
                    while (have_posts()) :
                        the_post();
                        ?>
                        <div class="col-md-6 mb-4">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100'); ?> data-aos="fade-up">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="card-img-top">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="card-body">
                                    <header class="entry-header">
                                        <h2 class="entry-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                    </header>

                                    <div class="entry-meta mb-3">
                                        <span class="posted-on">
                                            <?php echo get_the_date(); ?>
                                        </span>
                                    </div>

                                    <div class="entry-summary">
                                        <?php the_excerpt(); ?>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary">Lees meer</a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="pagination-container mt-4" data-aos="fade-up">
                    <?php the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '&laquo; Vorige',
                        'next_text' => 'Volgende &raquo;',
                    )); ?>
                </div>

            <?php else : ?>

                <p><?php esc_html_e('Het lijkt erop dat er geen berichten zijn gevonden.', 'madelies'); ?></p>

            <?php endif; ?>
        </div>

        <div class="col-lg-4">
            <div class="blog-sidebar">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
