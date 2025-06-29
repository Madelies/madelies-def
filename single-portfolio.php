<?php
// Template voor een enkel portfolio-item
get_header();
?>

<main id="main">

  <!-- Breadcrumbs Section -->
  <section class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h2>portfolio details</h2>
        <a href="<?php echo esc_url(home_url('/#portfolio')); ?>">terug naar portfolio</a>
      </div>
    </div>
  </section>

  <section id="portfolio-details" class="portfolio-details">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-8">
          <?php
          // Controleer of er een galerij is toegevoegd
          $gallery_images = array();
          
          // Als ACF is geïnstalleerd en een galerij-veld bestaat
          /*
          if (function_exists('get_field') && get_field('portfolio_gallery')) {
            $gallery = get_field('portfolio_gallery');
            if (!empty($gallery)) {
              foreach ($gallery as $image) {
                $gallery_images[] = array(
                  'url' => $image['url'],
                  'alt' => $image['alt'] ?: get_the_title(),
                  'type' => 'image'
                );
              }
            }
          }
          */
          // Als er geen ACF galerij is, probeer dan de media-bijlagen te gebruiken
          if (empty($gallery_images)) {
            $args = array(
              'post_type'      => 'attachment',
              'posts_per_page' => -1,
              'post_parent'    => get_the_ID(),
              'exclude'        => get_post_thumbnail_id()
            );
            
            $attachments = get_posts($args);
            
            if ($attachments) {
              foreach ($attachments as $attachment) {
                $gallery_images[] = array(
                  'url' => wp_get_attachment_url($attachment->ID),
                  'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true) ?: get_the_title(),
                  'type' => 'image'
                );
              }
            }
          }
          
          // Voeg uitgelichte afbeelding toe aan het begin van de galerij
          /*
          if (has_post_thumbnail()) {
            array_unshift($gallery_images, array(
              'url' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
              'alt' => get_the_title(),
              'type' => 'image'
            ));
          }
          */
          // Controleer of er een video URL is en voeg deze toe aan de galerij
          $video_url = '';
          if (function_exists('get_field') && get_field('portfolio_video')) {
            $video_url = get_field('portfolio_video');
          } else {
            $video_url = get_post_meta(get_the_ID(), '_portfolio_video', true);
          }
          
          if (!empty($video_url)) {
            // Voeg de video toe aan het einde van de galerij
            $gallery_images[] = array(
              'url' => $video_url,
              'alt' => get_the_title(),
              'type' => 'video'
            );
          }
          
          // Als er geen afbeeldingen of video zijn, gebruik dan een standaardafbeelding
          if (empty($gallery_images)) {
            $gallery_images[] = array(
              'url' => get_theme_file_uri('img/no-image.webp'),
              'alt' => get_the_title(),
              'type' => 'image'
            );
          }
          ?>
          
          <div class="portfolio-details-slider swiper">
            <div class="swiper-wrapper align-items-center">
              <?php foreach ($gallery_images as $item) : ?>
                <div class="swiper-slide">
                  <?php if ($item['type'] === 'video') : ?>
                    <div class="video-container">
                      <video class="portfolio-video img-fluid" autoplay loop muted playsinline controls preload="auto" poster="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>">
                        <source src="<?php echo esc_url($item['url']); ?>" type="video/mp4">
                        Je browser ondersteunt geen video weergave.
                      </video>
                    </div>
                  <?php else : ?>
                    <img src="<?php echo esc_url($item['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($item['alt']); ?>">
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="portfolio-description">
            <?php 
            $subtitle = '';
            
            // Probeer eerst ACF te gebruiken als het bestaat
            if (function_exists('get_field') && get_field('portfolio_subtitle')) {
              $subtitle = get_field('portfolio_subtitle');
            } else {
              // Anders gebruik de standaard meta velden
              $subtitle = get_post_meta(get_the_ID(), '_portfolio_subtitle', true);
            }
            
            // Als er een ondertitel is, gebruik die, anders gebruik de titel
            if (!empty($subtitle)) : ?>
              <h3><?php echo esc_html($subtitle); ?></h3>
            <?php else : ?>
              <h3><?php the_title(); ?></h3>
            <?php endif; ?>
            
            <?php the_content(); ?>
          </div>
          
         
        </div>
      </div>
    </div>
  </section>

  <?php
  // Gerelateerde portfolio-items op basis van categorie
  $related_args = array(
    'post_type' => 'portfolio',
    'posts_per_page' => 3,
    'post__not_in' => array(get_the_ID())
  );
  
  $categories = get_the_terms(get_the_ID(), 'portfolio_category');
  if ($categories && !is_wp_error($categories)) {
    $category_ids = array();
    foreach ($categories as $category) {
      $category_ids[] = $category->term_id;
    }
    $related_args['tax_query'] = array(
      array(
        'taxonomy' => 'portfolio_category',
        'field' => 'term_id',
        'terms' => $category_ids
      )
    );
  }
  
  $related_query = new WP_Query($related_args);
  
  if ($related_query->have_posts()) :
  ?>
  <section class="related-portfolio">
    <div class="container">
      <div class="section-title" data-aos="fade-up">
        <h2>Gerelateerde projecten</h2>
      </div>
      
      <div class="row portfolio-container" data-aos="fade-up">
        <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
          <div class="col-lg-4 col-md-6 portfolio-item">
            <div class="portfolio-wrap">
              <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('large'); ?>" class="img-fluid" alt="<?php the_title_attribute(); ?>">
              <?php else : ?>
                <img src="<?php echo esc_url(get_theme_file_uri('img/no-image.webp')); ?>" class="img-fluid" alt="<?php the_title_attribute(); ?>">
              <?php endif; ?>
              <div class="portfolio-info">
                <h4><?php the_title(); ?></h4>
                <?php
                $item_categories = get_the_terms(get_the_ID(), 'portfolio_category');
                if ($item_categories && !is_wp_error($item_categories)) {
                  $cat_names = array();
                  foreach ($item_categories as $cat) {
                    $cat_names[] = $cat->name;
                  }
                  echo '<p>' . esc_html(implode(', ', $cat_names)) . '</p>';
                }
                ?>
              </div>
              <div class="portfolio-links">
                <a href="<?php the_post_thumbnail_url('full'); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php the_title_attribute(); ?>"><i class="bx bx-plus"></i></a>
                <a href="<?php the_permalink(); ?>" title="Meer details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

</main>

<?php get_footer(); ?>
