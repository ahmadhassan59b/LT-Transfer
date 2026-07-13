<?php
/**
 * LT TRANSFERS - WEBSITE
 * estoppel-explanation.php
 */

require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle       = 'What Is a Timeshare Estoppel? | ' . SITE_NAME;
$pageDescription = 'Learn what a timeshare estoppel is, what information it verifies, when it is useful, whether fees may apply, and how LT Transfers uses it during a transfer.';
$canonicalPath   = '/estoppel-explanation';
$bodyClass       = 'page-estoppel page-resource';

require SITE_ROOT . '/common-template/header.php';
?>

<main>
  <section class="resource-masthead">
    <div class="breadcrumbs">
      <a href="<?= base_url('index.php') ?>">Home</a>
      <span aria-hidden="true">/</span>
      <span>What Is a Timeshare Estoppel?</span>
    </div>
    <div class="resource-masthead-inner">
      <div>
        <p class="eyebrow">Owner education</p>
        <h1>What Is a Timeshare Estoppel?</h1>
        <p class="lede">If you're selling, gifting, or transferring your timeshare, you may hear the term "Estoppel." Many owners aren't familiar with this document, but it can play an important role in helping ensure that the transfer is completed accurately.</p>
      </div>
      <aside class="resource-quick-card" aria-label="Quick summary">
        <span>At a glance</span>
        <strong>Estoppel = account verification</strong>
        <p>A resort-provided snapshot of ownership, usage, fee status, and transfer eligibility.</p>
      </aside>
    </div>
  </section>

  <section class="resource-layout">
    <aside class="resource-sidebar" aria-label="Page sections">
      <nav>
        <a href="#overview">Why is an Estoppel important?</a>
        <a href="#information">What Information Does an Estoppel Provide?</a>
        <a href="#required">Is an Estoppel Required?</a>
        <a href="#problems">Can an Estoppel Prevent Problems?</a>
        <a href="#lt-use">How Does LT Transfers Use the Information?</a>
        <a href="#fees">Are There Fees to Obtain an Estoppel?</a>
      </nav>
      <div class="resource-sidebar-cta">
        <strong>Need help with a transfer?</strong>
        <p>Send us your ownership details and we will guide the next step.</p>
        <a class="button primary" href="<?= base_url('booking.php') ?>">Start Your Transfer</a>
      </div>
    </aside>

    <div class="resource-article">
      <section class="resource-lead-card" id="overview">
        <div>
          <p class="eyebrow">Owner verification</p>
          <h2>Why is an Estoppel important?</h2>
          <p>A timeshare estoppel is a document or ownership verification provided by the resort or management company that confirms important information about a timeshare ownership.</p>
          <p>Think of it as a snapshot of the ownership account at the time it is requested.</p>
        </div>
        <img src="<?= asset('media/images/estoppel-ownership-review.svg') ?>" alt="Professional illustration of a timeshare estoppel ownership review" width="1200" height="820" loading="eager">
      </section>

      <section class="resource-section">
        <div class="resource-section-heading">
          <p class="eyebrow">Resort terminology</p>
          <h2>Depending on the resort, the document may be called an:</h2>
        </div>
        <div class="resource-check-grid">
          <article>
            <ul>
              <li>Estoppel Certificate</li>
              <li>Ownership Verification</li>
              <li>Ownership Interest Details</li>
              <li>Account Verification</li>
            </ul>
          </article>
          <article>
            <ul>
              <li>Owner Information Letter</li>
              <li>Usage or Financial Estoppel</li>
            </ul>
            <p>Although the names vary, they all serve the same basic purpose: to verify the details of the ownership before the transfer is completed.</p>
          </article>
        </div>
      </section>

      <section class="resource-section" id="information">
        <div class="resource-section-heading">
          <p class="eyebrow">Account details</p>
          <h2>What Information Does an Estoppel Provide?</h2>
          <p>The information provided varies by resort management.</p>
          <p>An estoppel may include information such as:</p>
        </div>
        <div class="resource-check-grid">
          <article>
            <ul>
              <li>Owner name(s)</li>
              <li>Contract or membership number</li>
              <li>Resort name</li>
              <li>Ownership type</li>
            </ul>
          </article>
          <article>
            <ul>
              <li>Unit and week information, if applicable</li>
              <li>Number of annual points</li>
              <li>Transfer restrictions</li>
              <li>Whether ownership is eligible for transfer</li>
            </ul>
          </article>
          <article>
            <ul>
              <li>Current maintenance fee status</li>
              <li>Outstanding loan balance, if any</li>
              <li>Outstanding assessments</li>
            </ul>
          </article>
        </div>
      </section>

      <section class="resource-section" id="issues">
        <div>
          <p class="eyebrow">Accuracy check</p>
          <h2>Why Is an Estoppel Important?</h2>
          <p>An estoppel helps verify that the information used to prepare the transfer documents is accurate.</p>
          <p>It can help identify issues before documents are prepared, such as:</p>
        </div>
        <div class="resource-split-panel resource-risk-panel">
          <img src="<?= asset('media/images/estoppel-document-verification.svg') ?>" alt="Illustration of an estoppel document with verified ownership fields" width="760" height="520" loading="lazy">
          <ul class="resource-risk-list">
            <li>Incorrect contract numbers</li>
            <li>Ownership name discrepancies</li>
            <li>Outstanding loan balances</li>
            <li>Delinquent maintenance fees</li>
            <li>Incorrect point totals</li>
            <li>Transfer restrictions imposed by the resort</li>
          </ul>
        </div>
        <div class="resource-insight-note">
          <strong>Why this matters</strong>
          <p>Finding these issues early can prevent delays later in the transfer process.</p>
        </div>
      </section>

      <section class="resource-section" id="required">
        <div class="resource-section-heading">
          <p class="eyebrow">Requirements</p>
          <h2>Is an Estoppel Required?</h2>
        </div>
        <div class="resource-note-grid resource-note-grid-two">
          <article>
            <h3>Is an Estoppel Required?</h3>
            <p>Not always. Many resorts do not require an estoppel before ownership can be transferred.</p>
            <p>However, requesting one is often a good idea because it helps confirm that the information being provided by the owner matches the resort's records.</p>
            <p>At <?= h(SITE_NAME) ?>, we may recommend obtaining an estoppel when additional verification would be beneficial, particularly if ownership details are unclear or there are questions about the account.</p>
          </article>
          <article>
            <h3>Does Every Resort Offer an Estoppel?</h3>
            <p>No. Every resort has its own procedures. Some provide detailed ownership verification, while others provide only limited account information.</p>
            <p>Some require written requests, while others allow owners to request information by telephone or through an owner portal.</p>
            <p>Because procedures vary, <?= h(SITE_NAME) ?> will advise you if additional ownership verification would be helpful for your particular transfer.</p>
          </article>
        </div>
      </section>

      <section class="resource-visual-section" id="problems">
        <div>
          <p class="eyebrow">Problem prevention</p>
          <h2>Can an Estoppel Prevent Problems?</h2>
          <p>In almost every instance, the answer is yes. While it cannot guarantee a smooth transfer, an estoppel can identify potential issues before documents are prepared.</p>
          <p>For example, it may reveal:</p>
          <ul>
            <li>An unpaid loan</li>
            <li>Past-due maintenance fees</li>
            <li>A contract number that doesn't match the deed</li>
            <li>Ownership information that needs to be corrected</li>
            <li>A restriction that could affect the transfer</li>
            <li>New Owner requirements</li>
          </ul>
          <p>Resolving these issues early often helps avoid delays later in the process.</p>
        </div>
        <img src="<?= asset('media/images/estoppel-transfer-workflow.svg') ?>" alt="Estoppel transfer workflow from resort verification to document preparation" width="1200" height="720" loading="lazy">
      </section>

      <section class="resource-section" id="lt-use">
        <div class="resource-section-heading">
          <p class="eyebrow">LT Transfers process</p>
          <h2>How Does LT Transfers Use the Information?</h2>
          <p>When an estoppel or ownership verification is available, we use it to compare the resort's records with the information provided by the owner and the sales agreement terms.</p>
          <p>This helps us prepare transfer documents using the most accurate information available and reduces the likelihood of processing delays caused by incorrect ownership information.</p>
        </div>
      </section>

      <section class="resource-section" id="fees">
        <div class="resource-section-heading">
          <p class="eyebrow">Resort fees</p>
          <h2>Are There Fees to Obtain an Estoppel?</h2>
        </div>
        <div class="resource-note-grid resource-fee-grid">
          <article>
            <span>01</span>
            <h3>Resort policies vary</h3>
            <p>Some resort management companies charge a fee to provide an estoppel or ownership verification document. These fees are established by the resort or management company, not by <?= h(SITE_NAME) ?>, and vary depending on the ownership type and resort policies.</p>
          </article>
          <article>
            <span>02</span>
            <h3>Ownership type can matter</h3>
            <p>For example, some resorts provide ownership verification at no charge, while others may charge an administrative fee to prepare and issue the document. In certain cases, the fee may differ based on whether the ownership is a fixed-week timeshare, a points-based membership, or another type of ownership.</p>
          </article>
          <article>
            <span>03</span>
            <h3>Confirm before requesting</h3>
            <p>Because resort policies and fees can change without notice, we recommend contacting your resort directly to confirm whether an estoppel fee applies before requesting the document.</p>
          </article>
        </div>
        <div class="resource-fee-note">
          <strong>Important fee note</strong>
          <p>When we recommend obtaining an estoppel, it is solely to help verify important ownership information and reduce the likelihood of delays or errors during the transfer process. Any fee charged for the estoppel is paid directly to the resort or management company and is separate from <?= h(SITE_NAME) ?>' document preparation fees.</p>
        </div>
      </section>

      <section class="resource-bottom-line" id="bottom-line">
        <div class="resource-bottom-line-intro">
          <div>
            <p class="eyebrow">The bottom line</p>
            <h2>The Bottom Line</h2>
          </div>
          <img src="<?= asset('media/images/estoppel-ownership-review.svg') ?>" alt="Illustration of a timeshare ownership review with verified records" width="1200" height="820" loading="lazy">
        </div>
        <div class="resource-bottom-line-copy">
          <p>An estoppel is one of the best tools available for confirming important ownership information before a timeshare transfer begins.</p>
          <p>Although it is not required for every transfer, obtaining one can provide valuable peace of mind by identifying potential issues early and helping ensure that the transfer documents accurately reflect the resort's records.</p>
          <p>If you have questions about whether an estoppel is recommended for your ownership, the team at <?= h(SITE_NAME) ?> is happy to help guide you through the process.</p>
          <ul class="resource-bottom-line-points" aria-label="Estoppel benefits">
            <li>Confirms resort records</li>
            <li>Helps avoid document errors</li>
            <li>Identifies issues early</li>
            <li>Supports a smoother transfer</li>
          </ul>
        </div>
      </section>
    </div>
  </section>

  <section class="final-cta">
    <div>
      <p class="eyebrow">Questions about your ownership?</p>
      <h2>We can advise whether an estoppel is worth requesting for your transfer.</h2>
    </div>
    <div class="cta-row">
      <a class="button primary light" href="<?= base_url('contact.php') ?>">Contact Us</a>
      <a class="button secondary light" href="tel:+<?= h(COMPANY_PHONE_TEL) ?>">Call <?= h(COMPANY_PHONE) ?></a>
    </div>
  </section>
</main>

<?php require SITE_ROOT . '/common-template/footer.php'; ?>
