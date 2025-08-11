<?php
/**
 * Fonctions du thème InfoLibertaire Inspired
 */

// Activation du support des fonctionnalités WordPress
function infolibertaire_theme_support() {
    // Support des images à la une
    add_theme_support('post-thumbnails');
    
    // Support du titre automatique
    add_theme_support('title-tag');
    
    // Support des menus
    add_theme_support('menus');
    
    // Support des formats d'articles
    add_theme_support('post-formats', array(
        'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
    ));
    
    // Support HTML5
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
    
    // Support des flux RSS
    add_theme_support('automatic-feed-links');
}
add_action('after_setup_theme', 'infolibertaire_theme_support');

// Enregistrement des menus
function infolibertaire_menus() {
    register_nav_menus(array(
        'primary' => 'Menu Principal',
        'footer' => 'Menu Pied de page'
    ));
}
add_action('init', 'infolibertaire_menus');

// Enregistrement des zones de widgets
function infolibertaire_widgets_init() {
    register_sidebar(array(
        'name' => 'Barre latérale principale',
        'id' => 'sidebar-1',
        'description' => 'Widgets affichés dans la barre latérale',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => 'Pied de page',
        'id' => 'footer-1',
        'description' => 'Widgets affichés dans le pied de page',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="footer-widget-title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'infolibertaire_widgets_init');

// Chargement des styles et scripts
function infolibertaire_scripts() {
    // Style principal
    wp_enqueue_style('infolibertaire-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Style militant supplémentaire
    wp_enqueue_style('infolibertaire-militant', get_template_directory_uri() . '/style-militant.css', array('infolibertaire-style'), '1.0.0');
    
    // Styles du customizer
    wp_enqueue_style('infolibertaire-customizer', get_template_directory_uri() . '/customizer.css', array('infolibertaire-style'), '1.0.0');
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&display=swap', array(), null);
    
    // Font Awesome pour les icônes
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css', array(), '6.0.0');
    
    // jQuery (déjà inclus dans WordPress)
    wp_enqueue_script('jquery');
    
    // Script personnalisé
    wp_enqueue_script('infolibertaire-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // CSS personnalisé depuis le customizer
    $custom_css = infolibertaire_get_custom_css();
    if ($custom_css) {
        wp_add_inline_style('infolibertaire-style', $custom_css);
    }
}

// Générer le CSS personnalisé
function infolibertaire_get_custom_css() {
    $primary_color = get_theme_mod('primary_color', '#de4939');
    $secondary_color = get_theme_mod('secondary_color', '#131313');
    
    $css = ":root {
        --primary-color: {$primary_color};
        --secondary-color: {$secondary_color};
        --hover-color: {$primary_color};
    }";
    
    return $css;
}
add_action('wp_enqueue_scripts', 'infolibertaire_scripts');

// Personnalisation de l'extrait
function infolibertaire_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'infolibertaire_excerpt_length');

function infolibertaire_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'infolibertaire_excerpt_more');

// Ajout de classes CSS personnalisées au body
function infolibertaire_body_classes($classes) {
    if (is_home() || is_front_page()) {
        $classes[] = 'home-page';
    }
    
    if (is_single()) {
        $classes[] = 'single-post';
    }
    
    if (is_page()) {
        $classes[] = 'single-page';
    }
    
    return $classes;
}
add_filter('body_class', 'infolibertaire_body_classes');

// Configuration des tailles d'images
function infolibertaire_image_sizes() {
    add_image_size('article-thumbnail', 400, 250, true);
    add_image_size('featured-large', 800, 400, true);
}
add_action('after_setup_theme', 'infolibertaire_image_sizes');

// Personnalisation du formulaire de commentaires
function infolibertaire_comment_form($args) {
    $args['comment_field'] = '<p class="comment-form-comment">
        <label for="comment">Commentaire *</label>
        <textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
    </p>';
    
    $args['fields']['author'] = '<p class="comment-form-author">
        <label for="author">Nom *</label>
        <input id="author" name="author" type="text" value="" size="30" required />
    </p>';
    
    $args['fields']['email'] = '<p class="comment-form-email">
        <label for="email">Email *</label>
        <input id="email" name="email" type="email" value="" size="30" required />
    </p>';
    
    $args['fields']['url'] = '<p class="comment-form-url">
        <label for="url">Site web</label>
        <input id="url" name="url" type="url" value="" size="30" />
    </p>';
    
    return $args;
}
add_filter('comment_form_defaults', 'infolibertaire_comment_form');

// Ajout de métadonnées Open Graph
function infolibertaire_add_og_meta() {
    if (is_single()) {
        global $post;
        ?>
        <meta property="og:title" content="<?php echo esc_attr(get_the_title()); ?>" />
        <meta property="og:description" content="<?php echo esc_attr(wp_trim_words(get_the_excerpt(), 20)); ?>" />
        <meta property="og:url" content="<?php echo esc_url(get_permalink()); ?>" />
        <meta property="og:type" content="article" />
        <?php if (has_post_thumbnail()) : ?>
            <meta property="og:image" content="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" />
        <?php endif; ?>
        <?php
    }
}
add_action('wp_head', 'infolibertaire_add_og_meta');

// Fonction pour afficher les articles récents
function get_recent_articles($limit = 5) {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    return new WP_Query($args);
}

// Fonction pour afficher les articles par catégorie
function get_articles_by_category($category_slug, $limit = 5) {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $limit,
        'post_status' => 'publish',
        'category_name' => $category_slug,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    
    return new WP_Query($args);
}

// Personnalisation de l'admin WordPress
function infolibertaire_admin_style() {
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/admin-style.css');
}
add_action('admin_enqueue_scripts', 'infolibertaire_admin_style');

// Ajout d'options de personnalisation
function infolibertaire_customize_register($wp_customize) {
    // Section couleurs
    $wp_customize->add_section('infolibertaire_colors', array(
        'title' => '🎨 Couleurs du thème',
        'priority' => 30,
    ));
    
    // Couleur principale
    $wp_customize->add_setting('primary_color', array(
        'default' => '#de4939',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => 'Couleur principale (Rouge)',
        'section' => 'infolibertaire_colors',
        'settings' => 'primary_color',
    )));
    
    // Couleur secondaire
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#131313',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => 'Couleur secondaire (Noir)',
        'section' => 'infolibertaire_colors',
        'settings' => 'secondary_color',
    )));
    
    // Section mise en page
    $wp_customize->add_section('infolibertaire_layout', array(
        'title' => '📐 Mise en page',
        'priority' => 32,
    ));
    
    // Affichage du ticker
    $wp_customize->add_setting('show_ticker', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('show_ticker', array(
        'label' => 'Afficher le ticker d\'actualités',
        'section' => 'infolibertaire_layout',
        'type' => 'checkbox',
    ));
    
    // Nombre d'articles par page
    $wp_customize->add_setting('posts_per_page', array(
        'default' => 6,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('posts_per_page', array(
        'label' => 'Nombre d\'articles par page',
        'section' => 'infolibertaire_layout',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 3,
            'max' => 12,
        ),
    ));
    
    // Section réseaux sociaux
    $wp_customize->add_section('infolibertaire_social', array(
        'title' => '📱 Réseaux sociaux',
        'priority' => 35,
    ));
    
    // Facebook
    $wp_customize->add_setting('facebook_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('facebook_url', array(
        'label' => 'URL Facebook',
        'section' => 'infolibertaire_social',
        'type' => 'url',
    ));
    
    // Twitter
    $wp_customize->add_setting('twitter_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('twitter_url', array(
        'label' => 'URL Twitter',
        'section' => 'infolibertaire_social',
        'type' => 'url',
    ));
    
    // Mastodon
    $wp_customize->add_setting('mastodon_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('mastodon_url', array(
        'label' => 'URL Mastodon',
        'section' => 'infolibertaire_social',
        'type' => 'url',
    ));
    
    // Telegram
    $wp_customize->add_setting('telegram_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('telegram_url', array(
        'label' => 'URL Telegram',
        'section' => 'infolibertaire_social',
        'type' => 'url',
    ));
    
    // Section textes
    $wp_customize->add_section('infolibertaire_texts', array(
        'title' => '✏️ Textes personnalisés',
        'priority' => 37,
    ));
    
    // Texte du ticker
    $wp_customize->add_setting('ticker_text', array(
        'default' => '🔴 ACTUALITÉS MILITANTES :',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('ticker_text', array(
        'label' => 'Texte du ticker d\'actualités',
        'section' => 'infolibertaire_texts',
        'type' => 'text',
    ));
    
    // Texte du footer
    $wp_customize->add_setting('footer_text', array(
        'default' => 'Thème inspiré d\'InfoLibertaire.net',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('footer_text', array(
        'label' => 'Texte du pied de page',
        'section' => 'infolibertaire_texts',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'infolibertaire_customize_register');

// Système de mise à jour GitHub
add_filter('pre_set_site_transient_update_themes', 'infolibertaire_check_for_update');

function infolibertaire_check_for_update($transient) {
    if (empty($transient->checked)) return $transient;
    
    $theme_slug = get_template();
    $theme_version = wp_get_theme()->get('Version');
    
    $remote_version = wp_remote_get('https://api.github.com/repos/AnARCHIS12/infolibertairerevo/releases/latest');
    
    if (!is_wp_error($remote_version)) {
        $version_data = json_decode(wp_remote_retrieve_body($remote_version), true);
        if (isset($version_data['tag_name'])) {
            $new_version = ltrim($version_data['tag_name'], 'v');
            
            if (version_compare($theme_version, $new_version, '<')) {
                $transient->response[$theme_slug] = array(
                    'theme' => $theme_slug,
                    'new_version' => $new_version,
                    'url' => 'https://github.com/AnARCHIS12/infolibertairerevo',
                    'package' => $version_data['zipball_url']
                );
            }
        }
    }
    
    return $transient;
}

// Sécurité : Masquer la version de WordPress
function infolibertaire_remove_version() {
    return '';
}
add_filter('the_generator', 'infolibertaire_remove_version');

// Optimisation : Supprimer les emojis WordPress
function infolibertaire_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'infolibertaire_disable_emojis');
?>