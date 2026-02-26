@extends('auth.app')

@section('title')
    ecoMar - Recuperar Palavra-Passe
@endsection

@section('content')
    <section class="authv3">
        <div class="authv3-container" style="align-items: start;">
            <div class="authv3-hero">
                <p class="authv3-kicker">Conta</p>
                <h1 class="authv3-title">Define uma nova palavra-passe</h1>
                <p class="authv3-lead">
                    Escolhe uma palavra-passe segura para voltares a aceder à tua conta ecoMar.
                </p>
            </div>

            <div class="authv3-card">
                <div class="authv3-cardtop">
                    <div class="authv3-brand">
                        <img src="{{ asset('img/svg/logo.svg') }}" alt="ecoMar">
                    </div>
                </div>

                <form class="authv3-form" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="authv3-field">
                        <label class="authv3-label" for="email">Email</label>
                        <div class="authv3-input @error('email') authv3-input-error @enderror">
                            <i class="ri-mail-line"></i>
                            <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required
                                autocomplete="email" autofocus placeholder="tu@exemplo.com">
                        </div>
                        @error('email')
                            <div class="authv3-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="authv3-field">
                        <label class="authv3-label" for="password">Nova palavra-passe</label>
                        <div class="authv3-input @error('password') authv3-input-error @enderror">
                            <i class="ri-lock-line"></i>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <div class="authv3-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="authv3-field">
                        <label class="authv3-label" for="password-confirm">Confirmar palavra-passe</label>
                        <div class="authv3-input">
                            <i class="ri-check-double-line"></i>
                            <input id="password-confirm" type="password" name="password_confirmation" required
                                autocomplete="new-password" placeholder="Repete a palavra-passe">
                        </div>
                    </div>

                    <div class="authv3-actions" style="grid-template-columns: 1fr;">
                        <button type="submit" class="authv3-btn authv3-btn-primary">
                            Redefinir palavra-passe
                        </button>
                    </div>

                    <p class="authv3-note" style="text-align:center; margin-top:6px;">
                        Lembraste da tua palavra-passe?
                        <a href="{{ route('login') }}">Voltar ao login</a>
                    </p>
                </form>
            </div>
        </div>

        <div class="authv3-footer">
            <span>Queres voltar ao site?</span>
            <a class="authv3-back" href="{{ url('/') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
        </div>
    </section>
@endsection
