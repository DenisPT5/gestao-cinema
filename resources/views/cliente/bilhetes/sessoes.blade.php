@extends('cliente.layouts.app')
@section('title', 'Sessões Disponíveis')

@section('content')
<div class="container page-content">
    <div class="section-header" style="margin-bottom:32px;padding-top:20px">
        <div class="section-title" style="font-size:1.8rem">🎬 Sessões Disponíveis</div>
    </div>

    @if($sessoes->count() > 0)
    <div class="sessoes-grid">
        @foreach($sessoes as $sessao)
        @php
            $vendidos = $sessao->bilhetes()->count();
            $cap = $sessao->sala->capacidade;
            $livres = $cap - $vendidos;
            $pct = $cap > 0 ? ($vendidos / $cap) * 100 : 0;
            $esgotado = $livres <= 0;
        @endphp
        <div class="sessao-card">
            <div class="sessao-card-header">
                <div>
                    <div class="sessao-filme">{{ $sessao->filme->titulo }}</div>
                    @foreach($sessao->filme->generos->take(2) as $g)
                        <span class="genre-tag" style="margin-top:6px;display:inline-block">{{ $g->nome }}</span>
                    @endforeach
                </div>
                <div class="sessao-preco">{{ number_format($sessao->preco_base, 2) }}€</div>
            </div>

            <div class="sessao-details">
                <div class="sessao-detail">
                    <span class="icon">📅</span>
                    <span>{{ \Carbon\Carbon::parse($sessao->data_hora)->format('d/m/Y') }}</span>
                </div>
                <div class="sessao-detail">
                    <span class="icon">🕐</span>
                    <span>{{ \Carbon\Carbon::parse($sessao->data_hora)->format('H:i') }}</span>
                </div>
                <div class="sessao-detail">
                    <span class="icon">🏛️</span>
                    <span>{{ $sessao->sala->nome }}</span>
                </div>
                <div class="sessao-detail">
                    <span class="icon">⏱️</span>
                    <span>{{ $sessao->filme->duracao_minutos }} minutos</span>
                </div>
            </div>

            <div class="sessao-disponivel">
                <span style="font-size:0.8rem;color:var(--text2)">{{ $livres }} lugares</span>
                <div class="progress-bar">
                    <div class="progress-fill {{ $pct > 80 ? 'quase-cheio' : '' }} {{ $esgotado ? 'esgotado' : '' }}"
                         style="width:{{ min($pct, 100) }}%"></div>
                </div>
                <span style="font-size:0.8rem;color:var(--text3)">{{ number_format($pct, 0) }}%</span>
            </div>

            @if(!$esgotado)
            <form method="POST" action="{{ route('cliente.bilhetes.comprar') }}">
                @csrf
                <input type="hidden" name="id_sessao" value="{{ $sessao->id_sessao }}">
                <button type="submit" class="btn-comprar"
                    onclick="return confirm('Confirmas a compra do bilhete por {{ number_format($sessao->preco_base, 2) }}€?')">
                    🎟️ Comprar Bilhete — {{ number_format($sessao->preco_base, 2) }}€
                </button>
            </form>
            @else
            <button class="btn-comprar" style="background:#333;cursor:not-allowed" disabled>
                😔 Esgotado
            </button>
            @endif
        </div>
        @endforeach
    </div>

    <div class="pagination-wrap">
        {{ $sessoes->links() }}
    </div>

    @else
    <div class="empty-state">
        <div class="icon">📅</div>
        <h3>Sem sessões disponíveis</h3>
        <p>De momento não há sessões agendadas. Volta em breve!</p>
    </div>
    @endif
</div>
@endsection
