@extends('_admin.layout')
@section('title', 'Criar Categoria de Patrocinador')
@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Criar Categoria de Patrocinador</h2>
    </div>
</div>
@include('_admin.sponsor-categories.partials.add-edit', [
'route' => route('admin.sponsor-categories.store'),
'method' => 'POST',
'item' => null,
'resource' => $resource,
'options' => $options ?? [],
])
@endsection