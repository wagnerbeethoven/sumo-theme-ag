<?php get_header(); ?>
<article id="post-0" class="post not-found">

  <div id="error">
    <div class="fof">
      <h1>Página não encontrada</h1>
    </div>
  </div>
  <p>
    <a class="mt-5 d-inline-block text-decoration-none btn" href="<?php bloginfo('url'); ?>">
      <span class="bi bi-arrow-bar-left me-1"></span>Página inicial</a>
  </p>

  <?php get_search_form(); ?>
</article>
<?php get_footer(); ?>