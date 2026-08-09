<?php
/**
 * LT TRANSFERS — WEBSITE
 * booking.php — Start Your Transfer
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Start Your Transfer | ' . SITE_NAME;
$pageDescription = 'Submit your timeshare details and upload your timeshare transfer required forms to start your transfer with LT Transfers.';
$canonicalPath   = '/booking.php';
$bodyClass       = 'page-booking';

require SITE_ROOT . '/common-template/header.php';

$services = require SITE_ROOT . '/includes/services-data.php';
?>

<main>
  <section class="page-hero">
    <div class="breadcrumbs">
      <a href="<?= base_url('index.php') ?>">Home</a>
      <span aria-hidden="true">/</span>
      <span>Start Your Transfer</span>
    </div>
    <p class="eyebrow">Step 1 of 3</p>
    <h1>Start your timeshare transfer</h1>
    <p class="lede">Send us your timeshare information and, if you have it, a copy of your current ownership document. We will review it and follow up with the exact paperwork and fees for your transfer.</p>
    <div class="booking-steps">
      <span>1. Submit information</span>
      <span>2. Review &amp; sign documents</span>
      <span>3. We record &amp; notify the resort</span>
    </div>
  </section>

  <section class="section">
    <div class="form-layout">
      <div class="form-card">
        <div class="form-alert" data-form-alert hidden></div>
        <form action="<?= base_url('php/submit-booking.php') ?>" method="post" enctype="multipart/form-data" data-ajax-form novalidate>
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
              <label for="resort">Resort / timeshare name</label>
              <input type="text" id="resort" name="resort" required placeholder="e.g. Marriott Grande Ocean">
            </div>
          </div>

          <div class="form-group">
            <label for="situation">What best describes your situation?</label>
            <select id="situation" name="situation">
              <option value="Standard transfer">Standard transfer</option>
              <?php foreach ($services as $service): ?>
                <option value="<?= h($service['title']) ?>"><?= h($service['title']) ?></option>
              <?php endforeach; ?>
              <option value="Not sure">Not sure / other</option>
            </select>
          </div>

          <div class="form-group">
            <label>Do you have a copy of your recorded ownership document?</label>
            <select id="has_deed" name="has_deed">
              <option value="Yes">Yes, I have my document</option>
              <option value="No">No, please conduct a document search ($25 fee)</option>
              <option value="Not sure">Not sure</option>
            </select>
          </div>

          <div class="form-group">
            <label for="deed">Upload your timeshare transfer required forms (optional)</label>
            <input type="file" id="deed" name="deed" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
            <span class="hint">PDF, Word, or image files up to 10MB. You can also send this later by email or fax.</span>
          </div>

          <div class="form-group">
            <label for="details">Additional details</label>
            <textarea id="details" name="details" placeholder="Anything else we should know — e.g. names to add, trust details, or estate documents available."></textarea>
          </div>

          <!-- Honeypot field: hidden from real visitors, catches bots -->
          <div class="form-group honeypot-field" aria-hidden="true">
            <label for="website2">Leave this field blank</label>
            <input type="text" id="website2" name="website" tabindex="-1" autocomplete="off">
          </div>

          <div class="form-actions">
            <button type="submit" class="button primary">Submit &amp; Start My Transfer</button>
          </div>
          <p class="form-note">We will follow up by email with a confirmation, an exact quote, and the next steps for your transfer.</p>
        </form>
      </div>

      <div class="contact-info-card">
        <h3>Prefer to send documents another way?</h3>
        <ul>
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
            <span><strong>Mail a hard copy</strong><?= h(COMPANY_ADDRESS_LINE1) ?><br><?= h(COMPANY_ADDRESS_LINE2) ?></span>
          </li>
          <li>
            <span>📞</span>
            <span><strong>Questions first?</strong><a href="tel:+<?= h(COMPANY_PHONE_TEL) ?>"><?= h(COMPANY_PHONE) ?></a></span>
          </li>
        </ul>
      </div>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
