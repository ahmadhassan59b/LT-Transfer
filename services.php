<?php
/** Services overview. */
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Timeshare Transfer Services | ' . SITE_NAME;
$pageDescription = 'Explore LT Transfers services by resort and ownership situation, including Disney, Marriott, Hilton, Wyndham, Hyatt, Vistana, trust, and inheritance transfers.';
$canonicalPath   = '/services.php';
$bodyClass       = 'page-services';

require SITE_ROOT . '/common-template/header.php';

$services          = require SITE_ROOT . '/includes/services-data.php';
$resortServices    = array_filter($services, fn ($s) => $s['eyebrow'] === 'Resort-specific transfer service');
$situationServices = array_filter($services, fn ($s) => $s['eyebrow'] === 'Ownership situation');
?>

<main class="services-main">
  <section class="page-hero services-hero">
    <div class="services-hero-grid">
      <div>
        <div class="breadcrumbs"><a href="<?= base_url('index.php') ?>">Home</a><span aria-hidden="true">/</span><span>Services</span></div>
        <p class="eyebrow">Timeshare transfer expertise</p>
        <h1>The right transfer service for your ownership</h1>
        <p class="lede">From resort-specific paperwork to family, trust, and inheritance changes, we prepare the documents and guide the process from start to finish.</p>
        <div class="services-hero-actions"><a class="button primary" href="#service-options">Explore services</a><a class="services-text-link" href="<?= base_url('booking.php') ?>">Start your transfer <span aria-hidden="true">&rarr;</span></a></div>
      </div>
      <aside class="services-process-card" aria-label="How LT Transfers helps">
        <p class="eyebrow">One coordinated process</p>
        <ol><li><span>01</span><div><strong>We review</strong><small>Your ownership and transfer goals</small></div></li><li><span>02</span><div><strong>We prepare</strong><small>The documents your situation requires</small></div></li><li><span>03</span><div><strong>We coordinate</strong><small>Recording and resort notification</small></div></li></ol>
      </aside>
    </div>
  </section>

  <section class="services-trust-strip" aria-label="Service highlights"><article><strong>Nationwide</strong><span>Transfer experience</span></article><article><strong>Resort-specific</strong><span>Document knowledge</span></article><article><strong>Start to finish</strong><span>Guided support</span></article><article><strong>Since <?= h(SITE_ESTABLISHED) ?></strong><span>Owner-focused service</span></article></section>

  <section class="section services-resort-section" id="service-options">
    <div class="services-section-intro"><div><p class="eyebrow">Choose your resort</p><h2>Transfer services built around resort requirements</h2></div><p>Each vacation ownership system has its own forms, recording needs, and notification steps. Our experience helps keep those details organized.</p></div>
    <div class="services-resort-grid">
      <?php $serviceIndex = 0; foreach ($resortServices as $slug => $service): $serviceIndex++; ?>
        <article class="services-resort-card">
          <div class="services-card-top"><span><?= str_pad((string) $serviceIndex, 2, '0', STR_PAD_LEFT) ?></span><i aria-hidden="true"><?= h(strtoupper(substr($service['title'], 0, 1))) ?></i></div>
          <h3><?= h($service['title']) ?></h3><p><?= h($service['intro']) ?></p>
          <a href="<?= base_url($slug . '/') ?>">View service details <span aria-hidden="true">&rarr;</span></a>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section section-soft services-situation-section">
    <div class="services-section-intro"><div><p class="eyebrow">Choose your situation</p><h2>Support for the ownership change you need</h2></div><p>Family, estate, and trust-related transfers require more than a standard change of name. We help identify and prepare the right paperwork.</p></div>
    <div class="services-situation-grid">
      <?php $situationIndex = 0; foreach ($situationServices as $slug => $service): $situationIndex++; ?>
        <article><span class="services-situation-number"><?= str_pad((string) $situationIndex, 2, '0', STR_PAD_LEFT) ?></span><div><span class="service-tag">Ownership situation</span><h3><?= h($service['title']) ?></h3><p><?= h($service['intro']) ?></p><a href="<?= base_url($slug . '/') ?>">Learn about this transfer <span aria-hidden="true">&rarr;</span></a></div></article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section services-guidance-section">
    <div class="services-guidance-panel">
      <div><p class="eyebrow">Not sure where you fit?</p><h2>Tell us what you own and what you want to change.</h2><p>We work with many additional resorts, including properties in the U.S. Virgin Islands, Aruba, and Mexico. Share the details you have and we will explain what is needed.</p><div class="services-guidance-actions"><a class="button primary" href="<?= base_url('contact.php') ?>">Ask our team</a><a class="button secondary" href="<?= base_url('booking.php') ?>">Request a quote</a></div></div>
      <aside><span>Typical transfer service</span><strong>$275&ndash;$450</strong><p>Document search, when needed: $25</p><a href="<?= base_url('fees.php') ?>">See complete pricing <span aria-hidden="true">&rarr;</span></a></aside>
    </div>
  </section>

  <section class="final-cta"><div><p class="eyebrow">Ready to transfer your timeshare?</p><h2>Start with the details you have. We will help with the next step.</h2></div><div class="cta-row"><a class="button primary light" href="<?= base_url('booking.php') ?>">Get Started Today</a><a class="button secondary light" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">Call <?= h(COMPANY_PHONE) ?></a></div></section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
