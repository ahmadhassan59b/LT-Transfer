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
    ['quote' => 'LT Transfers handled adding my children\'s names to my Disney Vacation Club deed with ease. The instructions were simple to follow, and everything was completed in a timely manner.', 'name' => 'Melissa K.'],
    ['quote' => 'Great customer service from everyone at LT Transfers in assisting us with two title transfers. I\'d definitely recommend LT for any title work.', 'name' => 'Brad K.'],
    ['quote' => 'LT Transfers made the entire timeshare transfer process smooth and stress-free. They were clear, responsive, and quick with every step along the way.', 'name' => 'Shirley'],
    ['quote' => 'Thank you for such a pleasant experience. I appreciate the frequent updates and the professionalism you exhibited throughout.', 'name' => 'JH', 'location' => 'Sedona Springs'],
    ['quote' => 'I appreciate your hard work and great efficiency — thank you!', 'name' => 'JA', 'location' => 'Sheraton Desert Oasis'],
    ['quote' => 'Your company was great to work with. We\'ll definitely use your services again in the future and will highly recommend you to friends.', 'name' => 'KP', 'location' => 'HGVC SeaWorld'],
    ['quote' => 'Thank you for clarifying the process for me. The whole endeavor was easier to complete than I first thought, and I\'d recommend your services to anyone.', 'name' => 'MB', 'location' => 'Wyndham Bonnet Creek'],
    ['quote' => 'Timely and professional work from start to finish — just as good, if not better, than options costing three to five times as much. I\'d recommend you to anyone.', 'name' => 'PW', 'location' => 'Cypress Palms'],
    ['quote' => 'Thank you for your timely handling of my timeshare transfer. I\'ll be recommending you to fellow owners at Cypress Pointe.', 'name' => 'JH', 'location' => 'Diamond Cypress Pointe'],
    ['quote' => 'Thank you for seeing this through with such professionalism. I\'ve already recommended your services to others asking about timeshare closings.', 'name' => 'AC', 'location' => 'Cypress Pointe'],
];

$resortCoverage = [
    [
        'brand' => 'Disney Vacation Club',
        'note'  => 'Florida, South Carolina & Hawaii',
        'list'  => 'Animal Kingdom, Bay Lake Tower, Beach Club, BoardWalk Villas, Grand Floridian, Lake Buena Vista, Old Key West, Polynesian, Riviera, Saratoga Springs, Vero Beach, Wilderness Lodge, and Copper Creek.',
    ],
    [
        'brand' => 'Marriott Vacation Club & Vistana',
        'note'  => 'Nationwide & Caribbean',
        'list'  => 'Aruba Ocean Club and Surf Club, Barony Beach Club, BeachPlace Towers, Canyon Villas, Marco Island, Custom House, Cypress Harbour, Desert Springs Villas, Grand Chateau, Grande Ocean, Grande Vista, Harbour Lake, Imperial Palms, Kauai Beach Club, Ko\'Olina Beach Club, Legends Edge, Manor Club, Marbella Beach Resort, Maui Ocean Club, Mountain Valley Lodge, Mountainside at Park City, Newport Coast, Ocean Point at Palm Beach Shores, Ocean Palms, OceanWatch Villas, Ritz-Carlton Club, Shadow Ridge, Summit Watch, SurfWatch, Timber Lodge, Waiohai Beach Club, Willow Ridge, Birch at Streamside, Douglas at Streamside, Fairway Villas at Seaview, Frenchman\'s Cove, Harbour Club, Harbour Point, Monarch, Royal Palms, Sabal Palms, Sunset Pointe, and Phuket Beach Club.',
    ],
    [
        'brand' => 'Hyatt Residence Club',
        'note'  => 'U.S. mainland & Hawaii',
        'list'  => 'Sunset Harbor, Windward Pointe, Beach House, Hacienda Del Mar, High Sierra Lodge, Coconut Plantation, Pinon Pointe, Wild Oak Ranch, Siesta Key Beach, and Ka\'anapali Beach.',
    ],
    [
        'brand' => 'Westin, Diamond, Westgate & Wyndham',
        'note'  => 'Nationwide',
        'list'  => 'Westin Mission Hills, Westin Ka\'anapali Ocean Resort, Westin Princeville Ocean Resort, Westin Desert Willow, and Westin Nanea Ocean Villas, plus Diamond Resorts, Westgate Resorts, Wyndham Destinations, and a range of legacy resort properties.',
    ],
];
?>

