<?php
/**
 * LT TRANSFERS — WEBSITE
 * index.php — Homepage
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Timeshare Transfer Experts Since ' . SITE_ESTABLISHED . ' | ' . SITE_NAME;
$pageDescription = 'LT Transfers provides affordable timeshare document preparation, recording, and resort transfer coordination for owners nationwide. Established in ' . SITE_ESTABLISHED . '.';
$canonicalPath   = '/';
$bodyClass       = 'page-home';

require SITE_ROOT . '/common-template/header.php';

$services = require SITE_ROOT . '/includes/services-data.php';
$faqData  = require SITE_ROOT . '/includes/faq-data.php';
$faqPreview = array_slice($faqData['General'], 0, 5);
?>

<main id="top">
  <section class="hero section-band">
    <div class="hero-copy">
      <p class="eyebrow">Established in <?= h(SITE_ESTABLISHED) ?> | Serving owners nationwide</p>
      <h1>Timeshare Transfer Experts Since <?= h(SITE_ESTABLISHED) ?></h1>
      <p class="hero-lede">Professional document preparation, recording, and resort transfer processing for timeshare owners nationwide.</p>
      <p class="hero-support"><?= h(SITE_NAME) ?> handles the paperwork, county recording, and resort notification so ownership changes feel clear, affordable, and carefully managed.</p>
      <div class="cta-row">
        <a class="button primary" href="<?= base_url('booking') ?>">Get Started Today</a>
        <a class="button secondary" href="<?= base_url('fees') ?>">Request a Quote</a>
      </div>
      <div class="hero-proof" aria-label="LT Transfers trust indicators">
        <span><?= h(SITE_SIGNATURE) ?></span>
        <span>TUG member recommended</span>
        <span>Repeat referral trusted</span>
      </div>
    </div>

    <div class="hero-media" aria-label="Timeshare transfer paperwork and resort property">
      <img src="<?= asset('media/images/lt-transfers-hero.png') ?>" alt="Professional timeshare transfer paperwork arranged beside a pen with a vacation property in the background" width="960" height="720" loading="eager">
      <div class="rating-card">
        <strong>Trusted by owners</strong>
        <span>Positive Google reviews and long-time owner referrals</span>
      </div>
    </div>
  </section>

  <section class="trust-strip" aria-label="Company trust indicators">
    <article>
      <strong><?= h(SITE_ESTABLISHED) ?></strong>
      <span>Established</span>
    </article>
    <article>
      <strong>Nationwide</strong>
      <span>Document preparation</span>
    </article>
    <article>
      <strong>Supervised</strong>
      <span>Document process</span>
    </article>
    <article>
      <strong>TUG</strong>
      <span>Owner community reputation</span>
    </article>
  </section>

  <section class="section intro-grid">
    <div>
      <p class="eyebrow">Simple, affordable timeshare transfers</p>
      <h2>We handle the transfer details from document preparation to resort notification.</h2>
    </div>
    <div class="intro-copy">
      <p>Timeshare ownership changes often involve document requirements, recording steps, resort rules, transfer fees, and follow-up paperwork. <?= h(SITE_NAME) ?> gives owners a focused team that understands timeshare transfers and keeps the process moving.</p>
      <p>Whether you are adding family, transferring to a trust, completing an inheritance transfer, or working with a major resort system, the goal is the same: clear steps, fair fees, and no unnecessary confusion.</p>
    </div>
  </section>

  <section class="section section-soft" id="why">
    <div class="section-heading">
      <p class="eyebrow">Why choose LT Transfers?</p>
      <h2>Why owners choose LT Transfers</h2>
      <p>Long-term experience, repeat referrals, a positive reputation with timeshare owner communities, and specialized knowledge of resort transfer requirements.</p>
    </div>
    <div class="benefit-grid">
      <article>
        <span class="check">✓</span>
        <h3>Affordable flat-rate fees</h3>
        <p>Clear pricing for common transfer work, with resort fees explained separately when they apply.</p>
      </article>
      <article>
        <span class="check">✓</span>
        <h3>Experienced specialists</h3>
        <p>A focused transfer team familiar with fixed-week and points-based timeshare ownership changes.</p>
      </article>
      <article>
        <span class="check">✓</span>
        <h3>Supervised process</h3>
        <p>Document preparation is handled through a supervised process built for accuracy and consistency.</p>
      </article>
      <article>
        <span class="check">✓</span>
        <h3>Nationwide document preparation</h3>
        <p>Support for many U.S. timeshare transfers, including the U.S. Virgin Islands and Aruba.</p>
      </article>
      <article>
        <span class="check">✓</span>
        <h3>Resort coordination</h3>
        <p>We help manage resort notification and transfer requirements after documents are completed.</p>
      </article>
      <article>
        <span class="check">✓</span>
        <h3>No hidden fees</h3>
        <p>Transparent LT Transfers fees, with separate resort transfer or name-change fees identified when possible.</p>
      </article>
    </div>
  </section>

  <section class="section steps-section">
    <div class="section-heading compact">
      <p class="eyebrow">How it works</p>
      <h2>Get started in 3 easy steps</h2>
    </div>
    <div class="steps">
      <article>
        <span>1</span>
        <h3>Submit information</h3>
        <p>Send your timeshare details and upload your current timeshare transfer required forms if available.</p>
        <a href="<?= base_url('booking') ?>">Upload Your Documents</a>
      </article>
      <article>
        <span>2</span>
        <h3>Review &amp; sign documents</h3>
        <p>We prepare the needed documents and send them for your review and signature.</p>
        <a href="<?= base_url('contact') ?>">Ask a Question</a>
      </article>
      <article>
        <span>3</span>
        <h3>We record &amp; notify the resort</h3>
        <p>After signing, we record the document when applicable and notify resort management.</p>
        <a href="<?= base_url('booking') ?>">Get Started Today</a>
      </article>
    </div>
  </section>

  <section class="section services" id="services">
    <div class="section-heading">
      <p class="eyebrow">Resort &amp; situation-specific help</p>
      <h2>Timeshare transfer services by resort and situation</h2>
      <p>Dedicated pages for the most common transfer situations, so you can find the exact help you need.</p>
    </div>
    <div class="service-grid">
      <?php foreach ($services as $slug => $service): ?>
        <a href="<?= base_url($slug . '/') ?>"><?= h($service['short']) ?></a>
      <?php endforeach; ?>
    </div>
    <div class="center-cta">
      <a class="button secondary" href="<?= base_url('services') ?>">View All Services</a>
    </div>
  </section>

  <section class="section split-section" id="fees">
    <div>
      <p class="eyebrow">Fee transparency</p>
      <h2>Clear typical costs before you begin.</h2>
      <p><?= h(SITE_NAME) ?> keeps common service pricing easy to understand. Resort transfer or name-change fees are separate and vary by resort.</p>
      <a class="button primary" href="<?= base_url('fees') ?>">Request a Quote</a>
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

  <section class="section section-soft review-section">
    <div class="review-copy">
      <p class="eyebrow">Testimonials and reputation</p>
      <h2>Trusted by timeshare owners nationwide</h2>
      <p><?= h(SITE_NAME) ?> has earned repeat referrals, positive reviews, and owner-community recommendations by focusing on clear communication and timeshare-specific transfer knowledge.</p>
      <div class="cta-row">
        <a class="button primary" href="<?= base_url('testimonials') ?>">Read Owner Reviews</a>
        <a class="button secondary" href="<?= base_url('about') ?>">About Our Team</a>
      </div>
    </div>
    <div class="review-card">
      <div class="stars" aria-label="Five star rating">★★★★★</div>
      <blockquote>Great communication, fair pricing, and a process that made the transfer easy to understand from start to finish.</blockquote>
      <cite>Representative owner review</cite>
    </div>
  </section>

  <section class="section faq" id="faq">
    <div class="section-heading">
      <p class="eyebrow">Common questions</p>
      <h2>Answers that reduce general emails</h2>
    </div>
    <div class="faq-list">
      <?php foreach ($faqPreview as $index => $item): ?>
        <details<?= $index === 0 ? ' open' : '' ?>>
          <summary><?= h($item['q']) ?></summary>
          <p><?= h($item['a']) ?></p>
        </details>
      <?php endforeach; ?>
    </div>
    <div class="center-cta">
      <a class="button secondary" href="<?= base_url('faq') ?>">View Full FAQ Page</a>
    </div>
  </section>

  <section class="attorney-notice" aria-label="Attorney in Charge disclosure">
    <div class="attorney-notice-inner">
      <div class="attorney-notice-heading">
        <span class="attorney-notice-icon" aria-hidden="true">AIC</span>
        <h2>Attorney in Charge</h2>
      </div>
      <div class="attorney-notice-content">
        <p class="attorney-notice-firm"><?= h(ATTORNEY_FIRM) ?></p>
        <ul class="attorney-notice-meta">
          <li><?= h(ATTORNEY_ADDRESS) ?></li>
          <li><a href="tel:+<?= h(preg_replace('/\D+/', '', ATTORNEY_PHONE)) ?>"><?= h(ATTORNEY_PHONE) ?></a></li>
          <li><a href="mailto:<?= h(ATTORNEY_EMAIL) ?>"><?= h(ATTORNEY_EMAIL) ?></a></li>
        </ul>
        <p>Timeshare transfer documents prepared through <?= h(SITE_NAME) ?> are supervised by the Attorney in Charge in accordance with Georgia State Bar requirements.</p>
      </div>
    </div>
  </section>

  <section class="final-cta" id="contact">
    <div>
      <p class="eyebrow">Ready to transfer your timeshare?</p>
      <h2>Start with the details you have. We will help with the next step.</h2>
    </div>
    <div class="cta-row">
      <a class="button primary light" href="<?= base_url('booking') ?>">Get Started Today</a>
      <a class="button secondary light" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">Call <?= h(COMPANY_PHONE) ?></a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
