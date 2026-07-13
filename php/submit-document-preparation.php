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
    'BuyerFirstName' => 'buyer first name', 'BuyerLastName' => 'buyer last name',
    'BuyerPhone' => 'buyer phone number', 'BuyerEmail' => 'buyer email',
    'SellerFirstName' => 'seller first name', 'SellerLastName' => 'seller last name',
    'SellerPhone' => 'seller phone number', 'SellerEmail' => 'seller email',
];
$errors = [];
foreach ($required as $field => $label) {
    if (clean($_POST[$field] ?? '') === '') $errors[] = 'Please enter the ' . $label . '.';
}
if (!is_valid_email(clean($_POST['BuyerEmail'] ?? '', 180))) $errors[] = 'Please enter a valid buyer email.';
if (!is_valid_email(clean($_POST['SellerEmail'] ?? '', 180))) $errors[] = 'Please enter a valid seller email.';

if ($errors) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

$allowedFields = [
    'BuyerFirstName','BuyerLastName','BuyerPhone','BuyerEmail','BuyerStatus','BuyerSoleProp','BuyerCountry','BuyerState','BuyerCity','BuyerZip','BuyerAddress','BuyerTitle','BuyerSellerRelation','BuyerCurrentlyOwn',
    'SellerFirstName','SellerLastName','DeceasedGrantor','SellerPhone','SellerEmail','SellerCountry','SellerState','SellerCity','SellerZip','SellerAddress','SellerTimeshareOwnerships','WhoWillSupplyDeed','TransferedInFamilyBefore',
    'BrokerInvloved','BrokerName','BrokerEmail','PropertyIsGift','PurchasePrice','EscrowService','ResortName','ResortAddress','ResortZip','FixedOrFloating','ResortCountry','ResortState','ResortCity','ResortUnitNumber','ResortWeekNumber','ResortIDNumber','FeeRequired','FeeAmount','UsageYear','ResortSpecial','ResortIsPartOther','PaymentPerson','ResortTransferFeePayer'
];

$submission = ['id' => 'DOC-' . date('Ymd-His') . '-' . strtoupper(bin2hex(random_bytes(2)))];
foreach ($allowedFields as $field) {
    $submission[$field] = clean($_POST[$field] ?? '', $field === 'BuyerCurrentlyOwn' ? 1500 : 500);
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

echo json_encode(['success' => true, 'message' => 'Thank you. Your document information was submitted successfully. Reference: ' . $submission['id']]);
