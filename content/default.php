<?php get_template_part('template-parts/banner', 'banner'); ?>

<div class="row pt-4">

    <div class="col-12 mx-auto col-md-8 entry-content">
        <article id="post-<?php the_ID(); ?>" <?php post_class('e-content'); ?>>
            <header class="entry-header mb-5">
                <?php the_title('<h1 class="page-title entry-title" itemprop="name">', '</h1>'); ?>
                <?php get_template_part('template-parts/post-info', 'post-info'); ?>
                <?php get_template_part('template-parts/summary', 'summary'); ?>
            </header>
            
            <?php get_template_part('template-parts/sidebar', 'sidebar'); ?>

            <div class="article_content">
                <?php the_content(); ?>
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
    </div>
</div>