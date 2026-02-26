@extends('layout.master')

@section('title')
    ecoMar - Index
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('main')
<!-- HEADER SECTION (full width, outside container) -->
<div class="header-section">
    <video class="header-bg-video" src="{{ asset('video/headerbackground.mp4') }}" autoplay loop muted playsinline></video>
    <video class="header-intro-video" src="{{ asset('video/ecomarIntro.webm') }}" autoplay muted playsinline></video>
    
    <div class="header-content">
        <h1>Um planeta azul começa<br>com a tua atitude.</h1>
        <button>Ver mais</button>
    </div>
</div>

<!-- CONTENT SECTION (inside container) -->
<section id="eventos">
    <!-- Decorative Side Bars -->
    <div class="decor-bar decor-left"></div>
    <div class="decor-bar decor-right"></div>

    <div class="container">
        <!-- Left Column: Text & Controls -->
        <div class="content-left">
            <h2 class="section-label">EVENTOS</h2>
            
            <div class="text-wrapper-outer">
                <div class="text-wrapper" id="text-content">
                    <h3 class="slide-headline" id="headline">{{ $slides[0]['headline'] }}</h3>
                    <h4 class="slide-mini-title" id="mini-title">{{ $slides[0]['miniTitle'] }}</h4>
                    <p class="slide-description" id="description">{{ $slides[0]['description'] }}</p>
                </div>

                <div class="controls-wrapper">
                    <div class="dots-wrapper" id="dots-container">
                        @foreach($slides as $index => $slide)
                             <button class="dot {{ $index === 0 ? 'active' : '' }}" aria-label="Go to slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <a href="{{ $slides[0]['url'] }}" class="btn-ver-mais" id="action-btn">Ver mais</a>
                </div>
            </div>
        </div>

        <!-- Right Column: Image Filmstrip -->
        <div class="content-right">
            <div class="filmstrip">
                <img src="{{ $slides[count($slides)-1]['image'] }}" alt="Previous" class="card left" id="img-prev">
                <img src="{{ $slides[0]['image'] }}" alt="Current" class="card center" id="img-curr">
                <img src="{{ $slides[1]['image'] }}" alt="Next" class="card right" id="img-next">
            </div>
        </div>
    </div>
</section>

<!-- SOBRE-NOS SECTION (from index2.blade.php) -->
<section id="sobre-nos">
  <div class="sticky-wrapper">
    <div class="content-grid">
      <!-- Left Column -->
      <div class="col-left">
        <h2 class="dynamic-word" id="leftWord">Preservar,</h2>
      </div>
      <!-- Right Column -->
      <div class="col-right">
        <div class="section-header">
          <h1 class="section-title">Sobre-Nós</h1>
          <p class="section-subtitle">
            Somos parte do mar que protegemos.<br>
            Cada onda limpa é um passo rumo a um futuro mais azul.
          </p>
        </div>
        <div class="carousel-container" id="carouselStage">
          <div class="carousel-card" id="card-0">
            <img src="{{ $sobreNosSlides[0]['image'] }}" alt="Transparência">
          </div>
          <div class="carousel-card" id="card-1">
            <img src="{{ $sobreNosSlides[1]['image'] }}" alt="Colaboração">
          </div>
          <div class="carousel-card" id="card-2">
            <img src="{{ $sobreNosSlides[2]['image'] }}" alt="Inovação">
          </div>
        </div>
        <div class="section-footer">
          <p class="description-text" id="descText">
            Loading description...
          </p>
          <div class="controls">
            <div class="dots-wrapper">
              <button class="dot" data-index="0" aria-label="Slide 1"></button>
              <button class="dot" data-index="1" aria-label="Slide 2"></button>
              <button class="dot" data-index="2" aria-label="Slide 3"></button>
            </div>
            <a href="{{ route('sobre-nos') }}" class="btn-main">Ver mais</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- NOTICIAS RECENTES SECTION -->
<section id="noticias-recentes">
    <!-- Left Decoration -->
    <div class="blue-decoration"></div>

    <div class="noticias-container">
        <!-- Header -->
        <h2 class="noticias-title">NOTÍCIAS RECENTES</h2>

        <!-- Main Content Grid -->
        <div class="noticias-content-wrapper">
            
            <!-- 1. Dots Column -->
            <div class="noticias-dots-column" id="newsDotsContainer" role="tablist" aria-label="Navegação de notícias">
                <button class="noticias-dot-btn active" role="tab" aria-selected="true" aria-label="Ver notícia 1" data-index="0"></button>
                <button class="noticias-dot-btn" role="tab" aria-selected="false" aria-label="Ver notícia 2" data-index="1"></button>
                <button class="noticias-dot-btn" role="tab" aria-selected="false" aria-label="Ver notícia 3" data-index="2"></button>
                <button class="noticias-dot-btn" role="tab" aria-selected="false" aria-label="Ver notícia 4" data-index="3"></button>
            </div>

            <!-- 2. Image Column -->
            <div class="noticias-image-column">
                <img id="news-image" src="" alt="News Image">
            </div>

            <!-- 3. Text Column -->
            <div class="noticias-text-column" id="newsTextColumn" aria-live="polite">
                <span class="noticias-pub-date" id="news-date"></span>
                <h3 class="noticias-headline" id="news-headline"></h3>
                <a href="#" class="btn-ver-mais-news" id="news-link">Ver mais</a>
            </div>

        </div>
    </div>
</section>


<!-- COMO AJUDAR SECTION -->
<section id="como-ajudar">
    <!-- LEFT COLUMN -->
    <div class="left-column">
        
        <!-- Sticky Dots Wrapper -->
        <div class="sticky-dots-wrapper">
            <div class="dots-container" id="dots-nav">
                <!-- Dots generated by JS -->
            </div>
        </div>

        <!-- Scrollable Panels -->
        <div class="panels-wrapper" id="panels-container">
            <!-- Panels generated by JS -->
        </div>
    </div>

    <!-- RIGHT COLUMN -->
    <div class="right-column">
        <div class="sticky-image-container" id="image-container">
            <!-- Images generated by JS -->
        </div>
    </div>
</section>

<script>
    window.serverSlides = @json($slides);
    window.serverSobreNos = @json($sobreNosSlides);
    window.serverRecentNews = @json($recentNews);
</script>
<script src="{{ asset('js/index.js') }}"></script>


@endsection

