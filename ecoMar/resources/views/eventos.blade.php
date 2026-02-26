@extends('layout.master')

@section('title')
    ecoMar - Eventos
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/eventos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('main')
    <header class="hero">
        <video class="hero__video" autoplay muted loop playsinline>
            <source src="{{ asset('video/events.mp4') }}" type="video/mp4" />
        </video>
        <div class="hero__overlay"></div>
        <div class="hero__content">
            <p class="hero__eyebrow">
                Participa nas nossas ações e ajuda a proteger o oceano
            </p>
            <h1 class="hero__title">EVENTOS</h1>
        </div>
    </header>

    <div class="eventos-container">
        @if($upcomingEvents->isNotEmpty())
            <section class="section-proximos">
                <h2 class="eventos__titulo">PRÓXIMOS</h2>
                <div class="eventos-grid eventos-grid--2">
                    @foreach($upcomingEvents as $event)
                        @php
                            $imgSrc = null;
                            if ($event->img_path) {
                                $candidate = ltrim($event->img_path, '/');
                                if (str_starts_with($candidate, 'storage/')) {
                                    $candidate = substr($candidate, 8);
                                }
                                if (str_starts_with($candidate, 'public/')) {
                                    $candidate = substr($candidate, 7);
                                }
                                if (filter_var($event->img_path, FILTER_VALIDATE_URL)) {
                                    $imgSrc = $event->img_path;
                                } elseif (Storage::disk('public')->exists($candidate)) {
                                    $imgSrc = asset('storage/' . $candidate);
                                }
                            }
                        @endphp
                        <div class="evento-card evento-card--upcoming" tabindex="0">
                            <div class="evento-card__image">
                                @if($imgSrc)
                                    <img src="{{ $imgSrc }}" alt="{{ $event->title }}">
                                @endif
                                <div class="evento-card__date">
                                    <span class="date-day">{{ date('d', strtotime($event->event_date)) }}</span>
                                    <span class="date-month">{{ strtoupper(date('M', strtotime($event->event_date))) }}</span>
                                </div>
                                <div class="evento-card__category">{{ $event->category->name ?? 'Evento' }}</div>
                            </div>
                            <div class="evento-card__body">
                                <div class="evento-card__title">{{ $event->title }}</div>
                                <div class="evento-card__details">
                                    <div class="evento-card__description">{{ $event->description }}</div>
                                    <div class="evento-card__meta">
                                        <div class="meta-item"><i class="ri-calendar-line"></i>
                                            {{ date('d/m/Y', strtotime($event->event_date)) }}</div>
                                        <div class="meta-item"><i class="ri-time-line"></i>
                                            {{ date('H:i', strtotime($event->event_time)) }}</div>
                                        <div class="meta-item"><i class="ri-map-pin-line"></i> {{ $event->location }}</div>
                                    </div>
                                    <div class="evento-card__voluntarios">Voluntários: <b>{{ $event->registrations_count }}</b>
                                    </div>
                                    <div class="evento-card__footer">
                                        @guest
                                            <a href="{{ route('register') }}" class="btn btn-primary">Iniciar sessão<i
                                                    class="ri-arrow-right-line"></i></a>
                                        @else
                                            @php
                                                $userRegistration = $event->relationLoaded('registrations')
                                                    ? $event->registrations->first()
                                                    : null;
                                            @endphp
                                            @if($userRegistration)
                                                <button class="btn btn-inscrito" disabled>Inscrito</button>
                                            @else
                                                <form method="POST" action="{{ route('event-registrations.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                    <button type="submit" class="btn btn-primary">Inscrever<i
                                                            class="ri-arrow-right-line"></i></button>
                                                </form>
                                            @endif
                                        @endguest
                                    </div>
                                </div>
                                <div class="evento-card__hint">Passe o rato ou toque para ver detalhes</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section id="section-agenda" class="section-agenda">
            <div class="section-subtitle">PRÓXIMAS AÇÕES</div>
            <h2 class="eventos__agenda-titulo">AGENDA</h2>
            <p style="margin-bottom:2rem;color:#666;font-size:0.95rem;">Participa presencialmente ou online. Cada presença
                conta para proteger o oceano.</p>

            <section class="section-filtros">
                <form class="filtros-container" method="GET" action="{{ route('eventos') }}#section-agenda"
                    id="filtrosForm">
                    <div class="filtros-title">
                        <i class="ri-filter-3-line"></i>
                        <span>Filtrar eventos</span>
                    </div>
                    <div class="filtro-search">
                        <i class="ri-search-line"></i>
                        <input type="text" name="q" placeholder="Procurar por título, ..." value="{{ request('q') }}">
                    </div>
                    <div class="filtro-select">
                        <label for="tema"><i class="ri-bookmark-line"></i> Categoria</label>
                        <select name="tema" id="tema">
                            <option value="">Todos</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('tema') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="filtro-select">
                        <label for="localizacao"><i class="ri-compass-3-line"></i> Localização</label>
                        <select name="localizacao" id="localizacao">
                            <option value="">Todas</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->location }}" {{ request('localizacao') == $location->location ? 'selected' : '' }}>
                                    {{ $location->location }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </section>

            <script>
                document.getElementById('tema').addEventListener('change', function () {
                    document.getElementById('filtrosForm').submit();
                });
                document.getElementById('localizacao').addEventListener('change', function () {
                    document.getElementById('filtrosForm').submit();
                });
            </script>
            <div class="eventos-grid eventos-grid--3">
                @forelse($events as $event)
                    @php
                        $imgSrc = null;
                        if ($event->img_path) {
                            $candidate = ltrim($event->img_path, '/');
                            if (str_starts_with($candidate, 'storage/')) {
                                $candidate = substr($candidate, 8);
                            }
                            if (str_starts_with($candidate, 'public/')) {
                                $candidate = substr($candidate, 7);
                            }
                            if (filter_var($event->img_path, FILTER_VALIDATE_URL)) {
                                $imgSrc = $event->img_path;
                            } elseif (Storage::disk('public')->exists($candidate)) {
                                $imgSrc = asset('storage/' . $candidate);
                            }
                        }
                    @endphp
                    <div class="evento-card">
                        <div class="evento-card__image">
                            @if($imgSrc)
                                <img src="{{ $imgSrc }}" alt="{{ $event->title }}">
                            @endif
                            <div class="evento-card__date">
                                <span class="date-day">{{ date('d', strtotime($event->event_date)) }}</span>
                                <span class="date-month">{{ strtoupper(date('M', strtotime($event->event_date))) }}</span>
                            </div>
                            <div class="evento-card__category">{{ $event->category->name ?? 'Evento' }}</div>
                        </div>
                        <div class="evento-card__body">
                            <div class="evento-card__title">{{ $event->title }}</div>
                            <div class="evento-card__description">{{ $event->description }}</div>
                            <div class="evento-card__meta">
                                <div class="meta-item"><i class="ri-calendar-line"></i>
                                    {{ date('d/m/Y', strtotime($event->event_date)) }}</div>
                                <div class="meta-item"><i class="ri-time-line"></i>
                                    {{ date('H:i', strtotime($event->event_time)) }}</div>
                                <div class="meta-item"><i class="ri-map-pin-line"></i> {{ $event->location }}</div>
                            </div>
                            <div class="evento-card__voluntarios">Voluntários: <b>{{ $event->registrations_count }}</b></div>
                            <div class="evento-card__footer">
                                @guest
                                    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sessão<i
                                            class="ri-arrow-right-line"></i></a>
                                @else
                                    @php
                                        $userRegistration = $event->relationLoaded('registrations')
                                            ? $event->registrations->first()
                                            : null;
                                    @endphp
                                    @if($userRegistration)
                                        <button class="btn btn-inscrito" disabled>Inscrito</button>
                                    @else
                                        <form method="POST" action="{{ route('event-registrations.store') }}">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                            <button type="submit" class="btn btn-primary">Inscrever<i
                                                    class="ri-arrow-right-line"></i></button>
                                        </form>
                                    @endif
                                @endguest
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem; color: #888;">
                        <p style="font-size: 1.1rem;">Nenhum evento encontrado.</p>
                    </div>
                @endforelse
            </div>
        </section>

        @if($events->lastPage() > 1)
            <div class="pagination">
                <div class="page-numbers">
                    @if ($events->onFirstPage())
                        <span class="page-number" style="cursor:not-allowed;opacity:0.4;color:#999;">Anterior</span>
                    @else
                        <a href="{{ $events->previousPageUrl() }}#section-agenda" class="page-number">Anterior</a>
                    @endif

                    @for ($i = 1; $i <= $events->lastPage(); $i++)
                        @if ($i == $events->currentPage())
                            <span class="page-number active">{{ $i }}</span>
                        @else
                            <a href="{{ $events->url($i) }}#section-agenda" class="page-number">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($events->hasMorePages())
                        <a href="{{ $events->nextPageUrl() }}#section-agenda" class="page-number">Próxima</a>
                    @else
                        <span class="page-number" style="cursor:not-allowed;opacity:0.4;color:#999;">Próxima</span>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <section class="section-sugestao">
        <div class="sugestao-container">
            <div class="sugestao-card">
                <div>
                    <p class="sugestao-eyebrow">Participa nos eventos</p>
                    <h3 class="sugestao-title">Queres sugerir um evento ecoMar?</h3>
                    <p class="sugestao-subtitle">Propõe uma ação ou localização onde os nossos voluntários podem ajudar.</p>
                </div>
                <div class="sugestao-actions">
                    @guest
                        <a class="btn btn-outline-light" href="{{ route('login') }}">Iniciar sessão</a>
                    @else
                        <button class="btn btn-light" id="openSugestaoModal">Submeter proposta</button>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    @auth
        <div class="modal-overlay" id="sugestaoModal">
            <div class="modal-box">
                <button class="modal-close" id="closeSugestaoModal"><i class="ri-close-line"></i></button>
                <h3>Submeter proposta</h3>
                <p class="modal-subtitle">Sugere um título e descreve o evento que gostarias de ver acontecer.</p>
                <form method="POST" action="{{ route('event-suggestions.store') }}">
                    @csrf
                    <label for="sugestao-title">Título</label>
                    <input id="sugestao-title" type="text" name="title" required
                        placeholder="Ex: Limpeza de praia em Matosinhos">

                    <label for="sugestao-description">Descrição</label>
                    <textarea id="sugestao-description" name="description" rows="4" required
                        placeholder="Fala-nos sobre o local, data sugerida e necessidades."></textarea>

                    <div class="modal-actions">
                        <button type="button" class="btn btn-outline-light" id="cancelSugestaoModal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Enviar sugestão</button>
                    </div>
                </form>
            </div>
        </div>

        @section('jslink')
            <script src="{{ asset('js/modal.js') }}"></script>
        @endsection
    @endauth
@endsection
