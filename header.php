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
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- News Ticker -->
    <?php if (get_theme_mod('show_ticker', true)) : ?>
    <div class="news-ticker">
        <div class="ticker-content">
            <strong><?php echo get_theme_mod('ticker_text', '🔴 ACTUALITÉS MILITANTES :'); ?></strong>
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
                <a href="<?php echo home_url(); ?>">
                    🔴 <?php bloginfo('name'); ?> 🏴
                </a>
            </h1>
            
            <div class="header-search">
                <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                    <input type="search" class="search-input" placeholder="Rechercher..." value="<?php echo get_search_query(); ?>" name="s">
                    <button type="submit" class="search-submit">🔍</button>
                </form>
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
                    <li><a href="' . home_url() . '">Accueil</a></li>
                    <li><a href="' . home_url('/category/actualites/') . '">Actualités</a></li>
                    <li><a href="' . home_url('/category/anarchisme/') . '">Anarchisme</a></li>
                    <li><a href="' . home_url('/category/antifascisme/') . '">Antifascisme</a></li>
                    <li><a href="' . home_url('/category/syndicalisme/') . '">Syndicalisme</a></li>
                    <li><a href="' . home_url('/category/international/') . '">International</a></li>
                  </ul>';
        }
        ?>
    </nav>

    <script>
        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            setTimeout(() => {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }, 1000);
        });
    </script>