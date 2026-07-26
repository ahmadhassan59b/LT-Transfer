<?php
/**
 * LT TRANSFERS — WEBSITE
 * common-template/footer.php
 *
 * Renders the closing footer and script includes, then closes
 * the HTML document. Every page includes this file last.
 */
$services = require SITE_ROOT . '/includes/services-data.php';
?>
<footer class="site-footer-full">
  <div class="footer-grid">
    <div class="footer-brand">
 <a class="brand" href="<?= base_url('index.php') ?>" aria-label="<?= h(SITE_NAME) ?> home">
    <img class="brand-logo" src="<?= asset('media/images/logo-white.png') ?>" alt="<?= h(SITE_NAME) ?>" width="290" height="86">
  </a>
      <p>Professional document preparation, recording, and resort transfer coordination for timeshare owners nationwide. Established in <?= h(SITE_ESTABLISHED) ?>.</p>
      <p class="footer-signature"><?= h(SITE_SIGNATURE) ?></p>
    </div>

    <div class="footer-col">
      <h4>Company</h4>
      <ul>
        <li><a href="<?= base_url('about') ?>">About Us</a></li>
        <li><a href="<?= base_url('services') ?>">Services</a></li>
        <li><a href="<?= base_url('fees') ?>">Fees</a></li>
        <li><a href="<?= base_url('testimonials') ?>">Testimonials</a></li>
        <li><a href="<?= base_url('faq') ?>">FAQ</a></li>
        <li><a href="<?= base_url('estoppel-explanation') ?>">What Is an Estoppel?</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Popular Services</h4>
      <ul>
        <?php $i = 0; foreach ($services as $slug => $service): if ($i++ >= 5) break; ?>
          <li><a href="<?= base_url($slug . '/') ?>"><?= h($service['short']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Contact</h4>
      <ul class="footer-contact">
        <li><a href="tel:+<?= h(COMPANY_PHONE_TEL) ?>"><?= h(COMPANY_PHONE) ?></a></li>
        <li><a href="mailto:<?= h(COMPANY_EMAIL) ?>"><?= h(COMPANY_EMAIL) ?></a></li>
        <li><?= h(COMPANY_ADDRESS_LINE1) ?><br><?= h(COMPANY_ADDRESS_LINE2) ?></li>
        <li><?= h(COMPANY_HOURS) ?></li>
      </ul>
    </div>
  </div>

  <nav class="footer-policy-links" aria-label="Legal and site information">
    <a href="<?= base_url('terms-of-service') ?>">Terms of Service</a>
    <a href="<?= base_url('terms-of-use') ?>">Terms of Use</a>
    <a href="<?= base_url('copyright-notice') ?>">Copyright Notice</a>
    <a href="<?= base_url('privacy-policy') ?>">Privacy Policy</a>
    <a href="<?= base_url('accessibility') ?>">Accessibility</a>
    <a href="<?= base_url('services') ?>">Sitemap</a>
  </nav>

  <nav class="footer-resource-links" aria-label="Timeshare transfer resources">
    <a href="<?= base_url('services') ?>">Timeshare Transfer Services</a>
    <a href="<?= base_url('testimonials') ?>">Legitimate Timeshare Transfers</a>
    <a href="<?= base_url('how-it-works-timeshare-deed-transfer') ?>">How to Transfer My Timeshare</a>
    <a href="<?= base_url('disney-vacation-club-transfers/') ?>">Transfer Disney Timeshares</a>
    <a href="<?= base_url('how-to-sell-a-timeshare') ?>">How to Sell My Timeshare</a>
    <a href="<?= base_url('how-to-sell-a-timeshare') ?>">How to Sell a Timeshare</a>
  </nav>

  <div class="footer-bottom">
    <span>&copy; <?= h(date('Y')) ?> <?= h(SITE_NAME) ?>. All rights reserved.</span>
    <span class="footer-legal">Document preparation services only. LT Transfers is not a law firm and does not provide legal advice.</span>
  </div>
</footer>

<?php require SITE_ROOT . '/common-template/scripts.php'; ?>
</body>
</html>
