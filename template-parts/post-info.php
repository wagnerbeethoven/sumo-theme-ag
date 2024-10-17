<ul class="post-meta post-meta-header">
  <li>
    <time datetime="<?php the_date('Y-m-d'); ?>">
      <span class="bi bi-calendar-event" title="Data de publicação"></span>
      <?php echo get_the_date('d/m/Y'); ?>
    </time>
  </li>
  <li>
    <span class="bi bi-stopwatch" title="Duração de leitura"></span>
    <?php echo display_reading_time(); ?>
  </li>
  <?php
  $link_adicional = get_post_meta(get_the_ID(), 'publication_url', true);
  $nome_link_adicional = get_post_meta(get_the_ID(), 'publication_source', true);

  if (! empty($link_adicional)) :
  ?>
  <li title="Publicado originalmente no <?php echo esc_html($nome_link_adicional); ?>">
    <span class="bi bi-megaphone-fill"></span>
        <a href="<?php echo esc_url($link_adicional); ?>" class="alert-link">
      <?php echo esc_html($nome_link_adicional); ?>
    </a>
  </li>
  <?php endif; ?>
</ul>