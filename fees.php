<?php
/**
 * LT TRANSFERS — WEBSITE
 * fees.php — Fees & pricing
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Fees & Pricing | ' . SITE_NAME;
$pageDescription = 'Transparent timeshare transfer pricing from LT Transfers, including document preparation, document search, and resort transfer fees.';
$canonicalPath   = '/fees.php';
$bodyClass       = 'page-fees';

require SITE_ROOT . '/common-template/header.php';
?>

<main>
  <section class="page-hero">
    <div class="breadcrumbs">
      <a href="<?= base_url('index.php') ?>">Home</a>
      <span aria-hidden="true">/</span>
      <span>Fees</span>
    </div>
    <p class="eyebrow">Fee transparency</p>
    <h1>Clear typical costs before you begin</h1>
    <p class="lede"><?= h(SITE_NAME) ?> keeps common service pricing easy to understand. Resort transfer or name-change fees are separate and vary by resort.</p>
  </section>

  <section class="section split-section">
    <div>
      <h2>How our fees work</h2>
      <p>Our document preparation fee covers preparing your transfer paperwork, coordinating county recording where applicable, and notifying the resort once the transfer is complete. If your resort charges its own transfer or name-change fee, that amount is separate and is paid directly to the resort on your behalf — we will always tell you the amount before you are charged.</p>
      <p>We do not process timeshares located in New York, Connecticut, or Illinois. For timeshares in the U.S. Virgin Islands, Aruba, or Mexico, contact us for a custom quote.</p>
      <a class="button primary" href="<?= base_url('booking.php') ?>">Request a Quote</a>
    </div>
    <div class="fee-panel">
      <div class="fee-row">
        <span>Document preparation (transfer)</span>
        <strong>$275&ndash;$450</strong>
      </div>
      <div class="fee-row">
        <span>Document search (if document unavailable)</span>
        <strong>$25</strong>
      </div>
      <div class="fee-row">
        <span>Resort transfer / name-change fee</span>
        <strong>Varies by resort</strong>
      </div>
      <div class="fee-row">
        <span>U.S. Virgin Islands, Aruba &amp; Mexico</span>
        <strong>Custom quote</strong>
      </div>
    </div>
  </section>

  <section class="section section-soft">
    <div class="section-heading">
      <p class="eyebrow">What affects the price?</p>
      <h2>Why fees vary by state and situation</h2>
    </div>
    <div class="value-grid">
      <article>
        <h3>State recording requirements</h3>
        <p>Document recording rules and county fees differ by state, which affects the final document preparation cost.</p>
      </article>
      <article>
        <h3>Resort-specific paperwork</h3>
        <p>Some resort systems require additional forms or notarization steps beyond a standard document transfer.</p>
      </article>
      <article>
        <h3>Situation complexity</h3>
        <p>Trust transfers, inheritance transfers, and multi-owner situations can require extra documentation.</p>
      </article>
    </div>
  </section>

  <section class="final-cta">
    <div>
      <p class="eyebrow">Get an exact quote</p>
      <h2>Send us your timeshare details for a precise, no-obligation quote.</h2>
    </div>
    <div class="cta-row">
      <a class="button primary light" href="<?= base_url('booking.php') ?>">Get Started Today</a>
      <a class="button secondary light" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">Call <?= h(COMPANY_PHONE) ?></a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
