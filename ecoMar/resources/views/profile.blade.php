@extends('layout.master')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('title')
    ecoMar - {{ $user->name }}
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('main')
    @php
        $photoPath = $user->img_path;
        $photoUrl = null;
        if ($photoPath) {
            $candidate = ltrim($photoPath, '/');
            if (str_starts_with($candidate, 'storage/')) {
                $candidate = substr($candidate, 8);
            }
            if (str_starts_with($candidate, 'public/')) {
                $candidate = substr($candidate, 7);
            }
            if (Storage::disk('public')->exists($candidate)) {
                $photoUrl = asset('storage/' . $candidate);
            } elseif (filter_var($photoPath, FILTER_VALIDATE_URL)) {
                $photoUrl = $photoPath;
            }
        }
        $isVerified = $user->hasVerifiedEmail();
    @endphp

    <header class="hero">
        <video class="hero__video" autoplay muted loop playsinline>
            <source src="{{ asset('video/profile.mp4') }}" type="video/mp4" />
        </video>
        <div class="hero__overlay"></div>
        <div class="hero__content">
            <p class="hero__eyebrow">
                Revê os teus dados e as tuas inscrições em eventos ecoMar.
            </p>
            <h1 class="hero__title">{{ $user->name ?? 'Utilizador' }}</h1>
        </div>
    </header>

    <section class="profile-shell">
        <div class="profile-grid">
            <div class="card card--profile">
                <div class="card__header">
                    <div>
                        <p class="eyebrow_text">Dados pessoais</p>
                        <h2>{{ $user->name }}</h2>
                        <p class="muted">{{ $typeLabels[$user->type ?? 'U'] ?? 'Utilizador' }}</p>
                    </div>
                    <div class="header-actions">
                        <button class="primary-btn" id="toggleEditProfile" type="button">Editar</button>
                        <a class="ghost-btn" href="{{ route('contactos') }}">Contactar</a>
                    </div>
                </div>

                <div class="card__body info-grid">
                    <div class="verification-row">
                        <span class="verification-pill {{ $isVerified ? 'verified' : 'unverified' }}">
                            <i class="ri-mail-check-line" aria-hidden="true"></i>
                            {{ $isVerified ? 'Email verificado' : 'Email por verificar' }}
                        </span>
                        @unless($isVerified)
                            <form method="POST" action="{{ route('verification.send') }}" class="verification-form">
                                @csrf
                                <button type="submit" class="ghost-btn verification-resend">Reenviar verificação</button>
                            </form>
                        @endunless
                    </div>
                    <div class="info-item">
                        <p class="label">Email</p>
                        <p class="value">{{ $user->email }}</p>
                    </div>
                    <div class="info-item">
                        <p class="label">Telefone</p>
                        <p class="value">{{ $user->phone ?? '—' }}</p>
                    </div>
                    <div class="info-item">
                        <p class="label">Localização</p>
                        <p class="value">{{ $user->location ?? '—' }}</p>
                    </div>
                    <div class="info-item">
                        <p class="label">Data de nascimento</p>
                        <p class="value">
                            {{ $user->dob ? date('d/m/Y', strtotime($user->dob)) : '—' }}
                        </p>
                    </div>
                </div>

                <form class="edit-form" id="editProfileForm" method="POST" action="{{ route('profile.update') }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <label class="form-field">
                            <span>Nome</span>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                        </label>
                        <label class="form-field">
                            <span>Telefone</span>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" maxlength="15">
                        </label>
                        <label class="form-field">
                            <span>Localização</span>
                            <input type="text" name="location" value="{{ old('location', $user->location) }}">
                        </label>
                        <label class="form-field">
                            <span>Data de nascimento</span>
                            <input type="date" name="dob" value="{{ old('dob', $user->dob) }}">
                        </label>
                        <div class="form-field form-field--inline">
                            <div class="form-field__block">
                                <span>Foto de perfil</span>
                                <input type="file" name="img_path" accept="image/*">
                            </div>
                        </div>
                        <label class="form-field form-field--wide">
                            <span>Nova password</span>
                            <input type="password" name="password" autocomplete="new-password"
                                placeholder="Deixa em branco para manter">
                        </label>
                        <label class="form-field form-field--wide">
                            <span>Confirmar password</span>
                            <input type="password" name="password_confirmation" autocomplete="new-password">
                        </label>
                    </div>
                    <div class="form-actions">
                        <button type="button" class="ghost-btn" id="cancelEditProfile">Cancelar</button>
                        <button type="submit" class="primary-btn">Guardar alterações</button>
                    </div>
                </form>

                <div class="card__footer stats">
                    <div class="stat">
                        <p class="label">Inscrições</p>
                        <p class="stat__value">{{ $registrations->count() }}</p>
                    </div>
                    <div class="stat">
                        <p class="label">Próximos eventos</p>
                        <p class="stat__value">{{ $upcomingCount }}</p>
                    </div>
                </div>
            </div>

            <div class="card card--avatar">
                <div class="avatar-large">
                    @if($photoUrl)
                        <img src="{{ $photoUrl }}" alt="{{ $user->name }}">
                    @else
                        <span>{{ strtoupper(substr($user->name ?? 'V', 0, 1)) }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card card--events">
            <div class="card__header">
                <div>
                    <p class="eyebrow_text">As tuas inscrições</p>
                    <h2>Eventos onde estás inscrito</h2>
                </div>
            </div>

            @if($registrations->isEmpty())
                <div class="empty-state">
                    <p>Ainda não tens inscrições.</p>
                    <a class="primary-btn" href="{{ route('eventos') }}">Procurar eventos</a>
                </div>
            @else
                <div class="events-list">
                    @foreach($registrations as $registration)
                        @php
                            $event = $registration->event;
                            if (!$event)
                                continue;
                            $date = strtotime($event->event_date);
                        @endphp
                        <div class="event-card">
                            <div class="event-card__date">
                                <span class="day">{{ date('d', $date) }}</span>
                                <span class="month">{{ strtoupper(date('M', $date)) }}</span>
                            </div>
                            <div class="event-card__body">
                                <div class="event-card__header">
                                    <div>
                                        <p class="eyebrow_text">{{ $event->category->name ?? 'Evento' }}</p>
                                        <h3>{{ $event->title }}</h3>
                                    </div>
                                    <button type="button" class="ghost-btn ghost-btn--danger cancel-trigger"
                                        data-action="{{ route('event-registrations.destroy', $registration) }}">
                                        Cancelar
                                    </button>
                                </div>
                                <p class="muted">{{ $event->location }}</p>
                                <div class="event-card__meta">
                                    <span><i class="ri-time-line"></i> {{ date('H:i', strtotime($event->event_time)) }}</span>
                                    <span><i class="ri-map-pin-line"></i> {{ $event->location }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="modal-overlay" id="cancelModal">
            <div class="modal-box">
                <button class="modal-close" id="closeCancelModal"><i class="ri-close-line"></i></button>
                <h3>Cancelar inscrição</h3>
                <p class="modal-subtitle">Tens a certeza que queres cancelar esta inscrição?</p>
                <form id="cancelForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-actions">
                        <button type="button" class="ghost-btn" id="cancelCancelModal">Manter inscrição</button>
                        <button type="submit" class="primary-btn">Cancelar inscrição</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @section('jslink')
        <script src="{{ asset('js/modal.js') }}"></script>
        <script src="{{ asset('js/profile.js') }}"></script>
    @endsection
@endsection
