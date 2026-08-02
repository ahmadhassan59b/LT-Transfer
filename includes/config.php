<?php
/**
 * LT TRANSFERS — WEBSITE
 * includes/config.php
 *
 * Central place for site-wide constants. Edit this file to update
 * company details, contact information, or feature flags — every
 * template pulls from here instead of hard-coding values.
 */

/* ── Environment ─────────────────────────────────────────── */
if (!defined('SITE_ROOT')) {
    define('SITE_ROOT', dirname(__DIR__));
}

$autoloader = SITE_ROOT . '/vendor/autoload.php';
if (file_exists($autoloader)) {
    require_once $autoloader;
}

if (class_exists('Dotenv\Dotenv')) {
    $dotenv = Dotenv\Dotenv::createImmutable(SITE_ROOT);
    $dotenv->safeLoad();
}

function envValue(string $key, string $default = ''): string
{
    return $_ENV[$key] ?? getenv($key) ?: $default;
}

/* ── Company / Brand ─────────────────────────────────────── */
define('SITE_NAME',        'LT Transfers');
define('SITE_TAGLINE',     'Timeshare Transfer Specialists');
define('SITE_URL',         envValue('SITE_URL', 'https://www.lttransfers.com'));
define('SITE_ESTABLISHED', '2011');

/* ── Contact Information ─────────────────────────────────── */
define('COMPANY_PHONE',        '706-394-3961');
define('COMPANY_PHONE_TEL',    '17063943961');
define('COMPANY_EMAIL',        'support@lttransfers.com');
define('COMPANY_ADDRESS_LINE1','140 Builders Parkway, Suite A');
define('COMPANY_ADDRESS_LINE2','Cornelia, GA 30531');
define('COMPANY_FAX',          '706-219-0092');
define('COMPANY_HOURS',        'Monday – Friday, 9:00 AM – 5:00 PM ET');

/* ── Attorney in Charge (Georgia State Bar disclosure) ───────
   Non-attorney document preparation services in Georgia must
   clearly disclose the supervising "Attorney in Charge" on the
   homepage. Edit these values if the firm of record changes.
   ─────────────────────────────────────────────────────────── */
define('ATTORNEY_FIRM',    'The Dempsey Law Firm, LLC');
define('ATTORNEY_ADDRESS', 'PO Box 460, Clarkesville, GA 30523');
define('ATTORNEY_PHONE',   '706-754-0004');
define('ATTORNEY_EMAIL',   'readylegal@gmail.com');

/* ── Brand signature tagline ─────────────────────────────────
   Used in the footer and as the closing line ("signature
   block") on outbound emails. Kept as one constant so it only
   needs to be updated in a single place.
   ─────────────────────────────────────────────────────────── */
define('SITE_SIGNATURE', 'Established ' . SITE_ESTABLISHED . ' — Over 15 Years Preparing Timeshare Transfer Documents');

/* ── Mail / Form Handling ────────────────────────────────── */
define('SMTP_HOST',     envValue('SMTP_HOST'));
define('SMTP_PORT',     envValue('SMTP_PORT', '465'));
define('SMTP_SECURE',   envValue('SMTP_SECURE', 'ssl'));
define('SMTP_USERNAME', envValue('SMTP_USERNAME'));
define('SMTP_PASSWORD', envValue('SMTP_PASSWORD'));

define('MAIL_FROM_EMAIL', envValue('MAIL_FROM_EMAIL', COMPANY_EMAIL));
define('MAIL_FROM_NAME',  envValue('MAIL_FROM_NAME', SITE_NAME));
define('MAIL_NOTIFY',     envValue('MAIL_NOTIFY', COMPANY_EMAIL));
define('MAIL_NOTIFY_NAME',envValue('MAIL_NOTIFY_NAME', 'LT Transfers Team'));

/* ── File paths for JSON storage (form submissions) ─────────── */
define('CONTACT_SUBMISSIONS_FILE', SITE_ROOT . '/data/contact-submissions.json');
define('BOOKING_SUBMISSIONS_FILE', SITE_ROOT . '/data/booking-submissions.json');
define('DOCUMENT_SUBMISSIONS_FILE', SITE_ROOT . '/data/.private/document-preparation-submissions.json');
define('DOCUMENT_UPLOAD_DIR',       SITE_ROOT . '/data/.private/uploads');
define('UPLOAD_DIR',               SITE_ROOT . '/data/uploads');

/* Admin access for the JSON submissions viewer. Set these in .env in production. */
define('ADMIN_USERNAME', envValue('ADMIN_USERNAME', 'admin'));
define('ADMIN_PASSWORD', envValue('ADMIN_PASSWORD', 'change-me-before-launch'));

/* ── Feature flags ───────────────────────────────────────── */
define('SEND_NOTIFICATION_EMAIL', true);
define('SEND_CONFIRMATION_EMAIL', true);
define('DEBUG_MODE', false);

/* ── Asset cache-busting version ─────────────────────────── */
define('ASSET_VERSION', '1.0.20');
