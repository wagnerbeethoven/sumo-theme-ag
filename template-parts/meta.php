  <!-- Post meta 2 -->
  <ul class="post-meta post-meta-footer">
    <li class="post-author" title="Escrito por Wagner Beethoven">
      <span class="bi bi-pen-fill"></span> <a href="<?php echo home_url(); ?>/sobre">Wagner Beethoven</a>
    </li>
    <li class="post-category">
      <span class="bi bi-archive-fill me-3" title="Seção do conteúdo"></span>
      <?php the_category(', '); ?>
    </li>
    <li class="post-tag">
      <span class="bi bi-bookmark-fill me-3" title="Assuntos da página"></span>
      <?php the_tags('', ', ', ''); ?>
    </li>
    <li class="comment-link">
      <span class="bi bi-chat-left-fill" title="Assuntos da página"></span>
      <?php if (comments_open()) {
        echo '<a href="' . esc_url(get_comments_link()) . '">' . sprintf(esc_html__('Comentários', 'ag')) . '</a>';
      } ?>
    </li>
  </ul>
  <!-- Post meta 2 -->