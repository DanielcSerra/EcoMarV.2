@extends('layout.master')

@section('title')
    ecoMar - Doar
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/donate.css') }}">
@endsection

@section('main')

    <header class="hero">
        <video class="hero__video" autoplay muted loop playsinline>
            <source src="{{ asset('video/donate.mp4') }}" type="video/mp4" />
        </video>
        <div class="hero__overlay"></div>
        <div class="hero__content">
            <p class="hero__eyebrow">
                Ajuda-nos a manter as ações pela saúde do oceano
            </p>
            <h1 class="hero__title">DOAÇÕES</h1>
        </div>
    </header>

    <section class="donate-section">
        <div class="donate-grid">
            <div class="donate-card">
                <p class="eyebrow_text">Contribui</p>
                <h2>Faz a tua doação</h2>
                <p class="muted">Cada euro ajuda-nos a organizar limpezas, formações e campanhas de sensibilização.</p>

                <form class="donate-form" method="POST" action="{{ route('donations.store') }}">
                    @csrf
                    <label class="form-field">
                        <span>Nome (opcional)</span>
                        <input type="text" name="name" placeholder="Anónimo">
                    </label>

                    <div class="form-field">
                        <span>Método de pagamento</span>
                        <div class="payment-methods" role="group" aria-label="Escolhe o método de pagamento">
                            <label class="method-card active" data-method="mbway">
                                <input type="radio" name="payment_method" value="mbway" checked>
                                <div class="method-content">
                                    <div class="method-head">
                                        <span class="method-title">MB WAY</span>
                                        <span class="method-tag">Rápido</span>
                                    </div>
                                    <p class="method-description">Recebe a confirmação direto no telemóvel.</p>
                                </div>
                            </label>

                            <label class="method-card" data-method="card">
                                <input type="radio" name="payment_method" value="card">
                                <div class="method-content">
                                    <div class="method-head">
                                        <span class="method-title">Cartão</span>
                                        <span class="method-tag alt">Crédito/Débito</span>
                                    </div>
                                    <p class="method-description">Usa o teu cartão habitual para doar.</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="payment-extra is-active" id="mbwayFields">
                        <label class="form-field">
                            <span>MB WAY - Telemóvel</span>
                            <input id="mbwayPhone" type="tel" name="mbway_phone" inputmode="tel" pattern="[0-9]{9}"
                                placeholder="913 456 789">
                            <small class="field-note">Iremos pedir-te autorização no teu MB WAY.</small>
                        </label>
                    </div>

                    <div class="payment-extra" id="cardFields">
                        <label class="form-field">
                            <span>Número do cartão</span>
                            <input id="cardNumber" type="text" name="card_number" inputmode="numeric" maxlength="19"
                                pattern="[0-9 ]{15,19}" placeholder="1234 5678 9012 3456">
                        </label>

                        <div class="card-grid">
                            <label class="form-field card-name">
                                <span>Nome no cartão</span>
                                <input id="cardName" type="text" name="card_name" placeholder="Nome e apelido">
                            </label>

                            <div class="form-field expiry-field">
                                <span>Validade (MM/AA)</span>
                                <div class="expiry-fields">
                                    <input id="cardExpMonth" type="text" name="card_exp_month" inputmode="numeric"
                                        maxlength="2" pattern="[0-9]{2}" placeholder="MM">
                                    <span class="expiry-divider">/</span>
                                    <input id="cardExpYear" type="text" name="card_exp_year" inputmode="numeric"
                                        maxlength="2" pattern="[0-9]{2}" placeholder="AA">
                                </div>
                            </div>

                            <label class="form-field cvv-field">
                                <span>CVV</span>
                                <input id="cardCvv" type="text" name="card_cvv" inputmode="numeric" maxlength="4"
                                    pattern="[0-9]{3,4}" placeholder="123">
                            </label>
                        </div>
                    </div>

                    <label class="form-field">
                        <span>Valor a doar (€)</span>
                        <input id="donationAmount" type="text" name="num_donated" maxlength="13" required
                            placeholder="Ex: 10,00">
                    </label>

                    <button type="submit" class="primary-btn">
                        <i class="ri-heart-line"></i>
                        Confirmar doação
                    </button>
                </form>
            </div>

            <div class="donate-highlight">
                <p class="eyebrow_text">Impacto</p>
                <div class="total-box">
                    <p>Total angariado</p>
                    <h3>{{ number_format($total, 2, ',', '.') }} €</h3>
                </div>
                <h4>Quem já ajudou</h4>
                @if($donations->isEmpty())
                    <p class="muted">Sê o primeiro a apoiar a causa.</p>
                @else
                    <div class="ticker">
                        <div class="ticker__inner">
                            @foreach($donations as $donation)
                                <div class="ticker__item">
                                    <div class="donor-info">
                                        <span class="donor-name">{{ $donation->name }}</span>
                                        <span class="donor-date">{{ $donation->created_at?->format('d/m/Y') }}</span>
                                    </div>
                                    <span class="donor-amount">{{ number_format($donation->num_donated, 2, ',', '.') }} €</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="store-note">
                    <h5>Preferes apoiar de outra forma?</h5>
                    <p>Compra produtos na nossa loja solidária, todo o valor das vendas é reinvestido no nosso oceano.
                    </p>
                    <a class="store-button" href="https://ecomar.iceiy.com">Ir para a loja</a>
                </div>
            </div>
        </div>
    </section>

    <div class="modal-overlay" id="donationModal">
        <div class="modal-box donation-modal">
            <button type="button" class="modal-close" id="closeDonationModal" aria-label="Fechar modal">&times;</button>
            <div class="donation-status">
                <div class="status-loader" aria-hidden="true"></div>
                <i class="ri-check-line status-check" aria-hidden="true"></i>
                <div>
                    <h3 class="status-title">Autorização pendente</h3>
                    <p class="modal-subtitle status-subtitle">Estamos a confirmar o pedido de doação.</p>
                </div>
            </div>
            <div class="status-steps">
                <span class="status-pill is-active" data-step="pending">Pendente</span>
                <span class="status-pill" data-step="success">Autorizado</span>
            </div>
            <p class="status-hint">Mantém-te nesta página enquanto finalizamos a doação.</p>
        </div>
    </div>
@endsection

@section('jslink')
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/donate.js') }}"></script>
@endsection
