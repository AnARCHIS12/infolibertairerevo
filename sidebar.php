<aside class="sidebar">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        
        <!-- Widget Articles Populaires -->
        <div class="widget">
            <h3 class="widget-title">📈 Articles Populaires</h3>
            <ul>
                <?php
                $popular_posts = wp_get_recent_posts(array(
                    'numberposts' => 5,
                    'post_status' => 'publish'
                ));
                
                foreach($popular_posts as $post) {
                    echo '<li><a href="' . get_permalink($post['ID']) . '">' . esc_html($post['post_title']) . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <!-- Widget Catégories -->
        <div class="widget">
            <h3 class="widget-title">📂 Catégories</h3>
            <ul>
                <?php
                $categories = get_categories(array(
                    'orderby' => 'count',
                    'order' => 'DESC',
                    'number' => 8
                ));
                
                foreach($categories as $category) {
                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . esc_html($category->name) . ' (' . $category->count . ')</a></li>';
                }
                ?>
            </ul>
        </div>

        <!-- Widget Archives -->
        <div class="widget">
            <h3 class="widget-title">📅 Archives</h3>
            <ul>
                <?php wp_get_archives(array('type' => 'monthly', 'limit' => 6)); ?>
            </ul>
        </div>

        <!-- Widget Recherche -->
        <div class="widget">
            <h3 class="widget-title">🔍 Recherche</h3>
            <?php get_search_form(); ?>
        </div>

        <!-- Widget Liens Utiles -->
        <div class="widget">
            <h3 class="widget-title">🔗 Liens Utiles</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/feed/')); ?>" target="_blank">Flux RSS</a></li>
                <li><a href="<?php echo esc_url(home_url('/sitemap.xml')); ?>" target="_blank">Plan du site</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a></li>
                <li><a href="<?php echo esc_url(home_url('/mentions-legales/')); ?>">Mentions légales</a></li>
            </ul>
        </div>

        <!-- Widget Actualités -->
        <div class="widget">
            <h3 class="widget-title">⚡ Dernières Actualités</h3>
            <div class="news-widget">
                <?php
                $recent_news = wp_get_recent_posts(array(
                    'numberposts' => 3,
                    'post_status' => 'publish',
                    'category' => get_cat_ID('Actualités')
                ));
                
                foreach($recent_news as $news) {
                    echo '<div class="news-item">';
                    echo '<h4><a href="' . get_permalink($news['ID']) . '">' . esc_html($news['post_title']) . '</a></h4>';
                    echo '<span class="news-date">' . date('d/m/Y', strtotime($news['post_date'])) . '</span>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <!-- Widget Tags -->
        <div class="widget">
            <h3 class="widget-title">🏷️ Mots-clés</h3>
            <div class="tag-cloud">
                <?php
                $tags = get_tags(array('number' => 15));
                foreach($tags as $tag) {
                    echo '<a href="' . get_tag_link($tag->term_id) . '" class="tag-link">' . esc_html($tag->name) . '</a> ';
                }
                ?>
            </div>
        </div>

    <?php endif; ?>
</aside>

<style>
.news-widget .news-item {
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.news-widget .news-item:last-child {
    border-bottom: none;
}

.news-widget h4 {
    font-size: 0.95rem;
    margin-bottom: 0.3rem;
    line-height: 1.3;
}

.news-widget h4 a {
    color: var(--light-text);
}

.news-widget h4 a:hover {
    color: var(--primary-color);
}

.news-date {
    font-size: 0.8rem;
    color: var(--primary-color);
}

.tag-cloud {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag-link {
    background: rgba(255,255,255,0.1);
    padding: 0.3rem 0.6rem;
    border-radius: 15px;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.tag-link:hover {
    background: var(--primary-color);
    color: white !important;
}
</style>