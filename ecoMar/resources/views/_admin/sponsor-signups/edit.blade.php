@extends('_admin.layout')

@section('title', 'Editar Pedido de Patrocínio')

@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Editar Pedido #{{ $item->id }}</h2>
    </div>
</div>

@include('_admin.sponsor-signups.partials.add-edit', [
    'route' => $route,
    'method' => $method,
    'item' => $item,
])
@endsection
