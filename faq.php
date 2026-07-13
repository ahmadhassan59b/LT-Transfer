<?php
/**
 * LT TRANSFERS — WEBSITE
 * faq.php — Full FAQ page
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Timeshare Transfer FAQ | ' . SITE_NAME;
$pageDescription = 'Answers to common questions about timeshare transfers, fees, document searches, trust transfers, and resort notification.';
$canonicalPath   = '/faq.php';
$bodyClass       = 'page-faq';

require SITE_ROOT . '/common-template/header.php';

$faqData = require SITE_ROOT . '/includes/faq-data.php';
?>

<main>
  <section class="page-hero">
    <div class="breadcrumbs">
      <a href="<?= base_url('index.php') ?>">Home</a>
      <span aria-hidden="true">/</span>
      <span>FAQ</span>
    </div>
    <p class="eyebrow">Common questions</p>
    <h1>Timeshare transfer frequently asked questions</h1>
    <p class="lede">Answers to the questions we hear most often. Do not see yours? <a href="<?= base_url('contact.php') ?>">Contact us</a> directly. Curious about ownership verification? Read <a href="<?= base_url('estoppel-explanation.php') ?>">What Is a Timeshare Estoppel?</a></p>
  </section>

  <section class="section">
    <div class="section-narrow">
      <?php foreach ($faqData as $category => $items): ?>
        <div class="faq-category">
          <h2><?= h($category) ?></h2>
          <div class="faq-list">
            <?php foreach ($items as $item): ?>
              <details>
                <summary><?= h($item['q']) ?></summary>
                <p><?= h($item['a']) ?></p>
              </details>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="final-cta">
    <div>
      <p class="eyebrow">Still have questions?</p>
      <h2>Send us the details of your timeshare and we will walk you through it.</h2>
    </div>
    <div class="cta-row">
      <a class="button primary light" href="<?= base_url('contact.php') ?>">Contact Us</a>
      <a class="button secondary light" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">Call <?= h(COMPANY_PHONE) ?></a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
