<p class="page-thanks pt-5 my-5">Obrigado por chegar até aqui 🤗</p>

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

<!-- Menu de Compartilhamento Social -->
<ul class="share">
  <li>Compartilhe no:</li>
  <li>
    <a class="facebook" title="Compartilhe no Facebook"
      href="https://www.facebook.com/share.php?u=<?php echo $site_url . $pageurl; ?>">
      <span class="bi bi-facebook"></span> Facebook
    </a>
  </li>
  <li>
    <a class="twitter" title="Compartilhe no Twitter"
      href="https://twitter.com/intent/tweet?text=<?php echo $site_url . $pageurl; ?>">
      <span class="bi bi-twitter"></span> Twitter
    </a>
  </li>
  <li>
    <a class="linkedin" title="Compartilhe no Linkedin"
      href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $site_url . $pageurl; ?>&title=&summary=&source=">
      <span class="bi bi-linkedin"></span> LinkedIn
    </a>
  </li>
  <?php if ($page_image) :
  ?>
  <li>
    <a class="pinterest" title="Compartilhe no Pinterest"
      href="https://pinterest.com/pin/create/button/?url=<?php echo $site_url . $pageurl; ?>&media=<?php echo esc_url($page_image); ?>&description=">
      <span class="bi bi-pinterest"></span> Pinterest
    </a>
  </li>
  <?php endif; ?>
  <li>
    <a class="mail" title="Compartilhe o texto por Email" href="mailto:?&body=<?php echo $site_url . $pageurl; ?>">
      <span class="bi bi-envelope"></span> Email
    </a>
  </li>
</ul>
<!-- Menu de Compartilhamento Social -->