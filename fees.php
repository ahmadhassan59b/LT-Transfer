<?php
/** Fees and pricing. */
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Fees & Pricing | ' . SITE_NAME;
$pageDescription = 'Transparent timeshare transfer pricing from LT Transfers, including document preparation, document search, and resort transfer fees.';
$canonicalPath   = '/fees.php';
$bodyClass       = 'page-fees';

require SITE_ROOT . '/common-template/header.php';
?>

<main class="fees-main">
  <section class="page-hero fees-hero">
    <div class="fees-hero-grid">
      <div>
        <div class="breadcrumbs"><a href="<?= base_url('index.php') ?>">Home</a><span aria-hidden="true">/</span><span>Fees</span></div>
        <p class="eyebrow">Straightforward pricing</p>
        <h1>Know the typical cost before you begin</h1>
        <p class="lede">Clear service fees, no hidden surprises, and an exact quote based on your ownership before work begins.</p>
        <div class="fees-hero-actions"><a class="button primary" href="<?= base_url('booking.php') ?>">Request your quote</a><a class="fees-text-link" href="#pricing-details">View pricing details <span aria-hidden="true">&darr;</span></a></div>
      </div>
      <aside class="fees-hero-price" aria-label="Typical document preparation price">
        <span>Typical document preparation</span>
        <div><sup>$</sup><strong>275</strong><i>to</i><sup>$</sup><strong>450</strong></div>
        <p>Your exact fee depends on the state, ownership structure, and documents required.</p>
        <small>Quoted before work begins</small>
      </aside>
    </div>
  </section>

  <section class="fees-trust-strip" aria-label="Pricing commitments">
    <article><span>01</span><strong>Upfront quote</strong><small>Before work begins</small></article>
    <article><span>02</span><strong>Clear inclusions</strong><small>Know what is covered</small></article>
    <article><span>03</span><strong>No hidden fees</strong><small>Separate costs explained</small></article>
  </section>

  <section class="section fees-pricing-section" id="pricing-details">
    <div class="section-heading compact fees-heading"><p class="eyebrow">Pricing details</p><h2>A clear breakdown of common costs</h2><p>Every ownership is reviewed individually. These figures show the typical fees and when additional costs may apply.</p></div>
    <div class="fees-card-grid">
      <article class="fees-price-card fees-price-card-primary"><span class="fees-card-label">Core service</span><h3>Document preparation</h3><div class="fees-card-price">$275&ndash;$450</div><p>Preparation of your transfer paperwork based on the state and ownership requirements.</p><ul><li>Transfer document preparation</li><li>County recording coordination, where applicable</li><li>Resort notification after completion</li></ul><a href="<?= base_url('booking.php') ?>">Get an exact quote <span aria-hidden="true">&rarr;</span></a></article>
      <article class="fees-price-card"><span class="fees-card-label">When needed</span><h3>Document search</h3><div class="fees-card-price">$25</div><p>If you do not have your current ownership document, we can usually locate it for you.</p><small>One-time research fee</small></article>
      <article class="fees-price-card"><span class="fees-card-label">Paid separately</span><h3>Resort transfer fee</h3><div class="fees-card-price fees-card-price-text">Varies by resort</div><p>Some resorts charge their own transfer or name-change fee. We will confirm the amount before you are charged.</p><small>Resort-controlled cost</small></article>
      <article class="fees-price-card fees-price-card-dark"><span class="fees-card-label">Outside standard coverage</span><h3>International locations</h3><div class="fees-card-price fees-card-price-text">Custom quote</div><p>Contact us for ownerships in the U.S. Virgin Islands, Aruba, or Mexico.</p><a href="<?= base_url('contact.php') ?>">Discuss your property <span aria-hidden="true">&rarr;</span></a></article>
    </div>
  </section>

  <section class="section section-soft fees-factors-section">
    <div class="fees-factors-intro"><div><p class="eyebrow">What shapes your quote</p><h2>Why the final fee can vary</h2></div><p>The details of the property and ownership determine the documents, recording steps, and resort requirements involved.</p></div>
    <div class="fees-factor-grid">
      <article><span>01</span><div><h3>State recording requirements</h3><p>Document rules and county recording fees differ by location.</p></div></article>
      <article><span>02</span><div><h3>Resort-specific paperwork</h3><p>Some resort systems require additional forms or notarization.</p></div></article>
      <article><span>03</span><div><h3>Ownership complexity</h3><p>Trusts, inheritances, and multiple owners may require extra documentation.</p></div></article>
    </div>
    <aside class="fees-coverage-note"><strong>Please note</strong><p>We do not process timeshares located in New York, Connecticut, Washington State and Illinois.</p><a href="<?= base_url('contact.php') ?>">Ask about your location <span aria-hidden="true">&rarr;</span></a></aside>
  </section>

  <section class="final-cta"><div><p class="eyebrow">Get an exact quote</p><h2>Send us your timeshare details for a precise, no-obligation quote.</h2></div><div class="cta-row"><a class="button primary light" href="<?= base_url('booking.php') ?>">Get Started Today</a><a class="button secondary light" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">Call <?= h(COMPANY_PHONE) ?></a></div></section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
