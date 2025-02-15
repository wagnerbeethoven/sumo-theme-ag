<?php
get_header();

if (have_posts()) :
  while (have_posts()) : the_post();
?>

    <?php get_template_part('template-parts/banner', 'banner'); ?>
    <header class="entry-header mb-5">
      <?php the_title('<h1 class="page-title entry-title mb-4" itemprop="name">', '</h1>'); ?>
    </header>
    <div class="row pt-4">
      
      <div class="col-12 col-md-8 entry-content">
        <?php get_template_part('template-parts/sidebar', 'sidebar'); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


          <div class="article_content">
            <?php the_content(); ?>
          </div>
        </article>
      </div>
    </div>

<?php
  endwhile;
endif;
get_footer();
?>