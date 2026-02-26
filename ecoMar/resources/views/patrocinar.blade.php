@extends('layout.master')

@section('title')
ecoMar - Patrocinar
@endsection

@section('csslink')
<link rel="stylesheet" href="{{ asset('css/patrocinar.css') }}">
@endsection

@section('main')
<section id="patrocinar-hero">
    <video playsinline autoplay muted loop>
        <source src="../video/backgroundvideo7.mp4" type="video/mp4">
    </video>

    <h2 class="patrocinar-subtitle">
        Junte-se à EcoMar como patrocinador e associe a sua marca a um projeto de impacto ambiental real.
    </h2>

    <div class="patrocinar-title">
        <h1>Patrocinar</h1>
        <img src="{{ asset('img/pagesymbol.png') }}" alt="Ícone da página">
    </div>
</section>

<section id="patrocinar-conteudo">
    <div class="patrocinar-bloco">
        <h3>Patrocínio institucional</h3>
        <p>
            O patrocínio institucional da EcoMar fortalece iniciativas ambientais,
            reforça a responsabilidade social corporativa e cria parcerias com impacto positivo e duradouro.
        </p>
    </div>
</section>
<section id="patrocinar-formulario-section">
    <section id="patrocinar-formulario">
        <h2>Formulário de Patrocínio</h2>

        @if(session('success'))
            <div class="form-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('sponsor.submit') }}" method="POST">
            @csrf
            <label for="nome">Nome da Empresa:</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome da empresa" required>

            <label for="email">Email de Contacto:</label>
            <input type="email" id="email" name="email" placeholder="Digite seu email" required>

            <label for="mensagem">Mensagem Adicional:</label>
            <textarea id="mensagem" name="mensagem" rows="4" placeholder="Mensagem opcional"></textarea>

            <button type="submit">Enviar Pedido de Patrocínio</button>
        </form>
    </section>
</section>





@endsection
