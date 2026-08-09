# LT Transfers — Website
### PHP + Bootstrap-free, Vanilla JS Edition

Production-ready rebuild of lttransfers.com implementing the new design while
following a modular, template-driven PHP architecture.

---

## File Structure

```
lttransfers/
├── index.php                 ← Homepage
├── about.php                 ← About Us
├── services.php              ← Services overview (resort + situation grid)
├── service.php                ← Dynamic single-service page (?slug=)
├── fees.php                  ← Pricing / fee transparency
├── faq.php                   ← Full FAQ, grouped by category
├── testimonials.php          ← Owner reviews
├── contact.php                ← Contact form
├── booking.php                ← "Start Your Transfer" intake form + deed upload
├── 404.php                   ← Custom not-found page
├── .htaccess                  ← Pretty URLs, security headers, error routing
├── composer.json               ← Optional PHPMailer dependency
│
├── common-template/
│   ├── header.php             ← Opens <html>, includes meta.php + navigation.php
│   ├── meta.php                ← <head> block: title, description, fonts, CSS
│   ├── navigation.php           ← Site navigation, active-link highlighting
│   ├── footer.php               ← Footer markup + includes scripts.php, closes </html>
│   └── scripts.php              ← Shared + per-page JS includes
│
├── includes/
│   ├── bootstrap.php            ← Single require for config + helpers (used by every page)
│   ├── config.php               ← Site constants: company info, mail settings, feature flags
│   ├── helpers.php              ← h(), clean(), asset(), base_url(), form-storage helpers
│   ├── mailer.php               ← send_site_mail() — PHPMailer with mail() fallback
│   ├── services-data.php        ← Data source for every resort/situation service page
│   └── faq-data.php             ← Shared FAQ content (homepage preview + full FAQ page)
│
├── php/
│   ├── submit-contact.php       ← AJAX handler for contact.php
│   └── submit-booking.php       ← AJAX handler for booking.php (handles deed upload)
│
├── css/
│   ├── style.css                ← Design tokens + all component styles
│   └── responsive.css           ← All breakpoints, kept separate from base styles
│
├── js/
│   └── main.js                  ← Mobile nav, sticky header, generic AJAX form handler
│
├── media/
│   ├── images/                  ← Hero image, favicon
│   └── icons/                   ← Reserved for future icon assets
│
└── data/                        ← Auto-created; JSON submissions + deed uploads (denied via .htaccess)
```

---

## Architecture Notes

- **Every page** starts with `require_once __DIR__ . '/includes/bootstrap.php';`, sets
  `$pageTitle` / `$pageDescription`, then requires `common-template/header.php` and ends
  with `common-template/footer.php`. This keeps every page's markup limited to its own
  unique content — no duplicated `<head>`, navigation, or footer HTML anywhere.
- **Service pages are data-driven.** Add a new resort or situation by adding one entry to
  `includes/services-data.php` and one `RewriteRule` line to `.htaccess` — `service.php`
  renders the page automatically, and it appears on `services.php` and the homepage grid
  without further changes.
- **Forms submit via `fetch()`** to `php/submit-contact.php` / `php/submit-booking.php`,
  which validate input, store a JSON record in `data/`, and email both the LT Transfers
  team and the sender. No page reload is required.

---

## Setup — Step by Step

### 1. (Optional) Install PHPMailer for SMTP email delivery

```bash
composer install
```

Without PHPMailer, form handlers automatically fall back to PHP's native `mail()`
function — the site works out of the box, but SMTP delivery is more reliable in
production.

### 2. Configure contact + mail settings

Edit `includes/config.php` to update the company phone, email, and address, or set the
following environment variables (via a `.env` file if using
[`vlucas/phpdotenv`](https://github.com/vlucas/phpdotenv), or your host's environment
settings):

```
SMTP_HOST=smtp.yourprovider.com
SMTP_PORT=465
SMTP_SECURE=ssl
SMTP_USERNAME=you@yourdomain.com
SMTP_PASSWORD=your-app-password
MAIL_FROM_EMAIL=you@yourdomain.com
MAIL_NOTIFY=info@lttransfers.com
```

### 3. Make `data/` writable

```bash
chmod 775 data/
chmod 775 data/uploads/
```

`data/` is already blocked from public access via `.htaccess`.

### 4. Upload to server

Upload the entire `lttransfers/` folder contents to your web root, ensuring
`mod_rewrite` and `mod_headers` are enabled on Apache (both are used by `.htaccess`).

### 5. Test

1. Visit `/` and confirm the homepage renders correctly.
2. Submit the contact form at `/contact.php` and confirm you receive a notification
   email.
3. Submit the booking form at `/booking.php`, including a test deed upload, and confirm
   the file appears in `data/uploads/`.
4. Visit a service URL such as `/disney-vacation-club-transfers/` and confirm the pretty
   URL resolves correctly.

---

## Adding a New Service Page

1. Add a new entry to the array in `includes/services-data.php` with a unique slug key.
2. Add a matching `RewriteRule` to `.htaccess`:
   ```
   RewriteRule ^your-new-slug/?$ service.php?slug=your-new-slug [L,QSA]
   ```
3. The page is now live at `/your-new-slug/` and automatically appears in the services
   grid on the homepage and `services.php`.

---

## Security (Production Checklist)

- [ ] Set `DEBUG_MODE` to `false` in `includes/config.php` (default)
- [ ] Confirm `data/` returns a 403 when accessed directly
- [ ] Run over HTTPS (Let's Encrypt / host-provided SSL)
- [ ] Review `MAIL_NOTIFY` to ensure form submissions reach the right inbox
- [ ] Periodically clear old files from `data/uploads/` per your data-retention policy

---

*LT Transfers — Timeshare Transfer Specialists, established 2011.*
