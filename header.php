<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="freelance grafisch design madelies Lies Willems" name="description">
  <meta content="freelance grafisch design tandarts madelies Lies Willems Leuven" name="keywords">
  <meta content="Lies Willems" name="Author">

  <link href="<?php echo esc_url(get_theme_file_uri('img/favicon-madelies-nieuw.webp')); ?>" rel="icon">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex justify-content-between">

      <div class="logo">
        <h1><a href="<?php echo esc_url(home_url('/')); ?>"></a>
        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(get_theme_file_uri('img/logo2-wit.webp')); ?>" alt="logo madelies" class="img-fluid"></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto<?php echo (is_front_page()) ? ' active' : ''; ?>" href="<?php echo esc_url(home_url('/')); ?>#hero">home</a></li>
          <li><a class="nav-link scrollto" href="<?php echo esc_url(home_url('/')); ?>#about">over mij</a></li>
          <li><a class="nav-link scrollto" href="<?php echo esc_url(home_url('/')); ?>#steps">aanbod</a></li>
          <li><a class="nav-link scrollto" href="<?php echo esc_url(home_url('/')); ?>#portfolio">portfolio</a></li>
          <li><a class="nav-link scrollto" href="<?php echo esc_url(home_url('/')); ?>#testimonials">reviews</a></li>
          <li><a class="nav-link scrollto" href="<?php echo esc_url(home_url('/')); ?>#contact">contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>

  <?php if (is_front_page()): ?>
  <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container hero text-center text-md-left">
       <video id="background-video-desktop" autoplay muted>
        <source src="<?php echo esc_url(get_theme_file_uri('video/hero-def-kanteling.mp4')); ?>" type="video/mp4">
        </video> 

      <h1><?php echo get_theme_mod('hero_title', 'welkom op mijn webstek'); ?></h1>
      <h2><?php echo get_theme_mod('hero_subtitle_before', 'ik ben'); ?> <strong class="lies"><a class="nav-link scrollto" href="#about"><?php echo get_theme_mod('hero_name', 'Lies'); ?></a></strong>, <?php echo get_theme_mod('hero_subtitle_after', 'freelance grafisch designer'); ?></h2>
      <a href="#steps" class="btn-get-started scrollto"><?php echo get_theme_mod('hero_button_text', 'mijn aanbod'); ?></a>
      <div class="icon-socials-hero btn-get-started">
                <?php echo get_theme_mod('hero_social_text', 'volg me op'); ?>
                <a href="<?php echo esc_url(get_theme_mod('social_facebook', 'https://www.facebook.com/profile.php?id=61552501971806')); ?>"><i class="bx bxl-facebook"></i></a>
                <a href="<?php echo esc_url(get_theme_mod('social_instagram', 'https://www.instagram.com/madelies.design/')); ?>"><i class="bx bxl-instagram"></i></a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <main id="main">
