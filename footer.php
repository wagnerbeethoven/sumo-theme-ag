</main>
<?php //get_sidebar(); 
?>
<?php get_template_part('template-parts/podcast', 'podcast'); ?>


<footer id="footer" role="contentinfo" class="container footer-site">

  <div class="footer-container social-footer">

    <nav class="menu-footer-pages">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'menu_rodape',
        'container'      => false, // Remove o container padrão
        'menu_class'     => 'footer-menu',
      ));
      ?>
    </nav>
    <nav class="menu-footer-social">
      <?php get_template_part('template-parts/social'); ?>


      <a href="<?php echo esc_url(get_site_url() . '/feed'); ?>" class="rss-link"
        title="<?php esc_attr_e('Assine o RSS', 'seu-text-domain'); ?>">
        <span class="bi bi-rss-fill"></span>
        <span class="visually-hidden"><?php _e('RSS', 'seu-text-domain'); ?></span>
      </a>
    </nav>
  </div>
</footer>

</div>
<?php wp_footer(); ?>

<!-- Modal do Bootstrap -->
<div class="modal fade" id="translateModal" tabindex="-1" aria-labelledby="translateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title" id="translateModalLabel"><?php _e('Selecione o idioma', 'seu-text-domain'); ?></div>
        <button type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="<?php _e('Fechar', 'seu-text-domain'); ?>"></button>
      </div>
      <div class="modal-body">
        <div class="translate-options">
          <ul class="list-group list-group-flush">
            <li class="px-0 list-group-item"><span class="me-2">🇺🇸</span>
              <?php _e('Select language:', 'seu-text-domain'); ?> <a href="#" data-lang="en">English</a></li>
            <li class="px-0 list-group-item"><span class="me-2">🇫🇷</span>
              <?php _e('Sélectionnez la langue:', 'seu-text-domain'); ?> <a href="#" data-lang="fr">Français</a></li>
            <li class="px-0 list-group-item"><span class="me-2">🇪🇸</span>
              <?php _e('Seleccione el idioma:', 'seu-text-domain'); ?> <a href="#" data-lang="es">Español</a></li>
            <li class="px-0 list-group-item"><span class="me-2">🇩🇪</span>
              <?php _e('Sprache auswählen:', 'seu-text-domain'); ?> <a href="#" data-lang="de">Deutsch</a></li>
            <li class="px-0 list-group-item"><span class="me-2">🇮🇹</span>
              <?php _e('Seleziona la lingua:', 'seu-text-domain'); ?> <a href="#" data-lang="it">Italiano</a></li>
            <li class="px-0 list-group-item"><span class="me-2">🇯🇵</span> <?php _e('言語を選択:', 'seu-text-domain'); ?> <a
                href="#" data-lang="ja">日本語</a>
            </li>
            <li class="px-0 list-group-item"><span class="me-2">🇨🇳</span> <?php _e('选择语言:', 'seu-text-domain'); ?> <a
                href="#" data-lang="zh-CN">中文
                (简体)</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</body>

</html>