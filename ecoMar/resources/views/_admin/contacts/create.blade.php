@extends('_admin.layout')
@section('title', 'Criar Contacto')
@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Criar Contacto</h2>
    </div>
</div>
@include('_admin.contacts.partials.add-edit', [
'route' => route('admin.contacts.store'),
'method' => 'POST',
'item' => null,
'resource' => $resource,
'options' => $options ?? [],
])
@endsection