<?php
declare(strict_types=1);

ob_start();
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

set_exception_handler(static function (Throwable $exception): void {
    if (ob_get_length()) ob_clean();
    error_log('Document preparation submission error: ' . $exception->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'The server could not process this submission. Please contact the site administrator.',
    ]);
    exit;
});

register_shutdown_function(static function (): void {
    $error = error_get_last();
    $fatalTypes = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR];
    if (!$error || !in_array($error['type'], $fatalTypes, true)) return;

    if (ob_get_length()) ob_clean();
    error_log('Document preparation fatal error: ' . $error['message']);
    if (!headers_sent()) {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(500);
    }
    echo json_encode([
        'success' => false,
        'message' => 'The server could not process this submission. Please contact the site administrator.',
    ]);
});

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once SITE_ROOT . '/includes/mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

if (is_spam_submission($_POST)) {
    echo json_encode(['success' => true, 'message' => 'Thank you. Your information has been received.']);
    exit;
}

$required = [
    'current_full_names' => 'current owner name(s)',
    'current_phone' => 'current owner phone number',
    'current_email' => 'current owner email',
    'new_full_names' => 'new owner name(s)',
    'new_phone' => 'new owner phone number',
    'new_email' => 'new owner email',
    'resort_name' => 'resort name',
];
$errors = [];
foreach ($required as $field => $label) {
    if (clean($_POST[$field] ?? '') === '') $errors[] = 'Please enter the ' . $label . '.';
}
if (!is_valid_email(clean($_POST['current_email'] ?? '', 180))) $errors[] = 'Please enter a valid current owner email.';
if (!is_valid_email(clean($_POST['new_email'] ?? '', 180))) $errors[] = 'Please enter a valid new owner email.';
if (clean($_POST['completed_by_email'] ?? '', 180) !== '' && !is_valid_email(clean($_POST['completed_by_email'] ?? '', 180))) $errors[] = 'Please enter a valid email for the person completing the form.';
if (clean($_POST['resort_group'] ?? '') === 'Other' && clean($_POST['resort_group_other'] ?? '') === '') {
    $errors[] = 'Please enter the custom resort or management group name.';
}
if (clean($_POST['ownership_type'] ?? '') === 'Other' && clean($_POST['ownership_type_other'] ?? '') === '') {
    $errors[] = 'Please enter the custom ownership type.';
}

if ($errors) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

$allowedFields = [
    'office_file_no','date_received','processor','transaction_other','purchase_price','is_gift','escrow_requested','owners_related','relationship',
    'current_full_names','current_mailing_address','current_city_state_zip','current_phone','current_email','additional_current_owner','name_changed','current_name_after_change',
    'new_full_names','new_mailing_address','new_city_state_zip','new_phone','new_email','additional_new_names','new_owner_status','spouse_full_name','title_method',
    'special_other','deceased_owner_names','ever_in_trust','resort_name','resort_location','resort_group','resort_group_other','management_company','owner_member_contract_no','contract_number','week_unit_no','ownership_type','ownership_type_other','new_owner_first_year_use','maintenance_fees_paid','ca_tax_bill_paid','ca_tax_bill_amount','transfer_fee_required','transfer_fee_amount','handled_by_broker','broker_name',
    'documents_other','document_notes','lt_transfer_fees_payer','resort_fees_payer','deed_search_required','deed_search_fee_payer','completed_by_name','completed_by_relationship','completed_by_relationship_other','completed_by_phone','completed_by_email'
];
$arrayFields = ['transaction_type','special_circumstances','documents_included'];

$submission = ['id' => 'DOC-' . date('Ymd-His') . '-' . strtoupper(bin2hex(random_bytes(2)))];
foreach ($allowedFields as $field) {
    $submission[$field] = clean($_POST[$field] ?? '', in_array($field, ['current_full_names','new_full_names','document_notes'], true) ? 1500 : 500);
}
foreach ($arrayFields as $field) {
    $values = $_POST[$field] ?? [];
    if (!is_array($values)) $values = [];
    $submission[$field] = array_values(array_filter(array_map(static fn ($value): string => clean((string) $value, 150), $values)));
}

