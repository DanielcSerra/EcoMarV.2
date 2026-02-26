@extends('_admin.layout')

@section('title', 'Criar Notícia')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Notícia</h2>
        </div>
    </div>

    @include('_admin.news.partials.add-edit', [
        'route' => route('admin.news.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
