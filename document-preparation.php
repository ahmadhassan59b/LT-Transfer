<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Document Preparation | ' . SITE_NAME;
$pageDescription = 'Submit the information LT Transfers needs to prepare your timeshare transfer documents.';
$canonicalPath = '/document-preparation';
$bodyClass = 'page-document-preparation';
$resorts = ['Capital Vacations','Disney Vacation Club','Aulani (Disney Vacation Club)','DVC Hilton Head','Exploria Resorts','Hilton Grand Vacations (HGV)','Holiday Inn Club Vacations','Hyatt Vacation Club','Marriott Vacations Worldwide','Marriott’s Grand Chateau','Vacatia','Westgate Resorts','Wyndham / Travel + Leisure Co','Zelandia/LaTour Group','Other'];

function form_choices(string $name, array $options, bool $multiple = false): void {
    echo '<div class="choice-grid' . ($multiple ? ' checkbox-grid' : '') . '">';
    foreach ($options as $index => $option) {
        $id = $name . '_' . ($index + 1);
        $fieldName = $multiple ? $name . '[]' : $name;
        $type = $multiple ? 'checkbox' : 'radio';
        echo '<label class="choice" for="' . h($id) . '"><input type="' . $type . '" id="' . h($id) . '" name="' . h($fieldName) . '" value="' . h($option) . '"><span>' . h($option) . '</span></label>';
    }
    echo '</div>';
}

