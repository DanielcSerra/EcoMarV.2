@extends('_admin.layout')
@section('title', 'Ver Patrocinador')
@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Patrocinador #{{ $item->id }}</h2>
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
        if ($name === 'approved_by' && $item->approver) {
        $value = $item->approver->name;
        }
        $src = null;
        if ($isImage && $value) {
        $candidate = ltrim($value, '/');
        if (str_starts_with($candidate, 'storage/')) {
        $candidate = substr($candidate, 8);
        }
        if (str_starts_with($candidate, 'public/')) {
        $candidate = substr($candidate, 7);
        }
        if ($isImage && $value) {
        $filename = basename($value);
        $src = asset('img/' . $filename);
        }
        }
        @endphp
        <div class="detail">
            <p class="overline">{{ $field['label'] ?? ucfirst($name) }}</p>
            @if ($src)
            <img src="{{ $src }}" alt="{{ $field['label'] ?? $name }}" class="preview-img">
            @endif
            @unless ($isImage && $src)
            <p>{{ $value ?? '—' }}</p>
            @endunless
        </div>
        @endforeach
    </div>
</div>
<div class="form-actions floating-actions">
    <a class="btn ghost btn-lg" href="{{ route('admin.sponsors.index') }}">
        <i class="ri-arrow-left-line"></i> Voltar
    </a>
    <a class="btn secondary btn-lg" href="{{ route('admin.sponsors.edit', $item->id) }}">
        <i class="ri-pencil-line"></i> Editar
    </a>
    <form method="POST" action="{{ route('admin.sponsors.destroy', $item->id) }}" class="confirm-delete">
        @csrf
        @method('DELETE')
        <button class="btn danger btn-lg" type="submit">
            <i class="ri-delete-bin-line"></i> Eliminar
        </button>
    </form>
</div>
@endsection