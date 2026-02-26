@extends('_admin.layout')
@section('title', 'Editar Newsletter')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Newsletter #{{ $item->id }}</h2>
        </div>
    </div>
    @include('_admin.newsletters.partials.add-edit', [
        'route' => route('admin.newsletters.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
