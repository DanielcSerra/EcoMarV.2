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
                    @foreach ($options['user_id'] ?? [] as $id => $label)
                        <option value="{{ $id }}" @selected(old('user_id', $item->user_id ?? '') == $id)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-field">
                <span>Mensagem</span>
                <textarea name="message" rows="5" required minlength="10" maxlength="300">{{ old('message', $item->message ?? '') }}</textarea>
            </div>

        <div class="form-field checkbox-field">
            <span>Aprovado</span>
            <label class="custom-checkbox">
                <input type="checkbox" name="is_approved" value="1"
                    {{ old('is_approved', $item->is_approved ?? false) ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
        </div>

        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.testimonies.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
            <button class="btn primary btn-lg">Guardar</button>
        </div>
    </form>
</div>
