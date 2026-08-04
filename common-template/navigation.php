<?php
/**
 * LT TRANSFERS — WEBSITE
 * common-template/navigation.php
 *
 * Primary site navigation. Included by header.php.
 * Uses is_active_page() (includes/helpers.php) to highlight
 * the current section in the menu.
 */

$navLinks = [
    ['label' => 'Home',        'href' => base_url('/'),        'pages' => ['index.php', '']],
    ['label' => 'About',       'href' => base_url('about'),        'pages' => ['about.php']],
    ['label' => 'Services',    'href' => base_url('services'),     'pages' => ['services.php', 'service.php']],
	['label' => 'How It Works',        'href' => base_url('how-it-works-timeshare-deed-transfer'),         'pages' => ['how-it-works-timeshare-deed-transfer.php']],
    ['label' => 'Fees',        'href' => base_url('fees'),         'pages' => ['fees.php']],
    ['label' => 'FAQ',         'href' => base_url('faq'),          'pages' => ['faq.php']],
    ['label' => 'Testimonials','href' => base_url('testimonials'), 'pages' => ['testimonials.php']],
	['label' => 'Document Preparation', 'href' => base_url('document-preparation'), 'pages' => ['document-preparation.php']],
    ['label' => 'Contact',     'href' => base_url('contact'),      'pages' => ['contact.php']],
];
?>
<header class="site-header" data-header>
    <a class="brand" href="<?= base_url('/') ?>" aria-label="<?= h(SITE_NAME) ?> home">
    <img class="brand-logo" src="<?= asset('media/images/IT-Transfers-logo.png') ?>" alt="<?= h(SITE_NAME) ?>" width="290" height="86">
  </a>

  <button class="nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="site-nav">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <nav class="site-nav" id="site-nav" data-nav>
    <?php foreach ($navLinks as $link): ?>
      <a href="<?= h($link['href']) ?>" class="<?= is_active_page($link['pages']) ? 'is-current' : '' ?>"><?= h($link['label']) ?></a>
    <?php endforeach; ?>
    <a class="nav-phone" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>"><?= h(COMPANY_PHONE) ?></a>
    <a class="nav-cta" href="<?= base_url('document-preparation') ?>">Start Your Transfer</a>
  </nav>
</header>
