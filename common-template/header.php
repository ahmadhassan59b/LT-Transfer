<?php
/**
 * LT TRANSFERS — WEBSITE
 * common-template/header.php
 *
 * Opens the HTML document and renders <head> + the site header.
 * Every page includes this file first, after setting $pageTitle
 * and $pageDescription.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require SITE_ROOT . '/common-template/meta.php'; ?>
</head>
<body class="<?= h($bodyClass ?? '') ?>">

<?php require SITE_ROOT . '/common-template/navigation.php'; ?>
