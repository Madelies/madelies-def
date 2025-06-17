<?php
/**
 * The template for displaying all single posts
 *
 * @package Madelies
 */

get_header();
?>

<div class="container py-5 mt-5">
    <div class="row">
        <div class="col-lg-8">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h1 class="entry-title" data-aos="fade-up"><?php the_title(); ?></h1>
                        
                        <div class="entry-meta" data-aos="fade-up">
                            <span class="posted-on">
                                <?php echo esc_html__('Gepubliceerd op', 'madelies') . ' ' . get_the_date(); ?>
                            </span>
                            <span class="byline">
                                <?php echo esc_html__('door', 'madelies') . ' ' . get_the_author(); ?>
                            </span>
                        </div>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="entry-featured-image" data-aos="fade-up" data-aos-delay="100">
                            <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                        </div>
                    <?php endif; ?>

                </article>
        </div>
        
    
    </div>
</div>

<?php
get_footer();

?>