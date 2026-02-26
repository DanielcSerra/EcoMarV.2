<form class="search-form" method="GET" action="{{ route('admin.sponsor-signups.index') }}">
    <div class="search-wrapper">
        <i class="ri-search-line search-icon"></i>
        <input type="text" name="search" class="search-input" placeholder="Pesquisar por nome, email ou mensagem..."
            value="{{ request('search') }}">
        @if (request('search'))
            <a href="{{ route('admin.sponsor-signups.index') }}" class="search-clear">
                <i class="ri-close-line"></i>
            </a>
        @endif
    </div>
</form>