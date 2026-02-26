<footer class="site-footer">
    <div class="container">
        <div class="footer-inner footer-compact">
            <div class="footer-brand">
                <img src="{{ asset('img/svg/logo.svg') }}" alt="ecoMar" />
                <p class="footer-tagline">
                    A ajudar o oceano todos os dias com a ajuda de vários voluntários para salvar o planeta azul.
                </p>
            </div>

            <div class="footer-newsletter">
                <p class="newsletter-text">
                    Recebe novidades frescas do mar direto na tua caixa de entrada.
                </p>
                <form class="newsletter-form" action="{{ route('newsletters.store') }}" method="post">
                    @csrf
                    <input type="email" name="email" placeholder="Insira o teu email *" required />
                    <button type="submit">Subscrever</button>
                </form>
            </div>

            <div class="footer-columns footer-compact-columns">
                <div class="footer-column">
                    <p class="column-title">Contactos</p>
                    <a href="{{ route('contactos') }}">Fala connosco</a>
                </div>
                <div class="footer-column">
                    <p class="column-title">Parcerias</p>
                    <a href="{{ route('patrocinadores') }}">Pedido de patrocinador</a>
                </div>
                <div class="footer-column">
                    <p class="column-title">Ajuda</p>
                    <a href="{{ route('faq') }}">FAQ</a>
                    <a href="{{ route('termos') }}">Termos e condições</a>
                    <a href="{{ route('cookies') }}">Cookies</a>
                </div>
            </div>

            <div class="footer-socials footer-compact-socials" aria-label="Redes sociais">
                <a href="#" aria-label="Facebook"><i class="ri-facebook-line"></i></a>
                <a href="#" aria-label="Instagram"><i class="ri-instagram-line"></i></a>
                <a href="#" aria-label="YouTube"><i class="ri-youtube-line"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="ri-linkedin-line"></i></a>
            </div>
        </div>
    </div>
</footer>