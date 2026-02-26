document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector(".donate-form");
    if (!form) return;

    const radios = form.querySelectorAll('input[name="payment_method"]');
    const cards = form.querySelectorAll(".method-card");
    const mbwayFields = document.getElementById("mbwayFields");
    const cardFields = document.getElementById("cardFields");

    const amount = document.getElementById("donationAmount");
    const modal = window.donationModalControl;

    const mbwayPhone = document.getElementById("mbwayPhone");
    const cardReq = [
        "cardNumber",
        "cardName",
        "cardExpMonth",
        "cardExpYear",
        "cardCvv",
    ]
        .map((id) => document.getElementById(id))
        .filter(Boolean);

    function toggle(method) {
        cards.forEach((c) =>
            c.classList.toggle("active", c.dataset.method === method)
        );
        mbwayFields?.classList.toggle("is-active", method === "mbway");
        cardFields?.classList.toggle("is-active", method === "card");

        if (mbwayPhone) mbwayPhone.required = method === "mbway";
        cardReq.forEach((f) => (f.required = method === "card"));
    }

    const current =
        form.querySelector('input[name="payment_method"]:checked')?.value ||
        "mbway";
    toggle(current);
    radios.forEach((r) => r.addEventListener("change", () => toggle(r.value)));

    amount?.addEventListener("input", () => {
        amount.value = amount.value.replace(/[^0-9.,]/g, "");
    });

    let t1, t2;

    form.addEventListener("submit", (e) => {
        if (form.dataset.processing === "true") return e.preventDefault();

        if (!form.reportValidity()) return e.preventDefault();

        e.preventDefault();
        form.dataset.processing = "true";

        modal?.openPending?.();

        clearTimeout(t1);
        clearTimeout(t2);

        t1 = setTimeout(() => modal?.markSuccess?.(), 1600);
        t2 = setTimeout(() => {
            if (amount) amount.value = (amount.value || "").replace(",", ".");
            form.submit();
        }, 2600);
    });
});
