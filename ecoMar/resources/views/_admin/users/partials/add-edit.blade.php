@php
    $imgValue = old('img_path', $item->img_path ?? '');
    $imgUrl = null;
    if ($imgValue) {
        $clean = ltrim($imgValue, '/');
        if (str_starts_with($clean, 'storage/')) {
            $clean = substr($clean, 8);
        }
        if (str_starts_with($clean, 'public/')) {
            $clean = substr($clean, 7);
        }
        $imgUrl = str_starts_with($imgValue, 'http') ? $imgValue : asset('storage/' . $clean);
    }
    $typeOptions = $resource['fields']['type']['options'] ?? ['A' => 'Administrador', 'F' => 'Funcionário', 'U' => 'Utilizador'];
@endphp

<div class="card form-card">
    <form method="POST" action="{{ $route }}" enctype="multipart/form-data">
        @csrf
        @if ($method !== 'POST')
            @method($method)
        @endif

        <div class="form-vertical">
            <div class="form-field">
                <span>Nome</span>
                <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}" maxlength="25" required>
                @error('name') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email', $item->email ?? '') }}" maxlength="255"
                    required>
                @error('email') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Telefone</span>
                <input type="text" name="phone" value="{{ old('phone', $item->phone ?? '') }}" maxlength="9"
                    pattern="\d*" inputmode="numeric">
                @error('phone') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Localização</span>
                <input type="text" name="location" value="{{ old('location', $item->location ?? '') }}" maxlength="255">
                @error('location') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Data de nascimento</span>
                <input type="date" name="dob"
                    value="{{ old('dob', isset($item->dob) ? date('Y-m-d', strtotime($item->dob)) : '') }}">
                @error('dob') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Foto de perfil</span>
                <div class="image-upload">
                    <input type="hidden" name="remove_image" value="0">
                    <input type="file" name="img_path" accept="image/*">
                    @if ($imgUrl)
                        <div class="preview-wrapper">
                            <img src="{{ $imgUrl }}" alt="Foto de perfil" class="preview-img">
                            <button type="button" class="remove-image-chip" aria-label="Remover foto">×</button>
                        </div>
                    @endif
                    <p class="muted small">Tamanho máximo: 3 MB.</p>
                </div>
                @error('img_path') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Tipo</span>
                <select name="type" required>
                    @foreach ($typeOptions as $value => $label)
                        <option value="{{ $value }}" @selected(old('type', $item->type ?? 'U') == $value)>{{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('type') <p class="error">{{ $message }}</p> @enderror
            </div>

            <div class="form-field">
                <span>Password</span>
                <input type="password" name="password" minlength="8">
                @if (!empty($item?->id))
                    <p class="muted small">Deixa vazio para manter a password atual.</p>
                @endif
                @error('password') <p class="error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="form-actions floating-actions">
            <a class="btn ghost btn-lg" href="{{ route('admin.users.index') }}">
                <i class="ri-arrow-left-line"></i> Voltar
            </a>
            @if (($method ?? 'POST') !== 'POST' && !empty($item?->id))
                <a class="btn secondary btn-lg" href="{{ route('admin.users.show', $item->id) }}">
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
    (function () {
        const form = document.currentScript.previousElementSibling?.querySelector('form');
        if (!form) return;

        const phoneInput = form.querySelector('input[name="phone"]');
        const fileInput = form.querySelector('input[name="img_path"]');
        const submitBtn = form.querySelector('button[type="submit"]');
        const MAX_PHONE = 9;
        const MAX_IMG_BYTES = 3 * 1024 * 1024;

        if (phoneInput) {
            phoneInput.addEventListener('input', () => {
                phoneInput.value = phoneInput.value.replace(/[^0-9]/g, '').slice(0, MAX_PHONE);
            });
        }

        form.addEventListener('submit', (e) => {
            if (fileInput && fileInput.files[0] && fileInput.files[0].size > MAX_IMG_BYTES) {
                e.preventDefault();
                alert('A imagem deve ter no máximo 3 MB.');
                return;
            }
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'A guardar...';
            }
        });
    })();
</script>
