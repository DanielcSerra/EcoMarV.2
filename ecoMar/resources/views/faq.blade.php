@extends('layout.master')

@section('title')
      ecoMar - Perguntas Frequentes
@endsection

@section('csslink')
      <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
@endsection

@section('main')
<section id="hero">
<video playsinline autoplay muted loop>
        <source src="../video/backgroundvideo2.mp4" type="video/mp4">
        Your browser does not support the video tag.
</video>
<div class="flexH">
<h1>Perguntas Frequentes</h1>
<img src="{{ asset('img/FAQsymbol.png') }}" alt=">">
</div>
</section>
<main>
<section id="faqtexto">
  <div class="faq">
    <div class="faqtitulo">
      <h3>1. O que é a ecoMar?</h3>
      <span class="seta">▼</span>
    </div>
    <p>A ecoMar é uma associação sem fins lucrativos dedicada à preservação marinha e à limpeza das zonas costeiras, promovendo educação ambiental e voluntariado ecológico.</p>
  </div>

  <div class="faq">
    <div class="faqtitulo">
      <h3>2. Como posso tornar-me voluntário?</h3>
      <span class="seta">▼</span>
    </div>
    <p>Pode inscrever-se através da página "Voluntários", preenchendo o formulário disponível. A equipa da ecoMar entrará em contacto após análise da inscrição.</p>
  </div>

  <div class="faq">
    <div class="faqtitulo">
      <h3>3. Existe algum custo de participação?</h3>
      <span class="seta">▼</span>
    </div>
    <p>Não. Todas as atividades de voluntariado da ecoMar são gratuitas.</p>
  </div>

  <div class="faq">
    <div class="faqtitulo">
      <h3>4. Os menores podem participar?</h3>
      <span class="seta">▼</span>
    </div>
    <p>Sim, desde que apresentem autorização escrita dos encarregados de educação.</p>
  </div>


  <div class="faq">
    <div class="faqtitulo">
      <h3>5. Que tipo de atividades realiza a ecoMar?</h3>
      <span class="seta">▼</span>
    </div>
    <p>Organizamos ações de limpeza de praias e rios, projetos de reciclagem, campanhas de sensibilização e eventos educativos sobre sustentabilidade ambiental.</p>
  </div>


  <div class="faq">
    <div class="faqtitulo">
      <h3>6. Posso fazer doações?</h3>
      <span class="seta">▼</span>
    </div>
    <p>Sim. Aceitamos donativos monetários e materiais (como luvas, sacos reutilizáveis ou ferramentas de limpeza). Todos os apoios são utilizados exclusivamente para ações ambientais.</p>
  </div>


  <div class="faq">
    <div class="faqtitulo">
      <h3>7. Como são utilizados os donativos?</h3>
      <span class="seta">▼</span>
    </div>
    <p>Os donativos destinam-se à aquisição de materiais de limpeza, apoio logístico, transporte e campanhas educativas.</p>
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
