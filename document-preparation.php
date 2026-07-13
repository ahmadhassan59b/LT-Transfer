<?php
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Document Preparation | ' . SITE_NAME;
$pageDescription = 'Submit the information LT Transfers needs to prepare your timeshare transfer documents.';
$canonicalPath = '/document-preparation';
$bodyClass = 'page-document-preparation';
$countries = ['Australia', 'Canada', 'France', 'Germany', 'Italy', 'United Kingdom (UK)', 'United States of America (USA)'];
$countryRegions = [
    'Australia' => ['Australian Capital Territory', 'New South Wales', 'Northern Territory', 'Queensland', 'South Australia', 'Tasmania', 'Victoria', 'Western Australia'],
    'Canada' => ['Alberta', 'British Columbia', 'Manitoba', 'New Brunswick', 'Newfoundland and Labrador', 'Northwest Territories', 'Nova Scotia', 'Nunavut', 'Ontario', 'Prince Edward Island', 'Quebec', 'Saskatchewan', 'Yukon'],
    'France' => ['Auvergne-Rhône-Alpes', 'Bourgogne-Franche-Comté', 'Brittany', 'Centre-Val de Loire', 'Corsica', 'Grand Est', 'Hauts-de-France', 'Île-de-France', 'Normandy', 'Nouvelle-Aquitaine', 'Occitanie', 'Pays de la Loire', "Provence-Alpes-Côte d'Azur", 'Guadeloupe', 'French Guiana', 'Martinique', 'Mayotte', 'Réunion'],
    'Germany' => ['Baden-Württemberg', 'Bavaria', 'Berlin', 'Brandenburg', 'Bremen', 'Hamburg', 'Hesse', 'Lower Saxony', 'Mecklenburg-Vorpommern', 'North Rhine-Westphalia', 'Rhineland-Palatinate', 'Saarland', 'Saxony', 'Saxony-Anhalt', 'Schleswig-Holstein', 'Thuringia'],
    'Italy' => ['Abruzzo', 'Aosta Valley', 'Apulia', 'Basilicata', 'Calabria', 'Campania', 'Emilia-Romagna', 'Friuli Venezia Giulia', 'Lazio', 'Liguria', 'Lombardy', 'Marche', 'Molise', 'Piedmont', 'Sardinia', 'Sicily', 'Trentino-South Tyrol', 'Tuscany', 'Umbria', 'Veneto'],
    'United Kingdom (UK)' => ['England', 'Northern Ireland', 'Scotland', 'Wales'],
    'United States of America (USA)' => ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'District of Columbia', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'],
];
$resorts = [
    'Capital Vacations Resorts - Fees Vary', 'Daily Management - $250 Transfer Fee',
    'Diamond Resorts International - Fees vary', 'HGVR - $95 ROFR, $489 Transfer Fee',
    'Holiday Inn/OLCC - $100 Transfer Fee', 'Hyatt - Fees Vary',
    'Marriott - ROFR Waiver $95, $25 Transfer Fee', 'Soleil Management - Fees Vary',
    'Southwind/Spinnaker - $125 Transfer Fee', 'Trading Places - Fees Vary',
    'Tricom Management - Fees Vary', 'Vacation Resorts International - Fees Vary',
    'Vistana/SVO - Fees Vary', 'Westgate - Waiver Needed & $150 Transfer Fee',
    'Zealandia - Fees Vary $100 to $325', 'Wyndham - $399 Transfer Fee', 'Other'
];
require SITE_ROOT . '/common-template/header.php';

