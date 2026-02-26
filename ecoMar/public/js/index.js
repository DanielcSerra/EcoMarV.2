document.addEventListener('DOMContentLoaded', function () {
  // Initial banner scroll lock animation removed
});

// --- EVENTOS Carousel Section Logic (ported from index2) ---
document.addEventListener('DOMContentLoaded', () => {
  const section = document.getElementById('eventos');
  if (!section) return;

  // DOM ELEMENTS
  const headlineEl = document.getElementById('headline');
  const miniTitleEl = document.getElementById('mini-title');
  const descEl = document.getElementById('description');
  const btnEl = document.getElementById('action-btn');
  const textWrapper = document.getElementById('text-content');
  
  const imgPrev = document.getElementById('img-prev');
  const imgCurr = document.getElementById('img-curr');
  const imgNext = document.getElementById('img-next');
  
  const dotsContainer = document.getElementById('dots-container');

  // DATA (from server or fallback)
  const slides = window.serverSlides || [
      {
          headline: "Honoring New Orleans 20 Years After Hurricane",
          miniTitle: "Binta Dixon & Nayyir Ransome",
          description: "20 years after Hurricane Katrina, advocate Nayyir Ransome reflects and emphasizes the power of community voices to protect NOAA this hurricane season.",
          image: "https://picsum.photos/900/1200?random=21",
          url: "#new-orleans"
      },
      {
          headline: "Ocean Conservation Gala 2025",
          miniTitle: "Annual Charity Event",
          description: "Join leading marine biologists and activists for a night of celebration and fundraising to support global reef restoration initiatives.",
          image: "https://picsum.photos/900/1200?random=22",
          url: "#gala-2025"
      },
      {
          headline: "Plastic Free July Workshop",
          miniTitle: "Community Education Series",
          description: "Learn practical steps to reduce single-use plastics in your daily life. Workshops held every weekend throughout the month of July.",
          image: "https://picsum.photos/900/1200?random=23",
          url: "#plastic-free"
      }
  ];

  // STATE
  let currentIndex = 0;
  let autoPlayInterval = null;
  const AUTO_DELAY = 3000;
  // Use matchMedia safely
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // HELPER: Modulo for negative numbers support
  function getIndex(i) {
      return (i + slides.length) % slides.length;
  }

  // RENDER FUNCTION
  function render(animate = true) {
      const slide = slides[currentIndex];
      const prevIndex = getIndex(currentIndex - 1);
      const nextIndex = getIndex(currentIndex + 1);

      // 1. Text Update
      if (animate && !reducedMotion) {
          if (textWrapper) textWrapper.classList.add('fade-text');
          setTimeout(() => {
              updateTextContent(slide);
              if (textWrapper) textWrapper.classList.remove('fade-text');
          }, 300); // Wait for half the transition
      } else {
          updateTextContent(slide);
      }

      // 2. Image Animation (Sliding Classes)
      const cards = [imgPrev, imgCurr, imgNext].filter(el => !!el);
      
      // We will rotate the sources on the elements to simulate the carousel, 
      // but to get the specific sliding animation requested ("like sobre-nos"), 
      // we need to manipulate classes on permanent elements or swap contents 
      // while animating transforms. 
      
      // However, the previous implementation in index2 just swapped srcs.
      // To simulate "sliding" with 3 card elements like "sobre-nos":
      // The "sobre-nos" logic wraps elements in a circle and changes classes: left, center, right.
      // Here we have 3 img tags: #img-prev, #img-curr, #img-next.
      // We can't just swap src if we want them to slide to a new position.
      // We need to assign logical positions to these 3 DOM elements.
      
      // Let's reimplement similar to sobre-nos:
      // We have 3 physical DOM elements. We map them to logical indices.
      // But here we might have more than 3 slides? Data has 3 slides.
      // If exactly 3 slides, we can map 1-to-1.
      
      // Logic from sobre-nos:
      // cards[prevIndex].classList.add('pos-left');
      // cards[index].classList.add('pos-center');
      // cards[nextIndex].classList.add('pos-right');
      
      // In this section, we have 3 IMG tags. Let's start treating them as a pool of 3 cards.
      // We need to ensure text updates match the "center" card.
      
      // Reset classes
      cards.forEach(c => c.className = 'card'); 
      
      // Assign classes based on current index relative to the card's assigned index?
      // Actually, if we just want to animate the transition, keeping the 3 IMGs fixed in DOM 
      // and changing their classes is better than swapping SRCs.
      // BUT, we need to know which IMG holds which Slide content initially.
      
      // Initialization:
      // IMG 1 (img-prev) holds Slide 2 (index 2) -> Class 'left'
      // IMG 2 (img-curr) holds Slide 0 (index 0) -> Class 'center'
      // IMG 3 (img-next) holds Slide 1 (index 1) -> Class 'right'
      
      // When we go to Slide 1:
      // We want the card holding Slide 1 (IMG 3) to move to 'center'.
      // The card holding Slide 0 (IMG 2) to move to 'left'.
      // The card holding Slide 2 (IMG 1) to move to 'right' (behind/next).
      
      // This requires the DOM elements to sustain their identity (src content).
      // Since `cards` array is [imgPrev, imgCurr, imgNext], let's try to map them dynamically.
      
      // Let's assume we have exactly 3 DOM elements for exactly 3 slides for now, matching the data.
      // (The data array has 3 slides).
      
      // We need a stable mapping of Slide Index -> DOM Element.
      // On init, we set:
      // slides[0] -> imgCurr
      // slides[1] -> imgNext
      // slides[2] -> imgPrev (representing the one to the left)
      
      // If we simply use the index modulo 3 to pick the element from a fixed array of 3 elements?
      // Card 0 (imgCurr) assigned to Slide 0
      // Card 1 (imgNext) assigned to Slide 1
      // Card 2 (imgPrev) assigned to Slide 2
      
      // Then:
      // cards[currentIndex].className = 'card center';
      // cards[prevIndex].className = 'card left';
      // cards[nextIndex].className = 'card right';
      
      // Let's try this logic. We must ensure the `src` are set correctly ONCE (at init), 
      // and then we never swap SRC, only classes.
      
      // Re-map the elements to logical order 0, 1, 2 matches Slides 0, 1, 2
      // HTML has:
      // img-prev (will be index 2)
      // img-curr (will be index 0)
      // img-next (will be index 1)
      
      const orderedCards = [];
      // If we assume the HTML IDs are just placeholders, let's map them:
      // We want orderedCards[0] to be the element for Slide 0.
      orderedCards[0] = imgCurr;
      orderedCards[1] = imgNext; 
      orderedCards[2] = imgPrev;
      
      // Update Classes
      orderedCards.forEach(c => c.className = 'card'); // reset base
      
      orderedCards[currentIndex].classList.add('center');
      orderedCards[prevIndex].classList.add('left');
      orderedCards[nextIndex].classList.add('right');

      // 3. Button URL
      if (btnEl) btnEl.href = slide.url;

      // 4. Dots Update
      if (dotsContainer) {
        Array.from(dotsContainer.children).forEach((dot, idx) => {
            if (idx === currentIndex) dot.classList.add('active');
            else dot.classList.remove('active');
            dot.setAttribute('aria-pressed', idx === currentIndex);
        });
      }
  }

  function updateTextContent(slide) {
      if (headlineEl) headlineEl.textContent = slide.headline;
      if (miniTitleEl) miniTitleEl.textContent = slide.miniTitle;
      if (descEl) descEl.textContent = slide.description;
  }

  // CONTROLS
  function nextSlide() {
      currentIndex = getIndex(currentIndex + 1);
      render(true);
  }

  function prevSlide() {
      currentIndex = getIndex(currentIndex - 1);
      render(true);
  }

  function goToSlide(index) {
      currentIndex = index;
      render(true);
      stopAutoPlay(); // Interaction stops autoplay
  }

  // AUTO PLAY
  function startAutoPlay() {
      if (reducedMotion) return; // Disable for accessibility
      if (autoPlayInterval) clearInterval(autoPlayInterval);
      autoPlayInterval = setInterval(nextSlide, AUTO_DELAY);
  }

  function stopAutoPlay() {
      if (autoPlayInterval) {
          clearInterval(autoPlayInterval);
          autoPlayInterval = null;
      }
  }

  // INITIALIZATION
  function init() {
      // Create Dots
      if (dotsContainer) {
        dotsContainer.innerHTML = '';
        slides.forEach((_, idx) => {
            const btn = document.createElement('button');
            btn.className = 'dot';
            btn.setAttribute('aria-label', `Go to slide ${idx + 1}`);
            btn.addEventListener('click', () => goToSlide(idx));
            dotsContainer.appendChild(btn);
        });
      }

      // Initialize Images Static Content (only once)
      // We mapped:
      // Index 0 -> imgCurr
      // Index 1 -> imgNext
      // Index 2 -> imgPrev
      if (imgCurr) { imgCurr.src = slides[0].image; imgCurr.alt = slides[0].headline; }
      if (imgNext) { imgNext.src = slides[1].image; imgNext.alt = slides[1].headline; }
      if (imgPrev) { imgPrev.src = slides[2].image; imgPrev.alt = slides[2].headline; }

      // Event Listeners for Interaction (Stop Autoplay)
      if (btnEl) btnEl.addEventListener('click', stopAutoPlay);
      
      // Keyboard Nav
      document.addEventListener('keydown', (e) => {
          // Check if section is visible (simple check)
          const rect = section.getBoundingClientRect();
          const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
          
          if (isVisible) {
              if (e.key === 'ArrowRight') {
                  stopAutoPlay();
                  nextSlide();
              }
              if (e.key === 'ArrowLeft') {
                  stopAutoPlay();
                  prevSlide();
              }
          }
      });

      // Initial Render
      render(false);
      startAutoPlay();
  }

  // Run
  init();
});


