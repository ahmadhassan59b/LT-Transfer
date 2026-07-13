<?php
/**
 * LT TRANSFERS — WEBSITE
 * includes/mailer.php
 *
 * Thin wrapper around PHPMailer (when installed via Composer)
 * with a graceful fallback to PHP's native mail(). This mirrors
 * the pattern used by the reference project's php/submit.php,
 * so form handlers stay simple and testable.
 */

declare(strict_types=1);

/**
 * Send an email. Returns true on success, false on failure.
 * Never throws — callers should check the boolean result.
 */
function send_site_mail(string $toEmail, string $toName, string $subject, string $bodyHtml, string $replyToEmail = '', string $replyToName = ''): bool
{
    if (class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
        try {
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USERNAME;
            $mail->Password   = SMTP_PASSWORD;
            $mail->SMTPSecure = SMTP_SECURE;
            $mail->Port       = (int) SMTP_PORT;

            $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
            $mail->addAddress($toEmail, $toName);

            if ($replyToEmail !== '') {
                $mail->addReplyTo($replyToEmail, $replyToName ?: $replyToEmail);
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $bodyHtml;
            $mail->AltBody = strip_tags($bodyHtml);

            return $mail->send();
        } catch (\Throwable $e) {
            if (DEBUG_MODE) {
                error_log('Mail error: ' . $e->getMessage());
            }
            return false;
        }
    }

    /* ── Fallback: native mail() ─────────────────────────── */
    $headers   = [];
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = sprintf('From: %s <%s>', MAIL_FROM_NAME, MAIL_FROM_EMAIL);

    if ($replyToEmail !== '') {
        $headers[] = sprintf('Reply-To: %s <%s>', $replyToName ?: $replyToEmail, $replyToEmail);
    }

    return @mail($toEmail, $subject, $bodyHtml, implode("\r\n", $headers));
}