function radio_options(string $name, array $options): void {
    echo '<div class="choice-grid">';
    foreach ($options as $index => $option) {
        $id = $name . '_' . ($index + 1);
        echo '<label class="choice" for="' . h($id) . '"><input type="radio" id="' . h($id) . '" name="' . h($name) . '" value="' . h($option) . '"><span>' . h($option) . '</span></label>';
    }
    echo '</div>';
}
?>
<main>
  <section class="page-hero document-hero">
    <div class="breadcrumbs"><a href="<?= base_url('/') ?>">Home</a><span aria-hidden="true">/</span><span>Document Preparation</span></div>
    <p class="eyebrow">Secure online intake</p>
    <h1>Document preparation form</h1>
    <p class="lede">Please complete the form below. Our team will review your information and contact you within one business day.</p>
    <div class="booking-steps"><span>1. Owner details</span><span>2. Property details</span><span>3. Review &amp; follow-up</span></div>
  </section>

  <section class="section document-form-section">
    <div class="document-form-shell">
      <aside class="document-sidebar">
        <p class="eyebrow">Before you begin</p>
        <h2>What you will need</h2>
        <ul><li>Buyer and seller contact details</li><li>Your resort and ownership information</li><li>A copy of the recorded deed or certificate, if available</li></ul>
        <p>Prefer paper? <a href="https://www.lttransfers.com/wp-content/uploads/2025/08/DEED-INFO-sheet.pdf" target="_blank" rel="noopener">Download the printable form</a> and mail it to <?= h(COMPANY_ADDRESS_LINE1) ?>, <?= h(COMPANY_ADDRESS_LINE2) ?>.</p>
        <a class="admin-shortcut" href="<?= base_url('admin/document-submissions.php') ?>">Staff: view submissions</a>
      </aside>

      <form class="form-card document-form" action="<?= base_url('php/submit-document-preparation.php') ?>" method="post" enctype="multipart/form-data" data-ajax-form>
        <div class="form-alert" data-form-alert hidden></div>
        <div class="honeypot-field" aria-hidden="true"><label for="website-doc">Leave blank</label><input id="website-doc" name="website" tabindex="-1" autocomplete="off"></div>

        <fieldset class="form-section"><legend><span>01</span> Grantee / New Owner Information</legend>
          <div class="form-row"><div class="form-group"><label for="BuyerFirstName">First name *</label><input id="BuyerFirstName" name="BuyerFirstName" required autocomplete="given-name"></div><div class="form-group"><label for="BuyerLastName">Last name *</label><input id="BuyerLastName" name="BuyerLastName" required autocomplete="family-name"></div></div>
          <div class="form-row"><div class="form-group"><label for="BuyerPhone">Phone number *</label><input type="tel" id="BuyerPhone" name="BuyerPhone" required autocomplete="tel"></div><div class="form-group"><label for="BuyerEmail">Email address *</label><input type="email" id="BuyerEmail" name="BuyerEmail" required autocomplete="email"></div></div>
          <div class="form-group"><label>Status</label><?php radio_options('BuyerStatus', ['Married Couple', 'Single Male', 'Single Female']); ?></div>
          <div class="form-group"><label>Married individual as their sole and separate property?</label><?php radio_options('BuyerSoleProp', ['Yes', 'No']); ?></div>
          <div class="form-row"><div class="form-group"><label for="BuyerCountry">Country</label><select id="BuyerCountry" name="BuyerCountry" data-country-select data-state-target="BuyerState"><option value="">Select country</option><?php foreach ($countries as $country): ?><option><?= h($country) ?></option><?php endforeach; ?></select></div><div class="form-group"><label for="BuyerState">State / Province</label><select id="BuyerState" name="BuyerState" data-state-select disabled><option value="">Select country first</option></select></div></div>
          <div class="form-row form-row-three"><div class="form-group"><label for="BuyerCity">City</label><input id="BuyerCity" name="BuyerCity"></div><div class="form-group"><label for="BuyerZip">ZIP / Postal code</label><input id="BuyerZip" name="BuyerZip"></div><div class="form-group"><label for="BuyerAddress">Street address</label><input id="BuyerAddress" name="BuyerAddress"></div></div>
          <div class="form-group"><label>If more than one person will be listed on the new deed, how should it be titled?</label><?php radio_options('BuyerTitle', ['Joint Tenants with rights of survivorship', 'Tenants in Common', 'Trust', 'Corporation']); ?></div>
          <div class="form-group"><label for="BuyerSellerRelation">Are buyers and sellers related?</label><input id="BuyerSellerRelation" name="BuyerSellerRelation" placeholder="Please state the family relationship, if applicable"></div>
          <div class="form-group"><label for="BuyerCurrentlyOwn">Do you currently own at this resort or with the management company?</label><textarea id="BuyerCurrentlyOwn" name="BuyerCurrentlyOwn" rows="3" placeholder="If yes, include your member number"></textarea></div>
        </fieldset>

        <fieldset class="form-section"><legend><span>02</span> Grantor / Current Owner Information</legend>
          <div class="form-row"><div class="form-group"><label for="SellerFirstName">First name *</label><input id="SellerFirstName" name="SellerFirstName" required></div><div class="form-group"><label for="SellerLastName">Last name *</label><input id="SellerLastName" name="SellerLastName" required></div></div>
          <div class="form-group"><label for="DeceasedGrantor">Any deceased grantor(s)</label><input id="DeceasedGrantor" name="DeceasedGrantor"></div>
          <div class="form-row"><div class="form-group"><label for="SellerPhone">Phone number *</label><input type="tel" id="SellerPhone" name="SellerPhone" required></div><div class="form-group"><label for="SellerEmail">Email address *</label><input type="email" id="SellerEmail" name="SellerEmail" required></div></div>
          <div class="form-row"><div class="form-group"><label for="SellerCountry">Country</label><select id="SellerCountry" name="SellerCountry" data-country-select data-state-target="SellerState"><option value="">Select country</option><?php foreach ($countries as $country): ?><option><?= h($country) ?></option><?php endforeach; ?></select></div><div class="form-group"><label for="SellerState">State / Province</label><select id="SellerState" name="SellerState" data-state-select disabled><option value="">Select country first</option></select></div></div>
          <div class="form-row form-row-three"><div class="form-group"><label for="SellerCity">City</label><input id="SellerCity" name="SellerCity"></div><div class="form-group"><label for="SellerZip">ZIP / Postal code</label><input id="SellerZip" name="SellerZip"></div><div class="form-group"><label for="SellerAddress">Street address</label><input id="SellerAddress" name="SellerAddress"></div></div>
          <div class="form-group"><label>Ownership type</label><?php radio_options('SellerTimeshareOwnerships', ['Deeded Timeshare', 'Certificate of ownership', 'Club access']); ?></div>
          <div class="form-group"><label>Who will supply the deed or certificate?</label><?php radio_options('WhoWillSupplyDeed', ['Buyer', 'Seller', 'LT Transfers - $25 deed search fee']); ?></div>
          <div class="form-group"><label>Has this timeshare ever been transferred into a Family or Living Trust?</label><?php radio_options('TransferedInFamilyBefore', ['Yes', 'No']); ?></div>
          <div class="form-group upload-drop"><label for="DeedOrCertificateDoc">Upload deed or certificate (optional)</label><input type="file" id="DeedOrCertificateDoc" name="DeedOrCertificateDoc" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"><span class="hint">PDF, Word, JPG or PNG. Maximum 10MB.</span></div>
        </fieldset>

        <fieldset class="form-section"><legend><span>03</span> Property Information</legend>
          <div class="form-group"><label>Is a broker involved?</label><?php radio_options('BrokerInvloved', ['Yes', 'No']); ?></div>
          <div class="form-row" data-broker-fields><div class="form-group"><label for="BrokerName">Broker name</label><input id="BrokerName" name="BrokerName"></div><div class="form-group"><label for="BrokerEmail">Broker email</label><input type="email" id="BrokerEmail" name="BrokerEmail"></div></div>
          <div class="form-row"><div class="form-group"><label>Is this a gift?</label><?php radio_options('PropertyIsGift', ['Yes', 'No']); ?></div><div class="form-group"><label for="PurchasePrice">Purchase price (if not a gift)</label><input id="PurchasePrice" name="PurchasePrice"></div></div>
          <div class="form-row"><div class="form-group"><label>Do you need escrow service?</label><?php radio_options('EscrowService', ['Yes', 'No']); ?></div><div class="form-group"><label for="ResortName">Resort name</label><input id="ResortName" name="ResortName"></div></div>
          <div class="form-row"><div class="form-group"><label for="ResortAddress">Resort address</label><input id="ResortAddress" name="ResortAddress"></div><div class="form-group"><label for="ResortZip">ZIP / Postal code</label><input id="ResortZip" name="ResortZip"></div></div>
          <div class="form-group"><label>Fixed or floating?</label><?php radio_options('FixedOrFloating', ['Fixed', 'Floating']); ?></div>
          <div class="form-row form-row-three"><div class="form-group"><label for="ResortCountry">Country</label><select id="ResortCountry" name="ResortCountry" data-country-select data-state-target="ResortState"><option value="">Select country</option><?php foreach ($countries as $country): ?><option><?= h($country) ?></option><?php endforeach; ?></select></div><div class="form-group"><label for="ResortState">State / Province</label><select id="ResortState" name="ResortState" data-state-select disabled><option value="">Select country first</option></select></div><div class="form-group"><label for="ResortCity">City</label><input id="ResortCity" name="ResortCity"></div></div>
          <div class="form-row form-row-three"><div class="form-group"><label for="ResortUnitNumber">Unit #</label><input id="ResortUnitNumber" name="ResortUnitNumber"></div><div class="form-group"><label for="ResortWeekNumber">Week #</label><input id="ResortWeekNumber" name="ResortWeekNumber"></div><div class="form-group"><label for="ResortIDNumber">Resort ID / member #</label><input id="ResortIDNumber" name="ResortIDNumber"></div></div>
          <div class="form-row"><div class="form-group"><label>Does the resort require a transfer fee?</label><?php radio_options('FeeRequired', ['Yes', 'No']); ?></div><div class="form-group"><label for="FeeAmount">Fee amount</label><input type="number" min="0" step="1" id="FeeAmount" name="FeeAmount"></div></div>
          <div class="form-group"><label for="UsageYear">First year of usage for buyer</label><input id="UsageYear" name="UsageYear"></div>
          <div class="form-group"><label for="ResortSpecial">If your resort is listed, select it</label><select id="ResortSpecial" name="ResortSpecial"><option value="">Select a resort / management group</option><?php foreach ($resorts as $resort): ?><option><?= h($resort) ?></option><?php endforeach; ?></select><span class="hint">* Some resorts require prepaid maintenance fees.</span></div>
          <div class="form-group" data-other-resort hidden><label for="ResortIsPartOther">Other resort / management group</label><input id="ResortIsPartOther" name="ResortIsPartOther"></div>
        </fieldset>

        <fieldset class="form-section"><legend><span>04</span> Payment Information</legend>
          <div class="form-row"><div class="form-group"><label>Who will pay document preparation and recording fees?</label><?php radio_options('PaymentPerson', ['Buyer', 'Seller']); ?></div><div class="form-group"><label>Who will pay the resort transfer fee?</label><?php radio_options('ResortTransferFeePayer', ['Buyer', 'Seller']); ?></div></div>
          <div class="payment-notice"><strong>Payment is due before the deed is sent for recording.</strong> We will invoice the paying party. Payment is accepted by check or PayPal; credit and debit cards are not accepted.</div>
        </fieldset>

        <div class="form-actions"><button type="submit" class="button primary">Submit Document Information</button></div>
        <p class="form-note">By submitting, you confirm the information is accurate to the best of your knowledge. Your information is used only to review and prepare your transfer.</p>
      </form>
    </div>
  </section>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
  var countryRegions = <?= json_encode($countryRegions, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?>;
  document.querySelectorAll('[data-country-select]').forEach(function (countrySelect) {
    var stateSelect = document.getElementById(countrySelect.dataset.stateTarget);
    if (!stateSelect) return;

    function updateStates() {
      var regions = countryRegions[countrySelect.value] || [];
      stateSelect.innerHTML = '';
      var prompt = document.createElement('option');
      prompt.value = '';
      prompt.textContent = regions.length ? 'Select state / province' : 'Select country first';
      stateSelect.appendChild(prompt);
      regions.forEach(function (region) {
        var option = document.createElement('option');
        option.value = region;
        option.textContent = region;
        stateSelect.appendChild(option);
      });
      stateSelect.disabled = regions.length === 0;
    }

    countrySelect.addEventListener('change', updateStates);
    updateStates();
  });

  var resort = document.getElementById('ResortSpecial');
  var other = document.querySelector('[data-other-resort]');
  if (resort && other) resort.addEventListener('change', function () { other.hidden = resort.value !== 'Other'; });
});
</script>
<?php require SITE_ROOT . '/common-template/footer.php'; ?>
