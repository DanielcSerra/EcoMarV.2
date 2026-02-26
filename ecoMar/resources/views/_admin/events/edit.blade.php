@extends('_admin.layout')
@section('title', 'Editar Evento')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Evento #{{ $item->id }}</h2>
        </div>
    </div>
    @include('_admin.events.partials.add-edit', [
        'route' => route('admin.events.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
