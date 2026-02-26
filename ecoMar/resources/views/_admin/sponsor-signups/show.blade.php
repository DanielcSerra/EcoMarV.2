@extends('_admin.layout')

@section('title', $resource['title'] ?? 'Ver Pedido de Patrocínio')

@section('content')
<div class="page-header">
    <div>
        <p class="eyebrow">{{ $resource['title'] ?? '' }}</p>
        <h2>Pedido #{{ $item->id }}</h2>
    </div>
</div>

<div class="card form-card">
    <div class="form-vertical">
        <div class="form-field">
            <span>Nome</span>
            <p>{{ $item->nome }}</p>
        </div>

        <div class="form-field">
            <span>Email</span>
            <p>{{ $item->email }}</p>
        </div>

        <div class="form-field">
            <span>Mensagem</span>
            <p>{{ $item->mensagem ?? '—' }}</p>
        </div>

        <div class="form-field">
            <span>Enviado em</span>
            <p>{{ $item->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="form-actions floating-actions">
        <a class="btn ghost btn-lg" href="{{ route('admin.sponsor-signups.index') }}">
            <i class="ri-arrow-left-line"></i> Voltar
        </a>
    </div>
</div>
@endsection