if (!empty($_FILES['DeedOrCertificateDoc']['name']) && ($_FILES['DeedOrCertificateDoc']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE) {
    $file = $_FILES['DeedOrCertificateDoc'];
    $allowedMime = ['application/pdf','image/jpeg','image/png','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        $errors[] = 'The document upload did not complete. Please try again.';
    } elseif (($file['size'] ?? 0) > 10 * 1024 * 1024) {
        $errors[] = 'The uploaded document must be 10MB or smaller.';
    } else {
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        if (!in_array($mime, $allowedMime, true)) {
            $errors[] = 'Please upload a PDF, Word document, JPG, or PNG file.';
        } else {
            if (!is_dir(DOCUMENT_UPLOAD_DIR)) @mkdir(DOCUMENT_UPLOAD_DIR, 0775, true);
            $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $storedName = strtolower($submission['id']) . '-' . bin2hex(random_bytes(4)) . '.' . $extension;
            if (!move_uploaded_file($file['tmp_name'], DOCUMENT_UPLOAD_DIR . '/' . $storedName)) {
                $errors[] = 'We could not save the uploaded document.';
            } else {
                $submission['uploaded_document'] = ['original_name' => clean($file['name'], 255), 'stored_name' => $storedName, 'mime_type' => $mime, 'size' => (int) $file['size']];
            }
        }
    }
}

if ($errors) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

$submission['ip'] = $_SERVER['REMOTE_ADDR'] ?? '';
if (!append_json_submission(DOCUMENT_SUBMISSIONS_FILE, $submission)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'We could not save your submission. Please call us at ' . COMPANY_PHONE . '.']);
    exit;
}

if (SEND_NOTIFICATION_EMAIL) {
    $notificationRows = [
        'Reference' => $submission['id'],
        'Current owner(s)' => $submission['current_full_names'],
        'Current owner email' => $submission['current_email'],
        'Current owner phone' => $submission['current_phone'],
        'New owner(s)' => $submission['new_full_names'],
        'New owner email' => $submission['new_email'],
        'New owner phone' => $submission['new_phone'],
        'Resort name' => $submission['resort_name'],
        'Resort / management group' => $submission['resort_group'],
        'Resort location' => $submission['resort_location'],
        'Transaction type' => implode(', ', $submission['transaction_type']),
        'Person completing the form' => $submission['completed_by_name'],
        'Supporting document' => isset($submission['uploaded_document'])
            ? $submission['uploaded_document']['original_name']
            : 'None uploaded',
    ];
    $notificationBody = '<h2>New Document Preparation Submission</h2>';
    foreach ($notificationRows as $label => $value) {
        $displayValue = trim((string) $value) !== '' ? (string) $value : 'Not provided';
        $notificationBody .= '<p><strong>' . h($label) . ':</strong> ' . h($displayValue) . '</p>';
    }
    $notificationBody .= '<p><a href="' . h(base_url('admin/document-submissions.php')) . '">View the complete submission in the admin area</a></p>';

    $replyToEmail = $submission['completed_by_email'] ?: $submission['current_email'];
    $replyToName = $submission['completed_by_name'] ?: $submission['current_full_names'];
    if (!send_site_mail(
        DOCUMENT_MAIL_NOTIFY,
        'Ready Legal',
        'New Document Preparation Submission - ' . $submission['id'],
        $notificationBody,
        $replyToEmail,
        $replyToName
    )) {
        error_log('Document preparation notification email failed for ' . $submission['id']);
    }
}

echo json_encode(['success' => true, 'message' => 'Thank you. Your document information was submitted successfully. Reference: ' . $submission['id']]);
