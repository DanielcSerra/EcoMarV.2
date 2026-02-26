@extends('_admin.layout')
@section('title', 'Criar Doação')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Doação</h2>
        </div>
    </div>
    @include('_admin.donations.partials.add-edit', [
        'route' => route('admin.donations.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
