@extends('layout.master')

@section('title')
    ecoMar - Depoimentos
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/voluntarios.css') }}">
@endsection

@section('main')
<section id="hero">
<video playsinline autoplay muted loop>
        <source src="../video/backgroundvideo6.mp4" type="video/mp4">
        Your browser does not support the video tag.
</video>
<div class="flexH">
    <h1>Depoimentos</h1>
    <img src="{{ asset('img/pagesymbol.png') }}" alt="Ícone da página">
</div>
</section>
<section id="depoimentos">
    <h2>Todos os depoimentos de voluntários</h2>

    <div class="depoimentos-container">
        @forelse($testimonies as $testimony)
            <div class="depoimento-card">
                <p>"{{ $testimony->message }}"</p>
                <div class="depoimento-user">
                    <p>-{{ $testimony->user->name ?? 'Erro' }}</p>
                    <img
                        src="{{ $testimony->user->img_path ? asset('storage/' . $testimony->user->img_path) : asset('img/default-pfp.png') }}"
                        alt="{{ $testimony->user->name ?? 'Erro' }}'s profile picture"
                        class="profile-picture"
                    >
                </div>
            </div>
        @empty
            <p>Não há depoimentos ainda.</p>
        @endforelse
    </div>
    <a href="{{ route('voluntarios') }}" class="butao">
    Voltar aos Voluntários
</a>

</section>
@endsection
