<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

if (empty($_SESSION['document_admin_csrf'])) {
    $_SESSION['document_admin_csrf'] = bin2hex(random_bytes(24));
}
$csrfToken = (string) $_SESSION['document_admin_csrf'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete_submission') {
    $submittedToken = (string) ($_POST['csrf_token'] ?? '');
    $submissionId = clean($_POST['submission_id'] ?? '', 80);
    $deleted = false;
    $uploadedFile = '';

    if (hash_equals($csrfToken, $submittedToken) && preg_match('/^DOC-[A-Z0-9-]+$/', $submissionId)) {
        $handle = @fopen(DOCUMENT_SUBMISSIONS_FILE, 'c+');
        if ($handle && flock($handle, LOCK_EX)) {
            $raw = stream_get_contents($handle);
            $records = json_decode($raw ?: '[]', true);
            if (is_array($records)) {
                $remaining = [];
                foreach ($records as $record) {
                    if (($record['id'] ?? '') === $submissionId) {
                        $uploadedFile = basename((string) ($record['uploaded_document']['stored_name'] ?? ''));
                        $deleted = true;
                        continue;
                    }
                    $remaining[] = $record;
                }
                if ($deleted) {
                    rewind($handle);
                    ftruncate($handle, 0);
                    $written = fwrite($handle, json_encode($remaining, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                    fflush($handle);
                    if ($written === false) $deleted = false;
                }
            }
            flock($handle, LOCK_UN);
            fclose($handle);
        } elseif ($handle) {
            fclose($handle);
        }
    }

    if ($deleted && $uploadedFile !== '') {
        $uploadPath = DOCUMENT_UPLOAD_DIR . DIRECTORY_SEPARATOR . $uploadedFile;
        $uploadRoot = realpath(DOCUMENT_UPLOAD_DIR);
        $resolvedUpload = realpath($uploadPath);
        if ($uploadRoot !== false && $resolvedUpload !== false && str_starts_with($resolvedUpload, $uploadRoot . DIRECTORY_SEPARATOR) && is_file($resolvedUpload)) {
            @unlink($resolvedUpload);
        }
    }

    header('Location: ' . base_url('admin/document-submissions.php?delete=' . ($deleted ? 'success' : 'failed')));
    exit;
}

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
    'office_file_no'=>'Office file number','date_received'=>'Date received','processor'=>'Processor','transaction_type'=>'Transaction type','transaction_other'=>'Other transaction type','purchase_price'=>'Purchase price','is_gift'=>'Gift','escrow_requested'=>'Escrow requested','owners_related'=>'Owners related','relationship'=>'Relationship',
    'current_full_names'=>'Current owner(s)','current_mailing_address'=>'Current owner address','current_city_state_zip'=>'Current owner city / state / ZIP','current_phone'=>'Current owner phone','current_email'=>'Current owner email','additional_current_owner'=>'Additional current owner','name_changed'=>'Name changed','current_name_after_change'=>'Current name after change',
    'new_full_names'=>'New owner(s)','new_mailing_address'=>'New owner address','new_city_state_zip'=>'New owner city / state / ZIP','new_phone'=>'New owner phone','new_email'=>'New owner email','additional_new_names'=>'Additional new owner(s)','new_owner_status'=>'New owner status','spouse_full_name'=>'Spouse name','title_method'=>'Title method',
    'special_circumstances'=>'Special circumstances','special_other'=>'Other circumstance','deceased_owner_names'=>'Deceased owner(s)','ever_in_trust'=>'Previously held in trust',
    'resort_name'=>'Resort name','resort_location'=>'Resort location','resort_group'=>'Resort / management group','resort_group_other'=>'Other resort group','management_company'=>'Management company','owner_member_contract_no'=>'Resort ID / member #','contract_number'=>'Contract number','week_unit_no'=>'Week / unit #','ownership_type'=>'Ownership type','ownership_type_other'=>'Other ownership type','new_owner_first_year_use'=>'First year of use','maintenance_fees_paid'=>'Maintenance fees current','ca_tax_bill_paid'=>'California tax bill paid','ca_tax_bill_amount'=>'California tax bill amount','transfer_fee_required'=>'Transfer fee required','transfer_fee_amount'=>'Transfer fee amount','handled_by_broker'=>'Handled by broker','broker_name'=>'Broker name','week_type'=>'Fixed / points (legacy)',
    'documents_included'=>'Documents included','documents_other'=>'Other document','document_notes'=>'Document notes','lt_transfer_fees_payer'=>'LT Transfers fee payer','resort_fees_payer'=>'Resort fee payer','deed_search_required'=>'Deed search required','deed_search_fee_payer'=>'Deed search fee payer','completed_by_name'=>'Completed by','completed_by_relationship'=>'Relationship to transfer','completed_by_relationship_other'=>'Other relationship','completed_by_phone'=>'Completed by phone','completed_by_email'=>'Completed by email',
    'BuyerFirstName'=>'Buyer first name','BuyerLastName'=>'Buyer last name','BuyerPhone'=>'Buyer phone','BuyerEmail'=>'Buyer email','BuyerStatus'=>'Buyer status','BuyerSoleProp'=>'Sole property','BuyerCountry'=>'Buyer country','BuyerState'=>'Buyer state / province','BuyerCity'=>'Buyer city','BuyerZip'=>'Buyer ZIP','BuyerAddress'=>'Buyer address','BuyerTitle'=>'Deed title','BuyerSellerRelation'=>'Buyer/seller relationship','BuyerCurrentlyOwn'=>'Existing ownership',
    'SellerFirstName'=>'Seller first name','SellerLastName'=>'Seller last name','DeceasedGrantor'=>'Deceased grantor(s)','SellerPhone'=>'Seller phone','SellerEmail'=>'Seller email','SellerCountry'=>'Seller country','SellerState'=>'Seller state / province','SellerCity'=>'Seller city','SellerZip'=>'Seller ZIP','SellerAddress'=>'Seller address','SellerTimeshareOwnerships'=>'Ownership type','WhoWillSupplyDeed'=>'Deed supplied by','TransferedInFamilyBefore'=>'Previously in trust',
    'BrokerInvloved'=>'Broker involved','BrokerName'=>'Broker name','BrokerEmail'=>'Broker email','PropertyIsGift'=>'Gift','PurchasePrice'=>'Purchase price','EscrowService'=>'Escrow service','ResortName'=>'Resort name','ResortAddress'=>'Resort address','ResortZip'=>'Resort ZIP','FixedOrPoints'=>'Fixed / points','FixedOrFloating'=>'Fixed / floating (legacy)','ResortCountry'=>'Resort country','ResortState'=>'Resort state','ResortCity'=>'Resort city','ResortUnitNumber'=>'Unit #','ResortWeekNumber'=>'Week #','ResortIDNumber'=>'Resort ID','FeeRequired'=>'Transfer fee required','FeeAmount'=>'Fee amount','UsageYear'=>'First usage year','ResortSpecial'=>'Resort group','ResortIsPartOther'=>'Other resort','PaymentPerson'=>'Document fee payer','ResortTransferFeePayer'=>'Transfer fee payer'
];

$modernSections = [
    'office' => ['label' => 'Office', 'fields' => ['office_file_no','date_received','processor']],
    'transaction' => ['label' => 'Transaction', 'fields' => ['transaction_type','transaction_other','purchase_price','is_gift','escrow_requested','owners_related','relationship']],
    'current-owners' => ['label' => 'Current Owners', 'fields' => ['current_full_names','current_mailing_address','current_city_state_zip','current_phone','current_email','additional_current_owner','name_changed','current_name_after_change']],
    'new-owners' => ['label' => 'New Owners', 'fields' => ['new_full_names','new_mailing_address','new_city_state_zip','new_phone','new_email','additional_new_names','new_owner_status','spouse_full_name','title_method']],
    'circumstances' => ['label' => 'Special Circumstances', 'fields' => ['special_circumstances','special_other','deceased_owner_names','ever_in_trust']],
    'resort' => ['label' => 'Resort & Ownership', 'fields' => ['resort_name','resort_location','resort_group','resort_group_other','management_company','owner_member_contract_no','contract_number','week_unit_no','ownership_type','ownership_type_other','new_owner_first_year_use','maintenance_fees_paid','ca_tax_bill_paid','ca_tax_bill_amount','transfer_fee_required','transfer_fee_amount','handled_by_broker','broker_name','week_type']],
    'documents' => ['label' => 'Documents', 'fields' => ['documents_included','documents_other','document_notes']],
    'payment' => ['label' => 'Payment', 'fields' => ['lt_transfer_fees_payer','resort_fees_payer','deed_search_required','deed_search_fee_payer']],
    'completed-by' => ['label' => 'Completed By', 'fields' => ['completed_by_name','completed_by_relationship','completed_by_relationship_other','completed_by_phone','completed_by_email']],
];

$legacySections = [
    'buyer' => ['label' => 'Buyer', 'fields' => ['BuyerFirstName','BuyerLastName','BuyerPhone','BuyerEmail','BuyerStatus','BuyerSoleProp','BuyerCountry','BuyerState','BuyerCity','BuyerZip','BuyerAddress','BuyerTitle','BuyerSellerRelation','BuyerCurrentlyOwn']],
    'seller' => ['label' => 'Seller', 'fields' => ['SellerFirstName','SellerLastName','DeceasedGrantor','SellerPhone','SellerEmail','SellerCountry','SellerState','SellerCity','SellerZip','SellerAddress','SellerTimeshareOwnerships','WhoWillSupplyDeed','TransferedInFamilyBefore']],
    'property' => ['label' => 'Property', 'fields' => ['BrokerInvloved','BrokerName','BrokerEmail','PropertyIsGift','PurchasePrice','EscrowService','ResortName','ResortAddress','ResortZip','FixedOrPoints','FixedOrFloating','ResortCountry','ResortState','ResortCity','ResortUnitNumber','ResortWeekNumber','ResortIDNumber','FeeRequired','FeeAmount','UsageYear','ResortSpecial','ResortIsPartOther']],
    'payment' => ['label' => 'Payment', 'fields' => ['PaymentPerson','ResortTransferFeePayer']],
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
    <?php if (($_GET['delete'] ?? '') === 'success'): ?><div class="admin-action-notice success">Submission deleted successfully.</div><?php endif; ?>
    <?php if (($_GET['delete'] ?? '') === 'failed'): ?><div class="admin-action-notice error">The submission could not be deleted. Please try again.</div><?php endif; ?>
    <div class="admin-tab-heading"><div><h2>Document preparation submissions</h2><p><?= count($submissions) ?> total submission<?= count($submissions) === 1 ? '' : 's' ?></p></div></div>
    <?php if (!$submissions): ?><div class="admin-empty"><h2>No submissions yet</h2><p>New document preparation forms will appear here automatically.</p></div><?php endif; ?>
    <div class="submission-list">
      <?php foreach ($submissions as $submission): ?>
        <details class="submission-card">
          <?php
            $ownerName = trim((string) ($submission['new_full_names'] ?? ''));
            if ($ownerName === '') $ownerName = trim(($submission['BuyerFirstName'] ?? '') . ' ' . ($submission['BuyerLastName'] ?? ''));
            $resortName = trim((string) ($submission['resort_name'] ?? ($submission['ResortName'] ?? '')));
            $submissionId = (string) ($submission['id'] ?? '');
            $submissionDomId = strtolower((string) preg_replace('/[^a-zA-Z0-9]+/', '-', $submissionId));
            $sections = array_key_exists('current_full_names', $submission) ? $modernSections : $legacySections;
          ?>
          <summary><span><strong><?= h($ownerName !== '' ? $ownerName : 'Owner not provided') ?></strong><small><?= h($submissionId) ?> &middot; <?= h(isset($submission['submitted_at']) ? date('M j, Y g:i A', strtotime($submission['submitted_at'])) : '') ?></small></span><span class="submission-resort"><?= h($resortName !== '' ? $resortName : 'Resort not provided') ?></span></summary>
          <div class="submission-card-body" data-submission-tabs>
            <div class="submission-toolbar">
              <div><strong>Submission details</strong><span>Choose a section to review its information.</span></div>
              <form method="post" class="submission-delete-form" onsubmit="return confirm('Delete this submission permanently? This cannot be undone.');">
                <input type="hidden" name="action" value="delete_submission">
                <input type="hidden" name="submission_id" value="<?= h($submissionId) ?>">
                <input type="hidden" name="csrf_token" value="<?= h($csrfToken) ?>">
                <button type="submit" class="submission-delete-button">Delete submission</button>
              </form>
            </div>
            <div class="submission-section-tabs" role="tablist" aria-label="Submission sections">
              <?php foreach ($sections as $sectionKey => $section): ?>
                <button type="button" role="tab" id="tab-<?= h($submissionDomId . '-' . $sectionKey) ?>" aria-controls="panel-<?= h($submissionDomId . '-' . $sectionKey) ?>" aria-selected="<?= $sectionKey === array_key_first($sections) ? 'true' : 'false' ?>" class="<?= $sectionKey === array_key_first($sections) ? 'is-active' : '' ?>"><?= h($section['label']) ?></button>
              <?php endforeach; ?>
            </div>
            <div class="submission-section-panels">
              <?php foreach ($sections as $sectionKey => $section): $sectionHasData = false; ?>
                <section role="tabpanel" id="panel-<?= h($submissionDomId . '-' . $sectionKey) ?>" aria-labelledby="tab-<?= h($submissionDomId . '-' . $sectionKey) ?>" <?= $sectionKey === array_key_first($sections) ? '' : 'hidden' ?>>
                  <div class="submission-section-heading"><span><?= str_pad((string) (array_search($sectionKey, array_keys($sections), true) + 1), 2, '0', STR_PAD_LEFT) ?></span><h3><?= h($section['label']) ?></h3></div>
                  <div class="submission-detail-grid">
                    <?php foreach ($section['fields'] as $key):
                      $value = $submission[$key] ?? '';
                      $hasValue = is_array($value) ? count($value) > 0 : trim((string) $value) !== '';
                      if (!$hasValue) continue;
                      $sectionHasData = true;
                      $displayValue = is_array($value) ? implode(', ', $value) : (string) $value;
                      if (in_array($key, ['purchase_price','ca_tax_bill_amount','transfer_fee_amount','PurchasePrice','FeeAmount'], true) && $displayValue !== '' && !str_starts_with($displayValue, '$')) {
                          $displayValue = '$' . $displayValue;
                      }
                    ?>
                      <div><span><?= h($labels[$key] ?? $key) ?></span><strong><?= nl2br(h($displayValue)) ?></strong></div>
                    <?php endforeach; ?>
                    <?php if ($sectionKey === 'documents' && !empty($submission['uploaded_document']['stored_name'])): $sectionHasData = true; ?>
                      <div><span>Uploaded document</span><strong><?= h($submission['uploaded_document']['original_name'] ?? 'Document') ?></strong></div>
                    <?php endif; ?>
                    <?php if (!$sectionHasData): ?><p class="submission-section-empty">No information was provided for this section.</p><?php endif; ?>
                  </div>
                </section>
              <?php endforeach; ?>
            </div>
          </div>
        </details>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<script>
document.querySelectorAll('[data-submission-tabs]').forEach(function (submission) {
  var tabs = submission.querySelectorAll('[role="tab"]');
  var panels = submission.querySelectorAll('[role="tabpanel"]');
  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      tabs.forEach(function (item) { item.classList.remove('is-active'); item.setAttribute('aria-selected', 'false'); });
      panels.forEach(function (panel) { panel.hidden = true; });
      tab.classList.add('is-active');
      tab.setAttribute('aria-selected', 'true');
      var panel = submission.querySelector('#' + tab.getAttribute('aria-controls'));
      if (panel) panel.hidden = false;
    });
  });
});
</script>
<?php require SITE_ROOT . '/common-template/footer.php'; ?>
