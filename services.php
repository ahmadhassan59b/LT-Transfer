<?php
/**
 * LT TRANSFERS — WEBSITE
 * services.php — Services overview
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Timeshare Transfer Services | ' . SITE_NAME;
$pageDescription = 'Explore LT Transfers services by resort and ownership situation, including Disney, Marriott, Hilton, Wyndham, Hyatt, Vistana, trust, and inheritance transfers.';
$canonicalPath   = '/services.php';
$bodyClass       = 'page-services';

require SITE_ROOT . '/common-template/header.php';

$services = require SITE_ROOT . '/includes/services-data.php';
$resortServices   = array_filter($services, fn ($s) => $s['eyebrow'] === 'Resort-specific transfer service');
$situationServices = array_filter($services, fn ($s) => $s['eyebrow'] === 'Ownership situation');
?>

<main>
  <section class="page-hero">
    <div class="breadcrumbs">
      <a href="<?= base_url('index.php') ?>">Home</a>
      <span aria-hidden="true">/</span>
      <span>Services</span>
    </div>
    <p class="eyebrow">What we do</p>
    <h1>Timeshare transfer services by resort and situation</h1>
    <p class="lede">We prepare your timeshare transfer required forms, coordinate county recording, and notify the resort for a wide range of ownership changes. Browse by resort system or by your specific situation below.</p>
  </section>

  <section class="section">
    <div class="section-heading">
      <p class="eyebrow">By resort system</p>
      <h2>Resort-specific transfer services</h2>
      <p>Each resort system has its own paperwork and notification requirements. We prepare documents to match.</p>
    </div>
    <div class="service-cards">
      <?php foreach ($resortServices as $slug => $service): ?>
        <article>
          <span class="service-tag"><?= h($service['eyebrow']) ?></span>
          <h3><?= h($service['title']) ?></h3>
          <p><?= h($service['intro']) ?></p>
          <a class="service-link" href="<?= base_url($slug . '/') ?>">Learn more &rarr;</a>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section section-soft">
    <div class="section-heading">
      <p class="eyebrow">By ownership situation</p>
      <h2>Common transfer situations</h2>
      <p>Adding family, moving ownership into a trust, or handling an inheritance — each has its own document requirements.</p>
    </div>
    <div class="service-cards">
      <?php foreach ($situationServices as $slug => $service): ?>
        <article>
          <span class="service-tag"><?= h($service['eyebrow']) ?></span>
          <h3><?= h($service['title']) ?></h3>
          <p><?= h($service['intro']) ?></p>
          <a class="service-link" href="<?= base_url($slug . '/') ?>">Learn more &rarr;</a>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section split-section">
    <div>
      <p class="eyebrow">Not sure where you fit?</p>
      <h2>Not seeing your resort or situation listed?</h2>
      <p>We work with many resorts beyond the ones listed here, including properties in the U.S. Virgin Islands, Aruba, and Mexico. Contact us with your timeshare details and we will let you know exactly what is needed.</p>
      <a class="button primary" href="<?= base_url('contact.php') ?>">Ask Us a Question</a>
    </div>
    <div class="fee-panel">
      <div class="fee-row">
        <span>Timeshare transfer</span>
        <strong>$275&ndash;$450</strong>
      </div>
      <div class="fee-row">
        <span>Document search</span>
        <strong>$25</strong>
      </div>
      <div class="fee-row">
        <span>Resort transfer fees</span>
        <strong>Varies by resort</strong>
      </div>
    </div>
  </section>

  <section class="final-cta">
    <div>
      <p class="eyebrow">Ready to transfer your timeshare?</p>
      <h2>Start with the details you have. We will help with the next step.</h2>
    </div>
    <div class="cta-row">
      <a class="button primary light" href="<?= base_url('booking.php') ?>">Get Started Today</a>
      <a class="button secondary light" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">Call <?= h(COMPANY_PHONE) ?></a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
