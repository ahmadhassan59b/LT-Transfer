<?php
/**
 * Alternate estoppel article URL.
 *
 * The canonical page file is estoppel-explanation.php.
 */

require_once __DIR__ . '/includes/bootstrap.php';

header('Location: ' . base_url('estoppel-explanation.php'), true, 301);
exit;
