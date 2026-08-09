<?php
/**
 * LT TRANSFERS — WEBSITE
 * php/submit-booking.php
 *
 * Accepts a POST (multipart, may include an uploaded ownership
 * document) from booking.php's "Start Your Transfer" form.
 * Validates input, stores the submission, saves any uploaded copy,
 * and emails the LT Transfers team plus a confirmation to the
 * owner.
 *
 * Returns JSON: { "success": true|false, "message": "..." }
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once SITE_ROOT . '/includes/mailer.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

if (is_spam_submission($_POST)) {
    echo json_encode(['success' => true, 'message' => 'Thank you — your information has been received.']);
    exit;
}

/* ── Sanitise + validate ─────────────────────────────────── */
$name       = clean($_POST['name'] ?? '', 120);
$email      = clean($_POST['email'] ?? '', 180);
$phone      = clean($_POST['phone'] ?? '', 40);
$resort     = clean($_POST['resort'] ?? '', 160);
$situation  = clean($_POST['situation'] ?? '', 120);
$hasDeed    = clean($_POST['has_deed'] ?? '', 10);
$details    = clean($_POST['details'] ?? '', 3000);

$errors = [];
if ($name === '') {
    $errors[] = 'Please enter your name.';
}
if (!is_valid_email($email)) {
    $errors[] = 'Please enter a valid email address.';
}
if ($resort === '') {
    $errors[] = 'Please enter your resort or timeshare name.';
}

/* ── Optional ownership document upload ──────────────────── */
$uploadedFileName = '';
if (!empty($_FILES['deed']['name'] ?? '')) {
    $file = $_FILES['deed'];

    if ($file['error'] === UPLOAD_ERR_OK) {
        $allowedExt = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowedExt, true)) {
            $errors[] = 'Your uploaded document must be a PDF, Word document, or image file.';
        } elseif ($file['size'] > 10 * 1024 * 1024) {
            $errors[] = 'Your uploaded document must be smaller than 10MB.';
        } else {
            if (!is_dir(UPLOAD_DIR)) {
                @mkdir(UPLOAD_DIR, 0775, true);
            }
            $uploadedFileName = bin2hex(random_bytes(8)) . '.' . $ext;
            $destination = rtrim(UPLOAD_DIR, '/') . '/' . $uploadedFileName;
            if (!move_uploaded_file($file['tmp_name'], $destination)) {
                $errors[] = 'We could not save your uploaded file. Please try again or email it to us directly.';
                $uploadedFileName = '';
            }
        }
    } elseif ($file['error'] !== UPLOAD_ERR_NO_FILE) {
        $errors[] = 'There was a problem uploading your file. Please try again.';
    }
}

if ($errors) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

/* ── Store submission ─────────────────────────────────────── */
append_json_submission(BOOKING_SUBMISSIONS_FILE, [
    'name'       => $name,
    'email'      => $email,
    'phone'      => $phone,
    'resort'     => $resort,
    'situation'  => $situation,
    'has_deed'   => $hasDeed,
    'details'    => $details,
    'deed_file'  => $uploadedFileName,
    'ip'         => $_SERVER['REMOTE_ADDR'] ?? '',
]);

/* ── Notify the LT Transfers team ─────────────────────────── */
if (SEND_NOTIFICATION_EMAIL) {
    $notifyBody = '<h2>New Transfer Request</h2>'
        . '<p><strong>Name:</strong> ' . h($name) . '</p>'
        . '<p><strong>Email:</strong> ' . h($email) . '</p>'
        . '<p><strong>Phone:</strong> ' . h($phone) . '</p>'
        . '<p><strong>Resort / Timeshare:</strong> ' . h($resort) . '</p>'
        . '<p><strong>Situation:</strong> ' . h($situation) . '</p>'
        . '<p><strong>Has recorded ownership document:</strong> ' . h($hasDeed) . '</p>'
        . '<p><strong>Details:</strong><br>' . nl2br(h($details)) . '</p>'
        . ($uploadedFileName ? '<p><strong>Document file saved as:</strong> ' . h($uploadedFileName) . '</p>' : '<p>No document was uploaded.</p>');

    send_site_mail(MAIL_NOTIFY, MAIL_NOTIFY_NAME, 'New Transfer Request — ' . SITE_NAME, $notifyBody, $email, $name);
}

/* ── Confirm to the owner ────────────────────────────────── */
if (SEND_CONFIRMATION_EMAIL) {
    $confirmBody = '<p>Hi ' . h($name) . ',</p>'
        . '<p>Thank you for starting your timeshare transfer with ' . h(SITE_NAME) . '. We received your information'
        . ($uploadedFileName ? ' and your uploaded document.' : '.')
        . ' Our team will review it and follow up with next steps and a final quote.</p>'
        . '<p>Typical turnaround for a full transfer is 8–20 weeks, depending on the resort and county recording requirements.</p>'
        . '<p>Questions in the meantime? Call us at <a href="tel:+' . h(COMPANY_PHONE_TEL) . '">' . h(COMPANY_PHONE) . '</a>.</p>'
        . '<p>— The ' . h(SITE_NAME) . ' Team<br><small>' . h(SITE_SIGNATURE) . '</small></p>';

    send_site_mail($email, $name, 'We received your transfer request — ' . SITE_NAME, $confirmBody);
}

echo json_encode(['success' => true, 'message' => 'Thank you, ' . $name . ' — we received your information and will follow up with next steps shortly.']);
