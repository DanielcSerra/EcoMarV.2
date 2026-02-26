@extends('_admin.layout')

@section('title', $resource['title'] ?? 'Gestão')

@php
    $columns = [];
    foreach ($resource['fields'] ?? [] as $name => $field) {
        if (!empty($field['list'])) {
            $columns[$name] = $field;
        }
    }
@endphp

@section('content')
    <div class="page-header">
        <div>
            <h2>{{ $resource['title'] ?? 'Notícias' }}</h2>
        </div>
        <div class="header-actions">
            <a class="btn primary" href="{{ route('admin.news.create') }}">
                <i class="ri-add-line"></i> Novo
            </a>
        </div>
    </div>

    <div class="card table-card">
        <!-- Search Bar -->
        @include('_admin.news.partials.search', ['placeholder' => 'título, descrição ou autor...'])

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        @foreach ($columns as $name => $field)
                            <th>{{ $field['label'] ?? ucfirst($name) }}</th>
                        @endforeach
                        <th class="align-right">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td class="muted">#{{ $item->id }}</td>

                            @foreach ($columns as $name => $field)
                                @php
                                    $value = data_get($item, $field['display'] ?? $name);
                                    $type = $field['type'] ?? 'text';

                                    if ($value && in_array($type, ['date', 'datetime', 'time'])) {
                                        $format = $type === 'date'
                                            ? 'd/m/Y'
                                            : ($type === 'time' ? 'H:i' : 'd/m/Y H:i');
                                        $value = date($format, strtotime($value));
                                    } elseif ($type === 'checkbox') {
                                        $value = $value ? 'Sim' : 'Não';
                                    } elseif (is_string($value) && strlen($value) > 80) {
                                        $value = substr($value, 0, 80) . '...';
                                    }
                                @endphp

                                <td>{{ $value ?? '—' }}</td>
                            @endforeach

                            <td class="actions align-right">
                                <a class="btn ghost small action-btn" href="{{ route('admin.news.show', $item->id) }}">
                                    <i class="ri-eye-line"></i><span>Ver</span>
                                </a>

                                <a class="btn secondary small action-btn" href="{{ route('admin.news.edit', $item->id) }}">
                                    <i class="ri-pencil-line"></i><span>Editar</span>
                                </a>

                                <form class="inline confirm-delete" method="POST"
                                    action="{{ route('admin.news.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn danger small action-btn">
                                        <i class="ri-delete-bin-line"></i><span>Apagar</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 2 }}" class="muted">
                                Ainda não existem registos.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $items->links() }}
        </div>
    </div>
@endsection