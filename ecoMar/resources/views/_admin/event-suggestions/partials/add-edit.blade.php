<div class="card form-card">
    <form method="POST" action="{{ $route }}">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-vertical">
            <div class="form-field">
                <span>Utilizador</span>
                <select name="user_id" required>
                    <option value="">— Selecionar —</option>
                    @foreach (($options['user_id'] ?? []) as $id => $label)
                        <option value="{{ $id }}" @selected(old('user_id', $item->user_id ?? '') == $id)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('user_id') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Título</span>
                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" maxlength="255" required>
                @error('title') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Descrição</span>
                <textarea name="description" rows="4" required>{{ old('description', $item->description ?? '') }}</textarea>
                @error('description') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.event-suggestions.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
            @if (($method ?? 'POST') !== 'POST' && !empty($item?->id))
                <a class="btn secondary btn-lg" href="{{ route('admin.event-suggestions.show', $item->id) }}">
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
    (function() {
        const form = document.currentScript.previousElementSibling?.querySelector('form');
        if (!form) return;
        const submitBtn = form.querySelector('button[type="submit"]');
        form.addEventListener('submit', () => {
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'A guardar...';
            }
        });
    })();
</script>
