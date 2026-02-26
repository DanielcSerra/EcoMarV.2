<div class="card form-card">
    <form method="POST" action="{{ $route }}">
        @csrf
        @if (($method ?? 'POST') !== 'POST')
        @method($method)
        @endif

        <div class="form-vertical">

            <div class="form-field">
                <span>Nome</span>
                <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" maxlength="255" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email', $item->email ?? '') }}" maxlength="255"
                    required>
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Assunto</span>
                <input type="text" name="title" value="{{ old('title', $item->title ?? '') }}" maxlength="255" required>
                @error('title') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Mensagem</span>
                <textarea name="message" rows="5" required>{{ old('message', $item->message ?? '') }}</textarea>
                @error('message') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.contacts.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>

            @if (($method ?? 'POST') !== 'POST' && !empty($item?->id))
            <a class="btn secondary btn-lg" href="{{ route('admin.contacts.show', $item->id) }}">
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