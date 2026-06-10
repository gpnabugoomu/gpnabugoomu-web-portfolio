(() => {
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

  // Year
  const yearEl = $('#year');
  if (yearEl) yearEl.textContent = String(new Date().getFullYear());

  // Mobile nav
  const toggleBtn = $('[data-nav-toggle]');
  const nav = $('.site-nav');
  if (toggleBtn && nav) {
    toggleBtn.addEventListener('click', () => {
      const open = toggleBtn.getAttribute('aria-expanded') === 'true';
      toggleBtn.setAttribute('aria-expanded', String(!open));
      nav.dataset.open = String(!open);
    });

    // Close nav on click
    $$('.site-nav .nav-link', nav).forEach(link => {
      link.addEventListener('click', () => {
        toggleBtn.setAttribute('aria-expanded', 'false');
        nav.dataset.open = 'false';
      });
    });
  }

  // Campaign data (example UI; connect to PHP/MySQL later)
  const campaigns = [
    {
      id: 'c1',
      name: 'Community Support Drive',
      tags: ['Health', 'Food'],
      status: 'In progress',
      raised: 18450,
      goal: 25000,
      blurb: 'Providing essentials and connecting families to resources.',
      description: 'This campaign supports community care visits and essential supplies for vulnerable households.'
    },
    {
      id: 'c2',
      name: 'School Supplies & Mentorship',
      tags: ['Education'],
      status: 'In progress',
      raised: 9200,
      goal: 15000,
      blurb: 'Backpacks, learning materials, and mentorship sessions.',
      description: 'Funds help provide school supplies and mentorship to improve attendance and learning outcomes.'
    },
    {
      id: 'c3',
      name: 'Clean Water & Hygiene Kits',
      tags: ['Health'],
      status: 'In progress',
      raised: 14100,
      goal: 20000,
      blurb: 'Hygiene kits and clean-water support to reduce illness.',
      description: 'Your support helps provide hygiene kits and contribute to clean-water initiatives for communities.'
    }
  ];

  const currency = new Intl.NumberFormat(undefined, { style: 'currency', currency: 'USD', maximumFractionDigits: 0 });
  const formatMoney = (n) => currency.format(n);

  const clampPercent = (raised, goal) => {
    if (!goal) return 0;
    return Math.max(0, Math.min(100, Math.round((raised / goal) * 100)));
  };

  const list = $('#campaignList');
  const tpl = $('#campaignCardTemplate');
  const searchInput = $('#campaignSearch');

  const renderCampaigns = (items) => {
    if (!list || !tpl) return;
    list.innerHTML = '';

    items.forEach(item => {
      const node = tpl.content.cloneNode(true);
      const card = node.querySelector('.campaign-card');

      // Mark elements for scroll reveal (used after insertion)
      if (card) {
        card.classList.add('reveal');
        // Stagger children (title, blurb, actions)
        const title = card.querySelector('.campaign-title');
        const blurb = card.querySelector('.campaign-blurb');
        const actions = card.querySelector('.campaign-actions');
        if (title) {
          title.classList.add('reveal__item');
          title.style.setProperty('--stagger', '70');
        }
        if (blurb) {
          blurb.classList.add('reveal__item');
          blurb.style.setProperty('--stagger', '120');
        }
        if (actions) {
          actions.classList.add('reveal__item');
          actions.style.setProperty('--stagger', '170');
        }
      }


      const title = card.querySelector('.campaign-title');
      const raisedEl = card.querySelector('.campaign-raised');
      const goalEl = card.querySelector('.campaign-goal');
      const bar = card.querySelector('.campaign-bar');
      const percentEl = card.querySelector('.campaign-percent');
      const remainingEl = card.querySelector('.campaign-remaining');
      const blurbEl = card.querySelector('.campaign-blurb');

      title.textContent = item.name;
      raisedEl.textContent = formatMoney(item.raised);
      goalEl.textContent = formatMoney(item.goal);
      blurbEl.textContent = item.blurb;

      const percent = clampPercent(item.raised, item.goal);
      const remaining = Math.max(0, item.goal - item.raised);

      bar.style.width = percent + '%';
      bar.setAttribute('aria-valuenow', String(percent));
      percentEl.textContent = percent + '% funded';
      remainingEl.textContent = formatMoney(remaining) + ' remaining';

      // tags
      const meta = card.querySelector('.campaign-meta');
      const tagEls = $$('[class~="campaign-tag"]', meta);
      // We know template contains 2 tags placeholders; replace them safely.
      tagEls.forEach((el, idx) => {
        el.textContent = item.tags[idx] ?? '';
        el.style.display = item.tags[idx] ? 'inline-flex' : 'none';
      });
      const statusEl = card.querySelector('.campaign-status');
      statusEl.textContent = item.status;

      // Modal details
      const modal = card.querySelector('[data-modal]');
      const detailsBtn = card.querySelector('[data-details]');
      const modalTitle = modal.querySelector('[data-modal-title]');
      const modalDesc = modal.querySelector('[data-modal-description]');
      const modalRaised = modal.querySelector('[data-modal-raised]');
      const modalGoal = modal.querySelector('[data-modal-goal]');
      const modalStatus = modal.querySelector('[data-modal-status]');
      const modalBar = modal.querySelector('[data-modal-bar]');

      if (detailsBtn && modal) {
        detailsBtn.addEventListener('click', () => {
          modalTitle.textContent = item.name;
          modalDesc.textContent = item.description;
          modalRaised.textContent = formatMoney(item.raised);
          modalGoal.textContent = formatMoney(item.goal);
          modalStatus.textContent = item.status;
          if (modalBar) modalBar.style.width = percent + '%';

          if (typeof modal.showModal === 'function') modal.showModal();
        });
      }

      list.appendChild(card);

      // Donate link anchor can be refined later
      const donateLink = card.querySelector('[data-donate-link]');
      if (donateLink) {
        donateLink.addEventListener('click', (e) => {
          // For now just scroll to donate; later attach campaign id.
          const donateSection = document.querySelector('#donate');
          if (donateSection) {
            e.preventDefault();
            donateSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
          }
        });
      }
    });
  };

  const setupRevealObserver = () => {
    const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced) return;

    const toReveal = $$('.reveal');
    if (!toReveal.length) return;

    const applyIn = (el) => {
      el.classList.add('reveal--in');
      // Ensure children inherit stagger effect only if present
    };

    const obs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          applyIn(entry.target);
          obs.unobserve(entry.target);
        }
      });
    }, { root: null, threshold: 0.15, rootMargin: '0px 0px -10% 0px' });

    toReveal.forEach(el => obs.observe(el));
  };

  const markStaticForReveal = () => {
    // Generic wrappers
    const wrappers = [
      ...$$('.hero-card'),
      ...$$('.campaign-card'),
      ...$$('.story-card'),
      ...$$('.trust-item'),
      ...$$('.panel'),
      ...$$('.aside-card')
    ];

    wrappers.forEach((el, idx) => {
      el.classList.add('reveal');
      // stagger by type/order
      el.style.setProperty('--stagger', String(idx * 60));

      // Reveal key children inside cards/panels
      const childSelectors = [
        '.hero-copy h1',
        '.hero-copy p',
        '.hero-actions',
        '.campaign-title',
        '.campaign-blurb',
        '.campaign-actions',
        '.story-title',
        '.story-text',
        '.story-link',
        'h3',
        'p',
        'form'
      ];

      const children = childSelectors
        .map(sel => el.querySelector(sel))
        .filter(Boolean);

      children.forEach((c, cIdx) => {
        c.classList.add('reveal__item');
        c.style.setProperty('--stagger', String(80 + cIdx * 80));
      });
    });

    // Make hero pill also reveal slightly
    const heroPill = $('.hero .pill');
    if (heroPill) {
      heroPill.classList.add('reveal');
      heroPill.style.setProperty('--stagger', '20');
    }
  };

  markStaticForReveal();
  renderCampaigns(campaigns);
  // After dynamic render, mark campaigns that were inserted by JS
  // (they already get .reveal in renderCampaigns)
  setupRevealObserver();

  if (searchInput) {
    searchInput.addEventListener('input', () => {
      const q = (searchInput.value || '').trim().toLowerCase();
      const filtered = campaigns.filter(c => c.name.toLowerCase().includes(q) || c.tags.join(' ').toLowerCase().includes(q));
      renderCampaigns(filtered);

      // Re-run observer to animate newly inserted cards
      // (markStaticForReveal also handles static wrappers but doesn't hurt)
      markStaticForReveal();
      setupRevealObserver();
    });
  }

  // Form validation helpers
  const validateEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

  const showFieldError = (inputId, message) => {
    const err = document.querySelector(`[data-err-for="${inputId}"]`);
    if (!err) return;
    err.textContent = message || '';
  };

  const clearAllFieldErrors = (form) => {
    $$('.field-error', form).forEach(e => (e.textContent = ''));
  };

  const setFormStatus = (statusEl, kind, text) => {
    if (!statusEl) return;
    statusEl.textContent = text;
    statusEl.dataset.kind = kind;
  };

  // Volunteer form
  const volunteerForm = $('#volunteerForm');
  if (volunteerForm) {
    volunteerForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      clearAllFieldErrors(volunteerForm);

      const statusEl = volunteerForm.querySelector('[data-status]');
      setFormStatus(statusEl, 'ok', 'Submitting…');

      const name = $('#vName', volunteerForm).value.trim();
      const email = $('#vEmail', volunteerForm).value.trim();
      const message = $('#vMessage', volunteerForm).value.trim();
      const role = $('#vRole', volunteerForm).value;

      let ok = true;
      if (name.length < 2) { showFieldError('vName', 'Please enter your full name.'); ok = false; }
      if (!validateEmail(email)) { showFieldError('vEmail', 'Enter a valid email address.'); ok = false; }
      if (message.length < 10) { showFieldError('vMessage', 'Please add a short message (10+ characters).'); ok = false; }
      if (!role) { ok = false; /* handled by select required */ }

      if (!ok) {
        setFormStatus(statusEl, 'bad', 'Please fix the highlighted fields.');
        return;
      }

      // UI-only success. Wire to: POST /php/volunteers/submit.php
      await new Promise(r => setTimeout(r, 650));
      volunteerForm.reset();
      setFormStatus(statusEl, 'ok', 'Application received. Thank you for volunteering!');
    });
  }

  // Donor form
  const donorForm = $('#donorForm');
  if (donorForm) {
    donorForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      clearAllFieldErrors(donorForm);

      const statusEl = donorForm.querySelector('[data-status]');
      setFormStatus(statusEl, 'ok', 'Submitting…');

      const first = $('#dFirst', donorForm).value.trim();
      const last = $('#dLast', donorForm).value.trim();
      const email = $('#dEmail', donorForm).value.trim();
      const amount = Number($('#dAmount', donorForm).value);
      const frequency = $('#dFrequency', donorForm).value;
      const consent = donorForm.querySelector('input[name="consent"]').checked;

      let ok = true;
      if (first.length < 2) { showFieldError('dFirst', 'Enter a valid first name.'); ok = false; }
      if (last.length < 2) { showFieldError('dLast', 'Enter a valid last name.'); ok = false; }
      if (!validateEmail(email)) { showFieldError('dEmail', 'Enter a valid email address.'); ok = false; }
      if (!Number.isFinite(amount) || amount < 1) { ok = false; /* keep simple */ }
      if (!frequency) { ok = false; }
      if (!consent) { showFieldError('consent', 'Consent is required to process donation info.'); ok = false; }

      if (!ok) {
        setFormStatus(statusEl, 'bad', 'Please fix the highlighted fields.');
        return;
      }

      // UI-only success. Wire to endpoints:
      // POST /php/donations/submit.php and POST /php/newsletter/subscribe.php
      await new Promise(r => setTimeout(r, 750));
      donorForm.reset();
      setFormStatus(statusEl, 'ok', 'Thanks! Your donation info was submitted securely (UI demo).');
    });
  }

  // Close modal on cancel button (if needed)
  document.addEventListener('click', (e) => {
    const target = e.target;
    if (!(target instanceof HTMLElement)) return;
    if (target.matches('dialog .icon-btn')) {
      const dialog = target.closest('dialog');
      if (dialog && typeof dialog.close === 'function') dialog.close();
    }
  });
})();

