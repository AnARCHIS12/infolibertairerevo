<?php
// Template des commentaires conforme aux recommandations WordPress
if (post_password_required()) {
    return;
}
?>
<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number === 1) {
                _e('Un commentaire', 'infolibertaire-inspired');
            } else {
                printf(_n('%s commentaire', '%s commentaires', $comments_number, 'infolibertaire-inspired'), number_format_i18n($comments_number));
            }
            ?>
        </h2>
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 48,
            ));
            ?>
        </ol>
        <?php the_comments_navigation(); ?>
    <?php endif; ?>
    <?php if (!comments_open() && get_comments_number()) : ?>
        <p class="no-comments"><?php _e('Les commentaires sont fermés.', 'infolibertaire-inspired'); ?></p>
    <?php endif; ?>
    <?php comment_form(); ?>
</div>
