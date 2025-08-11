<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#131313">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&display=swap" rel="preload" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- News Ticker -->
    <?php if (get_theme_mod('show_ticker', true)) : ?>
    <div class="news-ticker">
        <div class="ticker-content">
            <strong><?php echo esc_html(get_theme_mod('ticker_text', '🔴 ACTUALITÉS MILITANTES :')); ?></strong>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 5,
                'post_status' => 'publish'
            ));
            
            foreach($recent_posts as $post) {
                echo '<span style="margin-right: 50px;">' . esc_html($post['post_title']) . '</span>';
            }
            ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Header -->
    <header class="site-header">
        <div class="header-content">
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url()); ?>">
                    🔴 <?php bloginfo('name'); ?> 🏴
                </a>
            </h1>
            
            <div class="header-search">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-navigation">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_class' => 'nav-menu',
            'container' => false,
            'fallback_cb' => 'default_menu'
        ));
        
        function default_menu() {
                        echo '<ul class="nav-menu">
                                        <li><a href="' . esc_url(home_url()) . '">Accueil</a></li>
                                        <li><a href="' . esc_url(home_url('/category/actualites/')) . '">Actualités</a></li>
                                        <li><a href="' . esc_url(home_url('/category/anarchisme/')) . '">Anarchisme</a></li>
                                        <li><a href="' . esc_url(home_url('/category/antifascisme/')) . '">Antifascisme</a></li>
                                        <li><a href="' . esc_url(home_url('/category/syndicalisme/')) . '">Syndicalisme</a></li>
                                        <li><a href="' . esc_url(home_url('/category/international/')) . '">International</a></li>
                                    </ul>';
        }
        ?>
    </nav>

    <?php // Le script du preloader est maintenant en file d'attente via functions.php ?>