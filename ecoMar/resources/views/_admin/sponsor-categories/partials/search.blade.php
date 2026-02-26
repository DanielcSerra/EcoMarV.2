<form method="GET" action="{{ route('admin.' . $resourceKey . '.index') }}" class="search-form">
    <div class="search-wrapper">
        <i class="ri-search-line search-icon"></i>
        <input type="text" name="search" class="search-input"
            placeholder="Pesquisar por {{ $placeholder ?? 'nome...' }}" value="{{ $search ?? '' }}">
        @if ($search ?? false)
            <a href="{{ route('admin.' . $resourceKey . '.index') }}" class="btn ghost small">Limpar</a>
        @endif
    </div>
</form>