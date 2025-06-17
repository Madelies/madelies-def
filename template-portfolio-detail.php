<?php
/**
 * Template Name: Portfolio Detail
 *
 * Template for displaying portfolio detail pages
 *
 * @package Madelies
 */

get_header();
?>

<div class="container py-5 mt-5">
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="portfolio-title" data-aos="fade-up"><?php the_title(); ?></h2>
                    
                    <?php if (has_post_thumbnail()): ?>
                        <div class="portfolio-details-slider swiper" data-aos="fade-up" data-aos-delay="100">
                            <div class="swiper-wrapper align-items-center">
                                <div class="swiper-slide">
                                    <?php the_post_thumbnail('large', array('class' => 'img-fluid')); ?>
                                </div>
                                
                                <?php 
                                // Get additional images from gallery if using ACF
                                if (function_exists('get_field')):
                                    $gallery = get_field('portfolio_gallery');
                                    if ($gallery):
                                        foreach ($gallery as $image):
                                        ?>
                                            <div class="swiper-slide">
                                                <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid">
                                            </div>
                                        <?php
                                        endforeach;
                                    endif;
                                endif;
                                ?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4 portfolio-info" data-aos="fade-left" data-aos-delay="200">
                    <h3><?php esc_html_e('Project informatie', 'madelies'); ?></h3>
                    <ul>
                        <?php if (function_exists('get_field') && get_field('portfolio_client')): ?>
                            <li><strong><?php esc_html_e('Klant', 'madelies'); ?></strong>: <?php echo esc_html(get_field('portfolio_client')); ?></li>
                        <?php endif; ?>
                        
                        <?php if (function_exists('get_field') && get_field('portfolio_date')): ?>
                            <li><strong><?php esc_html_e('Datum', 'madelies'); ?></strong>: <?php echo esc_html(get_field('portfolio_date')); ?></li>
                        <?php endif; ?>
                        
                        <?php if (function_exists('get_field') && get_field('portfolio_url')): ?>
                            <li><strong><?php esc_html_e('Project URL', 'madelies'); ?></strong>: <a href="<?php echo esc_url(get_field('portfolio_url')); ?>" target="_blank"><?php esc_html_e('Bekijk project', 'madelies'); ?></a></li>
                        <?php endif; ?>
                        
                        <?php 
                        // Get portfolio categories if using a custom taxonomy
                        $terms = get_the_terms(get_the_ID(), 'portfolio_category');
                        if ($terms && !is_wp_error($terms)):
                            echo '<li><strong>' . esc_html__('Categorie', 'madelies') . '</strong>: ';
                            $term_names = array();
                            foreach ($terms as $term) {
                                $term_names[] = $term->name;
                            }
                            echo esc_html(implode(', ', $term_names));
                            echo '</li>';
                        endif;
                        ?>
                    </ul>

                    <div class="portfolio-description">
                        <h2><?php esc_html_e('Project details', 'madelies'); ?></h2>
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Related Projects Section -->
    <?php
    // Get related projects by category (if using a custom taxonomy)
    if (function_exists('get_field') && taxonomy_exists('portfolio_category')):
        $terms = get_the_terms(get_the_ID(), 'portfolio_category');
        if ($terms && !is_wp_error($terms)):
            $term_ids = array();
            foreach ($terms as $term) {
                $term_ids[] = $term->term_id;
            }
            
            $args = array(
                'post_type' => 'portfolio',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'portfolio_category',
                        'field' => 'term_id',
                        'terms' => $term_ids,
                        'operator' => 'IN',
                    )
                )
            );
            
            $related_query = new WP_Query($args);
            
            if ($related_query->have_posts()):
            ?>
                <section class="related-projects mt-5">
                    <div class="container">
                        <h3 class="mb-4" data-aos="fade-up"><?php esc_html_e('Gerelateerde projecten', 'madelies'); ?></h3>
                        
                        <div class="row">
                            <?php while ($related_query->have_posts()): $related_query->the_post(); ?>
                                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                                    <div class="portfolio-item">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                            <?php endif; ?>
                                            <div class="portfolio-info">
                                                <h4><?php the_title(); ?></h4>
                                                <?php 
                                                $project_cats = get_the_terms(get_the_ID(), 'portfolio_category');
                                                if ($project_cats && !is_wp_error($project_cats)):
                                                    $cat_names = array();
                                                    foreach ($project_cats as $cat) {
                                                        $cat_names[] = $cat->name;
                                                    }
                                                    echo '<p>' . esc_html(implode(', ', $cat_names)) . '</p>';
                                                endif;
                                                ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                </section>
            <?php
            endif;
        endif;
    endif;
    ?>
</div>

<?php
get_footer();
