@extends('layout.master')

@section('title')
    ecoMar - Campanhas
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/campanhas.css') }}">
@endsection

@section('main')
<!-- Video Hero -->
<header class="hero">
    <video class="hero__video" autoplay muted loop playsinline>
        <source src="{{ asset('video/events.mp4') }}" type="video/mp4" />
    </video>
    <div class="hero__overlay"></div>
    <div class="hero__content">
        <p class="hero__eyebrow">As nossas campanhas unem pessoas e ideias para proteger o oceano. Juntos, transformamos consciência em ação.</p>
        <h1 class="hero__title">CAMPANHAS</h1>
    </div>
</header>

<!-- World Map Hero -->
<header class="hero-section mt-5">
    <h1 class="hero-title">À VOLTA DO MUNDO</h1>
    <div class="world-map-container">
        <!-- Map markers -->
        <div class="map-marker" style="top: 23%; left: 43%;" onclick="handleMarkerClick('portugal')">
            <div class="marker-pin"></div>
            <div class="marker-pulse"></div>
            <span class="marker-label">Portugal</span>
        </div>
        <div class="map-marker" style="top: 64%; left: 58%;" onclick="handleMarkerClick('mocambique')">
            <div class="marker-pin"></div>
            <div class="marker-pulse"></div>
            <span class="marker-label">Moçambique</span>
        </div>
        <div class="map-marker" style="top: 65%; left: 29%;" onclick="handleMarkerClick('Brasil')">
            <div class="marker-pin"></div>
            <div class="marker-pulse"></div>
            <span class="marker-label">Brasil</span>
        </div>
        <!-- Decorative markers -->
    </div>
</header>


@php
    $countries = $campaigns->pluck('country')->unique()->sort()->values();
    if (!$countries->contains('Brasil')) {
        $countries->push('Brasil');
    }
@endphp
<div class="main-content">
    <div class="campaigns-filter-container">
        <div class="filter-bar">
            <label for="country-filter" class="filter-label">Filtrar por país:</label>
            <select id="country-filter" class="filter-select">
                <option value="">Todos</option>
                @foreach($countries as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="campaigns-container campaigns-grid w-100" style="position:relative;">
        @include('campanhas.cards')
    </div>
    <!-- Footer Button -->
    @if(isset($campaigns) && $campaigns->hasMorePages())
        <button class="btn-see-more" id="see-more-btn" onclick="loadMoreCampaigns()">Ver mais</button>
    @endif
</div>

<!-- GOALS SECTION: Interactive Bottom Section (kept intact) -->
<section class="goals-section">
    <div class="goals-decoration"></div>
    <h4 class="goals-header">METAS GERAIS</h4>

    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-6 col-md-12 goals-left-col">
                <div class="goals-content-wrapper">
                    <div id="goal-text-container" class="goal-text-container">
                        <h2 id="goal-title" class="goal-title">Remover 100 toneladas de lixo marinho até 2030</h2>
                        <p id="goal-description" class="goal-description">
                            A EcoMar compromete-se a intensificar operações de limpeza em zonas costeiras, rios e estuários, com o objetivo de remover 100 toneladas de plástico, redes de pesca e resíduos industriais até ao final da década. Esta meta representa não só uma limpeza física do oceano, mas também uma mudança cultural em direção a práticas mais responsáveis.
                        </p>
                    </div>

                    <div class="goals-dots-container">
                        <div class="goal-dot active" data-index="0" onclick="handleDotClick(0)"></div>
                        <div class="goal-dot" data-index="1" onclick="handleDotClick(1)"></div>
                        <div class="goal-dot" data-index="2" onclick="handleDotClick(2)"></div>
                        <div class="goal-dot" data-index="3" onclick="handleDotClick(3)"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 goals-right-col d-flex flex-column justify-content-center align-items-end">
                <div class="goal-image-wrapper">
                    <img id="goal-image" src="{{ asset('img/equipa.jpg') }}" alt="Goal Image">
                </div>
            </div>
        </div>
    </div>
</section>


@section('jslink')
    <script>
        window.goalsData = [
            {
                title: "Remover 100 toneladas de lixo marinho até 2030",
                description: "A EcoMar compromete-se a intensificar operações de limpeza em zonas costeiras, rios e estuários, com o objetivo de remover 100 toneladas de plástico, redes de pesca e resíduos industriais até ao final da década. Esta meta representa não só uma limpeza física do oceano, mas também uma mudança cultural em direção a práticas mais responsáveis.",
                image: "{{ asset('img/equipa.jpg') }}"
            },
            {
                title: "Educação Ambiental para 20.000 Alunos",
                description: "Acreditamos que o futuro depende da educação. O nosso programa 'Escola Azul' irá levar workshops interativos, visitas de estudo e materiais pedagógicos a mais de 200 escolas, capacitando a próxima geração para tomar decisões conscientes sobre o consumo e a proteção da biodiversidade.",
                image: "{{ asset('img/voluntario.jpg') }}"
            },
            {
                title: "Redução de 50% de Plásticos Únicos",
                description: "Trabalhamos diretamente com parceiros locais, restaurantes e hotéis para substituir embalagens de plástico descartável por alternativas biodegradáveis. A meta é criar zonas livres de plástico em 5 grandes áreas turísticas, reduzindo drasticamente a pegada ecológica do turismo.",
                image: "{{ asset('img/portugal.jpg') }}"
            },
            {
                title: "Restauração de Habitats Marinhos",
                description: "Além da limpeza, focamo-nos na regeneração. Planeamos restaurar 50 hectares de ervas marinhas e recifes de coral em perigo. Estas ações são vitais para o sequestro de carbono e para fornecer abrigo seguro a inúmeras espécies marinhas.",
                image: "{{ asset('img/transparencia.jpg') }}"
            }
        ];

        window.campaignsRoutes = {
            loadMore: "{{ route('campaigns.loadMore') }}"
        };
    </script>
    <script src="{{ asset('js/campanhas.js') }}"></script>
@endsection
@endsection
