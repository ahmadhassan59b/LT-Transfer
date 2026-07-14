<?php
/**
 * LT TRANSFERS — WEBSITE
 * contact.php — Contact page
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Contact Us | ' . SITE_NAME;
$pageDescription = 'Contact LT Transfers with questions about timeshare transfers, fees, document preparation, or an existing transaction.';
$canonicalPath   = '/contact';
$bodyClass       = 'page-contact';

$contactTestimonials = [
    [
        'quote' => 'LT Transfers handled adding my kids’ names to my Disney Vacation Club deed with ease. Instructions were easy to follow and everything was done in a timely manner.',
        'author' => 'Melissa K.',
    ],
    [
        'quote' => 'LT Transfers made the whole timeshare transfer process so smooth and stress free. They were clear, responsive, and very quick every step of the way.',
        'author' => 'Shirley',
    ],
    [
        'quote' => 'Thank you for the timely and professional work. You are just as good, if not better, than other options costing three to five times as much.',
        'author' => 'PW, Cypress Palms',
    ],
];

require SITE_ROOT . '/common-template/header.php';
?>

<main>
  <section class="page-hero contact-hero">
    <div class="contact-hero-grid">
      <div>
        <div class="breadcrumbs">
          <a href="<?= base_url('/') ?>">Home</a>
          <span aria-hidden="true">/</span>
          <span>Contact Us</span>
        </div>
        <p class="eyebrow">We are here to help</p>
        <h1>Let’s talk about your timeshare transfer.</h1>
        <p class="lede">Whether you are ready to begin or just need a clear answer, our team will help you understand the next step.</p>
      </div>
      <div class="contact-hero-callout">
        <span class="contact-callout-label">Speak with our team</span>
        <a href="tel:+<?= h(COMPANY_PHONE_TEL) ?>"><?= h(COMPANY_PHONE) ?></a>
        <p><?= h(COMPANY_HOURS) ?></p>
        <span class="contact-response-badge">Responses usually within one business day</span>
      </div>
    </div>
  </section>

  <section class="contact-methods" aria-label="Contact options">
    <a class="contact-method-card" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">
      <span class="contact-method-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24"><path d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2c.3-.3.7-.4 1.1-.2 1.2.4 2.5.6 3.8.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.7 21 3 13.3 3 3.8c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.6.6 3.8.1.4 0 .8-.2 1.1l-2.3 2.1Z"/></svg>
      </span>
      <span><small>Call us</small><strong><?= h(COMPANY_PHONE) ?></strong></span>
    </a>
    <a class="contact-method-card" href="mailto:<?= h(COMPANY_EMAIL) ?>">
      <span class="contact-method-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 0 0-2 2v12c0 1.1.9 2 2 2h16a2 2 0 0 0 2-2V6c0-1.1-.9-2-2-2Zm0 4-8 5-8-5V6l8 5 8-5v2Z"/></svg>
      </span>
      <span><small>Email us</small><strong><?= h(COMPANY_EMAIL) ?></strong></span>
    </a>
    <div class="contact-method-card">
      <span class="contact-method-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24"><path d="M19 8H5V3h14v5Zm0 7h-3v4H8v-4H5v-4h14v4Zm1-5H4a2 2 0 0 0-2 2v5h4v4h12v-4h4v-5a2 2 0 0 0-2-2Z"/></svg>
      </span>
      <span><small>Send a fax</small><strong><?= h(COMPANY_FAX) ?></strong></span>
    </div>
    <div class="contact-method-card">
      <span class="contact-method-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5Z"/></svg>
      </span>
      <span><small>Mailing address</small><strong><?= h(COMPANY_ADDRESS_LINE1) ?><br><?= h(COMPANY_ADDRESS_LINE2) ?></strong></span>
    </div>
  </section>

  <section class="section contact-main-section">
    <div class="contact-workspace">
      <div class="form-card contact-form-card">
        <div class="contact-form-heading">
          <p class="eyebrow">Send a message</p>
          <h2>How can we help?</h2>
          <p>Complete the form and a member of our team will get back to you as soon as possible.</p>
        </div>
        <form action="<?= base_url('php/submit-contact.php') ?>" method="post" data-ajax-form>
          <div class="form-alert" data-form-alert hidden></div>
          <div class="form-row">
            <div class="form-group">
              <label for="name">Your name <span aria-hidden="true">*</span></label>
              <input type="text" id="name" name="name" required autocomplete="name" placeholder="Full name">
            </div>
            <div class="form-group">
              <label for="email">Email address <span aria-hidden="true">*</span></label>
              <input type="email" id="email" name="email" required autocomplete="email" placeholder="you@example.com">
            </div>
          </div>
          <div class="form-group">
            <label for="topic">Subject</label>
            <input type="text" id="topic" name="topic" placeholder="What would you like to discuss?">
          </div>
          <div class="form-group">
            <label for="message">Your message <span aria-hidden="true">*</span></label>
            <textarea id="message" name="message" required maxlength="2000" rows="8" placeholder="Tell us about your timeshare and how we can help."></textarea>
          </div>

          <div class="form-group honeypot-field" aria-hidden="true">
            <label for="website">Leave this field blank</label>
            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
          </div>

          <div class="contact-form-footer">
            <p>We respect your privacy and only use your information to respond to your inquiry.</p>
            <button type="submit" class="button primary">Send Message</button>
          </div>
        </form>
      </div>

      <aside class="contact-proof-panel">
        <p class="eyebrow">Client experiences</p>
        <h2>Trusted for clear, responsive service.</h2>
        <div class="contact-testimonials">
          <?php foreach ($contactTestimonials as $testimonial): ?>
            <blockquote class="contact-testimonial">
              <div class="contact-stars" aria-label="5 out of 5 stars">★★★★★</div>
              <p>“<?= h($testimonial['quote']) ?>”</p>
              <cite><?= h($testimonial['author']) ?></cite>
            </blockquote>
          <?php endforeach; ?>
        </div>
        <a class="contact-reviews-link" href="<?= base_url('testimonials') ?>">Read more client reviews <span aria-hidden="true">→</span></a>
      </aside>
    </div>
  </section>

  <section class="contact-next-step">
    <div>
      <p class="eyebrow">Ready to provide your transfer details?</p>
      <h2>Use our document preparation form to get started.</h2>
    </div>
    <a class="button primary light" href="<?= base_url('document-preparation') ?>">Document Preparation Form</a>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
