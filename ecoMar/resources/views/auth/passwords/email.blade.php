@extends('auth.app')

@section('title')
    ecoMar - Recuperar Palavra-Passe
@endsection

@section('content')
    <section class="authv3">
        <div class="authv3-container" style="align-items: start;">
            <div class="authv3-hero">
                <p class="authv3-kicker">Conta</p>
                <h1 class="authv3-title">Recuperar acesso</h1>
                <p class="authv3-lead">
                    Introduz o email associado à tua conta para receberes um link seguro
                    de redefinição de palavra-passe.
                </p>
            </div>

            <div class="authv3-card">
                <div class="authv3-cardtop">
                    <div class="authv3-brand">
                        <img src="{{ asset('img/svg/logo.svg') }}" alt="ecoMar">
                    </div>
                </div>

                @if (session('status'))
                    <div class="authv3-alert" role="alert">
                        <i class="ri-check-line"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <form class="authv3-form" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="authv3-field">
                        <label class="authv3-label" for="email">Email</label>
                        <div class="authv3-input @error('email') authv3-input-error @enderror">
                            <i class="ri-mail-line"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autocomplete="email" autofocus placeholder="tu@exemplo.com">
                        </div>
                        @error('email')
                            <div class="authv3-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="authv3-actions" style="grid-template-columns: 1fr;">
                        <button type="submit" class="authv3-btn authv3-btn-primary">
                            Enviar link
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
