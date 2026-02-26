@extends('_admin.layout')
@section('title', 'Criar Newsletter')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Newsletter</h2>
        </div>
    </div>
    @include('_admin.newsletters.partials.add-edit', [
        'route' => route('admin.newsletters.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options ?? [],
    ])
@endsection
