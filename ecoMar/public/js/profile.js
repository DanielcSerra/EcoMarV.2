document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("toggleEditProfile");
    const cancelBtn = document.getElementById("cancelEditProfile");
    const form = document.getElementById("editProfileForm");

    const toggle = () => form?.classList.toggle("is-open");
    toggleBtn?.addEventListener("click", toggle);
    cancelBtn?.addEventListener("click", toggle);
});
