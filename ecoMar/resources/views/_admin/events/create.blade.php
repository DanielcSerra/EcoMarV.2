@extends('_admin.layout')
@section('title', 'Criar Evento')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Evento</h2>
        </div>
    </div>
    @include('_admin.events.partials.add-edit', [
        'route' => route('admin.events.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
