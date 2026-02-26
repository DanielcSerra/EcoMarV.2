@extends('_admin.layout')
@section('title', 'Criar Patrocinador')
@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Criar Patrocinador</h2>
    </div>
</div>
@include('_admin.sponsors.partials.add-edit', [
'route' => route('admin.sponsors.store'),
'method' => 'POST',
'item' => null,
'resource' => $resource,
'options' => $options ?? [],
])
@endsection