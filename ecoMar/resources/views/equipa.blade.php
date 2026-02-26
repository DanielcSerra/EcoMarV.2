@extends('layout.master')

@section('title')
ecoMar - Equipa
@endsection

@section('csslink')
<link rel="stylesheet" href="{{ asset('css/equipa.css') }}">
@endsection

@section('main')
<header class="hero">
    <video class="hero__video" autoplay muted loop playsinline>
        <source src="{{ asset('video/video_equipa.mp4') }}" type="video/mp4" />
    </video>
    <div class="hero__overlay"></div>
    <div class="hero__content">
        <p class="hero__eyebrow">
            Conhece a nossa equipa apaixonada pelo oceano!
        </p>
        <h1 class="hero__title">EQUIPA</h1>
    </div>
</header>

<div class="area1">
    <div class="area1__texto">
        <h1>JOÃO NEVES</h1>
        <h2>Chefe Executivo</h2>
        <p>
            João Neves é o nosso Chefe Executivo desde 2015, liderando com
            dedicação a proteção e conservação dos oceanos.
        </p>
    </div>
    <div class="area1__image">
        <img src="{{ asset('img/Joãoneves.png') }}" alt="Imagem-chefe" />
    </div>
</div>

<div class="area2">
    <h1>CONHECE A NOSSA EQUIPA </h1>
    <section class="cards-container">

        <div class="card">
            <div class="card-image">
                <img src="{{ asset('/img/Claudio.png') }}" alt="Claudio Machado" />
                <div class="card-text">
                    <button>Claudio Machado</button>
                </div>
                <div class="overlay">
                    <h3>Diretor Executivo</h3>
                    <p>Responsável pela visão estratégica da instituição e representação institucional em parcerias e
                        eventos internacionais sobre conservação marinha.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-image">
                <img src="{{ asset('/img/Mariana.png') }}" alt="Imagem 2" />
                <div class="card-text">
                    <button>Mariana Carreira</button>
                </div>
                <div class="overlay">
                    <h3>Diretora de Projetos Ambientais</h3>
                    <p>Lidera todos os projetos ambientais, incluindo iniciativas de limpeza costeira, educação
                        ambiental e campanhas de sustentabilidade.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-image">
                <img src="{{ asset('/img/Ricardo.png') }}" alt="Imagem 3" />
                <div class="card-text">
                    <button>Ricardo Fazeres</button>
                </div>
                <div class="overlay">
                    <h3>Coordenador de Operações de Campo</h3>
                    <p>Gerencia as equipes de voluntários e profissionais em operações de limpeza do mar, logística de
                        equipamentos e segurança.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-image">
                <img src="{{ asset('/img/Diogo.png') }}" alt="Imagem 4" />
                <div class="card-text">
                    <button>Diogo Manteigas</button>
                </div>
                <div class="overlay">
                    <h3>Engenheiro Ambiental</h3>
                    <p>Analisa impactos ambientais, desenvolve soluções sustentáveis e fornece suporte técnico para
                        projetos de conservação marinha.</p>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-image">
                <img src="{{ asset('/img/Jessica.png') }}" alt="Imagem 5" />
                <div class="card-text">
                    <button>Jessica Araujo</button>
                </div>
                <div class="overlay">
                    <h3>Responsável por Educação e Sensibilização</h3>
                    <p>Cria programas educativos e campanhas de sensibilização para escolas, comunidades e empresas,
                        promovendo a preservação dos oceanos.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-image">
                <img src="{{ asset('/img/Tomas.png') }}" alt="Imagem 6" />
                <div class="card-text">
                    <button>Tomás Araujo</button>
                </div>
                <div class="overlay">
                    <h3>Biólogo Marinho</h3>
                    <p>Monitora a fauna e flora marinhas, estuda os impactos da poluição nos ecossistemas e fornece
                        recomendações científicas para orientar ações de conservação.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-image">
                <img src="{{ asset('/img/Nuno.png') }}" alt="Imagem 7" />
                <div class="card-text">
                    <button>Nuno Mendes</button>
                </div>
                <div class="overlay">
                    <h3>Diretor de Operações</h3>
                    <p>Supervisiona e coordena todas as atividades de campo e logísticas da instituição, garantindo que
                        as operações de limpeza e conservação sejam eficientes e seguras.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-image">
                <img src="{{ asset('/img/Maria.png') }}" alt="Imagem 8" />
                <div class="card-text">
                    <button>Maria Dias</button>
                </div>
                <div class="overlay">
                    <h3>Gestora Administrativa e Financeira</h3>
                    <p>Supervisiona finanças, orçamentos, captação de recursos e contratos da instituição, garantindo
                        sustentabilidade financeira e cumprimento de regulamentos.</p>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection