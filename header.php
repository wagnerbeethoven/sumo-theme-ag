<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" />

  <?php wp_head(); ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">



</head>

<body <?php body_class('container mx-auto'); ?>>
  <?php wp_body_open(); ?>
  <?php
  if (is_single()) : ?>
    <header class="container header-site header-page">
      <div class="logo-page">
        <?php get_template_part('logo'); ?>
      </div>
      <div class="header-description">
        <div class="site-name-page" id="site-title" itemprop="publisher" itemscope
          itemtype="https://schema.org/Organization"><?php bloginfo('name'); ?></div>
        <div class="menu-page">
          <?php get_template_part('template-parts/menu'); ?>
        </div>
      </div>
    </header>
  <?php else : ?>
    <header class="container header-site header-index">
      <?php get_template_part('logo'); ?>
    </header>
  <?php endif; ?>


  <main id="content" role="main" class="container">