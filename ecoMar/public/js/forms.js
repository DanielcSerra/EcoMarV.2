const tabs = document.querySelectorAll(".authv3-tab");
const panels = document.querySelectorAll(".authv3-panel");
const container = document.querySelector("[data-auth-tabs]");

function setTab(id) {
    tabs.forEach((tab) => {
        const active = tab.dataset.tab === id;
        tab.classList.toggle("active", active);
        tab.setAttribute("aria-selected", active);
    });

    panels.forEach((panel) =>
        panel.classList.toggle("active", panel.id === id)
    );
}

const initialTab = (container && container.dataset.initialTab) || "login";
setTab(initialTab);

tabs.forEach((tab) =>
    tab.addEventListener("click", () => setTab(tab.dataset.tab))
);

document
    .querySelectorAll("[data-go]")
    .forEach((btn) =>
        btn.addEventListener("click", () => setTab(btn.dataset.go))
    );
