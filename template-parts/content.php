<?php
/**
 * Template part for displaying posts
 *
 * @package Madelies
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title" data-aos="fade-up">', '</h1>');
        else :
            the_title('<h2 class="entry-title" data-aos="fade-up"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta" data-aos="fade-up">
                <span class="posted-on">
                    <?php echo esc_html__('Gepubliceerd op', 'madelies') . ' ' . get_the_date(); ?>
                </span>
                <span class="byline">
                    <?php echo esc_html__('door', 'madelies') . ' ' . get_the_author(); ?>
                </span>
            </div>
        <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail() && !is_singular()) : ?>
        <div class="entry-thumbnail" data-aos="fade-up" data-aos-delay="100">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content" data-aos="fade-up" data-aos-delay="200">
        <?php
        if (is_singular()) :
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Lees meer<span class="screen-reader-text"> "%s"</span>', 'madelies'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pagina\'s:', 'madelies'),
                    'after'  => '</div>',
                )
            );
        else :
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-primary"><?php esc_html_e('Lees meer', 'madelies'); ?></a>
        <?php endif; ?>
    </div>

    <?php if (is_singular() && 'post' === get_post_type()) : ?>
        <footer class="entry-footer" data-aos="fade-up" data-aos-delay="300">
            <?php
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                echo '<span class="cat-links">' . esc_html__('Categorieën: ', 'madelies') . $categories_list . '</span>';
            }

            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list) {
                echo '<span class="tags-links">' . esc_html__('Tags: ', 'madelies') . $tags_list . '</span>';
            }
            ?>
        </footer>
    <?php endif; ?>
</article>
