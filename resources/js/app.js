import './bootstrap';

// Livewire 4 bundles Alpine.js — register data on the global Alpine.
// Use alpine:init event so our components are available before Alpine starts.
document.addEventListener('alpine:init', () => {
    const Alpine = window.Alpine;

    // Navbar scroll effect
    Alpine.data('navbar', () => ({
        scrolled: false,
        mobileOpen: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 40;
            }, {
                passive: true
            });
        },
    }));

    // Animated stats counters (Intersection Observer)
    Alpine.data('statsCounter', () => ({
        animated: false,
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !this.animated) {
                        this.animated = true;
                        this.$el.querySelectorAll('[data-target]').forEach(el => {
                            const target = parseInt(el.dataset.target);
                            const duration = 2000;
                            const start = performance.now();
                            const tick = (now) => {
                                const p = Math.min((now - start) / duration, 1);
                                const ease = 1 - Math.pow(1 - p, 3);
                                el.textContent = Math.floor(ease * target);
                                if (p < 1) requestAnimationFrame(tick);
                                else el.textContent = target;
                            };
                            requestAnimationFrame(tick);
                        });
                    }
                });
            }, {
                threshold: 0.3
            });
            observer.observe(this.$el);
        },
    }));

    // Scroll reveal animation
    Alpine.data('reveal', () => ({
        visible: false,
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.visible = true;
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            observer.observe(this.$el);
        },
    }));

    Alpine.data('whyUsSection', (features = []) => ({
        features: Array.isArray(features) ? features : [],
        activeIndex: 0,
        get activeFeature() {
            return this.features[this.activeIndex] ?? {
                title: '',
                body: '',
                eyebrow: '',
                index: '01',
            };
        },
        setActive(index) {
            if (index >= 0 && index < this.features.length) {
                this.activeIndex = index;
            }
        },
        isActive(index) {
            return this.activeIndex === index;
        },
    }));

    // Back to top button
    Alpine.data('backToTop', () => ({
        show: false,
        init() {
            window.addEventListener('scroll', () => {
                this.show = window.scrollY > 400;
            }, {
                passive: true
            });
        },
        scrollTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        },
    }));

    // Admin sidebar layout
    Alpine.data('adminLayout', () => ({
        sidebarOpen: window.innerWidth >= 1024,
    }));
});