require SITE_ROOT . '/common-template/header.php';
?>
<main>
  <section class="page-hero document-hero">
    <div class="breadcrumbs"><a href="<?= base_url('/') ?>">Home</a><span aria-hidden="true">/</span><span>Document Preparation</span></div>
    <p class="eyebrow">Secure online intake</p>
    <h1>Timeshare transfer information</h1>
    <p class="lede">Tell us about the ownership and transfer. We will review the details and contact you if anything else is needed.</p>
    <div class="booking-steps"><span>1. Transfer details</span><span>2. Owner &amp; resort information</span><span>3. Review &amp; follow-up</span></div>
  </section>

  <section class="section document-form-section">
    <div class="document-form-shell">
      <aside class="document-sidebar">
        <p class="eyebrow">Before you begin</p>
        <h2>What you will need</h2>
        <ul><li>Buyer and seller contact details</li><li>Your resort and ownership information</li><li>A copy of the recorded deed or certificate, if available</li></ul>
        <p>Prefer paper? <a href="<?= base_url('media/documents/Deed_Online_Info_Form.pdf') ?>" target="_blank" rel="noopener">Download the printable form</a> and mail it to <?= h(COMPANY_ADDRESS_LINE1) ?>, <?= h(COMPANY_ADDRESS_LINE2) ?>.</p>
        <a class="admin-shortcut" href="<?= base_url('admin/document-submissions.php') ?>">Staff: view submissions</a>
      </aside>

      <form class="form-card document-form document-intake" action="<?= base_url('php/submit-document-preparation.php') ?>" method="post" enctype="multipart/form-data" data-ajax-form>
        <div class="honeypot-field" aria-hidden="true"><label for="website-doc">Leave blank</label><input id="website-doc" name="website" tabindex="-1" autocomplete="off"></div>

        <header class="document-intake-header">
          <div><p class="eyebrow">LT Transfers</p><h2>Timeshare transfer document preparation form</h2><p>Complete the applicable fields below. If you are unsure of an answer, leave it blank and our team will help during review.</p></div>
          <div class="document-intake-contact"><span>Need help?</span><a href="tel:<?= preg_replace('/\D+/', '', COMPANY_PHONE) ?>"><?= h(COMPANY_PHONE) ?></a><a href="mailto:<?= h(COMPANY_EMAIL) ?>"><?= h(COMPANY_EMAIL) ?></a></div>
        </header>
        <div class="document-form-instructions"><strong>Please print clearly and complete all questions that apply.</strong> If you are unsure of an answer, leave it blank. Return this form with copies of available ownership documents. Do not send original documents unless requested. We will review the information provided and contact you if additional documents or clarification are needed.</div>
        <div class="document-requirements"><strong>Helpful to have nearby</strong><span>Current and new owner details</span><span>Resort and ownership information</span><span>Deed or ownership certificate</span><a href="<?= base_url('media/documents/Deed_Online_Info_Form.pdf') ?>" target="_blank" rel="noopener">Printable form</a></div>
        <div class="form-alert document-form-alert" data-form-alert hidden></div>

        <details class="document-office-fields" open><summary>Office use only</summary><div class="form-row form-row-three"><div class="form-group"><label for="office_file_no">File number</label><input id="office_file_no" name="office_file_no"></div><div class="form-group"><label for="date_received">Date received</label><input type="date" id="date_received" name="date_received"></div><div class="form-group"><label for="processor">Processor</label><input id="processor" name="processor"></div></div></details>

        <fieldset class="form-section"><legend><span>01</span> Transaction overview</legend>
          <p class="document-section-lead">Select every option that describes this transfer.</p>
          <div class="form-group"><label>Transaction type</label><?php form_choices('transaction_type', ['Sale / Purchase','Gift','Family Transfer','Add Owner','Remove Owner','Transfer to / from Trust','Estate / Probate','Divorce','Corporation / LLC'], true); ?></div>
          <div class="form-row"><div class="form-group"><label for="transaction_other">Other transaction type</label><input id="transaction_other" name="transaction_other"></div><div class="form-group"><label for="purchase_price">Purchase price</label><div class="currency-input"><span aria-hidden="true">$</span><input id="purchase_price" name="purchase_price" inputmode="decimal" placeholder="0.00" aria-label="Purchase price in dollars"></div></div></div>
          <div class="form-row"><div class="form-group"><label>Is this a gift?</label><?php form_choices('is_gift', ['Yes','No']); ?></div><div class="form-group"><label>Escrow requested?</label><?php form_choices('escrow_requested', ['Yes','No','Unsure']); ?></div></div>
          <div class="form-row"><div class="form-group"><label>Are the owners related?</label><?php form_choices('owners_related', ['Yes','No']); ?></div><div class="form-group"><label for="relationship">Relationship, if applicable</label><input id="relationship" name="relationship"></div></div>
        </fieldset>

        <fieldset class="form-section"><legend><span>02</span> Current owner(s) / grantors</legend>
          <div class="form-group"><label for="current_full_names">Full legal name(s) exactly as currently titled *</label><textarea id="current_full_names" name="current_full_names" rows="2" required></textarea></div>
          <div class="form-group"><label for="current_mailing_address">Mailing address</label><input id="current_mailing_address" name="current_mailing_address" autocomplete="street-address"></div>
          <div class="form-row"><div class="form-group"><label for="current_city_state_zip">City, state and ZIP / postal code</label><input id="current_city_state_zip" name="current_city_state_zip"></div><div class="form-group"><label for="additional_current_owner">Additional current owner</label><input id="additional_current_owner" name="additional_current_owner"></div></div>
          <div class="form-row"><div class="form-group"><label for="current_phone">Phone *</label><input type="tel" id="current_phone" name="current_phone" required autocomplete="tel"></div><div class="form-group"><label for="current_email">Email *</label><input type="email" id="current_email" name="current_email" required autocomplete="email"></div></div>
          <div class="form-row"><div class="form-group"><label>Has an owner’s name changed?</label><?php form_choices('name_changed', ['Yes','No']); ?></div><div class="form-group"><label for="current_name_after_change">Current name after change</label><input id="current_name_after_change" name="current_name_after_change"></div></div>
        </fieldset>

        <fieldset class="form-section"><legend><span>03</span> New owner(s) / grantees</legend>
          <div class="form-group"><label for="new_full_names">Full legal name(s) to appear on the new title *</label><textarea id="new_full_names" name="new_full_names" rows="2" required></textarea></div>
          <div class="form-group"><label for="new_mailing_address">Mailing address</label><input id="new_mailing_address" name="new_mailing_address" autocomplete="street-address"></div>
          <div class="form-row"><div class="form-group"><label for="new_city_state_zip">City, state and ZIP / postal code</label><input id="new_city_state_zip" name="new_city_state_zip"></div><div class="form-group"><label for="additional_new_names">Additional new owner(s)</label><input id="additional_new_names" name="additional_new_names"></div></div>
          <div class="form-row"><div class="form-group"><label for="new_phone">Phone *</label><input type="tel" id="new_phone" name="new_phone" required autocomplete="tel"></div><div class="form-group"><label for="new_email">Email *</label><input type="email" id="new_email" name="new_email" required autocomplete="email"></div></div>
          <div class="form-group"><label>New owner status</label><?php form_choices('new_owner_status', ['Married couple','Single person','Trust','Corporation / LLC','Other']); ?></div>
          <div class="form-row"><div class="form-group"><label for="spouse_full_name">Spouse’s full legal name</label><input id="spouse_full_name" name="spouse_full_name"></div><div class="form-group"><label for="title_method">How should title be held?</label><select id="title_method" name="title_method"><option value="">Select an option</option><option>Joint tenants with right of survivorship</option><option>Tenants in common</option><option>Sole and separate property</option><option>Trust</option><option>Corporation / LLC</option><option>Unsure — please advise</option></select></div></div>
          <p class="document-info-note">Title requirements vary by state and circumstance. LT Transfers may contact you to confirm the appropriate vesting language.</p>
        </fieldset>

        <fieldset class="form-section"><legend><span>04</span> Special circumstances</legend>
          <div class="form-group"><label>Select all that apply</label><?php form_choices('special_circumstances', ['Owner is deceased','Ownership was in a trust','Name change','Divorce','Probate / estate','Power of attorney','Minor owner','None'], true); ?></div>
          <div class="form-row"><div class="form-group"><label for="special_other">Other circumstance</label><input id="special_other" name="special_other"></div><div class="form-group"><label for="deceased_owner_names">Deceased owner name(s)</label><input id="deceased_owner_names" name="deceased_owner_names"></div></div>
          <div class="form-group"><label>Has the ownership ever been held in a family or living trust?</label><?php form_choices('ever_in_trust', ['Yes','No','Unsure']); ?></div>
        </fieldset>

        <fieldset class="form-section"><legend><span>05</span> Resort and ownership</legend>
          <div class="form-row"><div class="form-group"><label for="resort_name">Resort name *</label><input id="resort_name" name="resort_name" required></div><div class="form-group"><label for="resort_location">Resort city and state / country</label><input id="resort_location" name="resort_location"><span class="hint">We do not prepare transfers for properties located in Washington State, New York, Connecticut, or Illinois.</span></div></div>
          <div class="form-row"><div class="form-group"><label for="resort_group">Resort / management group</label><select id="resort_group" name="resort_group"><option value="">Select a group</option><?php foreach ($resorts as $resort): ?><option value="<?= h($resort) ?>"><?= h($resort) ?></option><?php endforeach; ?></select></div><div class="form-group other-resort-field" data-other-resort hidden><label for="resort_group_other">Custom resort / management group *</label><input id="resort_group_other" name="resort_group_other" autocomplete="organization"></div></div>
          <div class="form-row"><div class="form-group"><label for="management_company">Management company</label><input id="management_company" name="management_company"></div><div class="form-group"><label for="owner_member_contract_no">Resort ID / member #</label><input id="owner_member_contract_no" name="owner_member_contract_no"></div></div>
          <div class="form-row"><div class="form-group"><label for="contract_number">Contract number</label><input id="contract_number" name="contract_number"></div><div class="form-group"><label for="week_unit_no">Week / unit #</label><input id="week_unit_no" name="week_unit_no"></div></div>
          <div class="form-group"><label>Ownership type</label><?php form_choices('ownership_type', ['Deeded','Certificate / membership','Club access','Other']); ?></div>
          <div class="form-group other-resort-field" data-other-ownership hidden><label for="ownership_type_other">Other ownership type *</label><input id="ownership_type_other" name="ownership_type_other" placeholder="Enter the ownership type"></div>
          <div class="form-row"><div class="form-group"><label for="new_owner_first_year_use">New owner’s first year of use</label><input id="new_owner_first_year_use" name="new_owner_first_year_use"></div><div class="form-group"><label>Maintenance fees paid current?</label><?php form_choices('maintenance_fees_paid', ['Yes','No','Unsure']); ?></div></div>
          <div class="form-row"><div class="form-group"><label>California tax bill paid?</label><?php form_choices('ca_tax_bill_paid', ['Yes','No','Not applicable']); ?></div><div class="form-group"><label for="ca_tax_bill_amount">Tax bill amount</label><div class="currency-input"><span aria-hidden="true">$</span><input id="ca_tax_bill_amount" name="ca_tax_bill_amount" inputmode="decimal" placeholder="0.00" aria-label="Tax bill amount in dollars"></div></div></div>
          <div class="form-row"><div class="form-group"><label>Resort transfer fee required?</label><?php form_choices('transfer_fee_required', ['Yes','No','Unsure']); ?></div><div class="form-group"><label for="transfer_fee_amount">Transfer fee amount</label><div class="currency-input"><span aria-hidden="true">$</span><input id="transfer_fee_amount" name="transfer_fee_amount" inputmode="decimal" placeholder="0.00" aria-label="Transfer fee amount in dollars"></div></div></div>
          <div class="form-row"><div class="form-group"><label>Handled by a broker?</label><?php form_choices('handled_by_broker', ['Yes','No']); ?></div><div class="form-group"><label for="broker_name">Broker name</label><input id="broker_name" name="broker_name"></div></div>
        </fieldset>

        <fieldset class="form-section"><legend><span>06</span> Documents</legend>
          <div class="form-group"><label>Documents included or available</label><?php form_choices('documents_included', ['Recorded deed','Ownership certificate','Purchase agreement','Death certificate','Trust documents','Divorce decree','Power of attorney','Other'], true); ?></div>
          <div class="form-group"><label for="documents_other">Other document</label><input id="documents_other" name="documents_other"></div>
          <div class="form-group upload-drop"><label for="DeedOrCertificateDoc">Upload a supporting document (optional)</label><input type="file" id="DeedOrCertificateDoc" name="DeedOrCertificateDoc" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"><span class="hint">PDF, Word, JPG or PNG. Maximum 10MB.</span></div>
          <div class="form-group"><label for="document_notes">Document notes</label><textarea id="document_notes" name="document_notes" rows="3"></textarea></div>
        </fieldset>

        <fieldset class="form-section"><legend><span>07</span> Payment responsibility</legend>
          <div class="payment-choice-grid"><div><label>LT Transfers fees</label><?php form_choices('lt_transfer_fees_payer', ['Current owner','New owner','Other']); ?></div><div><label>Resort transfer fees</label><?php form_choices('resort_fees_payer', ['Current owner','New owner','Other']); ?></div><div><label>Deed search required?</label><?php form_choices('deed_search_required', ['Yes','No','Unsure']); ?></div><div><label>Deed search fee</label><?php form_choices('deed_search_fee_payer', ['Current owner','New owner','Other']); ?></div></div>
          <div class="payment-notice"><strong>Payment is due before documents are sent for recording.</strong> We will invoice the responsible party after reviewing the submission.</div>
        </fieldset>

        <fieldset class="form-section"><legend><span>08</span> Person completing this form</legend>
          <div class="form-row"><div class="form-group"><label for="completed_by_name">Full name</label><input id="completed_by_name" name="completed_by_name"></div><div class="form-group"><label for="completed_by_relationship">Relationship to transfer</label><select id="completed_by_relationship" name="completed_by_relationship"><option value="">Select one</option><option>Current owner</option><option>New owner</option><option>Family member</option><option>Broker</option><option>Attorney / representative</option><option>Other</option></select></div></div>
          <div class="form-row form-row-three"><div class="form-group"><label for="completed_by_relationship_other">Other relationship</label><input id="completed_by_relationship_other" name="completed_by_relationship_other"></div><div class="form-group"><label for="completed_by_phone">Phone</label><input type="tel" id="completed_by_phone" name="completed_by_phone"></div><div class="form-group"><label for="completed_by_email">Email</label><input type="email" id="completed_by_email" name="completed_by_email"></div></div>
        </fieldset>

        <section class="document-return-card" aria-labelledby="return-heading"><p class="eyebrow">Return instructions</p><h2 id="return-heading">Submit securely online</h2><p>Use the button below, or send completed paper forms and supporting documents to:</p><address><strong><?= h(SITE_NAME) ?></strong><br><?= h(COMPANY_ADDRESS_LINE1) ?><br><?= h(COMPANY_ADDRESS_LINE2) ?><br><a href="mailto:<?= h(COMPANY_EMAIL) ?>"><?= h(COMPANY_EMAIL) ?></a><br><a href="tel:<?= preg_replace('/\D+/', '', COMPANY_PHONE) ?>"><?= h(COMPANY_PHONE) ?></a></address></section>
        <div class="form-actions"><button type="submit" class="button primary">Submit Transfer Information</button></div>
        <p class="form-note">By submitting, you confirm the information is accurate to the best of your knowledge. Your information is used only to review and prepare your transfer.</p>
      </form>
    </div>
  </section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var resort = document.getElementById('resort_group');
  var other = document.querySelector('[data-other-resort]');
  var otherInput = document.getElementById('resort_group_other');
  if (!resort || !other || !otherInput) return;
  function updateOtherResort() {
    var isOther = resort.value === 'Other';
    other.hidden = !isOther;
    otherInput.required = isOther;
    if (!isOther) otherInput.value = '';
  }
  resort.addEventListener('change', updateOtherResort);
  updateOtherResort();

  var ownershipOther = document.querySelector('[data-other-ownership]');
  var ownershipOtherInput = document.getElementById('ownership_type_other');
  var ownershipOptions = document.querySelectorAll('input[name="ownership_type"]');
  function updateOtherOwnership() {
    var selected = document.querySelector('input[name="ownership_type"]:checked');
    var isOther = selected && selected.value === 'Other';
    if (!ownershipOther || !ownershipOtherInput) return;
    ownershipOther.hidden = !isOther;
    ownershipOtherInput.required = isOther;
    if (!isOther) ownershipOtherInput.value = '';
  }
  ownershipOptions.forEach(function (option) { option.addEventListener('change', updateOtherOwnership); });
  updateOtherOwnership();
});
</script>
<?php require SITE_ROOT . '/common-template/footer.php'; ?>
