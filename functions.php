<?php
if (!defined('ABSPATH')) {
    exit;
}

define('MADELIES_THEME_DIR', get_template_directory());
define('MADELIES_THEME_URI', get_template_directory_uri());

// Controleer of ACF is geïnstalleerd en geactiveerd
function madelies_check_for_acf() {
    return class_exists('ACF');
}

// Laad ACF velden als de plugin actief is
if (madelies_check_for_acf()) {
    require get_template_directory() . '/inc/acf-fields.php';
}

/**
 * Helper functie om zowel ACF als custom metabox velden te ondersteunen
 * Dit zorgt voor een soepele overgang naar ACF zonder bestaande data te verliezen
 * 
 * @param int    $post_id     Post ID
 * @param string $acf_field   ACF veldnaam
 * @param string $meta_key    Meta key zonder underscore prefix
 * @param bool   $single      Of we een enkele waarde willen (true) of een array (false)
 * @return mixed              De waarde van het veld
 */
function madelies_get_field_value($post_id, $acf_field, $meta_key, $single = true) {
    // Controleer eerst of ACF geïnstalleerd is en het veld bestaat
    if (function_exists('get_field') && get_field($acf_field, $post_id) !== null) {
        return get_field($acf_field, $post_id);
    }
    
    // Als ACF niet beschikbaar is of het veld niet bestaat, gebruik de meta data
    return get_post_meta($post_id, '_' . $meta_key, $single);
}

function madelies_theme_setup() {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    register_nav_menus(
        array(
            'primary-menu' => esc_html__('Primary Menu', 'madelies'),
            'footer-menu' => esc_html__('Footer Menu', 'madelies'),
        )
    );
    
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );
    
    add_theme_support('customize-selective-refresh-widgets');
    
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'madelies_theme_setup');

