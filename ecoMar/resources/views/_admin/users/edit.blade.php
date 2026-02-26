@extends('_admin.layout')
@section('title', 'Editar Utilizador')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Utilizador #{{ $item->id }}</h2>
        </div>
    </div>
    @include('_admin.users.partials.add-edit', [
        'route' => route('admin.users.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
