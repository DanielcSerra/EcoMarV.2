@extends('_admin.layout')
@section('title', 'Editar Campanha')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Campanha #{{ $item->id }}</h2>
        </div>
    </div>
    @include('_admin.campaigns.partials.add-edit', [
        'route' => route('admin.campaigns.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
