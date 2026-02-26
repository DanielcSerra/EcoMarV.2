@extends('layout.master')

@section('title')
    ecoMar - Voluntariado
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/voluntarios.css') }}">
@endsection

@section('main')
    <section id="hero">
        <video playsinline autoplay muted loop>
            <source src="{{ asset('video/ecoMar.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="flexH">
            <h1>Voluntários</h1>
            <img src="{{ asset('img/pagesymbol.png') }}" alt="Ícone da página">
        </div>
    </section>
    <main>

        <section id="conteudo">
            <!-- Left Column: Scrollable Text -->
            <div class="content-left">
                <div class="text-block header-block">
                    <h1>Junta-te à EcoMar: Faz a Diferença pelo Oceano</h1>
                </div>

                <div class="text-block">
                    <h2>Por que precisamos de si?</h2>
                    <p>Os oceanos são essenciais para a vida no nosso planeta, mas estão cada vez mais ameaçados pela
                        poluição, pesca excessiva e alterações climáticas. A EcoMar atua na linha da frente da proteção
                        marinha, mas não podemos fazer isto sozinhos.
                        Precisamos de pessoas como si, que acreditam na mudança e estão dispostas a agir. Cada par de mãos
                        conta, cada ação soma-se. Juntos, podemos restaurar praias, salvar espécies e educar futuras
                        gerações.
                        O oceano precisa de heróis. Você pode ser um deles.</p>
                </div>

                <div class="text-block">
                    <h2>O que um voluntário faz?</h2>
                    <p>Como voluntário da EcoMar, pode participar em diversas ações práticas e significativas:<br><br>
                        <strong>Limpezas de praia e costeiras:</strong> Recolha de plásticos e resíduos.<br>
                        <strong>Ações de sensibilização:</strong> Divulgação em escolas e eventos.<br>
                        <strong>Monitorização ambiental:</strong> Apoio em projetos de estudo de espécies marinhas.<br>
                        <strong>Logística de eventos:</strong> Ajuda na organização de atividades e campanhas.<br>
                        <strong>Criação de conteúdo:</strong> Fotografia, vídeo e redes sociais para partilhar a nossa missão.<br><br>
                        Não é preciso experiência prévia. Apenas vontade de aprender e contribuir.</p>
                </div>

                <div class="text-block">
                    <h2>Como pode participar?</h2>
                    <p>É simples e rápido:<br><br>
                        1. Registe-se como voluntário através do nosso formulário online.<br>
                        2. Escolha os eventos que mais se adequam à sua disponibilidade e interesses.<br>
                        3. Participe numa sessão de formação breve (online ou presencial).<br>
                        4. Junte-se a uma ação e comece a fazer a diferença!<br><br>
                        Pode participar de forma pontual ou regular. Cada contributo é valioso.</p>
                </div>

                <div class="text-block">
                    <h2>Benefícios para o voluntário</h2>
                    <p>Ser voluntário na EcoMar é mais do que ajudar o planeta. É também uma experiência enriquecedora para
                        si:<br><br>
                        - Desenvolvimento pessoal e profissional: Ganha competências em trabalho de equipa, organização e comunicação.<br>
                        - Certificado de participação: Válido para o seu currículo e portfólio.<br>
                        - Contacto com a natureza: Atividades ao ar livre em cenários costeiros.<br>
                        - Faz parte de uma comunidade: Conhece pessoas com os mesmos valores e paixão pelo mar.<br>
                        - Satisfação pessoal: Vê o impacto direto do seu trabalho em prol do oceano.</p>
                </div>
            </div>

            <!-- Right Column: Sticky Image -->
            <div class="content-right">
                <div class="sticky-image-container">
                    <img src="{{ asset('img/imagem1.jpg') }}" alt="Voluntários EcoMar">
                </div>
            </div>
        </section>
        <div class="spacer">
            <video playsinline autoplay muted loop>
                <source src="{{ asset('video/backgroundvideo4.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <section id="depoimentos">
            <div id="formdepoimentos">
                <div id="textodepoimentos">
                    <h4>PARTILHA A TUA EXPERIÊNCIA</h4>
                    <h2>Queres deixar o teu testemunho como voluntário ecoMar?</h2>
                    <p>Conta-nos como foi a tua experiência e inspira outras pessoas a juntar-se à nossa missão.</p>
                </div>
                <div class="butao1">
                    @auth
                        <button id="openFormBtn">SUBMETER DEPOIMENTO</button>
                    @else
                        <a href="{{ route('login') }}">
                            <button class="guest-button">INICIAR SESSÃO</button>
                        </a>
                    @endauth
                </div>
                <div id="depoimentoModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h3 class="modal-title">Submeter Depoimento</h3>
                        <form method="POST" action="{{ route('voluntarios.testimonies.store') }}">
                            @csrf
                            <label for="message">Mensagem:</label>
                            <textarea id="message" name="message" rows="4" placeholder="A sua mensagem" required
                                minlength="10" maxlength="300"></textarea>
                            <button type="submit">Enviar</button>
                        </form>

                    </div>
                </div>
            </div>
            <div id="mostrardepoimentos">
                <h2>Depoimentos de voluntários</h2>

                <div class="depoimentos-container">
                    @forelse($testimonies as $testimony)
                        <div class="depoimento-card">
                            <p>"{{ $testimony->message }}"</p>

                            <div class="depoimento-user">
                                <p>-{{ $testimony->user->name ?? 'Erro' }}</p>
                                <img src="{{ $testimony->user->img_path ? asset('storage/' . $testimony->user->img_path) : asset('img/default-pfp.png') }}"
                                    alt="{{ $testimony->user->name ?? 'Erro' }}'s profile picture" class="profile-picture">
                            </div>
                        </div>
                    @empty
                        <p>Não há depoimentos ainda. Seja o primeiro a partilhar a sua experiência!</p>
                    @endforelse
                </div>


                <a href="{{ route('voluntarios.depoimentos.all') }}" class="butao">Ver todos</a>
            </div>

        </section>
        <div class="spacer">
            <video playsinline autoplay muted loop>
                <source src="{{ asset('video/backgroundvideo5.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </main>
@endsection