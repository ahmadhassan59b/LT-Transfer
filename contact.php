<?php
/**
 * LT TRANSFERS — WEBSITE
 * contact.php — Contact page
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Contact Us | ' . SITE_NAME;
$pageDescription = 'Contact LT Transfers with questions about your timeshare transfer, fees, or the document preparation process.';
$canonicalPath   = '/contact.php';
$bodyClass       = 'page-contact';

require SITE_ROOT . '/common-template/header.php';
?>

<main>
  <section class="page-hero">
    <div class="breadcrumbs">
      <a href="<?= base_url('index.php') ?>">Home</a>
      <span aria-hidden="true">/</span>
      <span>Contact</span>
    </div>
    <p class="eyebrow">Get in touch</p>
    <h1>Contact <?= h(SITE_NAME) ?></h1>
    <p class="lede">Have a question before you start your transfer? Send us a message and we will respond promptly, usually within one business day.</p>
  </section>

  <section class="section">
    <div class="form-layout">
      <div class="form-card">
        <div class="form-alert" data-form-alert hidden></div>
        <form action="<?= base_url('php/submit-contact.php') ?>" method="post" data-ajax-form novalidate>
          <div class="form-row">
            <div class="form-group">
              <label for="name">Full name</label>
              <input type="text" id="name" name="name" required autocomplete="name">
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" id="email" name="email" required autocomplete="email">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="phone">Phone number</label>
              <input type="tel" id="phone" name="phone" autocomplete="tel">
            </div>
            <div class="form-group">
              <label for="topic">What can we help with?</label>
              <select id="topic" name="topic">
                <option value="General question">General question</option>
                <option value="Fees & pricing">Fees &amp; pricing</option>
                <option value="Document search">Document search</option>
                <option value="Trust transfer">Trust transfer</option>
                <option value="Inheritance transfer">Inheritance transfer</option>
                <option value="Resort-specific question">Resort-specific question</option>
                <option value="Existing transfer status">Existing transfer status</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" required placeholder="Tell us about your timeshare and what you need help with."></textarea>
          </div>

          <!-- Honeypot field: hidden from real visitors, catches bots -->
          <div class="form-group honeypot-field" aria-hidden="true">
            <label for="website">Leave this field blank</label>
            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
          </div>

          <div class="form-actions">
            <button type="submit" class="button primary">Send Message</button>
          </div>
          <p class="form-note">By submitting this form, you agree to be contacted by <?= h(SITE_NAME) ?> regarding your inquiry.</p>
        </form>
      </div>

      <div class="contact-info-card">
        <h3>Direct contact</h3>
        <ul>
          <li>
            <span>📞</span>
            <span><strong>Phone</strong><a href="tel:+<?= h(COMPANY_PHONE_TEL) ?>"><?= h(COMPANY_PHONE) ?></a></span>
          </li>
          <li>
            <span>✉️</span>
            <span><strong>Email</strong><a href="mailto:<?= h(COMPANY_EMAIL) ?>"><?= h(COMPANY_EMAIL) ?></a></span>
          </li>
          <li>
            <span>🖨️</span>
            <span><strong>Fax</strong><?= h(COMPANY_FAX) ?></span>
          </li>
          <li>
            <span>📍</span>
            <span><strong>Mailing address</strong><?= h(COMPANY_ADDRESS_LINE1) ?><br><?= h(COMPANY_ADDRESS_LINE2) ?></span>
          </li>
          <li>
            <span>🕒</span>
            <span><strong>Hours</strong><?= h(COMPANY_HOURS) ?></span>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <section class="final-cta">
    <div>
      <p class="eyebrow">Ready to start instead?</p>
      <h2>Skip the questions and submit your timeshare details directly.</h2>
    </div>
    <div class="cta-row">
      <a class="button primary light" href="<?= base_url('booking.php') ?>">Start Your Transfer</a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
