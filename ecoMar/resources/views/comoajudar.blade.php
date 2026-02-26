@extends('layout.master')

@section('title')
    ecoMar - Como Ajudar
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/comoajudar.css') }}">
@endsection

@section('main')
<header class="hero">
    <video class="hero__video" autoplay muted loop playsinline>
        <source src="{{ asset('video/videocomoajudar.mp4') }}" type="video/mp4" />
    </video>
    <div class="hero__overlay"></div>
    <div class="hero__content">
        <p class="hero__eyebrow">
            A tua ajuda pode transformar o futuro do oceano.
            Descobre aqui todas as formas de apoiar a missão da EcoMar.
        </p>
        <h1 class="hero__title">COMO AJUDAR</h1>
    </div>
</header>

<section class="ajudar">
    <div class="ajudar_text">
        <h2>Junte-se à Missão</h2>
        <p>
            O nosso objetivo é reduzir de forma significativa o lixo plástico nos oceanos dos PALOP, protegendo a vida marinha e preservando praias limpas para todos. Como associação sem fins lucrativos, dependemos do apoio de pessoas como você para levar esta missão mais longe.
        </p>
        <p>
            Pode ajudar de várias formas: participando como voluntário, doando para os nossos projetos, apoiar a nossa loja solidária online, entre outros. Cada ação faz a diferença e contribui para um oceano mais saudável e sustentável.
        </p>
    </div>
    <div class="ajudar_image-wrapper">
        <img src="{{ asset('img/equipa.jpg') }}" alt="Costa portuguesa" />
    </div>

    <div class="ajudar__cta">
        COMO PODES AJUDAR
    </div>
</section>


<div class="doar-wrapper" style="display: none;"></div> <!-- Hidden/Removed old wrapper logic -->

<section id="como-ajudar">
    <!-- Left Column: Navigation & Text -->
    <div class="left-column">
        <!-- Sticky Dots -->
        <div class="sticky-dots-wrapper">
            <div class="dots-container">
                <button class="dot-btn" aria-label="Ver Doações" aria-current="true" onclick="scrollToPanel(0)"></button>
                <button class="dot-btn" aria-label="Ver Voluntariado" aria-current="false" onclick="scrollToPanel(1)"></button>
                <button class="dot-btn" aria-label="Ver Loja" aria-current="false" onclick="scrollToPanel(2)"></button>
                <button class="dot-btn" aria-label="Ver Mar em Perigo" aria-current="false" onclick="scrollToPanel(3)"></button>
            </div>
        </div>

        <!-- Scrollable Panels -->
        <div class="panels-wrapper">
            <!-- Panel 1: Doações -->
            <div class="text-panel active" data-index="0">
                <h2 class="panel-title">DOAÇÕES</h2>
                <p class="panel-text">
                    Cada euro que doas ajuda-nos a remover resíduos do mar, proteger ecossistemas e apoiar o trabalho das nossas equipas no terreno.
                    O teu contributo transforma-se diretamente em ações que salvam o oceano hoje, amanhã e no futuro.
                </p>
                <img src="{{ asset('img/doar.jpg') }}" class="mobile-panel-image" alt="Doações">
                <a href="#" class="btn-ver-mais">DOAR</a>
            </div>

            <!-- Panel 2: Voluntariado -->
            <div class="text-panel" data-index="1">
                <h2 class="panel-title">VOLUNTARIAR</h2>
                <p class="panel-text">
                    Voluntariar-te é participar ativamente na recuperação de praias, rios e ecossistemas.
                    O oceano precisa de pessoas como tu.
                </p>
                <img src="{{ asset('img/voluntario.jpg') }}" class="mobile-panel-image" alt="Voluntariado">
                <a href="#" class="btn-ver-mais">VOLUNTARIAR</a>
            </div>

            <!-- Panel 3: Loja -->
            <div class="text-panel" data-index="2">
                <h2 class="panel-title">LOJA ONLINE</h2>
                <p class="panel-text">
                    Parte dos lucros da loja reverte para limpezas, campanhas e ações educativas.
                    Ajuda o mar enquanto compras algo que gostas.
                </p>
                <img src="{{ asset('img/roupa.png') }}" class="mobile-panel-image" alt="Loja Online">
                <a href="#" class="btn-ver-mais">VER LOJA</a>
            </div>

            <!-- Panel 4: Mar em Perigo -->
            <div class="text-panel" data-index="3">
                <h2 class="panel-title">MAR EM PERIGO</h2>
                <p class="panel-text">
                    Informa-te sobre as espécies marinhas ameaçadas e descobre como o impacto humano está a mudar os oceanos.
                    Proteger começa por compreender.
                </p>
                <img src="{{ asset('img/baleia.jpg') }}" class="mobile-panel-image" alt="Mar em Perigo">
                <a href="#" class="btn-ver-mais">VER PÁGINA</a>
            </div>
        </div>
    </div>

    <!-- Right Column: Sticky Images -->
    <div class="right-column">
        <div class="sticky-image-container">
            <img src="{{ asset('img/doar.jpg') }}" class="bg-image active" alt="Doações" data-index="0">
            <img src="{{ asset('img/voluntario.jpg') }}" class="bg-image" alt="Voluntariado" data-index="1">
            <img src="{{ asset('img/roupa.png') }}" class="bg-image" alt="Loja Online" data-index="2">
            <img src="{{ asset('img/baleia.jpg') }}" class="bg-image" alt="Mar em Perigo" data-index="3">
        </div>
    </div>
</section>


<script src="{{ asset('js/comoajudar.js') }}"></script>
@endsection