// === SOBRE-NOS SECTION (scroll + dots) ===
document.addEventListener('DOMContentLoaded', function () {
  const sobreNosSection = document.getElementById('sobre-nos');
  if (!sobreNosSection) return;

  // IMPORTANT: your debug showed body is the scroll container (overflowY: auto)
  // We'll compute scroll offsets relative to body/doc and listen to BOTH body + documentElement
  // to be safe across browsers.
  const scrollTargets = [document.body, document.documentElement];

  const slides = window.serverSobreNos || [
    {
      leftText: "Preservar,",
      description: "A EcoMar nasceu da paixão pelo oceano e da vontade de fazer a diferença.",
      imgId: "card-0"
    },
    {
      leftText: "proteger,",
      description: "Somos uma associação sem fins lucrativos que atua na limpeza, preservação e educação ambiental.",
      imgId: "card-1"
    },
    {
      leftText: "inspirar.",
      description: "Unindo pessoas que acreditam que cada ação conta, transformamos consciência em movimento.",
      imgId: "card-2"
    }
  ];

  const totalSlides = slides.length;
  let currentIndex = 0;
  let isTicking = false;

  // Scope all queries to the sobre-nos section only
  const leftWordEl = sobreNosSection.querySelector('#leftWord');
  const descTextEl = sobreNosSection.querySelector('#descText');

  const cards = [
    sobreNosSection.querySelector('#card-0'),
    sobreNosSection.querySelector('#card-1'),
    sobreNosSection.querySelector('#card-2')
  ];

  const dots = Array.from(sobreNosSection.querySelectorAll('.dots-wrapper .dot'));

  // Bail if markup mismatch
  if (dots.length !== totalSlides || cards.some(c => !c)) return;

  function updateSlide(index) {
    if (leftWordEl && leftWordEl.innerText !== slides[index].leftText) {
      leftWordEl.classList.add('fade-out');
      setTimeout(() => {
        leftWordEl.innerText = slides[index].leftText;
        leftWordEl.classList.remove('fade-out');
      }, 250);
    }

    if (descTextEl && descTextEl.innerText !== slides[index].description) {
      descTextEl.classList.add('fade');
      setTimeout(() => {
        descTextEl.innerText = slides[index].description;
        descTextEl.classList.remove('fade');
      }, 250);
    }

    // Dots
    dots.forEach((dot, i) => {
      if (i === index) dot.classList.add('active');
      else dot.classList.remove('active');
    });

    const prevIndex = (index - 1 + totalSlides) % totalSlides;
    const nextIndex = (index + 1) % totalSlides;

    cards.forEach(card => {
      card.classList.remove('pos-left', 'pos-center', 'pos-right');
    });

    cards[prevIndex].classList.add('pos-left');
    cards[index].classList.add('pos-center');
    cards[nextIndex].classList.add('pos-right');
  }

  // Scroll-driven slide selection that works with sticky layouts
  function handleScroll() {
    const rect = sobreNosSection.getBoundingClientRect();
    const vh = window.innerHeight;

    // Progress through viewport travel:
    // 0 when entering from bottom, 1 when leaving at top
    const totalTravel = vh + rect.height;
    let progress = (vh - rect.top) / totalTravel;
    progress = Math.max(0, Math.min(1, progress));

    const newIndex = Math.min(totalSlides - 1, Math.floor(progress * totalSlides));

    if (newIndex !== currentIndex) {
      currentIndex = newIndex;
      updateSlide(currentIndex);
    }

    isTicking = false;
  }

  function getScrollTop() {
    // Cross-browser scrollTop getter when body/html are scroll containers
    return window.pageYOffset ||
      document.documentElement.scrollTop ||
      document.body.scrollTop ||
      0;
  }

  function scrollToY(y) {
    // Cross-browser scrollTo when body/html are scroll containers
    scrollTargets.forEach(t => {
      if (t && typeof t.scrollTo === 'function') {
        t.scrollTo({ top: y, behavior: 'smooth' });
      } else if (t) {
        t.scrollTop = y;
      }
    });
  }

  function handleDotClick(targetIndex) {
    const rect = sobreNosSection.getBoundingClientRect();
    const scrollTop = getScrollTop();
    const absoluteSectionTop = rect.top + scrollTop;

    const vh = window.innerHeight;
    const sectionHeight = sobreNosSection.offsetHeight;

    // Scroll distance while section is "in play"
    const scrollableDistance = Math.max(1, sectionHeight - vh);

    // Ratios for 3 slides
    const ratios = [0, 0.5, 1];
    const targetRatio = ratios[targetIndex] ?? 0;

    const targetScrollY = absoluteSectionTop + (scrollableDistance * targetRatio);

    scrollToY(targetScrollY);

    currentIndex = targetIndex;
    updateSlide(currentIndex);
  }

  function initSobreNos() {
    updateSlide(0);

    // Listen to BOTH body and documentElement because your scroll container is body (overflowY:auto),
    // and some browsers scroll the html element instead.
    scrollTargets.forEach(target => {
      if (!target) return;
      target.addEventListener('scroll', () => {
        if (!isTicking) {
          window.requestAnimationFrame(handleScroll);
          isTicking = true;
        }
      }, { passive: true });
    });

    // Dot click
    dots.forEach(dot => {
      dot.addEventListener('click', (e) => {
        const idx = parseInt(e.currentTarget.dataset.index, 10);
        if (Number.isFinite(idx)) handleDotClick(idx);
      });
    });

    // Arrow keys (only when section is in view)
    document.addEventListener('keydown', (e) => {
      const rect = sobreNosSection.getBoundingClientRect();
      const isInView = rect.top < window.innerHeight && rect.bottom > 0;
      if (!isInView) return;

      if (e.key === 'ArrowRight') {
        handleDotClick((currentIndex + 1) % totalSlides);
      } else if (e.key === 'ArrowLeft') {
        handleDotClick((currentIndex - 1 + totalSlides) % totalSlides);
      }
    });

    // Sync on load
    handleScroll();
  }

  initSobreNos();
});

