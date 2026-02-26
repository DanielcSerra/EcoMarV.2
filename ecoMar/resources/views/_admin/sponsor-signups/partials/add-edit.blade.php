<div class="card form-card">
    <form method="POST" action="{{ $route }}">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-vertical">

            <div class="form-field">
                <span>Nome</span>
                <input type="text" name="nome"
                    value="{{ old('nome', $item->nome ?? '') }}" required>
            </div>

            <div class="form-field">
                <span>Email</span>
                <input type="email" name="email"
                    value="{{ old('email', $item->email ?? '') }}" required>
            </div>

            <div class="form-field">
                <span>Mensagem</span>
                <textarea name="mensagem" rows="5">{{ old('mensagem', $item->mensagem ?? '') }}</textarea>
            </div>

        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.sponsor-signups.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
            <button class="btn primary btn-lg">Guardar</button>
        </div>
    </form>
</div>
