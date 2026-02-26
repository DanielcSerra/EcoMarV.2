@extends('_admin.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="hero-card">
        <div>
            <p class="eyebrow">Dashboard</p>
            <h2>Bem-vindo de volta, {{ auth()->user()->name ?? 'Administrador' }}</h2>
            <p class="muted">Resumo rápido do impacto, eventos em tempo real.</p>
        </div>
        <div class="hero-actions">
            <a class="btn primary" href="{{ route('admin.events.create') }}">
                <i class="ri-calendar-add-line"></i> Novo evento
            </a>
            <a class="btn secondary" href="{{ route('admin.news.create') }}">
                <i class="ri-add-line"></i> Nova notícia
            </a>
        </div>
    </div>

    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-meta">
                <p class="overline">Donativos totais</p>
                <h3>€ {{ number_format($stats['donations_total'] ?? 0, 2, ',', ' ') }}</h3>
                <p class="muted">Valor angariado em todas as doações.</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-meta">
                <p class="overline">Eventos publicados</p>
                <h3>{{ $stats['events'] ?? 0 }}</h3>
                <p class="muted">Entradas ativas no calendário.</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-meta">
                <p class="overline">Sugestões de eventos</p>
                <h3>{{ $stats['event_suggestions'] ?? 0 }}</h3>
                <p class="muted">Ideias da comunidade.</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-meta">
                <p class="overline">Depoimentos</p>
                <h3>{{ $stats['testimonies'] ?? 0 }}</h3>
                <p class="muted">
                    {{ $stats['testimonies_pending'] ?? 0 }} por aprovar.
                </p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-meta">
                <p class="overline">Subscrições</p>
                <h3>{{ $stats['newsletters'] ?? 0 }}</h3>
                <p class="muted">Emails inscritos na newsletter.</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-meta">
                <p class="overline">Utilizadores</p>
                <h3>{{ $stats['users'] ?? 0 }}</h3>
                <p class="muted">Contas registadas.</p>
            </div>
        </div>
    </div>

    <div class="chart-grid">
        <div class="card">
            <div class="card-header">
                <p class="overline">Donativos por mês</p>
                <h4>Entrada de fundos</h4>
            </div>
            <canvas id="donationsChart" height="180"></canvas>
        </div>
        <div class="card">
            <div class="card-header">
                <p class="overline">Eventos por mês</p>
                <h4>Agenda</h4>
            </div>
            <canvas id="eventsChart" height="180"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        const donationsCtx = document.getElementById('donationsChart');
        const eventsCtx = document.getElementById('eventsChart');
        const donationsLabels = @json($donationsChart['labels'] ?? []);
        const donationsData = @json($donationsChart['data'] ?? []);
        const eventsLabels = @json($eventsChart['labels'] ?? []);
        const eventsData = @json($eventsChart['data'] ?? []);

        let donationsChart = null;
        let eventsChart = null;

        function renderDashboardCharts() {
            const styles = getComputedStyle(document.documentElement);
            const axisColor = (styles.getPropertyValue('--chart-axis') || '#334155').trim();
            const gridColor = (styles.getPropertyValue('--chart-grid') || 'rgba(148, 163, 184, 0.35)').trim();

            if (donationsChart) donationsChart.destroy();
            if (eventsChart) eventsChart.destroy();

            if (donationsCtx && donationsLabels.length) {
                donationsChart = new Chart(donationsCtx, {
                    type: 'line',
                    data: {
                        labels: donationsLabels,
                        datasets: [{
                            label: '€',
                            data: donationsData,
                            borderColor: '#2563eb',
                            backgroundColor: 'rgba(37, 99, 235, 0.1)',
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { color: axisColor }, grid: { color: gridColor } },
                            x: { ticks: { color: axisColor }, grid: { color: gridColor } }
                        }
                    }
                });
            }

            if (eventsCtx && eventsLabels.length) {
                eventsChart = new Chart(eventsCtx, {
                    type: 'bar',
                    data: {
                        labels: eventsLabels,
                        datasets: [{
                            label: 'Eventos',
                            data: eventsData,
                            backgroundColor: '#16a34a'
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1, color: axisColor }, grid: { color: gridColor } },
                            x: { ticks: { color: axisColor }, grid: { color: gridColor } }
                        }
                    }
                });
            }
        }

        renderDashboardCharts();
        window.renderDashboardCharts = renderDashboardCharts;
    </script>
@endpush