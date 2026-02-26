@extends('_admin.layout')
@section('title', 'Editar Doação')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Doação #{{ $item->id }}</h2>
        </div>
    </div>
    @include('_admin.donations.partials.add-edit', [
        'route' => route('admin.donations.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
