<div class="menu-main">
  <p>
    <a href="/sobre" title="Experiências profissionais, acadêmicas">Conheça minha trajetória</a> &bull; <a
      href="/contato" title="Fale comigo por email, telefone e nas redes socias">Fale comigo</a>.
    <?php
    if (is_single()) : ?><br>Acesse meus <a href="<?php echo home_url(); ?>/projetos">projetos</a>, leia
    meus <?php $slug_categoria = 'textos';
            $categoria = get_category_by_slug($slug_categoria);
            if (! is_wp_error($categoria)) {
              echo '<a href="' . esc_url(get_category_link($categoria->term_id)) . '">textos</a>';
            } ?> e confira minhas
    <?php $slug_categoria = 'palestras';
      $categoria = get_category_by_slug($slug_categoria);
      if (! is_wp_error($categoria)) {
        echo '<a href="' . esc_url(get_category_link($categoria->term_id)) . '">palestras</a>';
      } ?>
    .<?php endif; ?>
  </p>
  <p>Ouça meu <a href="#podcast" title="Podcast sobre acessibilidade, inclusão e diversidade na tecnologia">podcast</a>.
  </p>
</div>