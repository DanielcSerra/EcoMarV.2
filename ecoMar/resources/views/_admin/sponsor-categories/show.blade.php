@extends('_admin.layout')
@section('title', 'Ver Categoria de patrocinador')
@section('content')

<div class="page-header">
    <div>
        <h2>Categoria de Patrocinador #{{ $item->id }}</h2>
    </div>
</div>

<div class="card detail-card">
    <div class="detail-vertical">
        <div class="detail">
            <p class="overline">ID</p>
            <p>{{ $item->id }}</p>
        </div>
        <div class="detail">
            <p class="overline">Nome</p>
            <p>{{ $item->name }}</p>
        </div>
    </div>
</div>

<div class="form-actions floating-actions">
    <a class="btn ghost btn-lg" href="{{ route('admin.sponsor-categories.index') }}">
        <i class="ri-arrow-left-line"></i> Voltar
    </a>
    <a class="btn secondary btn-lg" href="{{ route('admin.sponsor-categories.edit', $item->id) }}">
        <i class="ri-pencil-line"></i> Editar
    </a>
    <form method="POST" action="{{ route('admin.sponsor-categories.destroy', $item->id) }}" class="confirm-delete">
        @csrf
        @method('DELETE')
        <button class="btn danger btn-lg" type="submit">
            <i class="ri-delete-bin-line"></i> Eliminar
        </button>
    </form>
</div>

@endsection