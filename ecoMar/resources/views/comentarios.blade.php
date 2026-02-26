@extends('layout.master')

@section('title')
    ecoMar - {{ $noticia->title }}
@endsection

@section('csslink')
    <link rel="stylesheet" href="{{ asset('css/comentarios.css') }}">
@endsection

@section('main')
    <div class="embrulho-noticia">

        <article class="ecomar-noticia-principal">
            <div class="cabecalho-impacto" style="background-image: url('{{ asset($noticia->img_path) }}')">
                <img src="{{ asset($noticia->img_path) }}" alt="{{ $noticia->title }}">
                <div class="gradiente-visual"></div>
                <div class="informacao-sobreposta">
                    <span class="tag-categoria">{{ $noticia->category->name ?? 'Notícia' }}</span>
                    <h1 class="titulo-noticia">{{ $noticia->title }}</h1>


                </div>
            </div>
        </article>

        <p class="noticia-description">{{ $noticia->description}}</p>

        {{-- COMMENTS PANEL --}}
        <div class="comments-panel">
            <h3>💬 Comments ({{ $comentarios->count() }})</h3>

            @forelse ($comentarios as $comentario)
                <div class="comment">
                    <div class="comment-avatar">
                        {{ strtoupper(substr($comentario->user->name, 0, 2)) }}
                    </div>
                    <div class="comment-content">
                        <div class="comment-header">
                            <span class="comment-author">{{ $comentario->user->name }}</span>
                            <span class="comment-date">{{ $comentario->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="comment-message">{{ $comentario->message }}</p>
                    </div>
                </div>
            @empty
                <p style="color:#777;">No comments yet.</p>
            @endforelse
        </div>

        @auth
            <div class="comment-form-box" id="formulario-comentario">
                <div class="comment-form-header">
                    <div class="comment-avatar big">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <h2>Deixa o teu comentário</h2>
                        <p>Partilha a tua opinião com a comunidade ecoMar 🌊</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('comentarios.store') }}" class="comment-form">
                    @csrf
                    <input type="hidden" name="news_id" value="{{ $noticia->id }}">

                    <textarea name="message" placeholder="Escreve aqui o teu comentário..." required></textarea>

                    <div class="comment-form-actions">
                        <span class="comment-info">Seja respeitoso 💙</span>
                        <button type="submit" class="btn-comment">Publicar comentário</button>
                    </div>
                </form>
            </div>
        @else
            <div class="login-comment-box">
                <div class="login-comment-content">
                    <h3> Quer comentar esta notícia?</h3>
                    <p>Inicia sessão para participar na conversa e juntar-te à comunidade ecoMar.</p>
                </div>

                <a href="{{ route('login') }}">
                    <button class="guest-button">INICIAR SESSÃO</button>
                </a>
            </div>
        @endauth



    </div>
@endsection
