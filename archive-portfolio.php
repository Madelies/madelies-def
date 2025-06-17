<?php
// Template voor portfolio archief
get_header();
?>

<main id="main">

  <!-- Breadcrumbs Section -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h2>portfolio</h2>
        <a href="<?php echo esc_url(home_url('/')); ?>">terug naar home</a>
      </div>
    </div>
  </section>

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2>mijn projecten</h2>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">Alles</li>
            <?php 
            // Haal alle portfolio categorieën op
            $portfolio_categories = get_terms(array(
              'taxonomy' => 'portfolio_category',
              'hide_empty' => true,
            ));
            
            if (!empty($portfolio_categories) && !is_wp_error($portfolio_categories)) {
              foreach ($portfolio_categories as $category) {
                echo '<li data-filter=".filter-' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</li>';
              }
            }
            ?>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
        <?php
        if (have_posts()) :
          while (have_posts()) : the_post();
            
            // Haal de categorieën van dit portfolio item op
            $categories = get_the_terms(get_the_ID(), 'portfolio_category');
            $category_classes = '';
            $category_names = array();
            
            if (!empty($categories) && !is_wp_error($categories)) {
              foreach ($categories as $category) {
                $category_classes .= ' filter-' . $category->slug;
                $category_names[] = $category->name;
              }
            }
            
            // Haal de uitgelichte afbeelding op
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if (!$thumbnail_url) {
              // Als er geen uitgelichte afbeelding is, gebruik een standaardafbeelding
              $thumbnail_url = get_theme_file_uri('img/no-image.webp');
            }
        ?>
        <div class="col-lg-4 col-md-6 portfolio-item<?php echo esc_attr($category_classes); ?>">
          <div class="portfolio-wrap">
            <img src="<?php echo esc_url($thumbnail_url); ?>" class="img-fluid" alt="<?php the_title_attribute(); ?>">
            <div class="portfolio-info">
              <h4><?php the_title(); ?></h4>
              <p><?php echo esc_html(implode(', ', $category_names)); ?></p>
            </div>
            <div class="portfolio-links">
              <a href="<?php echo esc_url($thumbnail_url); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php the_title_attribute(); ?>"><i class="bx bx-plus"></i></a>
              <a href="<?php echo esc_url(get_the_permalink()); ?>" class="portfolio-details-link" title="Meer details"><i class="bx bx-link"></i></a>
            </div>
          </div>
        </div>
        <?php
          endwhile;
        else :
        ?>
        <div class="col-12 text-center">
          <p>Geen portfolio-items gevonden.</p>
        </div>
        <?php endif; ?>
      </div>
      
      <?php 
      // Paginering tonen als er meer dan één pagina is
      the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => __('&laquo; Vorige', 'madelies'),
        'next_text' => __('Volgende &raquo;', 'madelies'),
      ));
      ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
