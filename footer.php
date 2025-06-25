<?php
// The template for displaying the footer
?>

  </main>
       <!-- ======= Contact Section ======= -->
     <section id="contact" class="contact">
      <div class="container contact">

        <div class="section-title" data-aos="fade-up">
          <h2>plant een zaadje</h2>
          <p>contacteer me met je vraag en ik maak een offerte op maat</p>
        </div>

        <div class="row no-gutters justify-content-center" data-aos="fade-up">

          <div class="col-lg-5 d-flex align-items-stretch">
            <div class="info">
              <div class="address">
                <a href="https://maps.app.goo.gl/n7XA9dgyNYGo3TS46"><i class="bi bi-geo-alt"></i></a>
             

                <h4>adres:</h4>
                 <p><a href="https://maps.app.goo.gl/n7XA9dgyNYGo3TS46">Waterlelieplein 5 bus 402, 3010 Kessel-lo</a></p>
              </div>

              <div class="email mt-4">
                <a href="mailto:madelies.design@gmail.com"><i class="bi bi-envelope"></i></a>
                </p><h4>email:</h4>
                <p><a href="mailto:madelies.design@gmail.com">madelies.design@gmail.com</a></p>
              </div>
            </div>
        </div>
      </div>
    </section>
  <footer id="footer">

    <div class="footer-top">

      <div class="container">
        <div class="row justify-content-center">

          <div>
            <div class="row footer-info">
              <a href="<?php echo esc_url(home_url('/')); ?>"><img class="footer-logo-madelies img-fluid" src="<?php echo esc_url(get_theme_file_uri('img/logo2-wit.webp')); ?>" alt="logo Madelies"></a>
              <div class="row social-links">
                <a href="<?php echo esc_url(get_theme_mod('social_facebook', 'https://www.facebook.com/profile.php?id=61552501971806')); ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="<?php echo esc_url(get_theme_mod('social_instagram', 'https://www.instagram.com/madelies.design/')); ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="<?php echo esc_url(get_theme_mod('social_linkedin', 'https://www.linkedin.com/in/lies-willems/')); ?>" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright col-lg-12 col-md-12">
        <?php echo get_theme_mod('footer_copyright_text', 'website gemaakt door madelies - Lies Willems - BTW BE1010.727.492 - KBC BE53 7370 7699 9653'); ?>
        <a class="gebruiksvoorwaarden" href="<?php echo esc_url(home_url('gebruiksvoorwaarden.html')); ?>">gebruiksvoorwaarden</a>
        <a class="privacy-policy" href="<?php echo esc_url(home_url('privacy policy.html')); ?>">privacy policy</a>
      </div>

    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?php wp_footer(); ?>

</body>

</html>

<?php if (class_exists('WooCommerce')) : ?>
<!-- Floating Action Button voor winkelwagen -->
<?php 
$cart_count = WC()->cart->get_cart_contents_count();
$show_class = $cart_count > 0 ? 'show' : '';
?>
<div class="cart-fab <?php echo $show_class; ?>" id="cart-fab">
    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-fab-link">
        <i class="bi bi-cart3"></i>
        <span class="cart-fab-count <?php echo $cart_count > 0 ? '' : 'empty'; ?>" id="cart-fab-count">
            <?php echo $cart_count; ?>
        </span>
    </a>
</div>
<?php endif; ?>
