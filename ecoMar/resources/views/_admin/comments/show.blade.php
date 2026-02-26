@extends('_admin.layout')

@section('title', 'Ver Comentário')

@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>Comentário #{{ $item->id }}</h2>
        </div>
    </div>

    <div class="card detail-card">
        <div class="detail-vertical">
            @foreach (($resource['fields'] ?? []) as $name => $field)
                @continue(isset($field['hide_on_show']) && $field['hide_on_show'])
                @php
                    $value = data_get($item, $field['display'] ?? $name);
                    $type = $field['type'] ?? 'text';

                    // Campos específicos de comentário
                    if ($name === 'user_id') {
                        $value = $item->user->name ?? '—';
                    } elseif ($name === 'news_id') {
                        $value = $item->news->title ?? '—';
                    } elseif ($type === 'checkbox') {
                        $value = $value ? 'Sim' : 'Não';
                    } elseif (is_string($value) && strlen($value) > 80) {
                        $value = substr($value, 0, 80) . '...';
                    }

                    $isImage = false;
                    $src = null;
                @endphp
                <div class="detail">
                    <p class="overline">{{ $field['label'] ?? ucfirst($name) }}</p>
                    <p>{{ $value ?? '—' }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-actions floating-actions">
        <a class="btn ghost btn-lg" href="{{ route('admin.comments.index') }}">
            <i class="ri-arrow-left-line"></i> Voltar
        </a>
        <a class="btn secondary btn-lg" href="{{ route('admin.comments.edit', $item->id) }}">
            <i class="ri-pencil-line"></i> Editar
        </a>
        <form method="POST" action="{{ route('admin.comments.destroy', $item->id) }}" class="confirm-delete">
            @csrf
            @method('DELETE')
            <button class="btn danger btn-lg" type="submit">
                <i class="ri-delete-bin-line"></i> Eliminar
            </button>
        </form>
    </div>
@endsection
