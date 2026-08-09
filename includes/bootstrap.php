<?php
/**
 * LT TRANSFERS — WEBSITE
 * includes/bootstrap.php
 *
 * Every public page requires this single file first. It loads
 * configuration constants and shared helper functions in the
 * correct order, keeping each page's top matter to one line.
 */

declare(strict_types=1);

define('SITE_ROOT', dirname(__DIR__));

require_once SITE_ROOT . '/includes/config.php';
require_once SITE_ROOT . '/includes/helpers.php';
