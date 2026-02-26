@extends('_admin.layout')
@section('title', 'Editar Sugestão de Evento')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Sugestão de Evento #{{ $item->id }}</h2>
        </div>
    </div>
    @include('_admin.event-suggestions.partials.add-edit', [
        'route' => route('admin.event-suggestions.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
