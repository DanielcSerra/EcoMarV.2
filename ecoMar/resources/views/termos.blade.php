@extends('layout.master')

@section('title')
      ecoMar - Termos e Condições
@endsection

@section('csslink')
      <link rel="stylesheet" href="{{ asset('css/termosstyles.css') }}">
@endsection

@section('main')
<section id="hero">
<video playsinline autoplay muted loop>
        <source src="../video/backgroundvideo1.mp4" type="video/mp4">
        Your browser does not support the video tag.
</video>
<h2>Ao aceder e utilizar este website, o utilizador declara ter lido, compreendido e aceite os presentes Termos e Condições.</h2>
<div class="flexH">
<h1>Termos e Condições</h1>
<img src="{{ asset('img/pagesymbol.png') }}" alt=">">
</div>
</section>
<main>
<section id="termostexto">

  <div class="termo">
    <div class="termotitulo">
      <h3>1. Objetivo</h3>
      <span class="seta">▼</span>
    </div>
    <p>O website da ecoMar tem como finalidade divulgar iniciativas de voluntariado, projetos ambientais e campanhas de sensibilização promovidas pela associação.</p>
  </div>

<div class="termo">
<div class="termotitulo">
<h3>2. Propriedade Intelectual </h3>
<span class="seta">▼</span>
</div>
<p>Todos os conteúdos presentes neste website, incluindo textos, imagens, logótipos, vídeos e outros materiais, são propriedade da ecoMar ou utilizados com autorização dos respetivos titulares.É proibida a reprodução, distribuição, modificação ou utilização destes conteúdos para fins comerciais sem autorização prévia por escrito.</p>
</div>

<div class="termo">
<div class="termotitulo">
<h3>3. Responsabilidade</h3>
<span class="seta">▼</span>
</div>
<p>A ecoMar procura garantir que todas as informações apresentadas são exatas e atualizadas.Contudo, a associação não assume responsabilidade por eventuais erros, omissões ou interrupções no serviço, nem por danos resultantes da utilização do website.</p>
</div>

<div class="termo">
<div class="termotitulo">
<h3>4. Participação em Atividades</h3>
<span class="seta">▼</span>
</div>
<p>A participação em atividades de voluntariado está sujeita à inscrição prévia e aceitação das condições definidas pela ecoMar.Os voluntários comprometem-se a cumprir as normas de segurança, ética e respeito ambiental durante as ações.</p>
</div>

<div class="termo">
<div class="termotitulo">
<h3>5. Proteção de Dados</h3>
<span class="seta">▼</span>
</div>
<p>Os dados pessoais recolhidos são tratados em conformidade com o Regulamento Geral sobre a Proteção de Dados (RGPD) e apenas utilizados para fins diretamente relacionados com as atividades da associação.
</p>
</div>

<div class="termo">
<div class="termotitulo">
<h3>6. Alterações aos Termos</h3>
<span class="seta">▼</span>
</div>
<p>A ecoMar reserva-se o direito de alterar, atualizar ou remover qualquer parte destes Termos e Condições sem aviso prévio. Recomenda-se a consulta regular desta página.
</p>
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
