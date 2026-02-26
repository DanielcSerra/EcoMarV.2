@extends('layout.master')

@section('title')
    ecoMar - Sobre Nós
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/maremrisco.css') }}">
@endsection

@section('main')
    <header class="hero">
        <video class="hero__video" autoplay muted loop playsinline>
            <source src="{{ asset('video/video_mar_em_risco.mp4') }}" type="video/mp4" />
        </video>
        <div class="hero__overlay"></div>
        <div class="hero__content">
            <p class="hero__eyebrow">
                Cada vida no oceano sustenta a nossa —
                agir agora é garantir um futuro onde o mar continue a respira
            </p>
            <h1 class="hero__title">MAR EM RISCO</h1>
        </div>
    </header>

    <section class="mar-risco-como-ajudamos">
        <div class="mar-risco-como-ajudamos-texto">
            <h2>Ameaças Que Colocam o Mar em Risco</h2>
            <p>

                Os oceanos enfrentam ameaças crescentes:
                poluição, sobrepesca e perda de biodiversidade
                colocam em risco o equilíbrio marinho e o futuro
                das nossas comunidades.
                É urgente agir para proteger este património vital.
            </p>
            <p>
                Hoje, milhares de espécies marinhas lutam pela sobrevivência,
                enquanto habitats inteiros são destruídos a um ritmo alarmante.
                A acidificação dos mares e o aumento da temperatura
                agravam ainda mais este cenário preocupante.
                Cada ação conta — o futuro dos nossos oceanos está nas nossas mãos.
            </p>
        </div>
        <div class="mar-risco-como-ajudamos_imagem">
            <img src="{{ asset('img/tartaruga-oceanos.jpg') }}" alt="Costa portuguesa" />
        </div>
    </section>
    <section class="cards">
        <h2 class="titulo_cards">Como Ajudamos o Mar</h2>

        <div class="card">
            <img src="{{ asset('img/image_etapas_1.png') }}" alt="Resgate">
            <h3>1º Resgate</h3>
            <p>
                Resgatamos animais feridos, doentes ou em perigo, garantindo cuidados imediatos.
                Sempre que possível, devolvemos cada espécie ao seu habitat natural.
            </p>
            <button>Saiba Mais</button>
        </div>

        <div class="card">
            <img src="{{ asset('img/image_etpas_2.png') }}" alt="Conservação">
            <h3>2º Conservação</h3>
            <p>
                Restauramos habitats marinhos e trabalhamos para recuperar ecossistemas inteiros,
                promovendo a biodiversidade e protegendo espécies vulneráveis.
            </p>
            <button>Saiba Mais</button>
        </div>

        <div class="card">
            <img src="{{ asset('img/3.png') }}"
                alt="Proteção Marinha">
            <h3>3º Proteção</h3>
            <p>
                Atuamos no terreno e na prevenção, garantindo a segurança da vida marinha
                e criando condições para um oceano saudável para as próximas gerações.
            </p>
            <button>Saiba Mais</button>
        </div>
    </section>




@endsection
