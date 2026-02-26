document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.querySelector(".navbar");
    const panel = document.getElementById("megaPanel");
    const triggers = Array.from(document.querySelectorAll(".nav-trigger"));

    const initialize = () => {
        if (navbar) navbar.classList.remove("show-panel");
        if (panel) panel.setAttribute("aria-hidden", "true");
    };

    initialize();

    const setPanelState = (open) => {
        if (!navbar || !panel) return;
        if (open) {
            navbar.classList.add("show-panel");
            panel.setAttribute("aria-hidden", "false");
        } else {
            navbar.classList.remove("show-panel");
            panel.setAttribute("aria-hidden", "true");
        }
    };

    const showPanelSection = (key) => {
        if (!key) return;
        document.querySelectorAll(".panel-story").forEach((el) => {
            el.style.display = "none";
        });
        document.querySelectorAll(".panel-links-col").forEach((el) => {
            el.style.display = "none";
        });
        document.querySelectorAll(`.panel-${key}`).forEach((el) => {
            el.style.display = "";
        });
    };

    const handleTrigger = (ev) => {
        const key = ev.currentTarget.dataset.key;
        showPanelSection(key);
        setPanelState(true);
    };

    triggers.forEach((t) => {
        t.addEventListener("mouseenter", handleTrigger);
        t.addEventListener("focus", handleTrigger);
    });

    let closeTimeout = null;
    const scheduleClose = () => {
        if (!panel) return;
        if (panel.contains(document.activeElement)) return;
        closeTimeout = setTimeout(() => setPanelState(false), 150);
    };
    const cancelClose = () => {
        if (closeTimeout) {
            clearTimeout(closeTimeout);
            closeTimeout = null;
        }
    };

    navbar?.addEventListener("mouseleave", scheduleClose);
    panel?.addEventListener("mouseleave", scheduleClose);
    navbar?.addEventListener("mouseenter", cancelClose);
    panel?.addEventListener("mouseenter", cancelClose);

    panel?.addEventListener("focusout", (e) => {
        if (panel.contains(e.relatedTarget)) return;
        scheduleClose();
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") setPanelState(false);
    });

    document.addEventListener("click", (e) => {
        const target = e.target;
        if (navbar?.contains(target) || panel?.contains(target)) return;
        setPanelState(false);
    });

    const solidThreshold = 200;
    const updateNavbarSolid = () => {
        if (!navbar) return;
        // Check multiple scroll sources to support different layout modes (e.g. height: 100% body)
        const scrollY = window.scrollY || document.documentElement.scrollTop || document.body.scrollTop || 0;
        
        if (scrollY > solidThreshold) navbar.classList.add("is-solid");
        else if (!navbar.classList.contains("show-panel"))
            navbar.classList.remove("is-solid");
    };
    
    // Use capture=true to catch scroll events from elements (like body) that don't bubble
    window.addEventListener("scroll", updateNavbarSolid, true);
    updateNavbarSolid();

    // Mobile
    const menuToggle = document.getElementById("menuToggle");
    const closeMobile = document.getElementById("closeMobile");
    const mobileMenu = document.getElementById("mobileMenu");
    const mobilePanel = document.getElementById("mobilePanel");
    const mobilePanelContent = document.getElementById("mobilePanelContent");
    const mobileBack = document.getElementById("mobileBack");
    const closeMobilePanel = document.getElementById("closeMobilePanel");
    const mobileLinks = Array.from(document.querySelectorAll(".mobile-link"));

    const openMobileMenu = () => {
        mobileMenu?.classList.add("open");
        mobileMenu?.setAttribute("aria-hidden", "false");
        document.body.classList.add("menu-open");
    };
    const closeMobileMenu = () => {
        mobileMenu?.classList.remove("open");
        mobileMenu?.setAttribute("aria-hidden", "true");
        document.body.classList.remove("menu-open");
        closeMobilePanelView();
    };
    const openMobilePanel = (name) => {
        const tpl = document.querySelector(`[data-panel-template="${name}"]`);
        if (!tpl || !mobilePanelContent || !mobilePanel) return;
        mobilePanelContent.innerHTML = tpl.innerHTML;
        mobilePanel.classList.add("open");
        mobilePanel.setAttribute("aria-hidden", "false");
    };
    const closeMobilePanelView = () => {
        mobilePanel?.classList.remove("open");
        mobilePanel?.setAttribute("aria-hidden", "true");
    };

    menuToggle?.addEventListener("click", openMobileMenu);
    closeMobile?.addEventListener("click", closeMobileMenu);
    mobileMenu?.addEventListener("click", (e) => {
        if (e.target === mobileMenu) closeMobileMenu();
    });
    mobileLinks.forEach((l) =>
        l.addEventListener("click", () => openMobilePanel(l.dataset.panel))
    );
    mobileBack?.addEventListener("click", closeMobilePanelView);
    closeMobilePanel?.addEventListener("click", () => {
        closeMobilePanelView();
        closeMobileMenu();
    });
});
