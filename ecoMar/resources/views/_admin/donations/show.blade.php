@extends('_admin.layout')
@section('title', 'Ver Doação')
@section('content')
    <div class="page-header">
        <div>
            <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
            <h2>{{ $resource['title'] ?? 'Donativo' }} #{{ $item->id }}</h2>
        </div>

    </div>
    <div class="card detail-card">
        <div class="detail-vertical">
            @foreach (($resource['fields'] ?? []) as $name => $field)
                @continue(isset($field['hide_on_show']) && $field['hide_on_show'])
                @php
                    $value = data_get($item, $field['display'] ?? $name);
                    $type = $field['type'] ?? 'text';
                    $isImage = str_contains($name, 'img') || str_contains($name, 'image');
                    if ($value && in_array($type, ['date', 'datetime', 'time'])) {
                        $format = $type === 'date' ? 'd/m/Y' : ($type === 'time' ? 'H:i' : 'd/m/Y H:i');
                        $value = date($format, strtotime($value));
                    } elseif ($type === 'checkbox') {
                        $value = $value ? 'Sim' : 'Não';
                    }
                    $src = null;
                    if ($isImage && $value) {
                        $clean = ltrim($value, '/');
                        if (str_starts_with($clean, 'storage/'))
                            $clean = substr($clean, 8);
                        if (str_starts_with($clean, 'public/'))
                            $clean = substr($clean, 7);
                        $src = filter_var($value, FILTER_VALIDATE_URL) ? $value : asset('storage/' . $clean);
                    }
                @endphp
                <div class="detail">
                    <p class="overline">{{ $field['label'] ?? ucfirst($name) }}</p>
                    @if ($src)
                        <img src="{{ $src }}" alt="{{ $field['label'] ?? $name }}" class="preview-img">
                    @endif
                    <p>{{ $value ?? '—' }}</p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-actions floating-actions">
        <a class="btn ghost btn-lg" href="{{ route('admin.donations.index') }}">
            <i class="ri-arrow-left-line"></i> Voltar
        </a>
        <a class="btn secondary btn-lg" href="{{ route('admin.donations.edit', $item->id) }}">
            <i class="ri-pencil-line"></i> Editar
        </a>
        <form method="POST" action="{{ route('admin.donations.destroy', $item->id) }}" class="confirm-delete">
            @csrf
            @method('DELETE')
            <button class="btn danger btn-lg" type="submit">
                <i class="ri-delete-bin-line"></i> Eliminar
            </button>
        </form>
    </div>
@endsection
