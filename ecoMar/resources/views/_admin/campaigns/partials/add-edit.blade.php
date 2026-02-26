@php
    $imgValue = old('image', $item->image ?? '');
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
                <span>Data de início</span>
                <input type="date" name="date_start" value="{{ old('date_start', isset($item->date_start) ? date('Y-m-d', strtotime($item->date_start)) : '') }}" required>
                @error('date_start') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Data de fim</span>
                <input type="date" name="date_end" value="{{ old('date_end', isset($item->date_end) ? date('Y-m-d', strtotime($item->date_end)) : '') }}" required>
                @error('date_end') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Meta (goal)</span>
                <input type="number" name="goal" value="{{ old('goal', $item->goal ?? '') }}" min="0" step="any" required>
                @error('goal') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Meta atual (goal_current)</span>
                <input type="number" name="goal_current" value="{{ old('goal_current', $item->goal_current ?? '') }}" min="0" step="any" required>
                @error('goal_current') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Grande campanha?</span>
                <input type="checkbox" name="is_large" value="1" {{ old('is_large', $item->is_large ?? false) ? 'checked' : '' }}>
                @error('is_large') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>País</span>
                <input type="text" name="country" value="{{ old('country', $item->country ?? '') }}" maxlength="255" required>
                @error('country') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Imagem</span>
                <div class="image-upload">
                    <input type="hidden" name="remove_image" value="0">
                    <input type="file" name="image" accept="image/*">
                    @if ($imgUrl)
                        <div class="preview-wrapper">
                            <img src="{{ $imgUrl }}" alt="Imagem da campanha" class="preview-img">
                            <button type="button" class="remove-image-chip" aria-label="Remover imagem">×</button>
                        </div>
                    @endif
                </div>
                @error('image') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="form-actions">
            <button class="btn primary" type="submit">Guardar</button>
            <a class="btn ghost" href="{{ route('admin.campaigns.index') }}">Cancelar</a>
        </div>
    </form>
</div>
