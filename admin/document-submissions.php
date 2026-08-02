<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');
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
    'resort_name'=>'Resort name','resort_location'=>'Resort location','resort_group'=>'Resort / management group','resort_group_other'=>'Other resort group','management_company'=>'Management company','owner_member_contract_no'=>'Owner / member / contract #','week_unit_no'=>'Week / unit #','week_type'=>'Fixed / points','ownership_type'=>'Ownership type','new_owner_first_year_use'=>'First year of use','maintenance_fees_paid'=>'Maintenance fees current','ca_tax_bill_paid'=>'California tax bill paid','ca_tax_bill_amount'=>'California tax bill amount','transfer_fee_required'=>'Transfer fee required','transfer_fee_amount'=>'Transfer fee amount','handled_by_broker'=>'Handled by broker','broker_name'=>'Broker name',
    'documents_included'=>'Documents included','documents_other'=>'Other document','document_notes'=>'Document notes','lt_transfer_fees_payer'=>'LT Transfers fee payer','resort_fees_payer'=>'Resort fee payer','deed_search_required'=>'Deed search required','deed_search_fee_payer'=>'Deed search fee payer','completed_by_name'=>'Completed by','completed_by_relationship'=>'Relationship to transfer','completed_by_relationship_other'=>'Other relationship','completed_by_phone'=>'Completed by phone','completed_by_email'=>'Completed by email',
    'BuyerFirstName'=>'Buyer first name','BuyerLastName'=>'Buyer last name','BuyerPhone'=>'Buyer phone','BuyerEmail'=>'Buyer email','BuyerStatus'=>'Buyer status','BuyerSoleProp'=>'Sole property','BuyerCountry'=>'Buyer country','BuyerState'=>'Buyer state / province','BuyerCity'=>'Buyer city','BuyerZip'=>'Buyer ZIP','BuyerAddress'=>'Buyer address','BuyerTitle'=>'Deed title','BuyerSellerRelation'=>'Buyer/seller relationship','BuyerCurrentlyOwn'=>'Existing ownership',
    'SellerFirstName'=>'Seller first name','SellerLastName'=>'Seller last name','DeceasedGrantor'=>'Deceased grantor(s)','SellerPhone'=>'Seller phone','SellerEmail'=>'Seller email','SellerCountry'=>'Seller country','SellerState'=>'Seller state / province','SellerCity'=>'Seller city','SellerZip'=>'Seller ZIP','SellerAddress'=>'Seller address','SellerTimeshareOwnerships'=>'Ownership type','WhoWillSupplyDeed'=>'Deed supplied by','TransferedInFamilyBefore'=>'Previously in trust',
    'BrokerInvloved'=>'Broker involved','BrokerName'=>'Broker name','BrokerEmail'=>'Broker email','PropertyIsGift'=>'Gift','PurchasePrice'=>'Purchase price','EscrowService'=>'Escrow service','ResortName'=>'Resort name','ResortAddress'=>'Resort address','ResortZip'=>'Resort ZIP','FixedOrPoints'=>'Fixed / points','FixedOrFloating'=>'Fixed / floating (legacy)','ResortCountry'=>'Resort country','ResortState'=>'Resort state','ResortCity'=>'Resort city','ResortUnitNumber'=>'Unit #','ResortWeekNumber'=>'Week #','ResortIDNumber'=>'Resort ID','FeeRequired'=>'Transfer fee required','FeeAmount'=>'Fee amount','UsageYear'=>'First usage year','ResortSpecial'=>'Resort group','ResortIsPartOther'=>'Other resort','PaymentPerson'=>'Document fee payer','ResortTransferFeePayer'=>'Transfer fee payer'
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
          <?php
            $ownerName = trim((string) ($submission['new_full_names'] ?? ''));
            if ($ownerName === '') $ownerName = trim(($submission['BuyerFirstName'] ?? '') . ' ' . ($submission['BuyerLastName'] ?? ''));
            $resortName = trim((string) ($submission['resort_name'] ?? ($submission['ResortName'] ?? '')));
          ?>
          <summary><span><strong><?= h($ownerName !== '' ? $ownerName : 'Owner not provided') ?></strong><small><?= h($submission['id'] ?? '') ?> &middot; <?= h(isset($submission['submitted_at']) ? date('M j, Y g:i A', strtotime($submission['submitted_at'])) : '') ?></small></span><span class="submission-resort"><?= h($resortName !== '' ? $resortName : 'Resort not provided') ?></span></summary>
          <div class="submission-detail-grid">
            <?php foreach ($labels as $key => $label): if (($submission[$key] ?? '') === '') continue; ?>
              <?php $displayValue = is_array($submission[$key]) ? implode(', ', $submission[$key]) : (string) $submission[$key]; ?>
              <div><span><?= h($label) ?></span><strong><?= nl2br(h($displayValue)) ?></strong></div>
            <?php endforeach; ?>
            <?php if (!empty($submission['uploaded_document']['stored_name'])): ?><div><span>Uploaded document</span><strong><?= h($submission['uploaded_document']['original_name'] ?? 'Document') ?></strong></div><?php endif; ?>
          </div>
        </details>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php require SITE_ROOT . '/common-template/footer.php'; ?>
