@extends('layout.master')

@section('title')
    ecoMar - Sobre Nós
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/sobrenos.css') }}">
@endsection

@section('main')
    <header class="hero">
        <video class="hero__video" autoplay muted loop playsinline>
            <source src="{{ asset('video/video_sobre_nos.mp4') }}" type="video/mp4" />
        </video>
        <div class="hero__overlay"></div>
        <div class="hero__content">
            <p class="hero__eyebrow">
                Inspirada pelo poder do oceano e pelo espírito das comunidades
                costeiras portuguesas
            </p>
            <h1 class="hero__title">SOBRE NÓS</h1>
        </div>
    </header>


    <section class="origins">
        <div class="origins__text">
            <h2>As nossas origens</h2>
            <p>
                A ecoMar começou em 2011, em Peniche, Portugal, quando um grupo de
                mergulhadores, professores e biólogos marinhos decidiu agir perante
                o aumento da poluição marinha e a perda de biodiversidade costeira.
                O que começou como pequenas limpezas de praia tornou-se um movimento
                nacional de conservação e literacia do oceano.
            </p>
            <p>
                Hoje, somos uma associação sem fins lucrativos com projetos que unem
                ciência, educação e ação comunitária em todo o território português
                — das praias da Ericeira às águas do Algarve, das escolas locais às
                universidades.
            </p>
        </div>
        <div class="origins__image-wrapper">
            <img src="{{ asset('img/equipa.jpg') }}" alt="Costa portuguesa" />
        </div>
    </section>

    <section class="mission">
        <video class="mission__video" autoplay muted loop playsinline>
            <source src="{{ asset('video/video_sobre_nos_2.mp4') }}" type="video/mp4" />
        </video>
        <div class="mission__overlay"></div>
        <div class="mission__card">
            <div class="mission__column">
                <p class="mission__label">Missão</p>
                <h3 class="mission__title">
                    Cuidar do oceano através de conhecimento e ação
                </h3>
                <p>
                    Promovemos a preservação marinha com educação ambiental, ciência
                    participativa e campanhas de sensibilização. Trabalhamos com
                    escolas, comunidades piscatórias e empresas para inspirar uma
                    relação sustentável com o mar.
                </p>
            </div>
            <div class="mission__column">
                <p class="mission__label">Visão</p>
                <h3 class="mission__title">
                    Um oceano saudável para as próximas gerações
                </h3>
                <p>
                    Acreditamos num futuro em que o oceano é fonte de vida e
                    equilíbrio, onde as comunidades costeiras prosperam e a
                    biodiversidade marinha é restaurada e protegida.
                </p>
            </div>
        </div>
    </section>

    <section class="story">
        <div class="story__text">
            <h2>Como trabalhamos</h2>
            <p>
                A ecoMar atua em três frentes: conservação costeira, educação
                ambiental e ciência cidadã. Mobilizamos voluntários e comunidades
                locais para recolha de resíduos, monitorização da fauna marinha e
                programas educativos sobre a importância dos ecossistemas oceânicos.
            </p>
            <p>
                O nosso trabalho é colaborativo, acreditamos que só juntos, aliando
                ciência, política e cidadania, conseguiremos regenerar o oceano.
            </p>
        </div>
        <div class="story__image-wrapper">
            <img src="{{ asset('img/lixoapanha.jpg') }}" alt="Costa portuguesa" />
        </div>
    </section>

    <section class="values">
        <div class="values__content">
            <blockquote class="values__quote">
                “Sempre que damos ao oceano tempo e espaço, ele mostra uma
                capacidade extraordinária de regeneração.”
            </blockquote>
            <p class="values__cite">EcoMar Portugal</p>

            <div class="values__cards">
                <div class="values__card values__card--transparency">
                    <img src="{{ asset('img/svg/icon-three.svg') }}" alt="EcoMar símbolo" />
                    <div class="values__divider"></div>
                    <h3>Transparência</h3>
                    <p>
                        Partilhamos resultados e dados de impacto de todas as nossas
                        ações, garantindo confiança e responsabilidade.
                    </p>
                </div>

                <div class="values__card values__card--collab">
                    <img src="{{ asset('img/svg/icon-three.svg') }}" alt="EcoMar símbolo" />
                    <div class="values__divider"></div>
                    <h3>Colaboração</h3>
                    <p>
                        Trabalhamos em rede com escolas, universidades, municípios e
                        ONGs para amplificar o impacto positivo.
                    </p>
                </div>

                <div class="values__card values__card--innovation">
                    <img src="{{ asset('img/svg/icon-three.svg') }}" alt="EcoMar símbolo" />
                    <div class="values__divider"></div>
                    <h3>Inovação</h3>
                    <p>
                        Usamos tecnologia, ciência e criatividade para encontrar
                        soluções sustentáveis e inspirar novas gerações.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="team">
        <div class="team__content">
            <h2>Conhece a nossa equipa</h2>
            <p>
                Educadores, biólogos, mergulhadores, comunicadores e voluntários de
                norte a sul do país dedicam-se diariamente à missão EcoMar.
            </p>
            <a href="{{ route('equipa') }}">
                <button class="team__button">
                    Ver equipa completa
                    <span aria-hidden="true">👥</span>
                </button>
            </a>
        </div>
    </section>

@endsection
