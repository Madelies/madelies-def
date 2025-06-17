<?php
/**
 * ACF Field Groups voor Madelies Theme
 * 
 * Dit bestand definieert alle Advanced Custom Fields veldgroepen
 * die worden gebruikt in het Madelies thema.
 */

if (!function_exists('acf_add_local_field_group')) {
    return;
}

/**
 * Portfolio Velden
 */
acf_add_local_field_group(array(
    'key' => 'group_portfolio',
    'title' => 'Portfolio Details',
    'fields' => array(
        array(
            'key' => 'field_portfolio_subtitle',
            'label' => 'Ondertitel / Omschrijving',
            'name' => 'portfolio_subtitle',
            'type' => 'text',
            'instructions' => 'Een korte titel die boven de inhoud wordt weergegeven op de detailpagina.',
            'required' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
        ),
        array(
            'key' => 'field_portfolio_client',
            'label' => 'Klant',
            'name' => 'portfolio_client',
            'type' => 'text',
            'instructions' => 'Naam van de klant of opdrachtgever.',
            'required' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ),
        array(
            'key' => 'field_portfolio_date',
            'label' => 'Project Datum',
            'name' => 'portfolio_date',
            'type' => 'text',
            'instructions' => 'Bijvoorbeeld: April 2023',
            'required' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
        ),
        array(
            'key' => 'field_portfolio_url',
            'label' => 'Project URL',
            'name' => 'portfolio_url',
            'type' => 'url',
            'instructions' => 'Een link naar het project op het web, indien van toepassing.',
            'required' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
        ),
        array(
            'key' => 'field_portfolio_video',
            'label' => 'Video URL',
            'name' => 'portfolio_video',
            'type' => 'file',
            'instructions' => 'Upload een video bestand (.mp4) dat zal worden weergegeven in de galerij.',
            'required' => 0,
            'return_format' => 'url',
            'library' => 'all',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => 'mp4',
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
        ),
        array(
            'key' => 'field_portfolio_gallery',
            'label' => 'Project Galerij',
            'name' => 'portfolio_gallery',
            'type' => 'gallery',
            'instructions' => 'Upload afbeeldingen om in de galerij op de projectpagina te tonen (ideaal 4 afbeeldingen).',
            'required' => 0,
            'return_format' => 'array',
            'preview_size' => 'medium',
            'insert' => 'append',
            'library' => 'all',
            'min' => 0,
            'max' => '',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'portfolio',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => 'Details voor portfolio projecten.',
    'show_in_rest' => 0,
));

/**
 * Testimonial Velden
 */
acf_add_local_field_group(array(
    'key' => 'group_testimonials',
    'title' => 'Testimonial Details',
    'fields' => array(
        array(
            'key' => 'field_testimonial_role',
            'label' => 'Bedrijf / Rol',
            'name' => 'testimonial_role',
            'type' => 'text',
            'instructions' => 'Bijvoorbeeld: tandarts, kinesist Reset, Yoga met Val, etc.',
            'required' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'testimonial',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => 'Details voor testimonials/reviews.',
    'show_in_rest' => 0,
));
