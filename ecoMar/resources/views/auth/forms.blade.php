@extends('auth.app')

@section('title')
    ecoMar - Login/Register
@endsection

@section('content')
    @php
        // Decide which tab to show first based on where the errors/old input came from
        $registerFields = ['name', 'phone', 'location', 'dob', 'password_confirmation', 'type'];
        $registerErrors = collect($registerFields)->contains(fn($field) => $errors->has($field));
        $initialTab = old('name') || old('dob') || $registerErrors ? 'register' : 'login';
    @endphp
    <section class="authv3">
        <div class="authv3-container">

            <header class="authv3-hero">
                <p class="authv3-kicker">CONTA</p>
                <h1 class="authv3-title">Entra para continuares</h1>
                <p class="authv3-lead">
                    Acede aos eventos, inscrições e novidades. Uma conta ecoMar dá-te acesso rápido a tudo.
                </p>
            </header>

            <div class="authv3-card" data-auth-tabs data-initial-tab="{{ $initialTab }}">
                <div class="authv3-cardtop">
                    <div class="authv3-brand">
                        <img src="{{ asset('img/svg/logo.svg') }}" alt="ecoMar">
                    </div>

                    <div class="authv3-tabs" role="tablist" aria-label="Autenticação">
                        <button class="authv3-tab" type="button" data-tab="login" role="tab" aria-selected="false">
                            <i class="ri-login-box-line"></i> Login
                        </button>
                        <button class="authv3-tab active" type="button" data-tab="register" role="tab" aria-selected="true">
                            <i class="ri-user-add-line"></i> Registar
                        </button>
                    </div>
                </div>

                <div class="authv3-panel" id="login" role="tabpanel">
                    <form method="POST" action="{{ route('login') }}" class="authv3-form">
                        @csrf

                        <div class="authv3-grid one">
                            <label class="authv3-field">
                                <span class="authv3-label">EMAIL</span>
                                <div class="authv3-input">
                                    <i class="ri-mail-line"></i>
                                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                        placeholder="Insere o teu email">
                                </div>
                                @error('email') <small class="authv3-error">{{ $message }}</small> @enderror
                            </label>

                            <label class="authv3-field">
                                <span class="authv3-label">PALAVRA-PASSE</span>
                                <div class="authv3-input">
                                    <i class="ri-lock-2-line"></i>
                                    <input type="password" name="password" required autocomplete="current-password"
                                        placeholder="••••••••">
                                </div>
                                @error('password') <small class="authv3-error">{{ $message }}</small> @enderror
                            </label>
                        </div>

                        <div class="authv3-row">
                            <label class="authv3-check">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span>Lembrar-me</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="authv3-link" href="{{ route('password.request') }}">Esqueceste a palavra-passe?</a>
                            @endif
                        </div>

                        <div class="authv3-actions">
                            <button type="submit" class="authv3-btn authv3-btn-primary">
                                Entrar <i class="ri-arrow-right-line"></i>
                            </button>
                            <button type="button" class="authv3-btn authv3-btn-ghost" data-go="register">
                                Registar <i class="ri-user-add-line"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="authv3-panel active" id="register" role="tabpanel">
                    <form method="POST" action="{{ route('register') }}" class="authv3-form">
                        @csrf
                        <input type="hidden" name="type" value="U">

                        <div class="authv3-grid two">
                            <label class="authv3-field">
                                <span class="authv3-label">NOME</span>
                                <div class="authv3-input">
                                    <i class="ri-user-3-line"></i>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                        placeholder="O teu nome">
                                </div>
                                @error('name') <small class="authv3-error">{{ $message }}</small> @enderror
                            </label>

                            <label class="authv3-field">
                                <span class="authv3-label">EMAIL</span>
                                <div class="authv3-input">
                                    <i class="ri-mail-line"></i>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        placeholder="tu@exemplo.com">
                                </div>
                                @error('email') <small class="authv3-error">{{ $message }}</small> @enderror
                            </label>

                            <label class="authv3-field">
                                <span class="authv3-label">TELEFONE</span>
                                <div class="authv3-input">
                                    <i class="ri-phone-line"></i>
                                    <input type="text" name="phone" value="{{ old('phone') }}" minlength="9" maxlength="9"
                                        pattern="\d*" placeholder="9xxxxxxxx">
                                </div>
                                @error('phone') <small class="authv3-error">{{ $message }}</small> @enderror
                            </label>

                            <label class="authv3-field">
                                <span class="authv3-label">LOCALIZAÇÃO</span>
                                <div class="authv3-input">
                                    <i class="ri-map-pin-line"></i>
                                    <input type="text" name="location" value="{{ old('location') }}"
                                        placeholder="Lisboa, Porto…">
                                </div>
                                @error('location') <small class="authv3-error">{{ $message }}</small> @enderror
                            </label>

                            <label class="authv3-field">
                                <span class="authv3-label">DATA DE NASCIMENTO</span>
                                <div class="authv3-input">
                                    <i class="ri-calendar-line"></i>
                                    <input type="date" name="dob" value="{{ old('dob') }}">
                                </div>
                                @error('dob') <small class="authv3-error">{{ $message }}</small> @enderror
                            </label>

                            <div class="authv3-field authv3-field-empty"></div>

                            <label class="authv3-field">
                                <span class="authv3-label">PALAVRA-PASSE</span>
                                <div class="authv3-input">
                                    <i class="ri-lock-2-line"></i>
                                    <input type="password" name="password" required autocomplete="new-password"
                                        placeholder="••••••••">
                                </div>
                                @error('password') <small class="authv3-error">{{ $message }}</small> @enderror
                            </label>

                            <label class="authv3-field">
                                <span class="authv3-label">CONFIRMAR</span>
                                <div class="authv3-input">
                                    <i class="ri-lock-2-line"></i>
                                    <input type="password" name="password_confirmation" required autocomplete="new-password"
                                        placeholder="••••••••">
                                </div>
                            </label>
                        </div>

                        <div class="authv3-actions">
                            <button type="submit" class="authv3-btn authv3-btn-primary">
                                Criar conta <i class="ri-arrow-right-line"></i>
                            </button>
                            <button type="button" class="authv3-btn authv3-btn-ghost" data-go="login">
                                Já tenho conta <i class="ri-login-box-line"></i>
                            </button>
                        </div>

                        <p class="authv3-note">
                            Ao criares conta, aceitas os <a href="{{ route('termos') }}">Termos e Condições</a>.
                        </p>
                    </form>
                </div>
            </div>

        </div>

        <div class="authv3-footer">
            <span class="authv3-footer__text">Queres voltar ao site?</span>
            <a class="authv3-back" href="{{ route('home') }}">
                <i class="ri-arrow-left-line" aria-hidden="true"></i>
                Voltar
            </a>
        </div>
    </section>
    <script src="{{ asset('js/forms.js') }}"></script>
@endsection