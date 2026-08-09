<?php
/**
 * LT TRANSFERS — WEBSITE
 * common-template/scripts.php
 *
 * Loads shared JavaScript. Pages may set $pageScripts (array of
 * extra script src paths) before including footer.php to load
 * additional page-specific behaviour (e.g. the booking form).
 */
?>
<script src="<?= asset('js/main.js') ?>"></script>
<?php if (!empty($pageScripts) && is_array($pageScripts)): ?>
  <?php foreach ($pageScripts as $script): ?>
    <script src="<?= asset($script) ?>"></script>
  <?php endforeach; ?>
<?php endif; ?>
