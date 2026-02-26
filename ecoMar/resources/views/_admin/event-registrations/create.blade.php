@extends('_admin.layout')
@section('title', 'Criar Registo de Evento')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Registo de Evento</h2>
        </div>
    </div>
    @include('_admin.event-registrations.partials.add-edit', [
        'route' => route('admin.event-registrations.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
