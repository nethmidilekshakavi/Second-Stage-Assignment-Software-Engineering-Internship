// public/js/search-email-only.js
// Include in your blade just before </body>:
// <script src="{{ asset('js/search-email-only.js') }}"></script>

(function () {
    'use strict';

    function debounce(fn, delay) {
        let timer;
        return function () {
            const ctx = this;
            const args = arguments;
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(ctx, args), delay);
        };
    }

    function getCardEmail(card) {
        // Prefer data-email attribute if present
        if (card.dataset && card.dataset.email) {
            return card.dataset.email.trim().toLowerCase();
        }
        // Fallback: find the info-row with .info-icon.email then read sibling .info-value
        const emailIconRow = card.querySelector('.info-icon.email');
        if (emailIconRow) {
            const infoContent = emailIconRow.closest('.info-row')?.querySelector('.info-value');
            if (infoContent) return infoContent.textContent.trim().toLowerCase();
        }
        // Last fallback: look for any .info-value that contains an @ sign
        const values = card.querySelectorAll('.info-value');
        for (const v of values) {
            const text = v.textContent || '';
            if (text.includes('@')) return text.trim().toLowerCase();
        }
        return '';
    }

    function filterCardsByEmail(gridEl, query, noResultsEl) {
        const q = (query || '').trim().toLowerCase();
        const cards = Array.from(gridEl.querySelectorAll('.application-card'));
        let visible = 0;

        cards.forEach(card => {
            const email = getCardEmail(card);
            const match = q === '' || (email && email.includes(q));
            card.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        if (noResultsEl) {
            noResultsEl.style.display = visible === 0 ? 'block' : 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('searchAll') || document.getElementById('searchInput');
        const grid = document.getElementById('allApplicationsGrid');
        const noResults = document.getElementById('noResultsAll') || document.getElementById('noResults');

        if (!input || !grid) {
            // No card grid found; do nothing (you can implement table fallback if needed)
            return;
        }

        const debounced = debounce(function () {
            filterCardsByEmail(grid, input.value, noResults);
        }, 150);

        input.addEventListener('input', debounced);

        // When focusing on search, optionally switch to the Applications tab
        input.addEventListener('focus', function () {
            const appsLink = document.querySelector('.nav-link[data-section="applications"]');
            if (appsLink && !appsLink.classList.contains('active')) appsLink.click();
        });

        // Run once to apply initial state (e.g., if the input has a value prefilled)
        debounced();
    });
})();
