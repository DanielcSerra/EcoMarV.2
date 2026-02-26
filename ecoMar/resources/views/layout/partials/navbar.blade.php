@php
    use Illuminate\Support\Facades\Storage;
@endphp

<nav class="navbar">
    <div class="container ">
        <div class="logo">
            <a href="{{ route('home') }}"><img src="{{ asset('img/svg/logo.svg') }}" alt="EcoMar" /></a>
        </div>

        <div class="right-section">
            <ul class="nav-links">
                <li class="nav-item">
                    <a href="{{ route('eventos') }}" class="nav-trigger" data-key="eventos">EVENTOS</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('noticias') }}" class="nav-trigger" data-key="noticias">NOTÍCIAS</a>

                </li>
                <li class="nav-item">
                    <a href="{{ route('sobre-nos') }}" class="nav-trigger" data-key="sobre">SOBRE NÓS</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('voluntarios') }}" class="nav-trigger" data-key="participar">VOLUNTARIAR</a>
                </li>
            </ul>

            <div class="mega-panel" id="megaPanel" aria-hidden="true">
                <div class="panel-story panel-eventos">
                    <p class="eyebrow">EVENTOS</p>
                    <h3>Encontros que movem o oceano</h3>
                    <p>
                        Descobre campanhas, conferências e atividades que unem comunidades para proteger o mar.
                        Participa
                        nos próximos eventos da ecoMar.
                    </p>
                </div>
                <div class="panel-links-col panel-eventos">
                    <p class="eyebrow">Ações</p>
                    <ul class="panel-links">
                        <li>
                            <a href="{{ route('eventos') }}">Eventos</a>
                        </li>
                        <li>
                            <a href="{{ route('campanhas') }}">Campanhas</a>
                        </li>
                    </ul>
                </div>
                <div class="panel-story panel-noticias" style="display: none;">
                    <p class="eyebrow">NOTÍCIAS</p>
                    <h3>Histórias que inspiram mudança</h3>
                    <p>
                        Acompanha as últimas descobertas, expedições e conquistas na proteção marinha. Fica por dentro
                        das
                        novidades ecoMar.
                    </p>
                </div>
                <div class="panel-links-col panel-noticias" style="display: none;">
                    <p class="eyebrow">Ações</p>
                    <ul class="panel-links">
                        <li>
                            <a href="{{ route('noticias') }}">Notícias</a>
                        </li>
                        <li>
                            <a href="{{ route('maremrisco') }}">Mar em Risco</a>
                        </li>
                    </ul>
                </div>
                <div class="panel-story panel-sobre" style="display: none;">
                    <p class="eyebrow">SOBRE NÓS</p>
                    <h3>Uma equipa, um oceano</h3>
                    <p>
                        Conhece quem está por trás da ecoMar — cientistas, voluntários e parceiros unidos por um futuro
                        azul
                        e sustentável.
                    </p>
                </div>
                <div class="panel-links-col panel-sobre" style="display: none;">
                    <p class="eyebrow">Ações</p>
                    <ul class="panel-links">
                        <li>
                            <a href="{{ route('sobre-nos') }}">Sobre nós</a>
                        </li>
                        <li>
                            <a href="{{ route('equipa') }}">Nossa Equipa</a>
                        </li>
                        <li>
                            <a href="{{ route('patrocinadores') }}">Patrocinadores</a>
                        </li>
                    </ul>
                </div>
                <div class="panel-story panel-participar" style="display: none;">
                    <p class="eyebrow">VOLUNTARIAR</p>
                    <h3>Participa e faz a diferença</h3>
                    <p>
                        Vê como te podes envolver: seja voluntariando-te, fazendo uma doação ou participando em
                        campanhas
                        locais pela saúde do oceano.
                    </p>
                </div>
                <div class="panel-links-col panel-participar" style="display: none;">
                    <p class="eyebrow">Ações</p>
                    <ul class="panel-links">
                        <li>
                            <a href="{{ route('voluntarios') }}">Voluntariar</a>
                        </li>
                        <li>
                            <a href="{{ route('como-ajudar') }}">Como ajudar</a>
                        </li>
                        <li>
                            <a href="{{ route('doar') }}">Doar</a>
                        </li>
                    </ul>
                </div>
                @guest
                    <div class="panel-form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <label class="form-line">
                                <span class="icon-circle"><i class="ri-user-line"></i></span>
                                <div class="input-text">
                                    <span>Email</span>
                                    <input type="email" name="email" placeholder="Insere o teu email" required />
                                </div>
                            </label>

                            <label class="form-line-password">
                                <span class="icon-circle"><i class="ri-lock-2-line"></i></span>
                                <div class="input-text">
                                    <span>Palavra-passe</span>
                                    <input type="password" name="password" placeholder="••••••••" required />
                                </div>
                            </label>

                            @if (Route::has('password.request'))
                                <div class="forgot-container">
                                    <a class="forgot-link forgot-inline" href="{{ route('password.request') }}">
                                        Esqueceste a palavra-passe?
                                    </a>
                                </div>
                            @endif

                            <div class="panel-buttons panel-buttons-login">
                                <button class="pill-btn outline" type="submit">
                                    <i class="ri-login-box-line btn-icon" aria-hidden="true"></i>
                                    Login
                                </button>

                                <button class="pill-btn outline" type="button"
                                    onclick="window.location='{{ route('register') }}'">
                                    <i class="ri-user-add-line btn-icon" aria-hidden="true"></i>
                                    Registar
                                </button>
                            </div>

                        </form>
                    </div>
                @endguest
                @auth
                    @php
                        $user = Auth::user();
                        $avatarUrl = null;
                        if (!empty($user->img_path)) {
                            $candidate = ltrim($user->img_path, '/');
                            if (str_starts_with($candidate, 'storage/')) {
                                $candidate = substr($candidate, 8);
                            }
                            if (str_starts_with($candidate, 'public/')) {
                                $candidate = substr($candidate, 7);
                            }
                            if (Storage::disk('public')->exists($candidate)) {
                                $avatarUrl = asset('storage/' . $candidate);
                            } elseif (filter_var($user->img_path, FILTER_VALIDATE_URL)) {
                                $avatarUrl = $user->img_path;
                            }
                        }
                    @endphp

                    <div class="panel-form panel-user" aria-label="painel do utilizador autenticado">
                        <div class="panel-user-top">
                            <div class="user-avatar">
                                @if($avatarUrl)
                                    <img src="{{ $avatarUrl }}" alt="Avatar de {{ $user->name }}" class="avatar-img" />
                                @else
                                    <span>{{ strtoupper(substr($user->name ?? 'V', 0, 1)) }}</span>
                                @endif
                            </div>

                            <div class="user-meta">
                                <p class="eyebrow user-greeting">
                                    Bem-vindo,</p>
                                <h3 class="user-name">
                                    {{ $user->name }}
                                </h3>
                                @if(!empty($user->email))
                                    <span class="user-email">{{ $user->email }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="panel-user-actions">
                            @if(isset($user->type) && ($user->type === 'A' || $user->type === 'F'))
                                <div class="panel-user-actions-row">
                                    <button class="pill-btn dashboard-btn" type="button"
                                        onclick="window.location='{{ route('admin.dashboard') }}'">
                                        <i class="ri-dashboard-line btn-icon" aria-hidden="true"></i>
                                        Dashboard
                                    </button>
                                </div>
                            @endif

                            <div class="panel-buttons-login">
                                <button class="pill-btn outline" type="button"
                                    onclick="window.location='{{ route('profile') }}'">
                                    <i class="ri-user-3-line btn-icon" aria-hidden="true"></i>
                                    Ver perfil
                                </button>

                                <form method="POST" action="{{ route('logout') }}" class="inline-form">
                                    @csrf
                                    <button class="pill-btn outline" type="submit">
                                        <i class="ri-logout-box-line btn-icon" aria-hidden="true"></i>
                                        Sair
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div> <a class="store-btn" href="https://ecomar.iceiy.com" target="_blank" rel="noopener">
                <i class="ri-store-line" aria-hidden="true"></i>
                <span>LOJA</span>
            </a>
            <a class="donate-btn" href="{{ route('doar') }}">
                <i class="ri-heart-line" aria-hidden="true"></i>
                <span>DOAR</span>
            </a>
            <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu">
                <i class="ri-menu-line" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</nav>

<div class="mobile-menu" id="mobileMenu" aria-hidden="true">
    <div class="mobile-header">
        <div class="logo">
            <img src="{{ asset('img/svg/logo.svg') }}" alt="EcoMar" />
        </div>
        <button class="close-mobile" id="closeMobile" aria-label="Fechar menu">
            &times;
        </button>
    </div>
    <ul class="mobile-links">
        <li>
            <button class="mobile-link" data-panel="eventos">Eventos</button>
        </li>
        <li>
            <button class="mobile-link" data-panel="noticias">Notícias</button>
        </li>
        <li>
            <button class="mobile-link" data-panel="sobre">Sobre nós</button>
        </li>
        <li>
            <button class="mobile-link" data-panel="participar">
                Voluntariar
            </button>
        </li>
    </ul>
    <div class="mobile-actions">
        <a class="mobile-store" href="https://ecomar.iceiy.com" target="_blank" rel="noopener">
            <i class="ri-store-line" aria-hidden="true"></i>
            <span>Loja</span>
        </a>
        <a class="mobile-donate"" href=" {{ route('doar') }}">
            <i class="ri-heart-line" aria-hidden="true"></i>
            <span>Doar</span>
        </a>
    </div>
    @guest
        <form class="mobile-login" method="POST" action="{{ route('login') }}">
            @csrf
            <label>
                <span>Email</span>
                <input type="email" name="email" placeholder="Insere o teu email" required />
            </label>
            <label>
                <span>Palavra-passe</span>
                <input type="password" name="password" placeholder="••••••••" required />
            </label>
            @if (Route::has('password.request'))
                <a class="forgot-link forgot-inline mobile" href="{{ route('password.request') }}">
                    Esqueceste a palavra-passe?
                </a>
            @endif
            <div class="panel-buttons">
                <button class="pill-btn outline" type="submit">
                    <i class="ri-login-box-line btn-icon" aria-hidden="true"></i>
                    Login
                </button>
                <button class="pill-btn outline" type="button" onclick="window.location='{{ route('register') }}'">
                    <i class="ri-user-add-line btn-icon" aria-hidden="true"></i>
                    Registar
                </button>
            </div>
        </form>
    @else
        @php
            $user = Auth::user();
            $avatarUrl = !empty($user->img_path) ? Storage::disk('public')->url($user->img_path) : null;
        @endphp

        <div class="mobile-login_auth auth-mobile">
            <div class="auth-mobile-top">
                <div class="mobile-avatar">
                    @if($avatarUrl)
                        <img src="{{ $avatarUrl }}" alt="Avatar de {{ $user->name }}" class="avatar-img" />
                    @else
                        <span>{{ strtoupper(substr($user->name ?? 'V', 0, 1)) }}</span>
                    @endif
                </div>
                <div class="auth-mobile-meta">
                    <div class="auth-mobile-name">{{ $user->name }}</div>
                    @if(!empty($user->email))
                        <div class="auth-mobile-email">{{ $user->email }}</div>
                    @endif
                </div>
                @if(isset($user->type) && ($user->type === 'A' || $user->type === 'F'))
                    <div class="auth-mobile-admin">
                        <button class="pill-btn auth-mobile-dashboard" type="button"
                            onclick="window.location='{{ route('admin.dashboard') }}'">
                            <i class="ri-dashboard-line btn-icon" aria-hidden="true"></i>
                            Dashboard
                        </button>
                    </div>
                @endif
            </div>

            <div class="panel-buttons panel-buttons-mobile">
                <button class="pill-btn outline" type="button" onclick="window.location='{{ route('profile') }}'">
                    <i class="ri-user-3-line btn-icon" aria-hidden="true"></i>
                    Ver perfil
                </button>

                <form method="POST" action="{{ route('logout') }}" class="inline-form">
                    @csrf
                    <button class="pill-btn outline" type="submit">
                        <i class="ri-logout-box-line btn-icon" aria-hidden="true"></i>
                        Sair
                    </button>
                </form>
            </div>
        </div>
    @endguest
    <button class="donate-btn full">Doar</button>
</div>

<div class="mobile-panel" id="mobilePanel" aria-hidden="true">
    <div class="mobile-panel-header">
        <button class="back-btn" id="mobileBack" aria-label="Voltar">
            ← Voltar
        </button>
        <button class="close-mobile" id="closeMobilePanel" aria-label="Fechar painel">
            &times;
        </button>
    </div>
    <div class="mobile-panel-content" id="mobilePanelContent"></div>
</div>

<div class="mobile-panel-templates" aria-hidden="true">
    <section data-panel-template="eventos">
        <h2>Eventos</h2>
        <p>
            Descobre campanhas, conferências e atividades que unem comunidades
            para proteger o mar. Participa nos próximos eventos da ecoMar.
        </p>
        <ul class="mobile-panel-links">
            <li><a href="{{ route('eventos') }}">Eventos</a></li>
            <li><a href="{{ route('campanhas') }}">Campanhas</a></li>
        </ul>
    </section>
    <section data-panel-template="noticias">
        <h2>Notícias</h2>
        <p>
            Acompanha as últimas descobertas, expedições e conquistas na proteção
            marinha. Fica por dentro das novidades ecoMar.
        </p>
        <ul class="mobile-panel-links">
            <li><a href="{{ route('noticias') }}">Notícias</a></li>
            <li><a href="{{ route('maremrisco') }}">Mar em Risco</a></li>
        </ul>
    </section>
    <section data-panel-template="sobre">
        <h2>Sobre Nós</h2>
        <p>
            Conhece quem está por trás da ecoMar, cientistas, voluntários e
            parceiros unidos por um futuro azul e sustentável.
        </p>
        <ul class="mobile-panel-links">
            <li><a href="{{ route('sobre-nos') }}">Sobre Nós</a></li>
            <li><a href="{{ route('equipa') }}">Nossa Equipa</a></li>
            <li><a href="{{ route('patrocinadores') }}">Patrocinadores</a></li>
        </ul>
    </section>
    <section data-panel-template="participar">
        <h2>Voluntariar</h2>
        <p>
            Vê como te podes envolver: seja voluntariando-te, fazendo uma doação
            ou participando em campanhas locais pela saúde do oceano.
        </p>
        <ul class="mobile-panel-links">
            <li><a href="{{ route('voluntarios') }}">Voluntariar</a></li>
            <li><a href="{{ route('como-ajudar') }}">Como ajudar</a></li>
            <li><a href="#">Doar</a></li>
        </ul>
    </section>
</div>