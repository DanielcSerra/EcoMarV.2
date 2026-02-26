@php
    $userValue = old('user_id', $item->user_id ?? '');
    $newsValue = old('news_id', $item->news_id ?? '');
    $messageValue = old('message', $item->message ?? '');
@endphp

<div class="card form-card">
    <form method="POST" action="{{ $route }}">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-vertical">
            {{-- Selecionar Utilizador --}}
            <div class="form-field">
                <span>Utilizador</span>
                <select name="user_id" required>
                    <option value="">— Selecionar —</option>
                    @foreach ($options['user_id'] ?? [] as $id => $label)
                        <option value="{{ $id }}" @selected($userValue == $id)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('user_id') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- Selecionar Notícia --}}
            <div class="form-field">
                <span>Notícia</span>
                <select name="news_id" required>
                    <option value="">— Selecionar —</option>
                    @foreach ($options['news_id'] ?? [] as $id => $label)
                        <option value="{{ $id }}" @selected($newsValue == $id)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('news_id') <p class="error">{{ $message }}</p> @enderror
            </div>

            {{-- Mensagem do comentário --}}
            <div class="form-field">
                <span>Comentário</span>
                <textarea name="message" rows="4" required maxlength="1000">{{ $messageValue }}</textarea>
                @error('message') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.comments.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
            @if (($method ?? 'POST') !== 'POST' && !empty($item?->id))
                <a class="btn secondary btn-lg" href="{{ route('admin.comments.show', $item->id) }}">
                    <i class="ri-eye-line"></i> Ver
                </a>
            @endif
            <button type="submit" class="btn primary btn-lg">
                Guardar
            </button>
        </div>
    </form>
</div>
