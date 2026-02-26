<div class="card form-card">
    <form method="POST" action="{{ $route }}">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-vertical">
            <div class="form-field">
                <span>Nome</span>
                <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" maxlength="100" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.news-categories.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
            @if (($method ?? 'POST') !== 'POST' && !empty($item?->id))
                <a class="btn secondary btn-lg" href="{{ route('admin.news-categories.show', $item->id) }}">
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
