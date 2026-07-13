<?php
/**
 * LT TRANSFERS — WEBSITE
 * service.php — Dynamic single-service page
 *
 * Renders one entry from includes/services-data.php based on
 * the ?slug= query parameter. Pretty URLs like
 * /disney-vacation-club-transfers/ are rewritten to this file
 * by .htaccess (see the RewriteRule block at the project root).
 */

require_once __DIR__ . '/includes/bootstrap.php';

$services = require SITE_ROOT . '/includes/services-data.php';
$slug     = clean($_GET['slug'] ?? '', 100);

if ($slug === '' || !isset($services[$slug])) {
    http_response_code(404);
    require SITE_ROOT . '/404.php';
    exit;
}

$service = $services[$slug];

$pageTitle       = $service['title'] . ' | ' . SITE_NAME;
$pageDescription = $service['meta'];
$canonicalPath   = '/' . $slug . '/';
$bodyClass       = 'page-service';

require SITE_ROOT . '/common-template/header.php';

/* Build a short "related services" list (up to 4, excluding current) */
$related = array_filter($services, fn ($key) => $key !== $slug, ARRAY_FILTER_USE_KEY);
$related = array_slice($related, 0, 4, true);
?>

<main>
  <section class="page-hero">
    <div class="breadcrumbs">
      <a href="<?= base_url('index.php') ?>">Home</a>
      <span aria-hidden="true">/</span>
      <a href="<?= base_url('services.php') ?>">Services</a>
      <span aria-hidden="true">/</span>
      <span><?= h($service['title']) ?></span>
    </div>
    <p class="eyebrow"><?= h($service['eyebrow']) ?></p>
    <h1><?= h($service['title']) ?></h1>
    <p class="lede"><?= h($service['intro']) ?></p>
  </section>

  <section class="section">
    <div class="service-detail">
      <div class="prose">
        <h2>What's included</h2>
        <ul class="point-list">
          <?php foreach ($service['points'] as $point): ?>
            <li><?= h($point) ?></li>
          <?php endforeach; ?>
        </ul>

        <h2>How the process works</h2>
        <p>We start with your timeshare and contact details. If you have a copy of your current ownership document, you can upload it directly — if not, we can usually conduct a document search for a $25 research fee. Once we have what we need, we prepare the transfer documents and send them to you for review and signature.</p>
        <p>After your documents are signed, we handle county recording where applicable and notify the resort of the ownership change. Typical turnaround is 8 to 20 weeks, depending on your resort and county requirements.</p>

        <h2>Fees</h2>
        <p>Document preparation typically ranges from $275 to $450, depending on your state and document requirements. Any resort transfer or name-change fee is separate and paid directly to the resort on your behalf.</p>
      </div>

      <aside class="service-sidebar">
        <h3>Ready to get started?</h3>
        <p>Send us your timeshare details and we will let you know exactly what is needed for your transfer.</p>
        <a class="button primary" href="<?= base_url('booking.php') ?>">Start Your Transfer</a>
        <a class="button secondary" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>" style="margin-top:10px;">Call <?= h(COMPANY_PHONE) ?></a>

        <div class="related-services">
          <h4>Helpful resource</h4>
          <a href="<?= base_url('estoppel-explanation.php') ?>">What Is a Timeshare Estoppel?</a>
        </div>

        <?php if ($related): ?>
        <div class="related-services">
          <h4>Related services</h4>
          <?php foreach ($related as $relSlug => $relService): ?>
            <a href="<?= base_url($relSlug . '/') ?>"><?= h($relService['short']) ?></a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </aside>
    </div>
  </section>

  <section class="final-cta">
    <div>
      <p class="eyebrow">Questions about your transfer?</p>
      <h2>We are happy to explain the process before you begin.</h2>
    </div>
    <div class="cta-row">
      <a class="button primary light" href="<?= base_url('contact.php') ?>">Contact Us</a>
      <a class="button secondary light" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">Call <?= h(COMPANY_PHONE) ?></a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
