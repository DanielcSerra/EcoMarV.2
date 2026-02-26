@extends('_admin.layout')
@section('title', 'Criar Sugestão de Evento')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Sugestão de Evento</h2>
        </div>
    </div>
    @include('_admin.event-suggestions.partials.add-edit', [
        'route' => route('admin.event-suggestions.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
