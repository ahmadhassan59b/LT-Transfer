<?php
/** Copyright Notice. Content supplied from the legacy LT Transfers website. */
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Copyright Notice | ' . SITE_NAME;
$pageDescription = 'Copyright ownership, permitted use, and enforcement notice for the LT Transfers website and services.';
$canonicalPath   = '/copyright-notice';
$bodyClass       = 'page-legal page-copyright';

require SITE_ROOT . '/common-template/header.php';
?>

<main class="legal-main">
  <section class="page-hero legal-hero">
    <div class="breadcrumbs"><a href="<?= base_url('index.php') ?>">Home</a><span aria-hidden="true">/</span><span>Copyright Notice</span></div>
    <div class="legal-hero-grid">
      <div><p class="eyebrow">Website terms</p><h1>Copyright Notice</h1><p class="lede">How <?= h(SITE_NAME) ?> content is protected, how it may be used, and how we enforce our copyright.</p></div>
      <aside><span>Copyright</span><strong>&copy; <?= h(SITE_NAME) ?> <?= date('Y') ?></strong><p>All rights reserved.</p></aside>
    </div>
  </section>

  <section class="section legal-section">
    <div class="legal-layout">
      <aside class="legal-sidebar">
        <p class="eyebrow">On this page</p>
        <nav aria-label="Copyright Notice sections">
          <a href="#ownership">Ownership of Content</a><a href="#permitted-use">Permitted Use</a><a href="#enforcement">Enforcement of Copyright</a><a href="#reporting">Reporting Misuse</a><a href="#contact-information">Contact Information</a>
        </nav>
        <div class="legal-help"><strong>Questions about this notice?</strong><a href="<?= base_url('contact') ?>">Contact our team <span aria-hidden="true">&rarr;</span></a></div>
      </aside>

      <article class="legal-content">
        <section id="ownership"><span class="legal-section-number">01</span><h2>Ownership of Content</h2><p>All files and information contained in this website located at <?= h(SITE_URL) ?> are copyright by <?= h(SITE_NAME) ?>, and may not be duplicated, copied, modified, or adapted in any way without our written permission. Our website may contain our service marks or trademarks as well as those of our affiliates or other companies, in the form of words, graphics, and logos.</p><p>Our content, as found within our website and services, is protected under local and foreign copyrights. The copying, redistribution, use, or publication by you of any such content is strictly prohibited. Your use of our website and services does not grant you any ownership rights to our content.</p></section>

        <section id="permitted-use"><span class="legal-section-number">02</span><h2>Permitted Use</h2><p>Your use of our <a href="<?= base_url('index.php') ?>">website</a> or services does not constitute any right or license for you to use our service marks or trademarks without the prior written permission of <?= h(SITE_NAME) ?>.</p></section>

        <section id="enforcement"><span class="legal-section-number">03</span><h2>Enforcement of Copyright</h2><p><?= h(SITE_NAME) ?> takes the protection of its copyright very seriously.</p><p>If <?= h(SITE_NAME) ?> discovers that you have used its copyright materials in contravention of the license above, <?= h(SITE_NAME) ?> may bring legal proceedings against you seeking monetary damages and an injunction to stop you using those materials. You could also be ordered to pay legal costs.</p></section>

        <section id="reporting"><span class="legal-section-number">04</span><h2>Reporting Misuse</h2><p>If you become aware of any use of <?= h(SITE_NAME) ?>&rsquo;s copyright materials that contravenes or may contravene the license above, please <a href="<?= base_url('contact') ?>">report this to us</a> immediately.</p><p>Copyright &copy; <?= h(SITE_NAME) ?> <?= date('Y') ?>. All Rights Reserved.</p></section>

        <section id="contact-information"><span class="legal-section-number">05</span><h2>Contact Information</h2><p>We welcome your comments or questions about this Copyright Notice. You may <a href="<?= base_url('contact') ?>">contact us</a> through the contact information available on our website.</p><div class="legal-contact-card"><div><span>Telephone</span><a href="tel:+<?= h(COMPANY_PHONE_TEL) ?>"><?= h(COMPANY_PHONE) ?></a></div><div><span>Fax</span><span><?= h(COMPANY_FAX) ?></span></div><div><span>Email</span><a href="mailto:<?= h(COMPANY_EMAIL) ?>"><?= h(COMPANY_EMAIL) ?></a></div><div><span>Mailing address</span><p><?= h(COMPANY_ADDRESS_LINE1) ?><br><?= h(COMPANY_ADDRESS_LINE2) ?></p></div></div></section>
      </article>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