// === NOTICIAS RECENTES SECTION ===
document.addEventListener('DOMContentLoaded', () => {
  // ELEMENTS
  const section = document.getElementById('noticias-recentes');
  if (!section) return;

  const imageEl = section.querySelector('#news-image');
  const dateEl = section.querySelector('.noticias-pub-date');
  const headlineEl = section.querySelector('.noticias-headline');
  const linkEl = section.querySelector('.btn-ver-mais-news');
  const textColEl = section.querySelector('.noticias-text-column');
  const dots = section.querySelectorAll('.noticias-dot-btn');

  // DATA STRUCTURE
  const newsItems = window.serverRecentNews || [
    {
      image: "https://picsum.photos/800/1000?random=1",
      publicationDate: "Publicada 10/10/2010 às 4:53",
      headline: "Honoring New Orleans 20 Years After Hurricane",
      url: "#news1"
    },
    {
      image: "https://picsum.photos/800/1000?random=2",
      publicationDate: "Publicada 12/08/2023 às 10:30",
      headline: "Global Ocean Cleanup Initiative Launches Phase Two",
      url: "#news2"
    },
    {
      image: "https://picsum.photos/800/1000?random=3",
      publicationDate: "Publicada 05/02/2024 às 14:15",
      headline: "New Marine Sanctuary Established in the Pacific",
      url: "#news3"
    },
    {
      image: "https://picsum.photos/800/1000?random=4",
      publicationDate: "Publicada 20/06/2024 às 09:00",
      headline: "Local Volunteers Restore Coral Reefs",
      url: "#news4"
    }
  ];

  // STATE
  let currentIndex = 0;
  let autoPlayInterval;

  // AUTO PLAY FUNCTIONS
  function startAutoPlay() {
    stopAutoPlay();
    autoPlayInterval = setInterval(() => {
      updateNews(currentIndex + 1);
    }, 3000);
  }

  function stopAutoPlay() {
    if (autoPlayInterval) {
      clearInterval(autoPlayInterval);
      autoPlayInterval = null;
    }
  }

  // FUNCTION: Update Content
  function updateNews(index) {
    if (index < 0) index = newsItems.length - 1;
    if (index >= newsItems.length) index = 0;

    const item = newsItems[index];

    // 1. Update Dots UI
    dots.forEach((dot, i) => {
      if (i === index) {
        dot.classList.add('active');
        dot.setAttribute('aria-selected', 'true');
      } else {
        dot.classList.remove('active');
        dot.setAttribute('aria-selected', 'false');
      }
    });

    // 2. Animate Out
    imageEl.classList.add('news-fade-out');
    textColEl.classList.add('news-fade-out');

    // 3. Swap Content & Animate In
    setTimeout(() => {
      imageEl.src = item.image;
      if (dateEl) dateEl.textContent = item.publicationDate;
      if (headlineEl) headlineEl.textContent = item.headline;
      if (linkEl) linkEl.href = item.url;
      
      const onImageLoad = () => {
         imageEl.classList.remove('news-fade-out');
      };
      
      if (imageEl.complete) {
         onImageLoad();
      } else {
         imageEl.onload = onImageLoad;
         setTimeout(onImageLoad, 200); 
      }
      
      textColEl.classList.remove('news-fade-out');
      currentIndex = index;
    }, 300);
  }

  // INIT
  function init() {
    // Initial load
    const item = newsItems[0];
    if (imageEl) imageEl.src = item.image;
    if (dateEl) dateEl.textContent = item.publicationDate;
    if (headlineEl) headlineEl.textContent = item.headline;
    if (linkEl) linkEl.href = item.url;

    // Event Listeners for Dots
    dots.forEach(dot => {
      dot.addEventListener('click', (e) => {
        // Stop auto play on user interaction
        stopAutoPlay();
        
        const idx = parseInt(e.currentTarget.dataset.index, 10);
        if (Number.isFinite(idx) && idx !== currentIndex) {
          updateNews(idx);
        }
      });
    });

    // Keyboard Navigation
    document.addEventListener('keydown', (e) => {
      const rect = section.getBoundingClientRect();
      const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
      
      if (!isVisible) return;

      if (e.key === 'ArrowDown' || e.key === 'ArrowRight') {
        stopAutoPlay(); // Also stop on keyboard navigation
        updateNews(currentIndex + 1);
      } else if (e.key === 'ArrowUp' || e.key === 'ArrowLeft') {
        stopAutoPlay();
        updateNews(currentIndex - 1);
      }
    });
  }

  init();
  startAutoPlay(); // Start rotating automatically
});

