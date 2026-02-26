@extends('_admin.layout')
@section('title', 'Editar Patrocinador')
@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Editar Patrocinador #{{ $item->id }}</h2>
    </div>
</div>
@include('_admin.sponsors.partials.add-edit', [
'route' => route('admin.sponsors.update', $item->id),
'method' => 'PUT',
'item' => $item,
'resource' => $resource,
'options' => $options ?? [],
])
@endsection