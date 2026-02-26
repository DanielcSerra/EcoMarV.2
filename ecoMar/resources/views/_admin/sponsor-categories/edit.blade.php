@extends('_admin.layout')
@section('title', 'Editar Categoria de Patrocinador')
@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Editar Categoria de Patrocinador #{{ $item->id }}</h2>
    </div>
</div>
@include('_admin.sponsor-categories.partials.add-edit', [
'route' => route('admin.sponsor-categories.update', $item->id),
'method' => 'PUT',
'item' => $item,
'resource' => $resource,
'options' => $options ?? [],
])
@endsection