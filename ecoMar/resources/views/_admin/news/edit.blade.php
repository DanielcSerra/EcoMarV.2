@extends('_admin.layout')

@section('title', 'Editar Notícia')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Notícia #{{ $item->id }}</h2>
        </div>
    </div>

    @include('_admin.news.partials.add-edit', [
        'route' => route('admin.news.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
