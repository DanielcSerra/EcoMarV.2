@extends('_admin.layout')
@section('title', 'Criar Categoria de Evento')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Categoria de Evento</h2>
        </div>
    </div>
    @include('_admin.event-categories.partials.add-edit', [
        'route' => route('admin.event-categories.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
