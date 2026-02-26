<form method="GET" action="{{ route('admin.contacts.index') }}" class="search-form">
    <div class="search-wrapper">
        <i class="ri-search-line search-icon"></i>
        <input type="text" name="search" class="search-input"
            placeholder="Pesquisar por {{ $placeholder ?? 'nome, email ou assunto...' }}"
            value="{{ request('search') ?? '' }}">
        @if (request('search'))
            <a href="{{ route('admin.contacts.index') }}" class="btn ghost small">Limpar</a>
        @endif
    </div>
</form>