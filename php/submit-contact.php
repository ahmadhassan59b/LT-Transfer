<?php
/**
 * LT TRANSFERS — WEBSITE
 * php/submit-contact.php
 *
 * Accepts a POST from the contact form (js/main.js's generic
 * [data-ajax-form] handler). Validates input, stores the
 * submission as JSON, and emails the LT Transfers team plus a
 * confirmation to the sender.
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

/* ── Honeypot spam check ─────────────────────────────────── */
if (is_spam_submission($_POST)) {
    echo json_encode(['success' => true, 'message' => 'Thank you — we will be in touch shortly.']);
    exit;
}

/* ── Sanitise + validate ─────────────────────────────────── */
$name    = clean($_POST['name'] ?? '', 120);
$email   = clean($_POST['email'] ?? '', 180);
$phone   = clean($_POST['phone'] ?? '', 40);
$topic   = clean($_POST['topic'] ?? '', 120);
$message = clean($_POST['message'] ?? '', 3000);

$errors = [];
if ($name === '') {
    $errors[] = 'Please enter your name.';
}
if (!is_valid_email($email)) {
    $errors[] = 'Please enter a valid email address.';
}
if ($message === '') {
    $errors[] = 'Please enter a message.';
}

if ($errors) {
    echo json_encode(['success' => false, 'message' => implode(' ', $errors)]);
    exit;
}

/* ── Store submission ─────────────────────────────────────── */
append_json_submission(CONTACT_SUBMISSIONS_FILE, [
    'name'    => $name,
    'email'   => $email,
    'phone'   => $phone,
    'topic'   => $topic,
    'message' => $message,
    'ip'      => $_SERVER['REMOTE_ADDR'] ?? '',
]);

/* ── Notify the LT Transfers team ─────────────────────────── */
if (SEND_NOTIFICATION_EMAIL) {
    $notifyBody = '<h2>New Contact Form Submission</h2>'
        . '<p><strong>Name:</strong> ' . h($name) . '</p>'
        . '<p><strong>Email:</strong> ' . h($email) . '</p>'
        . '<p><strong>Phone:</strong> ' . h($phone) . '</p>'
        . '<p><strong>Topic:</strong> ' . h($topic) . '</p>'
        . '<p><strong>Message:</strong><br>' . nl2br(h($message)) . '</p>';

    send_site_mail(MAIL_NOTIFY, MAIL_NOTIFY_NAME, 'New Contact Form Submission — ' . SITE_NAME, $notifyBody, $email, $name);
}

/* ── Confirm to the sender ───────────────────────────────── */
if (SEND_CONFIRMATION_EMAIL) {
    $confirmBody = '<p>Hi ' . h($name) . ',</p>'
        . '<p>Thank you for contacting ' . h(SITE_NAME) . '. We received your message and a member of our team will respond shortly.</p>'
        . '<p>If your matter is time-sensitive, you can reach us directly at <a href="tel:+' . h(COMPANY_PHONE_TEL) . '">' . h(COMPANY_PHONE) . '</a>.</p>'
        . '<p>— The ' . h(SITE_NAME) . ' Team<br><small>' . h(SITE_SIGNATURE) . '</small></p>';

    send_site_mail($email, $name, 'We received your message — ' . SITE_NAME, $confirmBody);
}

echo json_encode(['success' => true, 'message' => 'Thank you, ' . $name . ' — your message has been sent. We will be in touch shortly.']);
