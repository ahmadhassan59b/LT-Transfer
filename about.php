<?php
/**
 * LT TRANSFERS - WEBSITE
 * about.php - About Us
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'About LT Transfers | Timeshare Transfer Services';
$pageDescription = 'Whether you are the owner or buyer, our goal is to provide you with a worry-free transaction process when you decide to sell or purchase a timeshare vacation.';
$canonicalPath   = '/about';
$bodyClass       = 'page-about';

require SITE_ROOT . '/common-template/header.php';
?>

<main>
  <section class="about-profile-masthead">
    <div class="breadcrumbs">
      <a href="<?= base_url('index.php') ?>">Home</a>
      <span aria-hidden="true">/</span>
      <span>About Us</span>
    </div>
    <div class="about-profile-grid">
      <div>
        <p class="eyebrow">About <?= h(SITE_NAME) ?></p>
        <h1>A focused document preparation team for timeshare ownership transfers.</h1>
        <p class="lede">Whether you are the owner or buyer, our goal is to provide a clear, worry-free transaction process when you decide to sell or purchase a timeshare vacation.</p>
      </div>
      <aside class="about-profile-card" aria-label="Company profile">
        <span>Company profile</span>
        <strong>Established <?= h(SITE_ESTABLISHED) ?></strong>
        <p>Timeshare transfer document preparation, recording support, and resort transfer coordination from Cornelia, Georgia.</p>
      </aside>
    </div>
  </section>

  <section class="about-profile-strip" aria-label="LT Transfers service highlights">
    <article>
      <span>01</span>
      <strong>Owner and buyer support</strong>
    </article>
    <article>
      <span>02</span>
      <strong>Document preparation</strong>
    </article>
    <article>
      <span>03</span>
      <strong>Recording coordination</strong>
    </article>
    <article>
      <span>04</span>
      <strong>Resort transfer follow-up</strong>
    </article>
  </section>

  <section class="section about-profile-story">
    <div class="about-story-copy">
      <p class="eyebrow">Who we are</p>
      <h2>We keep timeshare transfer paperwork organized, understandable, and moving.</h2>
      <p>Our professional, experienced staff handles the document preparation required to complete timeshare ownership transfers. We work with owners, buyers, and resort requirements so the process feels less confusing and more manageable.</p>
      <p>Every transfer can have different details: deed information, ownership names, resort rules, transfer fees, recording requirements, and follow-up paperwork. Our role is to help organize those details and prepare the documents needed for the ownership change.</p>
    </div>
    <div class="about-story-panel">
      <img src="<?= asset('media/images/estoppel-document-verification.svg') ?>" alt="Illustration of reviewed transfer documents" width="760" height="520" loading="lazy">
      <div>
        <h3>Our work centers on accuracy.</h3>
        <p>Clear information at the beginning helps reduce avoidable delays later in the transfer process.</p>
      </div>
    </div>
  </section>

  <section class="section section-soft about-method-section">
    <div class="section-heading compact">
      <p class="eyebrow">How we work</p>
      <h2>A practical process built around transfer details.</h2>
    </div>
    <div class="about-method-grid">
      <article>
        <span>Review</span>
        <h3>We start with ownership details</h3>
        <p>We review the information you provide and identify the document preparation path for the transfer.</p>
      </article>
      <article>
        <span>Prepare</span>
        <h3>We prepare transfer documents</h3>
        <p>Our team prepares the paperwork needed for review, signatures, recording, or resort processing.</p>
      </article>
      <article>
        <span>Record</span>
        <h3>We support recording steps</h3>
        <p>When recording is required, we help coordinate the document process with the appropriate county.</p>
      </article>
      <article>
        <span>Notify</span>
        <h3>We help with resort transfer needs</h3>
        <p>We assist with follow-up requirements so the resort can process the ownership change.</p>
      </article>
    </div>
  </section>

  <section class="section about-contact-section">
    <div class="section-heading compact">
      <p class="eyebrow">Office and disclosure</p>
      <h2>Company and attorney information</h2>
    </div>
    <div class="about-info-grid">
      <article>
        <span class="about-card-label"><?= h(SITE_NAME) ?></span>
        <h3>Cornelia office</h3>
        <p><?= h(COMPANY_ADDRESS_LINE1) ?><br><?= h(COMPANY_ADDRESS_LINE2) ?></p>
        <div class="about-contact-list">
          <a href="tel:+<?= h(COMPANY_PHONE_TEL) ?>"><?= h(COMPANY_PHONE) ?></a>
          <span>Fax: <?= h(COMPANY_FAX) ?></span>
          <a href="mailto:<?= h(COMPANY_EMAIL) ?>"><?= h(COMPANY_EMAIL) ?></a>
        </div>
      </article>
      <article>
        <span class="about-card-label">Attorney in Charge</span>
        <h3><?= h(ATTORNEY_FIRM) ?></h3>
        <p><?= h(ATTORNEY_ADDRESS) ?></p>
        <div class="about-contact-list">
          <a href="tel:+<?= h(preg_replace('/\D+/', '', ATTORNEY_PHONE)) ?>"><?= h(ATTORNEY_PHONE) ?></a>
          <a href="mailto:<?= h(ATTORNEY_EMAIL) ?>"><?= h(ATTORNEY_EMAIL) ?></a>
        </div>
      </article>
    </div>
  </section>

  <section class="section section-soft about-quote-band">
    <div>
      <p class="eyebrow">Client experience</p>
      <h2>Clear, responsive timeshare transfer help.</h2>
      <p>Clients value a process that is easy to follow, timely, and handled by people who know timeshare transfer paperwork.</p>
    </div>
    <blockquote>
      <div class="stars" aria-label="Five star rating">*****</div>
      <p>LT Transfers handled adding my kid's names to my Disney Vacation Club deed with ease. Instructions were easy to follow and everything was done in a timely manner.</p>
      <cite>Melissa K</cite>
    </blockquote>
  </section>

  <section class="final-cta">
    <div>
      <p class="eyebrow">Ready when you are</p>
      <h2>Bring the timeshare details you have. We will help with the next step.</h2>
    </div>
    <div class="cta-row">
      <a class="button primary light" href="<?= base_url('booking.php') ?>">Get Started Today</a>
      <a class="button secondary light" href="<?= base_url('contact.php') ?>">Contact Us</a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
