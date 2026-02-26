    const fadeElements = document.querySelectorAll('.fade-in');
    function checkVisibility() {
        fadeElements.forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight - 50) {
                el.classList.add('visible');
            }
        });
    }
    window.addEventListener('scroll', checkVisibility);
    window.addEventListener('load', checkVisibility);
