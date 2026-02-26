@extends('layout.master')

@section('title')
    ecoMar - Sobre Nós
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/noticias.css') }}">
@endsection

@section('main')
    <!-- HERO VIDEO -->
    <header class="hero">
        <video class="hero__video" autoplay muted loop playsinline>
            <source src="{{ asset('video/video_noticias.mp4') }}" type="video/mp4" />
        </video>
        <div class="hero__overlay"></div>
        <div class="hero__content">
            <p class="hero__eyebrow">
              Fica informado com Eco-Mar News
            </p>
            <h1 class="hero__title">News</h1>
        </div>
    </header>

    <div class="secao-noticias">

        <!-- SEARCH -->
        <form method="GET" action="{{ route('noticias') }}">
            <div class="barra-pesquisa">
                <i>🔍</i>
                <input type="text" name="q" placeholder="Procurar por título, tema..." value="{{ request('q') }}">
                <button type="submit" style="background:none;border:0;cursor:pointer;font-size:1.2rem">
                    ➡️
                </button>
            </div>

            <!-- LAYOUT PRINCIPAL -->
            <div class="layout-noticias">

                <!-- FILTROS LATERAIS -->
                <div class="filtros">
                    <a href="{{ route('noticias') }}" class="limpar-filtros">Clear filters x</a>

                    <!-- Categoria -->
                    <div class="grupo-filtro">
                        <h4 class="titulo-filtro">Categorias Principais</h4>

                        @foreach ($categories as $cat)
                            <label class="radio-custom">
                                <input type="radio" name="categoria" value="{{ $cat->id }}"
                                    onchange="this.form.submit()" {{ request('categoria') == $cat->id ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                {{ $cat->name }}
                            </label>
                        @endforeach
                    </div>


                    <div class="grupo-filtro">
                        <h4 class="titulo-filtro">Autor da Noticia</h4>

                        @foreach ($authors as $auth)
                            <label class="radio-custom">
                                <input type="radio" name="autor" value="{{ $auth->author }}"
                                    onchange="this.form.submit()" {{ request('autor') == $auth->author ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                                {{ $auth->author }}
                            </label>
                        @endforeach
                    </div>

                </div>



                <div class="lista-noticias">

                    @forelse($news as $item)
                        <div class="noticias texto-imagem-subtitulo">
                            <div class="card-noticia">

                                <div class="card-img"
                                    style="background-image:url('{{ asset($item->img_path ?? 'img/default-news.jpg') }}');">
                                </div>

                                <div class="card-badges">
                                    <span class="badge-blue">
                                        {{ strtoupper($item->category->name ?? 'NEWS') }}
                                    </span>
                                    <span class="badge-gray">
                                        {{ strtoupper($item->location ?? 'GLOBAL') }}
                                    </span>
                                </div>

                                <div class="card-conteudo">
                                    <h3 class="card-titulo">{{ $item->title }}</h3>

                                    <p style="margin-top:8px;color:#555;">
                                        {{ Str::limit($item->description, 140) }}
                                    </p>

                                    <div class="card-meta">
                                        {{ \Carbon\Carbon::parse($item->date_upload)->format('d M Y') }},
                                        {{ $item->location }}
                                    </div>

                                    <p class="card-meta">Autor: <b>{{ $item->author }}</b></p>

                                </div>
                                <a href="{{ route('noticias.comentarios', $item->id) }}" class="btn-comentarios">
                                    💬 Ver Comentários
                                </a>

                            </div>
                        </div>

                    @empty
                        <div style="grid-column: 1 / -1; text-align:center; padding:2rem;">
                            <p style="color:#888;">Nenhuma notícia encontrada.</p>
                        </div>
                    @endforelse

                </div>
            </div>
        </form>


        <!-- PAGINAÇÃO -->
        <div class="paginacao">
            {{ $news->withQueryString()->links() }}
        </div>

    </div>
@endsection
