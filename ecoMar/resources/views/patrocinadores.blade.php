@extends('layout.master')

@section('title')
ecoMar - Patrocinadores
@endsection

@section('csslink')
<link rel="stylesheet" href="{{ asset('css/patrocinadores.css') }}">
@endsection


@section('main')
<header class="hero">
    <video class="hero__video" autoplay muted loop playsinline>
        <source src="{{ asset('video/video_patrocinadores.mp4') }}" type="video/mp4" />
    </video>
    <div class="hero__overlay"></div>
    <div class="hero__content">
        <p class="hero__eyebrow">
            Com o seu apoio, continuamos a proteger e a restaurar os oceanos!
        </p>
        <h1 class="hero__title">PATROCINADORES</h1>
    </div>
</header>

<section class="team">
    <div class="team__content">
        <h2>Faz te um patrocinador</h2>
        <p>
            Educadores, biólogos, mergulhadores, comunicadores e voluntários de
            norte a sul do país dedicam-se diariamente à missão EcoMar.
        </p>
        <a href="{{ route('patrocinar') }}">
            <button class="team__button">
                Ver formulário
                <span aria-hidden="true">👥</span>
            </button>
        </a>
    </div>
</section>


<div class="patrocinadores_texto">
    <h1>OS NOSSOS PARCEIROS</h1>
</div>



@foreach ($categories as $category)
@if ($category->paginatedSponsors->count())
<h2 class="categoria-titulo">{{ $category->name }}</h2>

<div class="PATROCINADORES" id="section-patrocinadores">
    <div class="patro__princ">
        @foreach ($category->paginatedSponsors as $sponsor)
        <div class="patro__content">
            <div class="patro__Imagem">
                <img src="{{ asset($sponsor->img_path) }}" alt="{{ $sponsor->name }}">
            </div>
            <div class="patro__texto">
                <h1>{{ $sponsor->name }}</h1>
                <p>{{ $sponsor->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endforeach



<div class="patrocinadores_texto2">
    <h1>PRINCIPAIS PARCEIROS</h1>
</div>

<div class="PATROCINADORES__2">
    <div class="patro">
        <div class="patro__main">
            <div class="patro__img">
                <img src="{{ asset('img/patro6.png') }}" alt="Imagem-chefe" />
            </div>
            <div class="patro__texts">
                <h2>SURFRIDER FOUNDATION</h2>
                <h2>Protegendo os oceanos e as praias</h2>
                <p>
                    Dedica-se à proteção das zonas costeiras, promovendo limpezas de praias e educação ambiental
                    para
                    manter os nossos oceanos limpos e saudáveis.
                </p>
                <a href="{{ route('patrocinar') }}#formulario-patrocinio">
                    <button class="doar__button">
                        FAZER PARTE
                        <span aria-hidden="true"></span>
                    </button>
                </a>
            </div>
        </div>

        <div class="doar__spacer"></div>

        <div class="patro__main">
            <div class="patro__img">
                <img src="{{ asset('img/patro7.png') }}" alt="Imagem-chefe" />
            </div>
            <div class="patro__texts">
                <h2>THE OCEAN CLEANUP</h2>
                <h2>Limpeza global dos oceanos</h2>
                <p>
                    Desenvolve tecnologias inovadoras para remover plásticos dos rios e oceanos, combatendo a
                    poluição e
                    protegendo a vida marinha.
                </p>
                <a href="{{ route('patrocinar') }}#formulario-patrocinio">
                    <button class="doar__button">
                        FAZER PARTE
                        <span aria-hidden="true"></span>
                    </button>
                </a>
            </div>
        </div>

        <div class="doar__spacer"></div>

        <div class="patro__main">
            <div class="patro__img">
                <img src="{{ asset('img/patro8.png') }}" alt="Imagem-chefe" />
            </div>
            <div class="patro__texts">
                <h2>NATIONAL GEOGRAPHIC</h2>
                <h2>Conhecimento e conservação</h2>
                <p>
                    Apoia a investigação científica e a educação ambiental, promovendo a compreensão dos oceanos e
                    incentivando a preservação dos ecossistemas marinhos.
                </p>
                <a href="{{ route('patrocinar') }}#formulario-patrocinio">
                    <button class="doar__button">
                        FAZER PARTE
                        <span aria-hidden="true"></span>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection