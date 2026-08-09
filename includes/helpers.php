<?php
/**
 * LT TRANSFERS — WEBSITE
 * includes/helpers.php
 *
 * Small, reusable helper functions shared across every template.
 * Keeping these centralised avoids duplicating logic (and HTML)
 * across individual pages.
 */

declare(strict_types=1);

/**
 * Escape a value for safe HTML output.
 */
function h(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Sanitise raw form input: strip tags, trim, cap length.
 */
function clean(mixed $value, int $maxLen = 500): string
{
    $value = trim(strip_tags((string) ($value ?? '')));

    return function_exists('mb_substr') ? mb_substr($value, 0, $maxLen) : substr($value, 0, $maxLen);
}

/**
 * Build a versioned asset URL for cache-busting.
 */
function asset(string $path): string
{
    $path = ltrim($path, '/');
    return base_url($path) . '?v=' . ASSET_VERSION;
}

/**
 * Resolve an absolute site path so includes work the same way
 * regardless of which directory depth a page lives in.
 */
function base_url(string $path = ''): string
{
    return '/' . ltrim($path, '/');
}

/**
 * Determine whether a given nav link matches the current page,
 * so we can apply an "active" class in the navigation partial.
 */
function is_active_page(string|array $pages): bool
{
    $current = basename($_SERVER['SCRIPT_NAME'] ?? '');
    $pages   = (array) $pages;
    return in_array($current, $pages, true);
}

/**
 * Simple JSON-line append used for storing form submissions
 * without requiring a database.
 */
function append_json_submission(string $file, array $entry): bool
{
    $dir = dirname($file);
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }

    /* FTP uploads can create the storage path as read-only for PHP. */
    if (is_dir($dir) && !is_writable($dir)) {
        @chmod($dir, 0775);
    }
    if (file_exists($file) && !is_writable($file)) {
        @chmod($file, 0664);
        if (!is_writable($file)) {
            @chmod($file, 0666);
        }
    }

    $handle = @fopen($file, 'c+');
    if (!$handle || !flock($handle, LOCK_EX)) {
        if ($handle) fclose($handle);
        return false;
    }

    $raw = stream_get_contents($handle);
    $decoded = json_decode($raw ?: '[]', true);
    $existing = is_array($decoded) ? $decoded : [];
    $entry['submitted_at'] = date('c');
    $existing[] = $entry;

    rewind($handle);
    ftruncate($handle, 0);
    $written = fwrite($handle, json_encode($existing, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    fflush($handle);
    flock($handle, LOCK_UN);
    fclose($handle);
    return $written !== false;
}

/**
 * Very small honeypot / spam check helper.
 */
function is_spam_submission(array $data, string $honeypotField = 'website'): bool
{
    return !empty($data[$honeypotField] ?? '');
}

/**
 * Validate an email address.
 */
function is_valid_email(string $email): bool
{
    return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}
