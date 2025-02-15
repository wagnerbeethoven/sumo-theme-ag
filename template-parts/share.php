<p class="page-thanks pt-5 my-5">Obrigado por chegar até aqui 🤗.
<?php
  // Verifica se a postagem está na categoria "Portfolio" e se existe um link adicional
  if (has_category('Projetos') && $link_adicional = get_post_meta(get_the_ID(), 'publication_url', true)) :
?>
  <a class="text-decoration-none ms-3" href="<?php echo esc_url($link_adicional); ?>" target="_blank">
    <u>Curta o projeto no Behance</u> 👍
  </a>
<?php endif; ?>

</p>

<?php
$custom_pageurl = get_post_meta(get_the_ID(), 'pageurl', true);
if (! empty($custom_pageurl)) {
  $pageurl = esc_url($custom_pageurl);
} else {
  $pageurl = esc_url(get_permalink());
}
$site_url = esc_url(home_url());
$page_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>

<?php echo get_social_share_links(); ?>