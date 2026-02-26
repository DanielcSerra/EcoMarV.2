@extends('_admin.layout')

@section('title', 'Criar Comentário')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Criar Comentário</h2>
        </div>
    </div>

    @include('_admin.comments.partials.add-edit', [
        'route' => route('admin.comments.store'),
        'method' => 'POST',
        'item' => null,
        'resource' => $resource,
        'options' => $options,
    ])
@endsection

