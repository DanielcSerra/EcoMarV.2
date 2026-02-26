function hideToast() {
    const toast = document.getElementById("toast");
    toast.style.animation = "fadeOut 0.4s forwards";
    setTimeout(() => toast.remove(), 400);
}

setTimeout(() => hideToast(), 3000);
