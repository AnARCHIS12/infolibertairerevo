    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-info">
                <h3><?php bloginfo('name'); ?></h3>
                <p><?php bloginfo('description'); ?></p>
            </div>
            
            <div class="footer-links">
                <div class="footer-section">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="<?php echo home_url(); ?>">Accueil</a></li>
                        <li><a href="<?php echo home_url('/category/actualites/'); ?>">Actualités</a></li>
                        <li><a href="<?php echo home_url('/category/anarchisme/'); ?>">Anarchisme</a></li>
                        <li><a href="<?php echo home_url('/about/'); ?>">À propos</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Catégories</h4>
                    <ul>
                        <li><a href="<?php echo home_url('/category/antifascisme/'); ?>">Antifascisme</a></li>
                        <li><a href="<?php echo home_url('/category/syndicalisme/'); ?>">Syndicalisme</a></li>
                        <li><a href="<?php echo home_url('/category/international/'); ?>">International</a></li>
                        <li><a href="<?php echo home_url('/category/france/'); ?>">France</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Suivez-nous</h4>
                    <div class="social-links">
                        <a href="#" class="social-link">Facebook</a>
                        <a href="#" class="social-link">Twitter</a>
                        <a href="#" class="social-link">Mastodon</a>
                        <a href="<?php echo home_url('/feed/'); ?>" class="social-link">RSS</a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tous droits réservés.</p>
                <p><?php echo get_theme_mod('footer_text', 'Thème inspiré d\'InfoLibertaire.net'); ?></p>
                
                <?php if (get_theme_mod('facebook_url') || get_theme_mod('twitter_url') || get_theme_mod('mastodon_url') || get_theme_mod('telegram_url')) : ?>
                <div class="footer-social">
                    <?php if (get_theme_mod('facebook_url')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('facebook_url')); ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                    <?php endif; ?>
                    <?php if (get_theme_mod('twitter_url')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('twitter_url')); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                    <?php endif; ?>
                    <?php if (get_theme_mod('mastodon_url')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('mastodon_url')); ?>" target="_blank"><i class="fab fa-mastodon"></i></a>
                    <?php endif; ?>
                    <?php if (get_theme_mod('telegram_url')) : ?>
                        <a href="<?php echo esc_url(get_theme_mod('telegram_url')); ?>" target="_blank"><i class="fab fa-telegram"></i></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
    
    <style>
    .footer-content {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        text-align: left;
    }
    
    .footer-info h3 {
        color: var(--primary-color);
        font-family: 'Oswald', sans-serif;
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    
    .footer-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin: 2rem 0;
    }
    
    .footer-section h4 {
        color: var(--light-text);
        font-family: 'Oswald', sans-serif;
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }
    
    .footer-section ul {
        list-style: none;
    }
    
    .footer-section li {
        margin-bottom: 0.5rem;
    }
    
    .footer-section a {
        color: var(--gray-text);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .footer-section a:hover {
        color: var(--primary-color);
    }
    
    .social-links {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .social-link {
        padding: 0.5rem 1rem;
        background: rgba(255,255,255,0.1);
        border-radius: 4px;
        transition: background 0.3s ease;
    }
    
    .social-link:hover {
        background: var(--primary-color);
        color: white !important;
    }
    
    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 1rem;
        text-align: center;
        color: var(--gray-text);
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .footer-links {
            grid-template-columns: 1fr;
        }
        
        .social-links {
            justify-content: center;
        }
    }
    </style>
</body>
</html>