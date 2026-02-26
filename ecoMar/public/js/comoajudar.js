document.addEventListener('DOMContentLoaded', () => {
    const section = document.getElementById('como-ajudar');
    if (!section) return;

    // Elements
    const panelsContainer = section.querySelector('.panels-wrapper');
    const dotsContainer = section.querySelector('.dots-container');
    const imageContainer = section.querySelector('.sticky-image-container');
    
    // NodeLists
    const panels = section.querySelectorAll('.text-panel');
    const dots = section.querySelectorAll('.dot-btn');
    const images = section.querySelectorAll('.bg-image');

    // OBSERVER CONFIGURATION
    // Detects when panels are in the "active" zone (center of screen)
    // rootMargin creates a narrow horizontal band in the middle of viewport
    const observerOptions = {
        root: null,
        rootMargin: '-40% 0px -40% 0px', 
        threshold: 0
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Determine which panel this is
                const index = parseInt(entry.target.dataset.index);
                if (!isNaN(index)) {
                    updateState(index);
                }
            }
        });
    }, observerOptions);

    panels.forEach(panel => observer.observe(panel));

    // STATE UPDATE FUNCTION
    function updateState(activeIndex) {
        if (activeIndex < 0) return;

        // Update Dots
        dots.forEach((dot, idx) => {
            const isActive = idx === activeIndex;
            dot.setAttribute('aria-current', isActive ? 'true' : 'false');
        });

        // Update Images
        images.forEach((img, idx) => {
            if (idx === activeIndex) {
                img.classList.add('active');
            } else {
                img.classList.remove('active');
            }
        });

        // Update Panels
        panels.forEach((p, idx) => {
            if (idx === activeIndex) {
                p.classList.add('active');
            } else {
                p.classList.remove('active');
            }
        });
    }

    // DOTS NAVIGATION
    window.scrollToPanel = function(index) {
        const targetPanel = panels[index];
        if (targetPanel) {
            targetPanel.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    };

    // Attach listeners to dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', (e) => {
            e.preventDefault(); 
            window.scrollToPanel(index);
        });
    });
});
