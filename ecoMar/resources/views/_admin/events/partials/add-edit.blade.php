@php
    $imgValue = old('img_path', $item->img_path ?? '');
    $imgUrl = null;
    if ($imgValue) {
        $clean = ltrim($imgValue, '/');
        if (str_starts_with($clean, 'storage/')) $clean = substr($clean, 8);
        if (str_starts_with($clean, 'public/')) $clean = substr($clean, 7);
        $imgUrl = str_starts_with($imgValue, 'http') ? $imgValue : asset('storage/' . $clean);
    }
@endphp

<div class="card form-card">
    <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-vertical">
            <div class="form-field">
                <span>Título</span>
                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" maxlength="255" required>
                @error('title') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Descrição</span>
                <textarea name="description" rows="4">{{ old('description', $item->description ?? '') }}</textarea>
                @error('description') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Data</span>
                <input type="date" name="event_date" value="{{ old('event_date', isset($item->event_date) ? date('Y-m-d', strtotime($item->event_date)) : '') }}" required>
                @error('event_date') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Hora</span>
                <input type="time" name="event_time" value="{{ old('event_time', $item->event_time ?? '') }}" required>
                @error('event_time') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Local</span>
                <input type="text" name="location" value="{{ old('location', $item->location ?? '') }}" maxlength="255" required>
                @error('location') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Imagem</span>
                <div class="image-upload">
                    <input type="hidden" name="remove_image" value="0">
                    <input type="file" name="img_path" accept="image/*">
                    @if ($imgUrl)
                        <div class="preview-wrapper">
                            <img src="{{ $imgUrl }}" alt="Imagem do evento" class="preview-img">
                        </div>
                    @endif
                    <p class="muted small">Tamanho máximo: 5 MB.</p>
                </div>
                @error('img_path') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Categoria</span>
                <select name="category_id" required>
                    <option value="">— Selecionar —</option>
                    @foreach (($options['category_id'] ?? []) as $id => $label)
                        <option value="{{ $id }}" @selected(old('category_id', $item->category_id ?? '') == $id)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('category_id') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Criado por</span>
                <select name="created_by">
                    <option value="">— Selecionar —</option>
                    @foreach (($options['created_by'] ?? []) as $id => $label)
                        <option value="{{ $id }}" @selected(old('created_by', $item->created_by ?? '') == $id)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('created_by') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.events.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
            @if (($method ?? 'POST') !== 'POST' && !empty($item?->id))
                <a class="btn secondary btn-lg" href="{{ route('admin.events.show', $item->id) }}">
                    <i class="ri-eye-line"></i> Ver
                </a>
            @endif
            <button type="submit" class="btn primary btn-lg">
                Guardar
            </button>
        </div>
    </form>
</div>

<script>
    // Limites simples no frontend para eventos
    (function() {
        const form = document.currentScript.previousElementSibling?.querySelector('form');
        if (!form) return;

        const fileInput = form.querySelector('input[name="img_path"]');
        const submitBtn = form.querySelector('button[type="submit"]');
        const MAX_IMG_BYTES = 5 * 1024 * 1024;

        form.addEventListener('submit', (e) => {
            if (fileInput && fileInput.files[0] && fileInput.files[0].size > MAX_IMG_BYTES) {
                e.preventDefault();
                alert('A imagem deve ter no máximo 5 MB.');
                return;
            }
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'A guardar...';
            }
        });
    })();
</script>
