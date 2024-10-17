<div id="comments">
  <?php
  if (have_comments()) :
    global $comments_by_type;
    $comments_by_type = separate_comments($comments);
    if (!empty($comments_by_type['comment'])) :
  ?>
  <section id="comments-list" class="comment-list comments">
    <h2 class="comments-title"><?php comments_number(); ?></h2>
    <?php if (get_comment_pages_count() > 1) : ?>
    <nav id="comments-nav-above" class="comments-navigation" role="navigation">
      <div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
    </nav>
    <?php endif; ?>
    <ul>
      <?php wp_list_comments('type=comment'); ?>
    </ul>
    <?php if (get_comment_pages_count() > 1) : ?>
    <nav id="comments-nav-below" class="comments-navigation" role="navigation">
      <div class="paginated-comments-links"><?php paginate_comments_links(); ?></div>
    </nav>
    <?php endif; ?>
  </section>
  <?php
    endif;
    if (!empty($comments_by_type['pings'])) :
      $ping_count = count($comments_by_type['pings']);
    ?>
  <section id="trackbacks-list" class="comments">
    <h2 class="comments-title">
      <?php echo '<span class="ping-count">' . esc_html($ping_count) . '</span> ' . esc_html(_nx('Trackback or Pingback', 'Trackbacks and Pingbacks', $ping_count, 'comments count', 'ag')); ?>
    </h2>
    <ul>
      <?php wp_list_comments('type=pings&callback=ag_custom_pings'); ?>
    </ul>
  </section>
  <?php
    endif;
  endif;
  if (comments_open()) {
    comment_form();
  }
  ?>
</div>
<style>
/* Estilo geral da área de comentários */
.comments-area {
  margin-top: 40px;
  padding: 20px;
  background-color: #f9f9f9;
}

/* Título da seção de comentários */
.comments-area h2 {
  margin-bottom: 20px;
  font-size: 24px;
  border-bottom: 2px solid #ddd;
  padding-bottom: 10px;
}

/* Lista de comentários */
.comment-list {
  list-style: none;
  margin: 0;
  padding: 0;
}

/* Cada comentário individual */
.comment-list li {
  margin-bottom: 20px;
  padding-bottom: 20px;
  border-bottom: 1px solid #eee;
}

/* Avatar do autor do comentário */
.comment-list .comment-author .avatar {
  float: left;
  margin-right: 15px;
  border-radius: 50%;
}

/* Nome do autor e data do comentário */
.comment-list .comment-meta {
  font-size: 14px;
  color: #555;
  margin-bottom: 10px;
}

/* Conteúdo do comentário */
.comment-list .comment-content {
  font-size: 16px;
  line-height: 1.6;
}

/* Link de resposta ao comentário */
.comment-list .reply {
  margin-top: 10px;
}

.comment-list .reply a {
  font-size: 14px;
  color: #0073aa;
  text-decoration: none;
}

.comment-list .reply a:hover {
  text-decoration: underline;
}

/* Formulário de comentário */
#respond {
  margin-top: 40px;
}

#respond h3 {
  margin-bottom: 20px;
  font-size: 20px;
  border-bottom: 2px solid #ddd;
  padding-bottom: 10px;
}

/* Campos do formulário */
#respond p {
  margin-bottom: 15px;
}

#respond input[type="text"],
#respond input[type="email"],
#respond input[type="url"],
#respond textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

#respond input[type="submit"] {
  padding: 10px 20px;
  background-color: #0073aa;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#respond input[type="submit"]:hover {
  background-color: #005177;
}
</style>