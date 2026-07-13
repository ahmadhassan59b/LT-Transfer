<?php
/**
 * LT TRANSFERS — WEBSITE
 * testimonials.php — Owner testimonials
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'Testimonials | ' . SITE_NAME;
$pageDescription = 'Read what timeshare owners say about their transfer experience with LT Transfers.';
$canonicalPath   = '/testimonials.php';
$bodyClass       = 'page-testimonials';

require SITE_ROOT . '/common-template/header.php';

$testimonials = [
    ['quote' => 'Great communication, fair pricing, and a process that made the transfer easy to understand from start to finish.', 'name' => 'Representative owner review'],
    ['quote' => 'LT Transfers handled adding my kids\' names to my Disney Vacation Club ownership documents with ease. Instructions were easy to follow and everything was done in a timely manner.', 'name' => 'Disney Vacation Club owner'],
    ['quote' => 'Great customer service from everyone at LT Transfers assisting us with two title transfers. Would definitely recommend LT for any title work.', 'name' => 'Repeat customer, two transfers'],
    ['quote' => 'LT Transfers made the whole timeshare transfer process so smooth and stress free. They were clear, responsive, and very quick with every step of the way.', 'name' => 'Marriott Vacation Club owner'],
    ['quote' => 'I appreciate the frequent updates and overall professionalism you have exhibited throughout my transfer.', 'name' => 'Vistana owner'],
    ['quote' => 'Your company was great to work with. We will definitely use your services again in the future, and will highly recommend you to friends.', 'name' => 'Repeat customer'],
];
?>

<main>
  <section class="page-hero">
    <div class="breadcrumbs">
      <a href="<?= base_url('index.php') ?>">Home</a>
      <span aria-hidden="true">/</span>
      <span>Testimonials</span>
    </div>
    <p class="eyebrow">What owners say</p>
    <h1>Trusted by timeshare owners nationwide</h1>
    <p class="lede"><?= h(SITE_NAME) ?> has earned repeat referrals and a 5-star reputation within timeshare owner communities like TUG by focusing on clear communication and resort-specific transfer knowledge.</p>
  </section>

  <section class="section">
    <div class="testimonial-grid">
      <?php foreach ($testimonials as $t): ?>
        <div class="review-card">
          <div class="stars" aria-label="Five star rating">★★★★★</div>
          <blockquote><?= h($t['quote']) ?></blockquote>
          <cite><?= h($t['name']) ?></cite>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="final-cta">
    <div>
      <p class="eyebrow">Join our owners</p>
      <h2>Ready to start your own worry-free transfer?</h2>
    </div>
    <div class="cta-row">
      <a class="button primary light" href="<?= base_url('booking.php') ?>">Get Started Today</a>
      <a class="button secondary light" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">Call <?= h(COMPANY_PHONE) ?></a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
