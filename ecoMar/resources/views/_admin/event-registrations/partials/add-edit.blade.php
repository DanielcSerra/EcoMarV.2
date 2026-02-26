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
                <span>Evento</span>
                <select name="event_id" required>
                    <option value="">— Selecionar —</option>
                    @foreach (($options['event_id'] ?? []) as $id => $label)
                        <option value="{{ $id }}" @selected(old('event_id', $item->event_id ?? '') == $id)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('event_id') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.event-registrations.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
            @if (($method ?? 'POST') !== 'POST' && !empty($item?->id))
                <a class="btn secondary btn-lg" href="{{ route('admin.event-registrations.show', $item->id) }}">
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
    // Proteção simples: desativar botão após submit
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
