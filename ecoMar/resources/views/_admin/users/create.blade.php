@extends('_admin.layout')
@section('title', 'Criar  Utilizador')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Utilizador</h2>
        </div>
    </div>
    @include('_admin.users.partials.add-edit', [
        'route' => route('admin.users.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
