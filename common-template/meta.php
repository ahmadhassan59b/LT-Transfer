<?php
/**
 * LT TRANSFERS — WEBSITE
 * common-template/meta.php
 *
 * Renders the <head> block. Pages set $pageTitle and
 * $pageDescription (and optionally $canonicalPath) before
 * including header.php, which in turn includes this file.
 */

$pageTitle       = $pageTitle ?? SITE_NAME . ' — ' . SITE_TAGLINE;
$pageDescription = $pageDescription ?? 'LT Transfers provides affordable timeshare document preparation, recording, and resort transfer coordination for owners nationwide. Established in ' . SITE_ESTABLISHED . '.';
$canonicalPath   = $canonicalPath ?? ($_SERVER['REQUEST_URI'] ?? '/');
?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?= h($pageTitle) ?></title>
<meta name="description" content="<?= h($pageDescription) ?>" />
<link rel="canonical" href="<?= h(SITE_URL . $canonicalPath) ?>" />

<link rel="icon" type="image/png" sizes="64x64" href="<?= asset('media/images/favicon.png') ?>" />

<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Site Stylesheets -->
<link rel="stylesheet" href="<?= asset('css/style.css') ?>" />
<link rel="stylesheet" href="<?= asset('css/responsive.css') ?>" />

<meta property="og:site_name" content="<?= h(SITE_NAME) ?>" />
<meta property="og:title" content="<?= h($pageTitle) ?>" />
<meta property="og:description" content="<?= h($pageDescription) ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?= h(SITE_URL . $canonicalPath) ?>" />
