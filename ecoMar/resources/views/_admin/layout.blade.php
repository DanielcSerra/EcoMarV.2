<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EcoMar Admin')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Manrope:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <script>
        (() => {
            try {
                const saved = localStorage.getItem('admin-theme');
                if (saved === 'dark') {
                    document.documentElement.classList.add('theme-dark');
                }
            } catch (e) { }
        })();
    </script>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    @stack('head')
</head>

<body class="admin-body sidebar-expanded">
    @php
        $authUser = auth()->user();
        $avatarUrl = null;
        if ($authUser && $authUser->img_path) {
            $candidate = ltrim($authUser->img_path, '/');
            if (str_starts_with($candidate, 'storage/')) {
                $candidate = substr($candidate, 8);
            }
            if (str_starts_with($candidate, 'public/')) {
                $candidate = substr($candidate, 7);
            }
            $avatarUrl = filter_var($authUser->img_path, FILTER_VALIDATE_URL)
                ? $authUser->img_path
                : asset('storage/' . $candidate);
        }
        $nameForInitial = $authUser->name ?? 'A';
        $userInitial = substr($nameForInitial, 0, 1);
    @endphp
    <div class="admin-grid">
        <aside class="admin-sidebar">
            <div class="brand">
                <a href="{{ route('admin.dashboard') }}" class="brand-icon plain-logo">
                    <img src="{{ asset('img/svg/logo-admin.svg') }}" alt="EcoMar logo">
                </a>
            </div>
            <button class="theme-toggle" type="button" id="themeToggle" aria-label="Alternar modo">
                <i class="ri-sun-line light-icon"></i>
                <i class="ri-moon-line dark-icon"></i>
                <span>Modo</span>
            </button>
            <nav class="nav">
                @foreach ($adminNavGroups ?? [] as $group)
                    @php $slugTitle = \Illuminate\Support\Str::slug($group['title']); @endphp
                    <div class="nav-group {{ $slugTitle === 'geral' ? 'general' : '' }}" data-group="{{ $slugTitle }}">
                        @unless ($slugTitle === 'geral')
                            <button class="nav-group-header">
                                <span>{{ $group['title'] }}</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </button>
                        @endunless
                        <div class="nav-group-items">
                            @foreach ($group['items'] as $item)
                                @php
                                    $isDashboard = $item['slug'] === 'dashboard';
                                    $url = $isDashboard ? route('admin.dashboard') : route('admin.' . $item['slug'] . '.index');
                                    $active = $isDashboard
                                        ? request()->routeIs('admin.dashboard')
                                        : request()->routeIs('admin.' . $item['slug'] . '.*');
                                @endphp
                                <a href="{{ $url }}" class="nav-link {{ $active ? 'active' : '' }}"
                                    data-label="{{ $item['title'] }}">
                                    <i class="{{ $item['icon'] }}"></i>
                                    <span class="nav-text">{{ $item['title'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>
            <div class="sidebar-profile">
                <div class="profile-avatar">
                    @if ($avatarUrl)
                        <img src="{{ $avatarUrl }}" alt="{{ $authUser->name ?? 'Perfil' }}">
                    @else
                        {{ $userInitial }}
                    @endif
                </div>
                <div class="profile-text">
                    <strong>{{ $authUser->name ?? 'Admin' }}</strong>
                    <p>{{ $authUser->email ?? '' }}</p>
                </div>
            </div>
            <div class="nav-footer">
                <a class="nav-link subtle" href="{{ url('/') }}">
                    <i class="ri-arrow-left-line"></i>
                    <span class="nav-text">Voltar ao site</span>
                </a>
            </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <div>

                </div>
                <div></div>
            </header>

            <div class="toast-container" id="toastContainer">
                @if (session('status'))
                    <div class="toast success" data-autohide="true">
                        <i class="ri-check-line"></i>
                        <div>
                            <strong>Sucesso</strong>
                            <p>{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="toast error" data-autohide="false">
                        <i class="ri-error-warning-line"></i>
                        <div>
                            <strong>Verifica os dados</strong>
                            <p>{{ $errors->first() }}</p>
                        </div>
                        <button class="toast-close" aria-label="Fechar">&times;</button>
                    </div>
                @endif
            </div>

            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>

    <div class="modal-overlay" id="adminDeleteModal">
        <div class="modal-box">
            <button class="modal-close" type="button" id="adminDeleteClose">&times;</button>
            <h3>Confirmar eliminação</h3>
            <p class="modal-subtitle">Esta ação não pode ser desfeita. Queres mesmo eliminar?</p>
            <div class="modal-actions">
                <button class="btn ghost" type="button" id="adminDeleteCancel">Cancelar</button>
                <button class="btn danger" type="button" id="adminDeleteConfirm">Eliminar</button>
            </div>
        </div>
    </div>
    @stack('scripts')
    <script>
        const bodyEl = document.body;
        const themeBtn = document.getElementById('themeToggle');
        const savedTheme = localStorage.getItem('admin-theme');
        if (savedTheme === 'dark') {
            bodyEl.classList.add('theme-dark');
            document.documentElement.classList.add('theme-dark');
        }
        themeBtn?.addEventListener('click', () => {
            const isDark = bodyEl.classList.toggle('theme-dark');
            document.documentElement.classList.toggle('theme-dark', isDark);
            localStorage.setItem('admin-theme', isDark ? 'dark' : 'light');
            if (typeof window.renderDashboardCharts === 'function') {
                window.renderDashboardCharts();
            }
        });

        // Abrir/fechar grupos do menu (apenas clique)
        document.querySelectorAll('.nav-group').forEach((group) => {
            const header = group.querySelector('.nav-group-header');
            if (group.classList.contains('general')) return;
            group.classList.add('collapsed');
            header?.addEventListener('click', (e) => {
                e.preventDefault();
                group.classList.toggle('collapsed');
            });
        });

        // Toasts: fechar e autohide
        document.querySelectorAll('.toast[data-autohide="true"]').forEach((toast) => {
            setTimeout(() => toast.remove(), 2000);
        });
        document.querySelectorAll('.toast.error').forEach((toast) => {
            setTimeout(() => toast.remove(), 3000);
        });
        document.querySelectorAll('.toast-close').forEach((btn) => {
            btn.addEventListener('click', (e) => e.currentTarget.closest('.toast')?.remove());
        });

        // Remover imagem com chip
        document.querySelectorAll('.remove-image-chip').forEach((btn) => {
            btn.addEventListener('click', () => {
                const wrap = btn.closest('.image-upload');
                const hidden = wrap?.querySelector('input[name="remove_image"]');
                const preview = btn.closest('.preview-wrapper');
                const active = btn.classList.toggle('active');
                if (hidden) hidden.value = active ? 1 : 0;
                preview?.classList.toggle('marked-remove', active);
            });
        });

        // Ordenar tabelas (clique no cabeçalho)
        document.querySelectorAll('.table-card table').forEach((table) => {
            const headers = table.querySelectorAll('th');
            headers.forEach((th, index) => {
                const label = th.textContent.trim().toLowerCase();
                if (label === 'ações' || th.classList.contains('no-sort')) return;
                th.classList.add('sortable');
                th.addEventListener('click', () => {
                    const direction = th.dataset.sortDir === 'asc' ? 'desc' : 'asc';
                    headers.forEach(h => h.classList.remove('asc', 'desc'));
                    th.dataset.sortDir = direction;
                    th.classList.add(direction);

                    const rows = Array.from(table.querySelectorAll('tbody tr'));
                    rows.sort((a, b) => {
                        const aText = (a.children[index]?.textContent || '').trim();
                        const bText = (b.children[index]?.textContent || '').trim();
                        return direction === 'asc'
                            ? aText.localeCompare(bText, undefined, { numeric: true, sensitivity: 'base' })
                            : bText.localeCompare(aText, undefined, { numeric: true, sensitivity: 'base' });
                    });

                    const tbody = table.querySelector('tbody');
                    rows.forEach(r => tbody.appendChild(r));
                });
            });
        });

        // Modal simples para eliminar
        const deleteModal = document.getElementById('adminDeleteModal');
        let pendingDeleteForm = null;
        document.querySelectorAll('form.confirm-delete').forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                pendingDeleteForm = form;
                deleteModal?.classList.add('is-open');
            });
        });
        const closeDelete = () => {
            deleteModal?.classList.remove('is-open');
            pendingDeleteForm = null;
        };
        document.getElementById('adminDeleteConfirm')?.addEventListener('click', () => {
            pendingDeleteForm?.submit();
            closeDelete();
        });
        document.getElementById('adminDeleteCancel')?.addEventListener('click', closeDelete);
        document.getElementById('adminDeleteClose')?.addEventListener('click', closeDelete);
        deleteModal?.addEventListener('click', (e) => {
            if (e.target === deleteModal) closeDelete();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeDelete();
        });
    </script>
</body>

</html>