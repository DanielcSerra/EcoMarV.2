@extends('layout.master')

@section('title')
ecoMar - Contactos
@endsection

@section('csslink')
<link rel="stylesheet" href="{{ asset('css/contactos.css') }}">
@endsection


@section('main')
<header class="hero">
    <video class="hero__video" autoplay muted loop playsinline>
        <source src="{{ asset('video/video_equipa.mp4') }}" type="video/mp4" />
    </video>
    <div class="hero__overlay"></div>
    <div class="hero__content">
        <p class="hero__eyebrow">
            Participa nas nossas ações e faz parte da mudança, juntos podemos proteger o oceano e garantir um futuro
            mais azul!
        </p>
        <h1 class="hero__title">CONTACTOS</h1>
    </div>
</header>

<div class="area1">

    <div class="area1__texto">
        <h1>LOCALIZAÇÃO</h1>
        <p>
            Ficaremos felizes em ouvi-lo! Seja para esclarecer dúvidas, solicitar apoio ou conhecer melhor os nossos
            serviços, a nossa equipa está disponível para ajudar.
        </p>
    </div>

    <div class="area1__localizacao">
        <img src="{{ asset('img/pin.png') }}" alt="Imagem-chefe" />
        <h2>Morada</h2>
        <p>
            Casa do Baleal, Av. <br>do Mar 170, 2520-052
        </p>
    </div>

    <div class="area1__contacto">
        <img src="{{ asset('img/mobile2.png') }}" alt="Imagem-chefe" />
        <h2>Contacto</h2>
        <p>
            244871392
        </p>
        <p>
            EcoMar@gmail.com
        </p>
    </div>

</div>

<div class="area4">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31185.123456789!2d-9.4333!3d39.356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sPeniche%2C%20Portugal!5e0!3m2!1spt-PT!2spt!4v0000000000000!5m2!1spt-PT!2spt"
        width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
<div class="area2">
    <div class="area2__texto">
        <h1>CONTACTA - NOS</h1>
        <p>
            Somos parte do mar
            que protegemos.<br>Cada onda limpa é um passo rumo a um futuro mais azul.
        </p>
    </div>
    <div class="area2__imagem">
        <img src="{{ asset('img/contacto1.png') }}" alt="Imagem1" />
        <img src="{{ asset('img/contacto2.png') }}" alt="Imagem2" />
        <img src="{{ asset('img/contacto3.png') }}" alt="Imagem3" />
    </div>
</div>



<div class="area3" id="formulario-patrocinio">
    <div class="area3_esquerda">
        <h2>CONTACTO</h2>
        <h3>Junta-te a nós.</h3>
        < <form class="area3_formulario" method="POST" action="{{ route('contacts.store') }}">
            @csrf
            <div class="form_row">
                <div class="form_group">
                    <label form="nome">Nome Completo *</label>
                    <input type="text" id="nome" name="name" placeholder="Insira o seu nome" required />
                </div>
                <div class="form_group">
                    <label form="email">Email *</label>
                    <input type="email" id="email" name="email" placeholder="Insira o seu email" required />
                </div>
            </div>

            <div class="form_row_2">
                <div class="form_group">
                    <label form="assunto">Assunto *</label>
                    <input type="text" id="assunto" name="title" placeholder="Indique o assunto" required />
                </div>
            </div>
            <div class="form_mesa">
                <label for="msg">Mensagem *</label>
                <textarea id="msg" name="message"></textarea>
            </div>
            <button type="submit" id="btn-enviar">Enviar</button>
            </form>
    </div>

    <div class="area3_direita">
        <img src="{{ asset('img/Contacto_img.png') }}" alt="Imagem3" />
    </div>
</div>
@endsection