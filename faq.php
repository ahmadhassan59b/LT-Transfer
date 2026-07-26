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

<main class="faq-main">
  <section class="page-hero faq-hero">
    <div class="faq-hero-grid">
      <div>
        <div class="breadcrumbs">
          <a href="<?= base_url('index.php') ?>">Home</a>
          <span aria-hidden="true">/</span>
          <span>FAQ</span>
        </div>
        <p class="eyebrow">Answers, without the guesswork</p>
        <h1>Timeshare transfer questions, clearly answered</h1>
        <p class="lede">Straightforward guidance about timing, costs, documents, family transfers, trusts, and what happens at each stage.</p>
        <div class="faq-hero-actions"><a class="button primary" href="#faq-questions">Explore questions</a><a class="faq-hero-link" href="<?= base_url('contact.php') ?>">Ask us directly <span aria-hidden="true">&rarr;</span></a></div>
      </div>
      <aside class="faq-hero-card">
        <span class="faq-hero-card-label">Quick answer</span>
        <strong>Most transfers take 8&ndash;20 weeks.</strong>
        <p>Timing depends on the resort, recording office, and the documents required for your specific ownership.</p>
        <a href="<?= base_url('booking.php') ?>">Start your transfer <span aria-hidden="true">&rarr;</span></a>
      </aside>
    </div>
  </section>

  <nav class="faq-category-nav" aria-label="FAQ categories">
    <span>Browse by topic</span>
    <?php foreach ($faqData as $category => $items): $categoryId = 'faq-' . strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($category))); ?>
      <a href="#<?= h($categoryId) ?>"><?= h($category) ?><small><?= count($items) ?></small></a>
    <?php endforeach; ?>
  </nav>

  <section class="section faq-content-section" id="faq-questions">
    <div class="faq-layout">
      <aside class="faq-support-card">
        <span class="faq-support-number">01</span>
        <p class="eyebrow">Need personal guidance?</p>
        <h2>Your transfer may have details these answers cannot cover.</h2>
        <p>Tell us about your resort and ownership. We will explain the documents and next steps that apply to you.</p>
        <a class="button primary" href="<?= base_url('contact.php') ?>">Talk to our team</a>
        <a class="faq-estoppel-link" href="<?= base_url('estoppel-explanation.php') ?>">Learn about timeshare estoppels <span aria-hidden="true">&rarr;</span></a>
      </aside>
      <div class="faq-groups">
      <?php $categoryIndex = 0; foreach ($faqData as $category => $items): $categoryIndex++; $categoryId = 'faq-' . strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($category))); ?>
        <section class="faq-category" id="<?= h($categoryId) ?>">
          <header class="faq-category-heading"><span><?= str_pad((string) $categoryIndex, 2, '0', STR_PAD_LEFT) ?></span><div><p><?= count($items) ?> questions</p><h2><?= h($category) ?></h2></div></header>
          <div class="faq-list">
            <?php foreach ($items as $itemIndex => $item): ?>
              <details class="faq-item"<?= $categoryIndex === 1 && $itemIndex === 0 ? ' open' : '' ?>>
                <summary><span><?= h($item['q']) ?></span><i aria-hidden="true"></i></summary>
                <div class="faq-answer"><p><?= h($item['a']) ?></p></div>
              </details>
            <?php endforeach; ?>
          </div>
        </section>
      <?php endforeach; ?>
      </div>
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
