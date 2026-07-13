/**
 * LT TRANSFERS — WEBSITE
 * js/main.js
 *
 * Shared behaviour for every page: mobile navigation toggle,
 * AJAX form submission for the contact + booking forms, and a
 * couple of small UX touches (active-link smooth scroll on the
 * homepage anchors, sticky header shadow on scroll).
 */

(function () {
  'use strict';

  /* ── Mobile navigation toggle ─────────────────────────── */
  const navToggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-nav]');

  if (navToggle && nav) {
    navToggle.addEventListener('click', () => {
      const isOpen = nav.classList.toggle('is-open');
      navToggle.setAttribute('aria-expanded', String(isOpen));
    });

    nav.addEventListener('click', (event) => {
      if (event.target instanceof HTMLAnchorElement) {
        nav.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ── Sticky header shadow on scroll ───────────────────── */
  const header = document.querySelector('[data-header]');
  if (header) {
    const toggleShadow = () => {
      header.classList.toggle('is-scrolled', window.scrollY > 8);
    };
    toggleShadow();
    window.addEventListener('scroll', toggleShadow, { passive: true });
  }

  /* ── Generic AJAX form handler ────────────────────────────
     Any <form data-ajax-form> submits via fetch() to its
     `action` attribute and expects { success, message } JSON.
     Used by both contact.php and booking.php.
  ─────────────────────────────────────────────────────────── */
  document.querySelectorAll('[data-ajax-form]').forEach((form) => {
    const alertBox = form.querySelector('[data-form-alert]');
    const submitBtn = form.querySelector('[type="submit"]');

    form.addEventListener('submit', async (event) => {
      event.preventDefault();

      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.dataset.originalText = submitBtn.dataset.originalText || submitBtn.textContent;
        submitBtn.textContent = 'Sending…';
      }

      const showAlert = (type, message) => {
        if (!alertBox) return;
        alertBox.textContent = message;
        alertBox.className = 'form-alert ' + type;
        alertBox.hidden = false;
        alertBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
      };

      try {
        const formData = new FormData(form);
        const response = await fetch(form.getAttribute('action'), {
          method: 'POST',
          body: formData,
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });

        const responseText = await response.text();
        let result;

        try {
          result = JSON.parse(responseText);
        } catch (parseError) {
          console.error('Form endpoint returned a non-JSON response.', {
            action: form.getAttribute('action'),
            status: response.status,
            response: responseText.slice(0, 500),
          });

          const statusMessage = response.status >= 400
            ? `The form server returned HTTP ${response.status}. Please contact us directly.`
            : 'The form server returned an invalid response. Please contact us directly.';
          showAlert('error', statusMessage);
          return;
        }

        if (response.ok && result.success) {
          showAlert('success', result.message || 'Thank you — your submission was received.');
          form.reset();
        } else {
          showAlert('error', result.message || 'Something went wrong. Please try again.');
        }
      } catch (err) {
        console.error('Form request failed.', err);
        showAlert('error', 'We could not reach the server. Please try again or call us directly.');
      } finally {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.textContent = submitBtn.dataset.originalText || 'Submit';
        }
      }
    });
  });
})();
