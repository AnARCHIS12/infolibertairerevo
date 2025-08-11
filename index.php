<?php get_header(); ?>

<main class="main-content">
    <div class="content-area">
        <?php if (have_posts()) : ?>
            <div class="articles-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="article-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="article-image">
                        <?php endif; ?>
                        
                        <div class="article-content">
                            <h2 class="article-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <div class="article-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </div>
                            
                            <div class="article-meta">
                                <span class="article-date"><?php echo get_the_date(); ?></span>
                                <span class="article-category">
                                    <?php 
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo esc_html($categories[0]->name);
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <div class="pagination">
                <?php
                the_posts_pagination(array(
                    'prev_text' => '← Précédent',
                    'next_text' => 'Suivant →',
                ));
                ?>
            </div>
            
        <?php else : ?>
            <div class="no-posts">
                <h2>Aucun article trouvé</h2>
                <p>Il n'y a pas encore d'articles publiés.</p>
            </div>
        <?php endif; ?>
    </div>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>