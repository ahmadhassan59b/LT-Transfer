<?php
/**
 * LT TRANSFERS — WEBSITE
 * 404.php — Not found page
 */

if (!defined('SITE_ROOT')) {
    require_once __DIR__ . '/includes/bootstrap.php';
}

$pageTitle       = 'Page Not Found | ' . SITE_NAME;
$pageDescription = 'The page you are looking for could not be found.';
$canonicalPath   = '/404.php';
$bodyClass       = 'page-404';

require SITE_ROOT . '/common-template/header.php';
?>

<main>
  <section class="section error-page">
    <span class="error-code">404</span>
    <h1>We couldn't find that page</h1>
    <p class="lede">The page you're looking for may have moved or no longer exists. Try one of the links below, or head back to the homepage.</p>
    <div class="cta-row">
      <a class="button primary" href="<?= base_url('index.php') ?>">Back to Homepage</a>
      <a class="button secondary" href="<?= base_url('services.php') ?>">Browse Services</a>
      <a class="button secondary" href="<?= base_url('contact.php') ?>">Contact Us</a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
