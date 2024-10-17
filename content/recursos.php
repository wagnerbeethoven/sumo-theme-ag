<article id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-8 entry-content pt-4'); ?>>
    <header class="entry-header">
        <h1 class="page-title pt-5 mb-5 entry-title"><?php the_title(); ?></h1>
        <?php get_template_part('template-parts/post-meta'); ?>
    </header>
    <div class="article_content pt-4">
        <?php the_content(); ?>



        <p>
            <?php $link_adicional = get_post_meta(get_the_ID(), 'publication_url', true);
            $nome_link_adicional = get_post_meta(get_the_ID(), 'publication_source', true);
            if (! empty($link_adicional)) : ?>
                <a class="icon-link lh-1" href="<?php echo esc_url($link_adicional); ?>" target="_blank">
                    <span class="bi bi-link-45deg" aria-hidden="true"></span>
                    <?php echo esc_html($nome_link_adicional); ?>
                    <span class="bi bi-arrow-right-short" aria-hidden="true"></span>
                </a>
            <?php endif; ?>
        </p>

    </div>

    <?php get_template_part('template-parts/share', 'share'); ?>
    <?php get_template_part('template-parts/meta', 'meta'); ?>
    <?php get_template_part('template-parts/nav', 'nav'); ?>

    <?php
    if (comments_open() && ! post_password_required()) {
        comments_template();
    } else {
        echo '<p class="comments-closed">Os comentários estão fechados para esta publicação.</p>';
    }
    ?>
</article>