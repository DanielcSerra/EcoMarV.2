function toggleExpand(clickedElement) {
    // Get all small blocks
    const allBlocks = document.querySelectorAll('.small-block');

    // Check if the clicked element is already active
    const isActive = clickedElement.classList.contains('active');

    // Reset all blocks to initial state
    allBlocks.forEach(block => {
        block.classList.remove('active');
    });

    // If it wasn't active before, make it active now
    // If it WAS active, we leave it removed (toggled off)
    if (!isActive) {
        clickedElement.classList.add('active');
        
        // Optional: Scroll slightly to make sure the expanded element is in view
        setTimeout(() => {
            clickedElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 300);
    }
}

/**
 * Smooth scrolls to the target section ID.
 * @param {string} sectionId - The ID of the element to scroll to.
 */
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

/* --- GOALS SECTION LOGIC --- */

// Data for the Goals Slider will be injected from Blade

// Current active index
let currentGoalIndex = 0;
let autoPlayInterval = null;
let isAutoPlaying = true;

/**
 * Updates the content of the goals section based on index.
 * @param {number} index - The index of the goal to display.
 */
function updateGoal(index) {
    // If called manually (not by interval) and index is same, do nothing
    // But if auto playing, we might refresh.
    if (index === currentGoalIndex && !isAutoPlaying) return; 

    const titleEl = document.getElementById('goal-title');
    const descEl = document.getElementById('goal-description');
    const imageEl = document.getElementById('goal-image');
    const textContainer = document.getElementById('goal-text-container');
    const dots = document.querySelectorAll('.goal-dot');

    // 1. Fade Out Text and Image
    textContainer.classList.add('fade-out');
    imageEl.style.opacity = 0;

    // 2. Wait for fade out, then swap content and fade in
    setTimeout(() => {
        // Update Data
        titleEl.textContent = goalsData[index].title;
        descEl.textContent = goalsData[index].description;
        imageEl.src = goalsData[index].image;

        // Update Dots
        dots.forEach(dot => dot.classList.remove('active'));
        dots[index].classList.add('active');

        // Update global index
        currentGoalIndex = index;

        // Fade In
        textContainer.classList.remove('fade-out');
        imageEl.style.opacity = 1;

    }, 400); // Matches CSS transition time
}

/**
 * Handles clicks on pagination dots.
 * Stops the auto-play loop permanently.
 * @param {number} index 
 */
function handleDotClick(index) {
    stopAutoPlay();
    updateGoal(index);
}

function startAutoPlay() {
    isAutoPlaying = true;
    autoPlayInterval = setInterval(() => {
        let nextIndex = currentGoalIndex + 1;
        if (nextIndex >= goalsData.length) {
            nextIndex = 0;
        }
        updateGoal(nextIndex);
    }, 5000); // 5 Seconds
}

function stopAutoPlay() {
    if (isAutoPlaying) {
        clearInterval(autoPlayInterval);
        isAutoPlaying = false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // --- FILTERS ---
    const filter = document.getElementById('country-filter');
    const seeMoreBtn = document.getElementById('see-more-btn');

    if(filter) {
        window.filterCampaigns = function() {
            const selected = filter.value.toLowerCase();
            let anyFiltered = false;
            
            // Show all first
            document.querySelectorAll('.campaign-block').forEach(card => {
                card.style.display = '';
            });

            document.querySelectorAll('.campaign-block').forEach(card => {
                const country = card.querySelector('.card-title').textContent.trim().toLowerCase();
                const matchesCountry = !selected || country === selected;
                card.style.display = matchesCountry ? '' : 'none';
                if (matchesCountry) anyFiltered = true;
            });

            if (selected && seeMoreBtn) {
                 if(seeMoreBtn.dataset.fullyLoaded !== 'true') seeMoreBtn.style.display = 'none';
            } else if (seeMoreBtn) {
                 if(seeMoreBtn.dataset.fullyLoaded !== 'true') seeMoreBtn.style.display = '';
            }
        };

        filter.addEventListener('change', window.filterCampaigns);
        const filterBar = document.querySelector('.filter-bar');
        if(filterBar) filterBar.style.opacity = 1;
    }

    // --- GOALS AUTO PLAY ---
    startAutoPlay();
});

// --- LOAD MORE ---
let currentPage = 1;
let isLoading = false;

function loadMoreCampaigns(isRecursive = false) {
    if (isLoading && !isRecursive) return Promise.resolve(false);
    if (isLoading) return Promise.resolve(false);
    
    const btn = document.getElementById('see-more-btn');
    if (!btn) return Promise.resolve(false);
    
    // Check if route is defined
    if(!window.campaignsRoutes || !window.campaignsRoutes.loadMore) {
        console.error("campaignsRoutes.loadMore not defined");
        return Promise.resolve(false);
    }

    isLoading = true;
    
    if(!isRecursive) {
         btn.disabled = true;
         btn.textContent = 'A carregar...';
    }

    return fetch(window.campaignsRoutes.loadMore + '?page=' + (currentPage + 1), {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        const container = document.querySelector('.campaigns-container');

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = data.html;
        
        let hasMore = true;
        if(!data.html || data.html.trim() === '' || data.html.includes('No more campaigns available')) {
            hasMore = false;
        }

        if (hasMore) {
            while (tempDiv.firstChild) {
                container.appendChild(tempDiv.firstChild);
            }
        }

        if(typeof window.filterCampaigns === 'function') window.filterCampaigns();

        currentPage++;
        
        if (hasMore) {
            if(!isRecursive) {
                btn.disabled = false;
                btn.textContent = 'Ver mais';
            }
        } else {
            btn.style.display = 'none';
            btn.dataset.fullyLoaded = 'true';
        }
        
        isLoading = false;
        return hasMore;
    })
    .catch(error => {
        console.error('Error loading campaigns:', error);
        if(!isRecursive && btn) { 
            btn.disabled = false; 
            btn.textContent = 'Ver mais'; 
        }
        isLoading = false;
        return false;
    });
}

function loadAllCampaigns() {
    return new Promise((resolve) => {
         const btn = document.getElementById('see-more-btn');
         if(!btn || btn.style.display === 'none' || btn.dataset.fullyLoaded === 'true') {
             resolve();
             return;
         }
         
         btn.textContent = 'A carregar tudo...';
         btn.disabled = true;
         
         const recursiveLoad = () => {
             loadMoreCampaigns(true).then(hasMore => {
                 if(hasMore) {
                     recursiveLoad();
                 } else {
                     resolve();
                 }
             });
         };
         recursiveLoad();
    });
}

function handleMarkerClick(country) {
    loadAllCampaigns().then(() => {
        const filter = document.getElementById('country-filter');
        if(filter) {
            filter.value = country;
            filter.dispatchEvent(new Event('change'));
            const container = document.querySelector('.campaigns-filter-container');
            if(container) container.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
}

// Start auto-play when page loads
document.addEventListener('DOMContentLoaded', () => {
    startAutoPlay();
});