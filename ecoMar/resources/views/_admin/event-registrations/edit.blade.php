@extends('_admin.layout')
@section('title', 'Editar Registo de Evento')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Registo de Evento #{{ $item->id }}</h2>
        </div>
    </div>
    @include('_admin.event-registrations.partials.add-edit', [
        'route' => route('admin.event-registrations.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
