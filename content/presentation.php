

<article id="presentation-<?php the_ID(); ?>" <?php post_class('presentation-content'); ?>>
  <iframe class="speakerdeck-iframe" frameborder="0" src="
  <?php

  $publication_url = get_post_meta(get_the_ID(), 'publication_url', true);
  if ($publication_url) {
    $tags_array = explode(',', $publication_url);
    foreach ($tags_array as $tag) {
      echo '' . esc_html(trim($tag)) . '';
    }
  }
  ?>" title="<?php the_title(); ?>" allowfullscreen="true"
    style="border: 0px; background: padding-box padding-box rgba(0, 0, 0, 0.1); margin: 0px; padding: 0px; border-radius: 6px; box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 40px; width: 100%; height: auto; aspect-ratio: 560 / 315;"
    data-ratio="1.7777777777777777"></iframe>



  <header class="entry-header">
    <h1 class="page-title pt-5 mb-5 entry-title"><?php the_title(); ?></h1>
    <?php get_template_part('template-parts/post-meta'); ?>
  </header>
  <div class="entry-content pt-4">
    <?php the_content(); ?>
    <?php get_template_part('template-parts/share', 'share'); ?>
    <?php get_template_part('template-parts/meta', 'meta'); ?>
    <?php get_template_part('template-parts/nav', 'nav'); ?>

  </div>
</article>
<?php
if (comments_open() && ! post_password_required()) {
  comments_template();
} else {
  echo '<p class="comments-closed">Os comentários estão fechados para esta publicação.</p>';
}
?>