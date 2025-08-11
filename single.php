<?php get_header(); ?>

<main class="main-content single-post-content">
    <div class="content-area">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('single-article'); ?>>
                    <header class="article-header">
                        <h1 class="article-title"><?php the_title(); ?></h1>
                        
                        <div class="article-meta">
                            <span class="article-date">
                                <i class="fas fa-calendar"></i>
                                <?php echo get_the_date('d F Y'); ?>
                            </span>
                            
                            <span class="article-author">
                                <i class="fas fa-user"></i>
                                <?php the_author(); ?>
                            </span>
                            
                            <span class="article-category">
                                <i class="fas fa-folder"></i>
                                <?php 
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo '<a href="' . get_category_link($categories[0]->term_id) . '">' . esc_html($categories[0]->name) . '</a>';
                                }
                                ?>
                            </span>
                            
                            <?php if (has_tag()) : ?>
                                <span class="article-tags">
                                    <i class="fas fa-tags"></i>
                                    <?php the_tags('', ', ', ''); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </header>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="article-featured-image">
                            <?php the_post_thumbnail('featured-large', array('alt' => get_the_title())); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="article-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages(); ?>
                    </div>
                    
                    <footer class="article-footer">
                        <div class="share-buttons">
                            <h4>Partager cet article :</h4>
                            <div class="social-share">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="share-facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>" class="share-email">
                                    <i class="fas fa-envelope"></i> Email
                                </a>
                                <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="share-telegram">
                                    <i class="fab fa-telegram"></i> Telegram
                                </a>
                            </div>
                        </div>
                        
                        <div class="article-navigation">
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                            ?>
                            
                            <?php if ($prev_post) : ?>
                                <div class="nav-previous">
                                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                        <i class="fas fa-arrow-left"></i>
                                        <span>Article précédent</span>
                                        <strong><?php echo esc_html($prev_post->post_title); ?></strong>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($next_post) : ?>
                                <div class="nav-next">
                                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                                        <span>Article suivant</span>
                                        <i class="fas fa-arrow-right"></i>
                                        <strong><?php echo esc_html($next_post->post_title); ?></strong>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </footer>
                </article>
                
                <!-- Articles similaires -->
                <section class="related-articles">
                    <h3>Articles similaires</h3>
                    <div class="related-grid">
                        <?php
                        $categories = get_the_category();
                        if ($categories) {
                            $category_ids = array();
                            foreach($categories as $category) {
                                $category_ids[] = $category->term_id;
                            }
                            
                            $related_args = array(
                                'category__in' => $category_ids,
                                'post__not_in' => array(get_the_ID()),
                                'posts_per_page' => 3,
                                'orderby' => 'rand'
                            );
                            
                            $related_query = new WP_Query($related_args);
                            
                            if ($related_query->have_posts()) :
                                while ($related_query->have_posts()) : $related_query->the_post();
                        ?>
                                    <div class="related-article">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('article-thumbnail'); ?>
                                            </a>
                                        <?php endif; ?>
                                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                        <span class="related-date"><?php echo get_the_date(); ?></span>
                                    </div>
                        <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        }
                        ?>
                    </div>
                </section>
                
                <!-- Commentaires -->
                <?php if (comments_open() || get_comments_number()) : ?>
                    <section class="comments-section">
                        <?php comments_template(); ?>
                    </section>
                <?php endif; ?>
                
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    
    <?php get_sidebar(); ?>
</main>

<style>
.single-post-content {
    margin-top: 2rem;
}

.single-article {
    background: rgba(255,255,255,0.05);
    border-radius: 8px;
    padding: 2rem;
    margin-bottom: 2rem;
}

.article-header {
    margin-bottom: 2rem;
    border-bottom: 2px solid var(--primary-color);
    padding-bottom: 1rem;
}

.single-article .article-title {
    font-family: 'Oswald', sans-serif;
    font-size: 2.5rem;
    color: var(--light-text);
    margin-bottom: 1rem;
    line-height: 1.2;
}

.single-article .article-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    font-size: 0.9rem;
    color: var(--gray-text);
}

.single-article .article-meta span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.single-article .article-meta i {
    color: var(--primary-color);
}

.article-featured-image {
    margin-bottom: 2rem;
    text-align: center;
}

.article-featured-image img {
    border-radius: 8px;
    max-width: 100%;
    height: auto;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
}

.article-content p {
    margin-bottom: 1.5rem;
}

.article-content h2,
.article-content h3,
.article-content h4 {
    font-family: 'Oswald', sans-serif;
    color: var(--light-text);
    margin: 2rem 0 1rem 0;
}

.article-content h2 {
    font-size: 1.8rem;
}

.article-content h3 {
    font-size: 1.5rem;
}

.article-content h4 {
    font-size: 1.3rem;
}

.article-content blockquote {
    background: rgba(222, 73, 57, 0.1);
    border-left: 4px solid var(--primary-color);
    padding: 1rem 1.5rem;
    margin: 2rem 0;
    font-style: italic;
}

.article-footer {
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 2rem;
}

.share-buttons h4 {
    font-family: 'Oswald', sans-serif;
    margin-bottom: 1rem;
    color: var(--light-text);
}

.social-share {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.social-share a {
    padding: 0.75rem 1.5rem;
    border-radius: 4px;
    text-decoration: none;
    color: white;
    font-weight: 500;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.share-facebook { background: #1877f2; }
.share-twitter { background: #1da1f2; }
.share-email { background: #666; }
.share-telegram { background: #0088cc; }

.social-share a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.article-navigation {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-top: 2rem;
}

.nav-previous,
.nav-next {
    background: rgba(255,255,255,0.05);
    padding: 1rem;
    border-radius: 4px;
    transition: background 0.3s ease;
}

.nav-previous:hover,
.nav-next:hover {
    background: rgba(255,255,255,0.1);
}

.nav-previous a,
.nav-next a {
    color: var(--light-text);
    text-decoration: none;
    display: block;
}

.nav-next {
    text-align: right;
}

.related-articles {
    margin-top: 3rem;
    padding: 2rem;
    background: rgba(255,255,255,0.03);
    border-radius: 8px;
}

.related-articles h3 {
    font-family: 'Oswald', sans-serif;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    color: var(--light-text);
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.related-article {
    background: rgba(255,255,255,0.05);
    border-radius: 4px;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.related-article:hover {
    transform: translateY(-3px);
}

.related-article img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.related-article h4 {
    padding: 1rem;
    margin: 0;
    font-size: 1rem;
}

.related-article h4 a {
    color: var(--light-text);
    text-decoration: none;
}

.related-article h4 a:hover {
    color: var(--primary-color);
}

.related-date {
    padding: 0 1rem 1rem;
    font-size: 0.85rem;
    color: var(--gray-text);
}

.comments-section {
    margin-top: 3rem;
    padding: 2rem;
    background: rgba(255,255,255,0.03);
    border-radius: 8px;
}

@media (max-width: 768px) {
    .single-article .article-title {
        font-size: 2rem;
    }
    
    .single-article .article-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .article-navigation {
        grid-template-columns: 1fr;
    }
    
    .nav-next {
        text-align: left;
    }
    
    .social-share {
        flex-direction: column;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php get_footer(); ?>