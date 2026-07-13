<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
$submissions = [];
$storageDirectory = dirname(DOCUMENT_SUBMISSIONS_FILE);
$storageWritable = is_dir($storageDirectory)
    && is_writable($storageDirectory)
    && (!file_exists(DOCUMENT_SUBMISSIONS_FILE) || is_writable(DOCUMENT_SUBMISSIONS_FILE));
if (file_exists(DOCUMENT_SUBMISSIONS_FILE)) {
    $decoded = json_decode((string) file_get_contents(DOCUMENT_SUBMISSIONS_FILE), true);
    if (is_array($decoded)) $submissions = array_reverse($decoded);
}

$pageTitle = 'Document Submissions | ' . SITE_NAME;
$pageDescription = 'Administrative submissions viewer.';
$canonicalPath = '/admin/document-submissions.php';
$bodyClass = 'page-admin';
require SITE_ROOT . '/common-template/header.php';

$labels = [
    'BuyerFirstName'=>'Buyer first name','BuyerLastName'=>'Buyer last name','BuyerPhone'=>'Buyer phone','BuyerEmail'=>'Buyer email','BuyerStatus'=>'Buyer status','BuyerSoleProp'=>'Sole property','BuyerCountry'=>'Buyer country','BuyerState'=>'Buyer state / province','BuyerCity'=>'Buyer city','BuyerZip'=>'Buyer ZIP','BuyerAddress'=>'Buyer address','BuyerTitle'=>'Deed title','BuyerSellerRelation'=>'Buyer/seller relationship','BuyerCurrentlyOwn'=>'Existing ownership',
    'SellerFirstName'=>'Seller first name','SellerLastName'=>'Seller last name','DeceasedGrantor'=>'Deceased grantor(s)','SellerPhone'=>'Seller phone','SellerEmail'=>'Seller email','SellerCountry'=>'Seller country','SellerState'=>'Seller state / province','SellerCity'=>'Seller city','SellerZip'=>'Seller ZIP','SellerAddress'=>'Seller address','SellerTimeshareOwnerships'=>'Ownership type','WhoWillSupplyDeed'=>'Deed supplied by','TransferedInFamilyBefore'=>'Previously in trust',
    'BrokerInvloved'=>'Broker involved','BrokerName'=>'Broker name','BrokerEmail'=>'Broker email','PropertyIsGift'=>'Gift','PurchasePrice'=>'Purchase price','EscrowService'=>'Escrow service','ResortName'=>'Resort name','ResortAddress'=>'Resort address','ResortZip'=>'Resort ZIP','FixedOrFloating'=>'Fixed / floating','ResortCountry'=>'Resort country','ResortState'=>'Resort state','ResortCity'=>'Resort city','ResortUnitNumber'=>'Unit #','ResortWeekNumber'=>'Week #','ResortIDNumber'=>'Resort ID','FeeRequired'=>'Transfer fee required','FeeAmount'=>'Fee amount','UsageYear'=>'First usage year','ResortSpecial'=>'Resort group','ResortIsPartOther'=>'Other resort','PaymentPerson'=>'Document fee payer','ResortTransferFeePayer'=>'Transfer fee payer'
];
?>
<main class="admin-main">
  <section class="admin-dashboard">
    <div class="admin-heading"><div><p class="eyebrow">LT Transfers admin</p><h1>Submissions</h1><p>Review information submitted through website forms.</p></div></div>
    <nav class="admin-tabs" aria-label="Admin sections">
      <a class="is-active" href="<?= base_url('admin/') ?>">Document Submissions <span><?= count($submissions) ?></span></a>
    </nav>
    <?php if (!$storageWritable): ?>
      <div class="admin-storage-warning"><strong>Submission storage is not writable.</strong> In FTP, set <code>data/.private</code> and <code>data/.private/uploads</code> to permission <code>775</code>, and set <code>document-preparation-submissions.json</code> to <code>664</code> (or <code>666</code> if required by the host).</div>
    <?php endif; ?>
    <div class="admin-tab-heading"><div><h2>Document preparation submissions</h2><p><?= count($submissions) ?> total submission<?= count($submissions) === 1 ? '' : 's' ?></p></div></div>
    <?php if (!$submissions): ?><div class="admin-empty"><h2>No submissions yet</h2><p>New document preparation forms will appear here automatically.</p></div><?php endif; ?>
    <div class="submission-list">
      <?php foreach ($submissions as $submission): ?>
        <details class="submission-card">
          <summary><span><strong><?= h(($submission['BuyerFirstName'] ?? '') . ' ' . ($submission['BuyerLastName'] ?? '')) ?></strong><small><?= h($submission['id'] ?? '') ?> &middot; <?= h(isset($submission['submitted_at']) ? date('M j, Y g:i A', strtotime($submission['submitted_at'])) : '') ?></small></span><span class="submission-resort"><?= h($submission['ResortName'] ?? 'Resort not provided') ?></span></summary>
          <div class="submission-detail-grid">
            <?php foreach ($labels as $key => $label): if (($submission[$key] ?? '') === '') continue; ?>
              <div><span><?= h($label) ?></span><strong><?= nl2br(h((string) $submission[$key])) ?></strong></div>
            <?php endforeach; ?>
            <?php if (!empty($submission['uploaded_document']['stored_name'])): ?><div><span>Uploaded document</span><strong><?= h($submission['uploaded_document']['original_name'] ?? 'Document') ?></strong></div><?php endif; ?>
          </div>
        </details>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php require SITE_ROOT . '/common-template/footer.php'; ?>
