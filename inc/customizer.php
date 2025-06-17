<?php
function madelies_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    
    // Hero Section
    $wp_customize->add_section('madelies_hero_section', array(
        'title'    => __('Hero Sectie', 'madelies'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default'           => __('welkom op mijn webstek', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label'    => __('Hero Titel', 'madelies'),
        'section'  => 'madelies_hero_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle_before', array(
        'default'           => __('ik ben', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_subtitle_before', array(
        'label'    => __('Tekst voor naam', 'madelies'),
        'section'  => 'madelies_hero_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('hero_name', array(
        'default'           => __('Lies', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_name', array(
        'label'    => __('Naam', 'madelies'),
        'section'  => 'madelies_hero_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle_after', array(
        'default'           => __('freelance grafisch designer', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_subtitle_after', array(
        'label'    => __('Tekst na naam', 'madelies'),
        'section'  => 'madelies_hero_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('hero_button_text', array(
        'default'           => __('mijn aanbod', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_button_text', array(
        'label'    => __('Knop Tekst', 'madelies'),
        'section'  => 'madelies_hero_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('hero_social_text', array(
        'default'           => __('volg me op', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('hero_social_text', array(
        'label'    => __('Social Media Tekst', 'madelies'),
        'section'  => 'madelies_hero_section',
        'type'     => 'text',
    ));
    
    // Social Media Links
    $wp_customize->add_section('madelies_social_section', array(
        'title'    => __('Social Media Links', 'madelies'),
        'priority' => 35,
    ));
    
    $wp_customize->add_setting('social_instagram', array(
        'default'           => 'https://www.instagram.com/madelies.design/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_instagram', array(
        'label'    => __('Instagram URL', 'madelies'),
        'section'  => 'madelies_social_section',
        'type'     => 'url',
    ));
    
    $wp_customize->add_setting('social_facebook', array(
        'default'           => 'https://www.facebook.com/profile.php?id=61552501971806',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_facebook', array(
        'label'    => __('Facebook URL', 'madelies'),
        'section'  => 'madelies_social_section',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('social_linkedin', array(
        'default'           => 'https://www.linkedin.com/in/lies-willems/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('social_linkedin', array(
        'label'    => __('LinkedIn URL', 'madelies'),
        'section'  => 'madelies_social_section',
        'type'     => 'url',
    ));
    
    // About Section
    $wp_customize->add_section('madelies_about_section', array(
        'title'    => __('Over Mij Sectie', 'madelies'),
        'priority' => 40,
    ));
    
    $wp_customize->add_setting('about_title', array(
        'default'           => __('made-by-Lies // madeliefje', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('about_title', array(
        'label'    => __('Titel', 'madelies'),
        'section'  => 'madelies_about_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('about_intro', array(
        'default'           => __('Na 6 jaar te werken als <strong>tandarts</strong>, besloot ik te luisteren naar mijn innerlijke creatieve stem en me bij te scholen tot <strong>grafisch designer</strong>.', 'madelies'),
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('about_intro', array(
        'label'    => __('Introductietekst', 'madelies'),
        'section'  => 'madelies_about_section',
        'type'     => 'textarea',
    ));
    
    // Steps Section
    $wp_customize->add_section('madelies_steps_section', array(
        'title'    => __('Aanbod Sectie', 'madelies'),
        'priority' => 45,
    ));
    
    $wp_customize->add_setting('steps_title', array(
        'default'           => __('wat groeit er in mijn moestuin?', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('steps_title', array(
        'label'    => __('Titel', 'madelies'),
        'section'  => 'madelies_steps_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('steps_subtitle', array(
        'default'           => __('hieronder een overzicht van mijn aanbod', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('steps_subtitle', array(
        'label'    => __('Ondertitel', 'madelies'),
        'section'  => 'madelies_steps_section',
        'type'     => 'text',
    ));
    
    // Portfolio Section
    $wp_customize->add_section('madelies_portfolio_section', array(
        'title'    => __('Portfolio Sectie', 'madelies'),
        'priority' => 50,
    ));
    
    $wp_customize->add_setting('portfolio_title', array(
        'default'           => __('oogst uit mijn moestuin', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('portfolio_title', array(
        'label'    => __('Titel', 'madelies'),
        'section'  => 'madelies_portfolio_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('portfolio_subtitle', array(
        'default'           => __('bekijk een selectie van mijn projecten', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('portfolio_subtitle', array(
        'label'    => __('Ondertitel', 'madelies'),
        'section'  => 'madelies_portfolio_section',
        'type'     => 'text',
    ));
    
    // Testimonials Section
    $wp_customize->add_section('madelies_testimonials_section', array(
        'title'    => __('Reviews Sectie', 'madelies'),
        'priority' => 55,
    ));
    
    $wp_customize->add_setting('testimonials_title', array(
        'default'           => __('reviews', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('testimonials_title', array(
        'label'    => __('Titel', 'madelies'),
        'section'  => 'madelies_testimonials_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('testimonials_subtitle', array(
        'default'           => __('elke opdracht is voor mij een kans om te groeien en het doet me dan ook ongelooflijk veel plezier om achteraf fijne reviews te ontvangen', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('testimonials_subtitle', array(
        'label'    => __('Ondertitel', 'madelies'),
        'section'  => 'madelies_testimonials_section',
        'type'     => 'textarea',
    ));
    
    // Contact Section
    $wp_customize->add_section('madelies_contact_section', array(
        'title'    => __('Contact Sectie', 'madelies'),
        'priority' => 60,
    ));
    
    $wp_customize->add_setting('contact_title', array(
        'default'           => __('contact', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    
    $wp_customize->add_control('contact_title', array(
        'label'    => __('Titel', 'madelies'),
        'section'  => 'madelies_contact_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('contact_address', array(
        'default'           => __('Leuven, België', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_address', array(
        'label'    => __('Adres', 'madelies'),
        'section'  => 'madelies_contact_section',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('contact_email', array(
        'default'           => __('info@madelies.be', 'madelies'),
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('contact_email', array(
        'label'    => __('Email', 'madelies'),
        'section'  => 'madelies_contact_section',
        'type'     => 'email',
    ));
    
    $wp_customize->add_setting('contact_phone', array(
        'default'           => __('+32 123 45 67 89', 'madelies'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('contact_phone', array(
        'label'    => __('Telefoon', 'madelies'),
        'section'  => 'madelies_contact_section',
        'type'     => 'text',
    ));
    
    // Footer Section
    $wp_customize->add_section('madelies_footer_section', array(
        'title'    => __('Footer Sectie', 'madelies'),
        'priority' => 65,
    ));

    $wp_customize->add_setting('footer_copyright_text', array(
        'default'           => __('website gemaakt door madelies - Lies Willems - BTW BE1010.727.492 - KBC BE53 7370 7699 9653', 'madelies'),
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('footer_copyright_text', array(
        'label'    => __('Copyright Tekst', 'madelies'),
        'section'  => 'madelies_footer_section',
        'type'     => 'textarea',
    ));
}
add_action('customize_register', 'madelies_customize_register');

function madelies_customize_partial_blogname() {
    bloginfo('name');
}

function madelies_customize_partial_blogdescription() {
    bloginfo('description');
}
function madelies_customize_preview_js() {
    wp_enqueue_script('madelies-customizer', get_theme_file_uri('/js/customizer.js'), array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'madelies_customize_preview_js');
