@extends('_admin.layout')

@section('title', 'Editar Comentário')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Editar Comentário #{{ $item->id }}</h2>
        </div>
    </div>

    @include('_admin.comments.partials.add-edit', [
        'route' => route('admin.comments.update', $item->id),
        'method' => 'PUT',
        'item' => $item,
        'resource' => $resource,
        'options' => $options,
    ])
@endsection
