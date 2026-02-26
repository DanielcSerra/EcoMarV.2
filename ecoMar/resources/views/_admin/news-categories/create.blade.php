@extends('_admin.layout')

@section('title', 'Criar Categoria de Notícia')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Categoria de Notícia</h2>
        </div>
    </div>

    @include('_admin.news-categories.partials.add-edit', [
        'route' => route('admin.news-categories.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
