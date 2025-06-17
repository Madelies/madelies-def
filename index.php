<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @package Madelies
 */

get_header();
//TODO: - push to seperate branch
?>

<?php if (is_front_page()): ?>
    
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="row">
          <div class="test col-xl-6 col-lg-7" data-aos="fade-right">
            <img src="<?php echo esc_url(get_theme_file_uri('img/fotofolies5.webp')); ?>" class="img-fluid-profile img-fluid" alt="<?php echo esc_attr(get_theme_mod('about_image_alt', 'foto van profielfoto van mezelf')); ?>">
          </div>
          <div class="col-xl-6 col-lg-5 pt-5 pt-lg-0">
            <h3 data-aos="fade-up"><?php echo get_theme_mod('about_title', 'made-by-Lies // madeliefje'); ?></h3>
            <p data-aos="fade-up">
              <?php echo get_theme_mod('about_intro', 'Na 6 jaar te werken als <strong>tandarts</strong>, besloot ik te luisteren naar mijn innerlijke creatieve stem en me bij te scholen tot <strong>grafisch designer</strong>.'); ?>
            </p>
            <div class="icon-box" data-aos="fade-up">
              <i class="fa-solid fa-certificate pt-2"></i>
              <h4><?php echo get_theme_mod('about_box1_title', 'zaadje'); ?></h4>
              <p><?php echo get_theme_mod('about_box1_content', 'Als kind was ik elk vrij moment bezig met mijn <strong>handen</strong> om mooie en praktische dingen te maken. Ik maakte ontelbare kaartjes en tekeningen en <strong>experimenteerde</strong> met allerlei materialen.'); ?></p>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <i class="fa-solid fa-seedling pt-2"></i>
              <h4><?php echo get_theme_mod('about_box2_title', 'kiem'); ?></h4>
              <p><?php echo get_theme_mod('about_box2_content', 'Ik studeerde af als <strong>algemeen tandarts</strong> in 2016. Voornamelijk de <strong>fijne motoriek</strong> en <strong>mensen helpen</strong> geven me voldoening, maar het bleef <strong>kriebelen</strong> om andere dingen te creëren.'); ?>
              </p>
            </div>

            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <i class="bi bi-flower1"></i>
              <h4><?php echo get_theme_mod('about_box3_title', 'bloem'); ?></h4>
              <p><?php echo get_theme_mod('about_box3_content', 'Ik zette de stap om een voltijdse dagopleiding <strong>grafisch design</strong> te volgen aan Syntra AB. Daarnaast volgde ik ook een cursus front-end<strong> webdevelopment</strong>. Ik besloot beide jobs (tandarts en grafisch design) te <strong>combineren</strong>.'); ?></p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Steps Section ======= -->
    <section id="steps" class="steps section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2><?php echo get_theme_mod('steps_title', 'wat groeit er in mijn moestuin?'); ?></h2>
          <p><?php echo get_theme_mod('steps_subtitle', 'hieronder een overzicht van mijn aanbod'); ?></p>
        </div>

        <div class="row no-gutters">
          <?php
          $steps_items = array(
              array(
                  'number' => '01',
                  'title' => 'logo',
                  'description' => 'je wenst een persoonlijke aanpak om een pakkend en passend logo te creëren',
              ),
              array(
                  'number' => '02',
                  'title' => 'huisstijl',
                  'description' => 'je kiest voor een visuele identiteit die zorgt voor consistentie en herkenbaarheid',
              ),
              array(
                  'number' => '03',
                  'title' => 'drukwerk',
                  'description' => 'je bent op zoek naar tasbare affiches, flyers, visitekaartjes, briefhoofd,.. en wil deze laten printen door een drukker',
              ),
              array(
                  'number' => '04',
                  'title' => 'website',
                  'description' => 'je wil een eigen website die qua design past bij de rest van je branding',
              ),
              array(
                  'number' => '05',
                  'title' => 'webshop',
                  'description' => 'je wil een webshop opstarten waar je je waren verkoopt',
              ),
              array(
                  'number' => '06',
                  'title' => 'illustraties',
                  'description' => 'je wil bestaande producten personaliseren met een uniek ontwerp, of je wil een gepersonaliseerd cadeau geven',
              ),
          );
          $delay = 0;
          foreach ($steps_items as $index => $item) :
          ?>
            <div class="col-lg-4 col-md-6 content-item" data-aos="fade-in" <?php if ($delay > 0) echo 'data-aos-delay="' . $delay . '"'; ?>>
                <span><?php echo esc_html($item['number']); ?></span>
                <h4><?php echo esc_html($item['title']); ?></h4>
                <p><?php echo esc_html($item['description']); ?></p>
            </div>
          <?php 
            $delay += 100;
            endforeach; 
          ?>
        </div>
      </div>
    </section><!-- End Steps Section -->
    
    <!-- ======= Moestuin Foto's Section ======= -->
    <div class="moestuin">
      <div class="row">
        <div class="column">
          <img src="<?php echo esc_url(get_theme_file_uri('img/fotofolies3.webp')); ?>" alt="foto in moestuin" style="width:100%">
        </div>
        <div class="column">
          <img src="<?php echo esc_url(get_theme_file_uri('img/fotofolies2.webp')); ?>" alt="foto in moestuin" style="width:100%">
        </div>
        <div class="column">
          <img src="<?php echo esc_url(get_theme_file_uri('img/fotofolies4.webp')); ?>" alt="foto Lies houdt tomaten vast in moestuin" style="width:100%">
        </div>
      </div>
    </div>
    
    <section>
      <div>
        <img class="onderbrekingslijn img-fluid" src="<?php echo esc_url(get_theme_file_uri('img/onderbrekingslijn.webp')); ?>" alt="stippellijn">
      </div>
    </section>
    
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2><?php echo get_theme_mod('portfolio_title', 'oogst uit mijn moestuin'); ?></h2>
          <p><?php echo get_theme_mod('portfolio_subtitle', 'bekijk een selectie van mijn projecten'); ?></p>
        </div>

      

        <div class="row portfolio-container" data-aos="fade-up">
          <?php
          // Haal portfolio posts op
          $portfolio_args = array(
            'post_type' => 'portfolio',
            'posts_per_page' => -1, 
          );
          
          $portfolio_query = new WP_Query($portfolio_args);
          
          if ($portfolio_query->have_posts()) :
            while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
              
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
              
              $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
              if (!$thumbnail_url) {
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
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="portfolio-details-link" title="Meer details"></a>
              </div>
            </div>
          </div>
          <?php
            endwhile;
            wp_reset_postdata();
          else :
            // Als er geen portfolio-items zijn, toon een standaard item
          ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-huisstijl">
            <div class="portfolio-wrap">
              <img src="<?php echo esc_url(get_theme_file_uri('img/portfolio/friendful-logo-resize.webp')); ?>" class="img-fluid" alt="Voorbeeldproject">
              <div class="portfolio-info">
                <h4>Voorbeeldproject</h4>
                <p>Voeg je eerste portfolio-item toe via WordPress admin</p>
              </div>
              <div class="portfolio-links">
                <a href="<?php echo esc_url(get_theme_file_uri('img/portfolio/friendful-logo-resize.webp')); ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Voorbeeld"><i class="bx bx-plus"></i></a>
                <a href="#" title="Meer details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </section><!-- End Portfolio Section -->
    
    <section>
      <div>
        <img class="streepjes img-fluid" src="<?php echo esc_url(get_theme_file_uri('img/puntjes.webp')); ?>" alt="streepjes">
      </div>
    </section>
    
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2><?php echo get_theme_mod('testimonials_title', 'wederzijdse bestuiving'); ?></h2>
          <p><?php echo get_theme_mod('testimonials_subtitle', 'elke opdracht is voor mij een kans om te groeien en het doet me dan ook ongelooflijk veel plezier om achteraf fijne reviews te ontvangen'); ?></p>
        </div>
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            <?php
            // Haal testimonials op uit WordPress
            $testimonial_args = array(
              'post_type' => 'testimonial',
              'posts_per_page' => -1,
              'orderby' => 'date',
              'order' => 'DESC'
            );
            
            $testimonials_query = new WP_Query($testimonial_args);
            
            // Als er testimonials zijn, toon ze
            if ($testimonials_query->have_posts()) :
              while ($testimonials_query->have_posts()) : $testimonials_query->the_post();
                
                $role = get_post_meta(get_the_ID(), '_testimonial_role', true);
                
                $image_url = '';
                $image_alt = get_the_title();
                
                if (has_post_thumbnail()) {
                  $image_url = get_the_post_thumbnail_url(null, 'thumbnail');
                } else {
                  $image_url = get_theme_file_uri('img/testimonials/2x/getuigenisVal_2x.webp');
                }
            ?>
              <div class="swiper-slide">
                <div class="testimonial-item">
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    <span style="display: inline;"><?php echo strip_tags(get_the_content()); ?></span>
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                  <img src="<?php echo esc_url($image_url); ?>" class="testimonial-img" alt="<?php echo esc_attr($image_alt); ?>">
                  <h3><?php the_title(); ?></h3>
                  <?php if (!empty($role)) : ?>
                    <h4><?php echo esc_html($role); ?></h4>
                  <?php endif; ?>
                </div>
              </div>
            <?php 
              endwhile;
              wp_reset_postdata();
            else :
            ?>
       <h1> Add testimonials in the WordPress admin</h1>
              
       
              
            
            <?php endif; ?>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section><!-- End Testimonials Section -->
    

<?php else: ?>
    <div class="container py-5">
       <div> <h1>Nothing to see here.</h1> </div>
    </div>
<?php endif; ?>

<?php
get_footer();
