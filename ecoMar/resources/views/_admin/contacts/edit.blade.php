@extends('_admin.layout')
@section('title', 'Editar Contacto')
@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Editar Contacto #{{ $item->id }}</h2>
    </div>
</div>
@include('_admin.contacts.partials.add-edit', [
'route' => route('admin.contacts.update', $item->id),
'method' => 'PUT',
'item' => $item,
'resource' => $resource,
'options' => $options ?? [],
])
@endsection