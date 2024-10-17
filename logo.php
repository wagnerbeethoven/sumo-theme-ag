<div class="site-logo">
  <a href="<?php echo esc_url(home_url('/')); ?>">
    <?php if (has_custom_logo()) : ?>
    <?php
      // Obtém o ID do logotipo personalizado
      $custom_logo_id = get_theme_mod('custom_logo');
      // Obtém a URL da imagem do logotipo
      $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
      // Recupera o atributo ALT da imagem
      $alt_text = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
      // Define um valor padrão para o ALT, se necessário
      if (empty($alt_text)) {
        $alt_text = get_bloginfo('name');
      }
      // Recupera o título da imagem (opcional)
      $image_title = get_the_title($custom_logo_id);
      ?>
    <figure title="<?php echo esc_attr(get_the_title()); ?>">
      <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr($alt_text); ?>"
        title="<?php echo esc_attr($image_title); ?>">
    </figure>
    <?php else : ?>
    <!-- Se não houver um logotipo personalizado, exiba o título do site -->
    <figure title="<?php echo esc_attr(get_the_title()); ?>">
      <h1><?php bloginfo('name'); ?></h1>
    </figure>
    <?php endif; ?>
  </a>




  <a title="Traduzir o site / Translate site / Traduire le site / Traducir sitio / Website übersetzen / Traduci sito / サイトを翻訳 / 翻译网站"
    data-bs-toggle="modal" data-bs-target="#translateModal" tabindex="0" role="button" class="translate">
    <span class="bi bi-translate"></span>
    <span class="visually-hidden">Traduzir o site / Translate site / Traduire le site / Traducir sitio / Website
      übersetzen / Traduci sito / サイトを翻訳 / 翻译网站</span>
  </a>
</div>