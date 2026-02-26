<div class="card form-card">
    <form method="POST" action="{{ $route }}">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-vertical">
            <div class="form-field">
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email', $item->email ?? '') }}" maxlength="255" required>
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.newsletters.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
            @if (($method ?? 'POST') !== 'POST' && !empty($item?->id))
                <a class="btn secondary btn-lg" href="{{ route('admin.newsletters.show', $item->id) }}">
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
