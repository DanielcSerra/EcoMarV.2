document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("sugestaoModal");
    const openBtn = document.getElementById("openSugestaoModal");
    const closeBtn = document.getElementById("closeSugestaoModal");
    const cancelBtn = document.getElementById("cancelSugestaoModal");

    if (modal && openBtn && closeBtn && cancelBtn) {
        const closeModal = () => modal.classList.remove("is-open");
        const openModal = () => modal.classList.add("is-open");

        openBtn.addEventListener("click", openModal);
        closeBtn.addEventListener("click", closeModal);
        cancelBtn.addEventListener("click", closeModal);

        modal.addEventListener("click", (e) => {
            if (e.target === modal) closeModal();
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeModal();
        });
    }
    const cancelModal = document.getElementById("cancelModal");
    const cancelForm = document.getElementById("cancelForm");

    if (cancelModal && cancelForm) {
        const close = () => cancelModal.classList.remove("is-open");

        document.querySelectorAll(".cancel-trigger").forEach((btn) => {
            btn.addEventListener("click", () => {
                if (btn.dataset.action) {
                    cancelForm.action = btn.dataset.action;
                    cancelModal.classList.add("is-open");
                }
            });
        });

        document
            .getElementById("closeCancelModal")
            ?.addEventListener("click", close);
        document
            .getElementById("cancelCancelModal")
            ?.addEventListener("click", close);

        cancelModal.addEventListener("click", (e) => {
            if (e.target === cancelModal) close();
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") close();
        });
    }

    const donationModal = document.getElementById("donationModal");
    const donationCloseBtn = document.getElementById("closeDonationModal");
    const donationBox = donationModal?.querySelector(".donation-modal");
    const donationStatusTitle = donationModal?.querySelector(".status-title");
    const donationStatusSubtitle =
        donationModal?.querySelector(".status-subtitle");
    const donationPills = donationModal?.querySelectorAll(".status-pill");
    let donationCanClose = false;
    const setDonationPills = (step) => {
        donationPills?.forEach((pill) =>
            pill.classList.toggle("is-active", pill.dataset.step === step)
        );
    };
    const openDonationPending = () => {
        donationCanClose = false;
        donationBox?.classList.remove("is-success");
        if (donationStatusTitle)
            donationStatusTitle.textContent = "Autorização pendente";
        if (donationStatusSubtitle)
            donationStatusSubtitle.textContent =
                "Estamos a confirmar o pedido de doação.";
        setDonationPills("pending");
        donationModal?.classList.add("is-open");
    };
    const markDonationSuccess = () => {
        donationBox?.classList.add("is-success");
        if (donationStatusTitle)
            donationStatusTitle.textContent = "Autorização com sucesso";
        if (donationStatusSubtitle)
            donationStatusSubtitle.textContent =
                "Pagamento confirmado. Vamos concluir a doação.";
        setDonationPills("success");
        donationCanClose = true;
    };
    const closeDonation = () => {
        if (donationCanClose) donationModal?.classList.remove("is-open");
    };
    if (donationModal) {
        donationCloseBtn?.addEventListener("click", closeDonation);
        donationModal.addEventListener("click", (e) => {
            if (e.target === donationModal) closeDonation();
        });
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeDonation();
        });
        window.donationModalControl = {
            openPending: openDonationPending,
            markSuccess: markDonationSuccess,
            closeIfAllowed: closeDonation,
        };
    }
});
