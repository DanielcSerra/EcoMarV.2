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
                <input type="text" name="title"
                       value="{{ old('title', $item->title ?? '') }}"
                       maxlength="255" required>
                @error('title') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Descrição</span>
                <textarea name="description" rows="4">{{ old('description', $item->description ?? '') }}</textarea>
                @error('description') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Data</span>
                <input type="date" name="date_upload"
                       value="{{ old('date_upload', isset($item->date_upload) ? date('Y-m-d', strtotime($item->date_upload)) : '') }}"
                       required>
                @error('date_upload') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Autor</span>
                <input type="text" name="author"
                       value="{{ old('author', $item->author ?? '') }}"
                       maxlength="255" required>
                @error('author') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Imagem</span>
                <div class="image-upload">
                    <input type="file" name="img_path" accept="image/*">

                    @if ($imgUrl)
                        <div class="preview-wrapper">
                            <img src="{{ $imgUrl }}" alt="Imagem da notícia" class="preview-img">
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
                        <option value="{{ $id }}"
                            @selected(old('category_id', $item->category_id ?? '') == $id)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Criado por</span>
                <select name="user_id">
                    <option value="">— Selecionar —</option>
                    @foreach (($options['user_id'] ?? []) as $id => $label)
                        <option value="{{ $id }}"
                            @selected(old('user_id', $item->user_id ?? '') == $id)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('user_id') <p class="error">{{ $message }}</p> @enderror
            </div>

        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.news.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>

            @if (($method ?? 'POST') !== 'POST' && !empty($item?->id))
                <a class="btn secondary btn-lg" href="{{ route('admin.news.show', $item->id) }}">
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
    // Limites simples no frontend para notícias
    (function () {
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
