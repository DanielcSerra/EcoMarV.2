document.addEventListener('DOMContentLoaded', function () {
  // Modal Logic for Testimonials/Volunteer Form
  const modal = document.getElementById('depoimentoModal');
  const openBtn = document.getElementById('openFormBtn');
  if (modal) {
    const closeBtn = modal.querySelector('.close');
    if (openBtn) openBtn.addEventListener('click', function () { modal.style.display = 'block'; });
    if (closeBtn) closeBtn.addEventListener('click', function () { modal.style.display = 'none'; });
    window.addEventListener('click', function (e) { if (e.target === modal) modal.style.display = 'none'; });
  }
});

