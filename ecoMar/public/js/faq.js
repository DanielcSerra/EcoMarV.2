document.querySelectorAll('.faqtitulo').forEach(titulo => {
  titulo.addEventListener('click', () => {
    const p = titulo.nextElementSibling;
    if (p) {
      p.classList.toggle('show');
    }
    titulo.classList.toggle('active');
  });
});