function madelies_enqueue_scripts() {
    wp_enqueue_style('google-fonts-montserrat', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500&display=swap', array(), null);
    wp_enqueue_style('google-fonts-sacramento', 'https://fonts.googleapis.com/css2?family=Sacramento&display=swap', array(), null);
    
    wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/b8b77904c3.js', array(), null, true);
    
    wp_enqueue_style('aos-css', get_theme_file_uri('/vendor/aos/aos.css'), array(), '1.0.0');
    wp_enqueue_style('bootstrap-icons-css', get_theme_file_uri('/vendor/bootstrap-icons/bootstrap-icons.css'), array(), '1.0.0');
    wp_enqueue_style('boxicons-css', get_theme_file_uri('/vendor/boxicons/css/boxicons.min.css'), array(), '1.0.0');
    wp_enqueue_style('glightbox-css', get_theme_file_uri('/vendor/glightbox/css/glightbox.min.css'), array(), '1.0.0');
    wp_enqueue_style('swiper-css', get_theme_file_uri('/vendor/swiper/swiper-bundle.min.css'), array(), '1.0.0');
    wp_enqueue_style('bootstrap-css', get_theme_file_uri('/vendor/bootstrap/css/bootstrap.min.css'), array(), '5.3.1');
    
    wp_enqueue_style('madelies-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('portfolio-custom', get_theme_file_uri('/css/portfolio-custom.css'), array('madelies-style'), '1.0.0');
    wp_enqueue_style('portfolio-overlay-fix', get_theme_file_uri('/css/portfolio-overlay-fix.css'), array('madelies-style', 'portfolio-custom'), '1.0.0');
    wp_enqueue_style('testimonials-custom', get_theme_file_uri('/css/testimonials-custom.css'), array('madelies-style'), '1.0.0');
    
    wp_enqueue_script('aos-js', get_theme_file_uri('/vendor/aos/aos.js'), array(), '1.0.0', true);
    wp_enqueue_script('bootstrap-js', get_theme_file_uri('/vendor/bootstrap/js/bootstrap.bundle.min.js'), array(), '5.3.1', true);
    wp_enqueue_script('glightbox-js', get_theme_file_uri('/vendor/glightbox/js/glightbox.min.js'), array(), '1.0.0', true);
    wp_enqueue_script('isotope-js', get_theme_file_uri('/vendor/isotope-layout/isotope.pkgd.min.js'), array(), '1.0.0', true);
    wp_enqueue_script('swiper-js', get_theme_file_uri('/vendor/swiper/swiper-bundle.min.js'), array(), '1.0.0', true);
    
    wp_enqueue_script('madelies-main-js', get_theme_file_uri('/js/main.js'), array('jquery'), '1.0.0', true);
    
    // Voeg portfolio video script toe alleen op single portfolio pages
    if (is_singular('portfolio')) {
        wp_enqueue_script('portfolio-video-js', get_theme_file_uri('/js/portfolio-video.js'), array('jquery', 'swiper-js'), '1.0.0', true);
    }
    
    // Voeg portfolio links script toe op pagina's waar portfolio items worden getoond
    if (is_front_page() || is_post_type_archive('portfolio') || is_tax('portfolio_category')) {
        wp_enqueue_script('portfolio-links-js', get_theme_file_uri('/js/portfolio-links.js'), array('jquery'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', 'madelies_enqueue_scripts');

function madelies_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'madelies'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'madelies'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'madelies_widgets_init');

require get_template_directory() . '/inc/customizer.php';

/**
 * Register Custom Post Type for Portfolio
 */
function madelies_register_post_types() {
    // Portfolio Post Type
    $labels = array(
        'name'                  => _x('Portfolio Items', 'Post Type General Name', 'madelies'),
        'singular_name'         => _x('Portfolio Item', 'Post Type Singular Name', 'madelies'),
        'menu_name'             => __('Portfolio', 'madelies'),
        'name_admin_bar'        => __('Portfolio Item', 'madelies'),
        'archives'              => __('Item Archives', 'madelies'),
        'attributes'            => __('Item Attributes', 'madelies'),
        'parent_item_colon'     => __('Parent Item:', 'madelies'),
        'all_items'             => __('Alle Items', 'madelies'),
        'add_new_item'          => __('Nieuw Item Toevoegen', 'madelies'),
        'add_new'               => __('Nieuw Toevoegen', 'madelies'),
        'new_item'              => __('Nieuw Item', 'madelies'),
        'edit_item'             => __('Item Bewerken', 'madelies'),
        'update_item'           => __('Item Bijwerken', 'madelies'),
        'view_item'             => __('Item Bekijken', 'madelies'),
        'view_items'            => __('Items Bekijken', 'madelies'),
        'search_items'          => __('Item Zoeken', 'madelies'),
        'not_found'             => __('Niet Gevonden', 'madelies'),
        'not_found_in_trash'    => __('Niet Gevonden in Prullenbak', 'madelies'),
        'featured_image'        => __('Uitgelichte Afbeelding', 'madelies'),
        'set_featured_image'    => __('Stel Uitgelichte Afbeelding In', 'madelies'),
        'remove_featured_image' => __('Verwijder Uitgelichte Afbeelding', 'madelies'),
        'use_featured_image'    => __('Gebruik als Uitgelichte Afbeelding', 'madelies'),
        'insert_into_item'      => __('Invoegen in Item', 'madelies'),
        'uploaded_to_this_item' => __('Geüpload naar dit Item', 'madelies'),
        'items_list'            => __('Items Lijst', 'madelies'),
        'items_list_navigation' => __('Items Lijst Navigatie', 'madelies'),
        'filter_items_list'     => __('Filter Items Lijst', 'madelies'),
    );
    $args = array(
        'label'                 => __('Portfolio Item', 'madelies'),
        'description'           => __('Portfolio projecten voor Madelies', 'madelies'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'            => array('portfolio_category'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-format-gallery',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'rewrite'               => array('slug' => 'portfolio'),
    );
    register_post_type('portfolio', $args);
    
    // Voeg ondersteuning toe voor thumbnail en excerpt
    add_post_type_support('portfolio', array('thumbnail', 'excerpt'));

    // Portfolio Category Taxonomy
    $labels = array(
        'name'                       => _x('Portfolio Categorieën', 'Taxonomy General Name', 'madelies'),
        'singular_name'              => _x('Portfolio Categorie', 'Taxonomy Singular Name', 'madelies'),
        'menu_name'                  => __('Categorie', 'madelies'),
        'all_items'                  => __('Alle Categorieën', 'madelies'),
        'parent_item'                => __('Hoofd Categorie', 'madelies'),
        'parent_item_colon'          => __('Hoofd Categorie:', 'madelies'),
        'new_item_name'              => __('Nieuwe Categorie Naam', 'madelies'),
        'add_new_item'               => __('Nieuwe Categorie Toevoegen', 'madelies'),
        'edit_item'                  => __('Categorie Bewerken', 'madelies'),
        'update_item'                => __('Categorie Bijwerken', 'madelies'),
        'view_item'                  => __('Categorie Bekijken', 'madelies'),
        'separate_items_with_commas' => __('Scheid Categorieën met Komma\'s', 'madelies'),
        'add_or_remove_items'        => __('Categorieën Toevoegen of Verwijderen', 'madelies'),
        'choose_from_most_used'      => __('Kies uit Meest Gebruikte', 'madelies'),
        'popular_items'              => __('Populaire Categorieën', 'madelies'),
        'search_items'               => __('Categorieën Zoeken', 'madelies'),
        'not_found'                  => __('Niet Gevonden', 'madelies'),
        'no_terms'                   => __('Geen Categorieën', 'madelies'),
        'items_list'                 => __('Categorieën Lijst', 'madelies'),
        'items_list_navigation'      => __('Categorieën Lijst Navigatie', 'madelies'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy('portfolio_category', array('portfolio'), $args);

    // Testimonials Post Type
    $labels = array(
        'name'                  => _x('Testimonials', 'Post Type General Name', 'madelies'),
        'singular_name'         => _x('Testimonial', 'Post Type Singular Name', 'madelies'),
        'menu_name'             => __('Testimonials', 'madelies'),
        'name_admin_bar'        => __('Testimonial', 'madelies'),
        'add_new'               => __('Nieuw Toevoegen', 'madelies'),
        'add_new_item'          => __('Nieuwe Testimonial Toevoegen', 'madelies'),
    );
    $args = array(
        'label'                 => __('Testimonial', 'madelies'),
        'description'           => __('Klantbeoordelingen', 'madelies'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-format-quote',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type('testimonial', $args);
}
add_action('init', 'madelies_register_post_types');

// Voeg portfolio metadata boxes toe
function madelies_add_portfolio_meta_boxes() {
    add_meta_box(
        'madelies_portfolio_meta',
        'Project Informatie',
        'madelies_portfolio_meta_callback',
        'portfolio',
        'normal',
        'high'
    );
    
    add_meta_box(
        'madelies_portfolio_gallery',
        'Project Galerij',
        'madelies_portfolio_gallery_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'madelies_add_portfolio_meta_boxes');

// Callback functie voor project informatie meta box
function madelies_portfolio_meta_callback($post) {
    // Beveilig het formulier
    wp_nonce_field('madelies_portfolio_meta', 'madelies_portfolio_meta_nonce');
    
    // Haal opgeslagen waardes op
    $client = get_post_meta($post->ID, '_portfolio_client', true);
    $date = get_post_meta($post->ID, '_portfolio_date', true);
    $url = get_post_meta($post->ID, '_portfolio_url', true);
    $subtitle = get_post_meta($post->ID, '_portfolio_subtitle', true);
    $video = get_post_meta($post->ID, '_portfolio_video', true);
    
    ?>
    <p>
        <label for="portfolio_subtitle">Ondertitel / Omschrijving:</label><br>
        <input type="text" name="portfolio_subtitle" id="portfolio_subtitle" value="<?php echo esc_attr($subtitle); ?>" style="width: 100%;">
        <span class="description">Een korte titel die boven de inhoud wordt weergegeven op de detailpagina.</span>
    </p>
    
    <p>
        <label for="portfolio_client">Klant:</label><br>
        <input type="text" name="portfolio_client" id="portfolio_client" value="<?php echo esc_attr($client); ?>" style="width: 100%;">
    </p>
    
    <p>
        <label for="portfolio_date">Project Datum:</label><br>
        <input type="text" name="portfolio_date" id="portfolio_date" value="<?php echo esc_attr($date); ?>" style="width: 100%;">
        <span class="description">Bijvoorbeeld: April 2023</span>
    </p>
    
    <p>
        <label for="portfolio_url">Project URL:</label><br>
        <input type="url" name="portfolio_url" id="portfolio_url" value="<?php echo esc_url($url); ?>" style="width: 100%;">
        <span class="description">Een link naar het project op het web, indien van toepassing.</span>
    </p>
    
    <p>
        <label for="portfolio_video">Video URL:</label><br>
        <input type="text" name="portfolio_video" id="portfolio_video" value="<?php echo esc_url($video); ?>" style="width: 100%;">
        <span class="description">Link naar een video bestand (.mp4). Upload eerst naar Media Library, dan de link hier plakken.</span>
    </p>
    <?php
}

// Callback functie voor project galerij meta box
function madelies_portfolio_gallery_callback($post) {
    // Beveilig het formulier
    wp_nonce_field('madelies_portfolio_gallery', 'madelies_portfolio_gallery_nonce');
    
    // Haal opgeslagen galerij op
    $gallery_ids = get_post_meta($post->ID, '_portfolio_gallery', true);
    
    ?>
    <p>
        <label>Project Afbeeldingen:</label><br>
        <span class="description">Upload afbeeldingen om in de galerij op de projectpagina te tonen.</span>
    </p>
    
    <div class="portfolio-gallery-container">
        <input type="hidden" id="portfolio_gallery" name="portfolio_gallery" value="<?php echo esc_attr($gallery_ids); ?>">
        <button type="button" class="button" id="portfolio_gallery_button">Afbeeldingen toevoegen</button>
        
        <div id="portfolio_gallery_preview" class="gallery-preview">
            <?php
            if (!empty($gallery_ids)) {
                $ids = explode(',', $gallery_ids);
                foreach ($ids as $id) {
                    $image_url = wp_get_attachment_image_url($id, 'thumbnail');
                    if ($image_url) {
                        echo '<div class="gallery-item" data-id="' . esc_attr($id) . '">';
                        echo '<img src="' . esc_url($image_url) . '">';
                        echo '<button type="button" class="remove-image">×</button>';
                        echo '</div>';
                    }
                }
            }
            ?>
        </div>
    </div>
    
    <style>
        .gallery-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }
        .gallery-item {
            position: relative;
            width: 150px;
            height: 150px;
            border: 1px solid #ddd;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(255,0,0,0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        // Media uploader
        var mediaUploader;
        
        $('#portfolio_gallery_button').click(function(e) {
            e.preventDefault();
            
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            mediaUploader = wp.media({
                title: 'Selecteer afbeeldingen voor de galerij',
                button: {
                    text: 'Gebruik deze afbeeldingen'
                },
                multiple: true
            });
            
            mediaUploader.on('select', function() {
                var attachments = mediaUploader.state().get('selection').toJSON();
                var galleryIds = $('#portfolio_gallery').val();
                var idsArray = galleryIds ? galleryIds.split(',') : [];
                
                $.each(attachments, function(index, attachment) {
                    if (!idsArray.includes(attachment.id.toString())) {
                        idsArray.push(attachment.id);
                        
                        $('#portfolio_gallery_preview').append(
                            '<div class="gallery-item" data-id="' + attachment.id + '">' +
                            '<img src="' + (attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url) + '">' +
                            '<button type="button" class="remove-image">×</button>' +
                            '</div>'
                        );
                    }
                });
                
                $('#portfolio_gallery').val(idsArray.join(','));
            });
            
            mediaUploader.open();
        });
        
        // Verwijder afbeelding
        $(document).on('click', '.remove-image', function() {
            var item = $(this).parent();
            var id = item.data('id').toString();
            var galleryIds = $('#portfolio_gallery').val();
            var idsArray = galleryIds ? galleryIds.split(',') : [];
            
            var index = idsArray.indexOf(id);
            if (index > -1) {
                idsArray.splice(index, 1);
                $('#portfolio_gallery').val(idsArray.join(','));
                item.remove();
            }
        });
    });
    </script>
    <?php
}

// Sla portfolio meta op
function madelies_save_portfolio_meta($post_id) {
    // Controleer of we moeten opslaan
    if (!isset($_POST['madelies_portfolio_meta_nonce']) || !wp_verify_nonce($_POST['madelies_portfolio_meta_nonce'], 'madelies_portfolio_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Sla meta velden op
    if (isset($_POST['portfolio_client'])) {
        update_post_meta($post_id, '_portfolio_client', sanitize_text_field($_POST['portfolio_client']));
    }
    
    if (isset($_POST['portfolio_date'])) {
        update_post_meta($post_id, '_portfolio_date', sanitize_text_field($_POST['portfolio_date']));
    }
    
    if (isset($_POST['portfolio_url'])) {
        update_post_meta($post_id, '_portfolio_url', esc_url_raw($_POST['portfolio_url']));
    }
    
    if (isset($_POST['portfolio_subtitle'])) {
        update_post_meta($post_id, '_portfolio_subtitle', sanitize_text_field($_POST['portfolio_subtitle']));
    }
    
    if (isset($_POST['portfolio_video'])) {
        update_post_meta($post_id, '_portfolio_video', esc_url_raw($_POST['portfolio_video']));
    }
    
    // Sla galerij op
    if (isset($_POST['madelies_portfolio_gallery_nonce']) && wp_verify_nonce($_POST['madelies_portfolio_gallery_nonce'], 'madelies_portfolio_gallery')) {
        if (isset($_POST['portfolio_gallery'])) {
            update_post_meta($post_id, '_portfolio_gallery', sanitize_text_field($_POST['portfolio_gallery']));
        } else {
            delete_post_meta($post_id, '_portfolio_gallery');
        }
    }
}
add_action('save_post_portfolio', 'madelies_save_portfolio_meta');

// Helper functie om portfolio galerij op te halen
function madelies_get_portfolio_gallery($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $gallery_ids = get_post_meta($post_id, '_portfolio_gallery', true);
    
    if (empty($gallery_ids)) {
        return array();
    }
    
    $ids = explode(',', $gallery_ids);
    $gallery = array();
    
    foreach ($ids as $id) {
        $image_url = wp_get_attachment_image_url($id, 'full');
        $image_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
        
        if ($image_url) {
            $gallery[] = array(
                'url' => $image_url,
                'alt' => $image_alt ?: get_the_title($post_id)
            );
        }
    }
    
    return $gallery;
}

// Voeg testimonial metadata box toe
function madelies_add_testimonial_meta_boxes() {
    add_meta_box(
        'madelies_testimonial_meta',
        'Testimonial Informatie',
        'madelies_testimonial_meta_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'madelies_add_testimonial_meta_boxes');

// Callback functie voor testimonial informatie meta box
function madelies_testimonial_meta_callback($post) {
    // Beveilig het formulier
    wp_nonce_field('madelies_testimonial_meta', 'madelies_testimonial_meta_nonce');
    
    // Haal opgeslagen waardes op
    $role = get_post_meta($post->ID, '_testimonial_role', true);
    
    ?>
    <p>
        <label for="testimonial_role">Bedrijf / Rol:</label><br>
        <input type="text" name="testimonial_role" id="testimonial_role" value="<?php echo esc_attr($role); ?>" style="width: 100%;">
        <span class="description">Bijvoorbeeld: Yoga met Val, Klant, Bedrijfsnaam, etc.</span>
    </p>
    <?php
}

// Sla testimonial meta op
function madelies_save_testimonial_meta($post_id) {
    // Controleer of we moeten opslaan
    if (!isset($_POST['madelies_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['madelies_testimonial_meta_nonce'], 'madelies_testimonial_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Sla meta veld op
    if (isset($_POST['testimonial_role'])) {
        update_post_meta($post_id, '_testimonial_role', sanitize_text_field($_POST['testimonial_role']));
    }
}
add_action('save_post_testimonial', 'madelies_save_testimonial_meta');

// Flush permalinks na thema activatie
function madelies_rewrite_flush() {
    // Registreer custom post types
    madelies_register_post_types();
    
    // Flush rewrite rules
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'madelies_rewrite_flush');

/**
 * Verberg reguliere posts en reacties uit het admin menu
 */
function madelies_remove_default_post_type() {
    remove_menu_page('edit.php');         // Verwijdert Posts menu-item
    remove_menu_page('edit-comments.php'); // Verwijdert Reacties menu-item
}
add_action('admin_menu', 'madelies_remove_default_post_type');

/**
 * Schakel reacties volledig uit
 */
function madelies_disable_comments() {
    // Schakel ondersteuning voor reacties en trackbacks uit voor alle post types
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
    
    // Sluit reacties op bestaande posts
    global $wpdb;
    $wpdb->update($wpdb->posts, ['comment_status' => 'closed', 'ping_status' => 'closed'], ['comment_status' => 'open']);
    
    // Verwijder bestaande reactie-gerelateerde metaboxes
    add_action('admin_init', function() {
        remove_meta_box('commentstatusdiv', null, 'normal');
        remove_meta_box('commentsdiv', null, 'normal');
        remove_meta_box('trackbacksdiv', null, 'normal');
    });
    
    // Verberg reacties uit admin bar
    add_action('wp_before_admin_bar_render', function() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    });
}
add_action('init', 'madelies_disable_comments');
