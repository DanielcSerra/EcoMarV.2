@extends('_admin.layout')

@section('title', 'Editar Categoria de Notícia')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Categoria de Notícia #{{ $item->id }}</h2>
        </div>
    </div>

    @include('_admin.news-categories.partials.add-edit', [
        'route' => route('admin.news-categories.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
