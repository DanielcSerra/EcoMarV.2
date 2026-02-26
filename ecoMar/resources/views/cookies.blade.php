@extends('layout.master')

@section('title')
      ecoMar - Política de Cookies
@endsection

@section('csslink')
      <link rel="stylesheet" href="{{ asset('css/cookies.css') }}">
@endsection

@section('main')
<section id="hero">
<video playsinline autoplay muted loop>
        <source src="../video/backgroundvideo5.mp4" type="video/mp4">
        Your browser does not support the video tag.
</video>
<h2>O website da ecoMar utiliza cookies com o objetivo de melhorar a experiência do utilizador e otimizar o desempenho do site.</h2>
<div class="flexH">
<h1>Política de Cookies</h1>
<img src="{{ asset('img/pagesymbol.png') }}" alt=">">
</div>
</section>
<main>
<section id="politicatexto">

    <div class="bloco-politica">
        <h3>1. O que são cookies?</h3>
        <p>Cookies são pequenos ficheiros de texto armazenados no dispositivo do utilizador, que permitem reconhecer preferências e facilitar a navegação.</p>
    </div>

    <div class="bloco-politica">
        <h3>2. Tipos de cookies utilizados</h3>
        <ul>
            <li>Cookies essenciais: garantem o funcionamento básico do site e não podem ser desativados.</li>
            <li>Cookies analíticos: recolhem dados estatísticos sobre a utilização do site, permitindo melhorar os nossos serviços.</li>
            <li>Cookies funcionais: memorizam preferências, como o idioma ou as opções de sessão.</li>
        </ul>
    </div>

    <div class="bloco-politica">
        <h3>3. Gestão de cookies</h3>
        <p>O utilizador pode, a qualquer momento, configurar o seu navegador para recusar ou eliminar cookies. Contudo, tal ação poderá limitar certas funcionalidades do website.</p>
    </div>

    <div class="bloco-politica destaque">
        <h3>Consentimento</h3>
        <p>Ao continuar a navegar no site da ecoMar, o utilizador declara consentir com a utilização de cookies conforme descrito nesta Política.</p>
    </div>

</section>
<div class="spacer">
<video playsinline autoplay muted loop>
        <source src="../video/backgroundvideo5.mp4" type="video/mp4">
        Your browser does not support the video tag.
</video>
</div>
</main>
@endsection
