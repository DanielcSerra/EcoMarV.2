@extends('_admin.layout')
@section('title', 'Editar Depoimento')

@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Editar Depoimento #{{ $item->id }}</h2>
    </div>
</div>

@include('_admin.testimonies.partials.add-edit', [
    'route' => $route,
    'method' => $method,
    'item' => $item,
    'options' => $options ?? [],
])
@endsection
