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

  /* ── Testimonials slider ───────────────────────────────────
     Progressive carousel for [data-testimonial-slider]: arrow
     nav, dot pagination, autoplay (paused on hover/focus), and
     touch swipe. Slide width/gap are measured from the DOM so
     it stays correct across the 3/2/1-per-view breakpoints.
  ─────────────────────────────────────────────────────────── */
  document.querySelectorAll('[data-testimonial-slider]').forEach((slider) => {
    const track = slider.querySelector('[data-slider-track]');
    const slides = track ? Array.from(track.children) : [];
    if (!track || slides.length < 2) return;

    const prevBtn = slider.querySelector('[data-slider-prev]');
    const nextBtn = slider.querySelector('[data-slider-next]');
    const dotsWrap = slider.querySelector('[data-slider-dots]');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const AUTOPLAY_MS = 6000;

    let index = 0;
    let dots = [];
    let autoplayId = null;

    const perView = () => {
      const width = slider.clientWidth;
      if (width < 640) return 1;
      if (width < 980) return 2;
      return 3;
    };

    const maxIndex = () => Math.max(0, slides.length - perView());

    const stopAutoplay = () => {
      if (autoplayId) {
        window.clearInterval(autoplayId);
        autoplayId = null;
      }
    };

    const startAutoplay = () => {
      stopAutoplay();
      if (reduceMotion) return;
      autoplayId = window.setInterval(() => {
        goTo(index >= maxIndex() ? 0 : index + 1);
      }, AUTOPLAY_MS);
    };

    const buildDots = () => {
      if (!dotsWrap) return;
      dotsWrap.innerHTML = '';
      dots = [];
      for (let i = 0; i <= maxIndex(); i += 1) {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'slider-dot';
        dot.setAttribute('aria-label', 'Go to testimonial ' + (i + 1));
        dot.addEventListener('click', () => {
          goTo(i);
          startAutoplay();
        });
        dotsWrap.appendChild(dot);
        dots.push(dot);
      }
    };

    const render = () => {
      index = Math.min(index, maxIndex());
      const first = slides[0];
      const second = slides[1];
      const gap = second ? second.offsetLeft - (first.offsetLeft + first.offsetWidth) : 0;
      const offset = index * (first.offsetWidth + gap);
      track.style.transform = 'translateX(-' + offset + 'px)';

      dots.forEach((dot, i) => dot.classList.toggle('is-active', i === index));
      if (prevBtn) prevBtn.disabled = index === 0;
      if (nextBtn) nextBtn.disabled = index >= maxIndex();
    };

    const goTo = (target) => {
      index = Math.max(0, Math.min(target, maxIndex()));
      render();
    };

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        goTo(index >= maxIndex() ? 0 : index + 1);
        startAutoplay();
      });
    }

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        goTo(index <= 0 ? maxIndex() : index - 1);
        startAutoplay();
      });
    }

    slider.addEventListener('mouseenter', stopAutoplay);
    slider.addEventListener('mouseleave', startAutoplay);
    slider.addEventListener('focusin', stopAutoplay);
    slider.addEventListener('focusout', startAutoplay);

    let touchStartX = null;
    track.addEventListener('touchstart', (event) => {
      touchStartX = event.touches[0].clientX;
      stopAutoplay();
    }, { passive: true });

    track.addEventListener('touchend', (event) => {
      if (touchStartX === null) return;
      const delta = event.changedTouches[0].clientX - touchStartX;
      if (Math.abs(delta) > 40) {
        goTo(delta < 0 ? index + 1 : index - 1);
      }
      touchStartX = null;
      startAutoplay();
    });

    let resizeTimer = null;
    window.addEventListener('resize', () => {
      window.clearTimeout(resizeTimer);
      resizeTimer = window.setTimeout(() => {
        buildDots();
        render();
      }, 150);
    });

    buildDots();
    render();
    startAutoplay();
  });
})();
