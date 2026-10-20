import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    // 1. Scroll Reveal Intersection Observer
    const revealElements = document.querySelectorAll('.reveal');
    if (revealElements.length > 0 && 'IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        // Fallback for older browsers
        revealElements.forEach(el => el.classList.add('is-revealed'));
    }

    // 2. Interactive Cursor Spotlight for Cards
    const spotlightCards = document.querySelectorAll('.spotlight-card, .glass-panel');
    spotlightCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
        });
    });

    // 3. Smooth Number Counting Animation for Metrics
    const counters = document.querySelectorAll('[data-counter]');
    if (counters.length > 0 && 'IntersectionObserver' in window) {
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const rawValue = el.getAttribute('data-counter');
                    const isPercentage = rawValue.includes('%');
                    const isPlus = rawValue.includes('+');
                    const hasTahun = rawValue.toLowerCase().includes('tahun');
                    const numericValue = parseFloat(rawValue.replace(/[^0-9.]/g, ''));

                    if (!isNaN(numericValue)) {
                        animateNumber(el, numericValue, 1600, (current) => {
                            let formatted = current;
                            if (rawValue.includes('.')) {
                                formatted = current.toFixed(1);
                            } else {
                                formatted = Math.floor(current);
                            }
                            if (isPercentage) formatted += '%';
                            if (isPlus) formatted += '+';
                            if (hasTahun) formatted += ' Tahun';
                            return formatted;
                        });
                    }
                    observer.unobserve(el);
                }
            });
        }, { threshold: 0.3 });

        counters.forEach(counter => counterObserver.observe(counter));
    }

    function animateNumber(element, target, duration, formatter) {
        const start = 0;
        const startTime = performance.now();

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            // Ease-out cubic curve
            const easeOutProgress = 1 - Math.pow(1 - progress, 3);
            const current = start + (target - start) * easeOutProgress;

            element.textContent = formatter(current);

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                element.textContent = formatter(target);
            }
        }

        requestAnimationFrame(update);
    }

    // 4. Navbar Sticky Dynamic Elevation on Scroll
    const header = document.querySelector('header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 25) {
                header.classList.add('header-scrolled');
            } else {
                header.classList.remove('header-scrolled');
            }
        }, { passive: true });
    }
});
