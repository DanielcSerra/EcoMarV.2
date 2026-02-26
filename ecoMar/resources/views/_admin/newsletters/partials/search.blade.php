<form method="GET" action="{{ route('admin.newsletters.index') }}" class="search-form">
    <div class="search-wrapper">
        <i class="ri-search-line search-icon"></i>
        <input type="text" name="search" class="search-input"
            placeholder="Pesquisar por {{ $placeholder ?? 'email...' }}" value="{{ request('search') ?? '' }}">
        @if (request('search'))
            <a href="{{ route('admin.newsletters.index') }}" class="btn ghost small">Limpar</a>
        @endif
    </div>
</form>