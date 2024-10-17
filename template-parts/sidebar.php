<?php
// Verifica se estamos em uma página ou post singular
if (is_singular()) :
  // Obtém o valor do campo personalizado 'exibir_toc' para o post atual
  $exibir_toc = get_post_meta(get_the_ID(), 'exibir_toc', true);

  // Define classes CSS com base no valor de $exibir_toc
  if ($exibir_toc) {
    $classe_aside = 'd-block';
  } else {
    $classe_aside = 'd-none';
  }
?>

  <aside id="sidebar" class="<?php echo $classe_aside; ?> col-12 col-md-4" role="complementary">
  <?php
    if ($exibir_toc) {
      // Exibe o TOC usando o shortcode
      echo do_shortcode('[toc]');
    }
    
    // Verifica se a área de widgets está ativa
    if (is_active_sidebar('primary-widget-area')) : ?>
      <ul class="list-group list-group-flush">
        
        <?php dynamic_sidebar('primary-widget-area'); ?>
      </ul>
    <?php endif; ?>
  </aside>

<?php endif; // Fim da verificação is_singular() 
?>