<main>
  <section class="page-hero testimonial-hero">
    <div class="testimonial-hero-grid">
      <div>
        <div class="breadcrumbs">
          <a href="<?= base_url('index.php') ?>">Home</a>
          <span aria-hidden="true">/</span>
          <span>Testimonials</span>
        </div>
        <p class="eyebrow">What owners say</p>
        <h1>Trusted by timeshare owners nationwide</h1>
        <p class="lede"><?= h(SITE_NAME) ?> has earned repeat referrals and a 5-star reputation within timeshare owner communities like TUG by focusing on clear communication and resort-specific transfer knowledge.</p>
      </div>
      <aside class="testimonial-hero-card" aria-label="Owner rating summary">
        <span>Owner rating</span>
        <strong>5.0 ★★★★★</strong>
        <p>Consistent with our 5-star rating on Google, based on feedback shared directly with our team by owners we've helped.</p>
      </aside>
    </div>
  </section>

  <section class="testimonial-fact-strip" aria-label="LT Transfers testimonial highlights">
    <article>
      <span>01</span>
      <strong>Verified owner feedback</strong>
    </article>
    <article>
      <span>02</span>
      <strong>Nationwide resort coverage</strong>
    </article>
    <article>
      <span>03</span>
      <strong>Repeat client referrals</strong>
    </article>
    <article>
      <span>04</span>
      <strong>Established <?= h(SITE_ESTABLISHED) ?></strong>
    </article>
  </section>

  <section class="section section-soft">
    <div class="testimonial-intro">
      <p class="eyebrow">Thank you for stopping by</p>
      <h2>We appreciate you checking out our reviews</h2>
      <p>We appreciate owners letting us know how they liked our service, and we appreciate everyone looking to see what people think about our timeshare transfer services. <?= h(SITE_NAME) ?> has some of the highest-rated reviews for timeshare deed transfers in the business. We keep the process simple with our online <a href="<?= base_url('document-preparation.php') ?>">timeshare transfer document preparation</a>, and we maintain a 5-star rating on Google — many of the reviews below were shared with us even before Google Reviews became the standard way owners left feedback.</p>
      <p>We're also happy to help owners learn how to transfer a timeshare deed from some of the most popular resorts we've served, including:</p>
    </div>
    <div class="content-columns">
      <?php foreach ($resortCoverage as $group): ?>
        <article>
          <span class="about-card-label"><?= h($group['note']) ?></span>
          <h3><?= h($group['brand']) ?></h3>
          <p><?= h($group['list']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
    <p class="resort-coverage-footnote">As you can see, we don't just have great reviews — we have deep, resort-specific transfer experience. Don't see your resort listed? <a href="<?= base_url('contact.php') ?>">Contact us</a> with your timeshare details and we will confirm exactly what is needed.</p>
  </section>

  <section class="section">
    <div class="section-heading compact">
      <p class="eyebrow">In their own words</p>
      <h2>Owners share their transfer experience</h2>
      <p>Read what timeshare owners have shared with us directly about their transfer experience.</p>
    </div>

    <div class="testimonial-slider" data-testimonial-slider aria-roledescription="carousel" aria-label="Owner testimonials">
      <div class="testimonial-viewport">
        <div class="testimonial-track" data-slider-track>
          <?php foreach ($testimonials as $i => $t): ?>
            <div class="review-card testimonial-slide" data-slider-slide role="group" aria-roledescription="slide" aria-label="Testimonial <?= $i + 1 ?> of <?= count($testimonials) ?>">
              <div class="stars" aria-label="Five star rating">★★★★★</div>
              <blockquote><?= h($t['quote']) ?></blockquote>
              <cite><?= h($t['name']) ?><?php if (!empty($t['location'])): ?>, <?= h($t['location']) ?><?php endif; ?></cite>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="slider-controls">
        <button type="button" class="slider-arrow" data-slider-prev aria-label="Previous testimonial">&#8249;</button>
        <div class="slider-dots" data-slider-dots></div>
        <button type="button" class="slider-arrow" data-slider-next aria-label="Next testimonial">&#8250;</button>
      </div>
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