/* 
 * COMO AJUDAR SECTION LOGIC 
 */
document.addEventListener('DOMContentLoaded', () => {
    const section = document.getElementById('como-ajudar');
    if (!section) return;

    // DATA
    const panels = [
        {
            title: "COMO\nAJUDAR",
            text: "A mudança começa contigo. Pequenos gestos criam grandes ondas. Descobre como podes fazer parte desta missão e ajudar a proteger os nossos oceanos para as futuras gerações.",
            image: "img/comoajudar1.png",
            url: "/public/como-ajudar"
        },
        {
            title: "CAMPANHAS",
            text: "De limpezas de praias a projetos educativos, cada campanha EcoMar é um convite à ação. Junta-te a nós e ajuda a criar impacto real.",
            image: "img/comoajudar2.png",
            url: "/public/campanhas"
        },
        {
            title: "DOAÇÕES",
            text: "Cada 1€ doado ajuda-nos a retirar até 1kg de lixo do oceano. O teu contributo faz a diferença, onda após onda.",
            image: "img/comoajudar3.png",
            url: "/public/doar"
        }
    ];

    // ELEMENTS
    const panelsContainer = document.getElementById('panels-container');
    const dotsContainer = document.getElementById('dots-nav');
    const imageContainer = document.getElementById('image-container');
    let isScrolling = false; 

    // RENDER
    panels.forEach((panel, index) => {
        // 1. Text Panel
        const panelEl = document.createElement('div');
        panelEl.className = `text-panel ${index === 0 ? 'active' : ''}`;
        panelEl.id = `panel-${index}`;
        panelEl.innerHTML = `
            <h2 class="panel-title">${panel.title}</h2>
            <p class="panel-text">${panel.text}</p>
            <img src="${panel.image}" class="mobile-panel-image" alt="${panel.title.replace('\n', ' ')}">
            <a href="${panel.url}" class="btn-ver-mais" aria-label="Saber mais sobre ${panel.title.replace('\n', ' ')}">Ver mais</a>
        `;
        panelsContainer.appendChild(panelEl);

        // 2. Dot
        const dot = document.createElement('button');
        dot.className = 'dot-btn';
        dot.setAttribute('aria-label', `Ir para seção ${index + 1}`);
        dot.setAttribute('aria-current', index === 0 ? 'true' : 'false');
        dot.dataset.index = index;
        dot.addEventListener('click', () => {
            if(panelEl) {
                panelEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
        dotsContainer.appendChild(dot);

        // 3. Image
        const img = document.createElement('img');
        img.src = panel.image;
        img.className = `bg-image ${index === 0 ? 'active' : ''}`;
        img.alt = `Imagem ilustrativa para ${panel.title.replace('\n', ' ')}`;
        imageContainer.appendChild(img);
    });

    // OBSERVER
    const observerOptions = {
        root: null,
        rootMargin: '-35% 0px -35% 0px', 
        threshold: 0
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const index = Array.from(panelsContainer.children).indexOf(entry.target);
                updateState(index);
            }
        });
    }, observerOptions);

    panelsContainer.querySelectorAll('.text-panel').forEach(panel => observer.observe(panel));

    // STATE UPDATE
    function updateState(activeIndex) {
        if(activeIndex < 0) return;

        // Dots
        const dots = dotsContainer.querySelectorAll('.dot-btn');
        dots.forEach((dot, idx) => {
            dot.setAttribute('aria-current', idx === activeIndex ? 'true' : 'false');
        });

        // Images
        const images = imageContainer.querySelectorAll('.bg-image');
        images.forEach((img, idx) => {
            if (idx === activeIndex) {
                img.classList.add('active');
            } else {
                img.classList.remove('active');
            }
        });

        // Text Panels
        const textPanels = panelsContainer.querySelectorAll('.text-panel');
        textPanels.forEach((p, idx) => {
            if (idx === activeIndex) {
                p.classList.add('active');
            } else {
                p.classList.remove('active');
            }
        });
    }

    // KEYBOARD NAVIGATION
    document.addEventListener('keydown', (e) => {
        const rect = section.getBoundingClientRect();
        // Check if section is visible in viewport
        const isInView = rect.top < window.innerHeight && rect.bottom > 0;

        if (!isInView || isScrolling) return;

        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            // Optional: Add custom keyboard navigation logic here if desired
            // Currently relying on native scroll behavior to avoid trapping user
        }
    });

    /* ANIMATIONS OBSERVER */
    setTimeout(() => {
        const animObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-active');
                    animObserver.unobserve(entry.target); // Run once
                }
            });
        }, { threshold: 0.15 });

        const targets = document.querySelectorAll(
            '#eventos .section-label, #sobre-nos .section-title, .noticias-title, #como-ajudar .panel-title'
        );
        targets.forEach(el => animObserver.observe(el));
    }, 100);
});
