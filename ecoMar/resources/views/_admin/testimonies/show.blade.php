@extends('_admin.layout')
@section('title', 'Ver Depoimento')

@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Depoimento #{{ $item->id }}</h2>
    </div>
</div>

<div class="card detail-card">
    <div class="detail-vertical">
        @foreach ($resource['fields'] as $name => $field)
        @php
            $value = data_get($item, $field['display'] ?? $name);
            if (($field['type'] ?? '') === 'checkbox') {
                $value = $value ? 'Sim' : 'Não';
            }
            if (($field['type'] ?? '') === 'datetime' && $value) {
                $value = date('d/m/Y H:i', strtotime($value));
            }
        @endphp
        <div class="detail">
            <p class="overline">{{ $field['label'] }}</p>
            <p>{{ $value ?? '—' }}</p>
        </div>
        @endforeach
    </div>
</div>

<div class="form-actions floating-actions">
    <a class="btn ghost btn-lg" href="{{ route('admin.testimonies.index') }}">
        <i class="ri-arrow-left-line"></i> Voltar
    </a>
    <a class="btn secondary btn-lg" href="{{ route('admin.testimonies.edit', $item->id) }}">
        <i class="ri-pencil-line"></i> Editar
    </a>
    <form method="POST" action="{{ route('admin.testimonies.destroy', $item->id) }}" class="confirm-delete">
        @csrf
        @method('DELETE')
        <button class="btn danger btn-lg">
            <i class="ri-delete-bin-line"></i> Eliminar
        </button>
    </form>
</div>
@endsection
