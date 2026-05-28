@extends('cliente.layouts.app')
@section('title', 'Os Meus Bilhetes')

@section('content')
<div class="container page-content">
    <div class="section-header" style="padding-top:20px;margin-bottom:32px">
        <div class="section-title" style="font-size:1.8rem">🎟️ Os Meus Bilhetes</div>
        <a href="{{ route('cliente.sessoes') }}" class="btn-submit" style="text-decoration:none">
            + Comprar Bilhete
        </a>
    </div>

    {{-- TABS --}}
    <div class="tabs">
        <button class="tab active" onclick="filterBilhetes('todos', this)">Todos</button>
        <button class="tab" onclick="filterBilhetes('futuros', this)">Próximas Sessões</button>
        <button class="tab" onclick="filterBilhetes('passados', this)">Histórico</button>
    </div>

    @if($bilhetes->count() > 0)
    <div class="bilhetes-grid" id="bilhetes-container">
        @foreach($bilhetes as $bilhete)
        @php
            $futuro = \Carbon\Carbon::parse($bilhete->sessao->data_hora)->isFuture();
        @endphp
        <div class="bilhete-card" data-tipo="{{ $futuro ? 'futuros' : 'passados' }}">
            <div class="bilhete-card-top">
                <div class="bilhete-icon">{{ $futuro ? '🎬' : '✅' }}</div>
                <div class="bilhete-info">
                    <h3>{{ $bilhete->sessao->filme->titulo }}</h3>
                    <p>📅 {{ \Carbon\Carbon::parse($bilhete->sessao->data_hora)->format('d/m/Y \à\s H:i') }}</p>
                    <p>🏛️ {{ $bilhete->sessao->sala->nome }}</p>
                    <p style="margin-top:4px;font-size:0.75rem;color:var(--text3)">
                        Comprado em {{ \Carbon\Carbon::parse($bilhete->data_compra)->format('d/m/Y H:i') }}
                    </p>
                </div>
            </div>
            <div class="bilhete-card-bottom">
                <div>
                    <div class="bilhete-price">{{ number_format($bilhete->preco, 2) }}€</div>
                    <div class="bilhete-num">#{{ $bilhete->num_bilhete }} · {{ $bilhete->tipo_compra }}</div>
                </div>
                <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px">
                    <span class="bilhete-status {{ $futuro ? 'status-futuro' : 'status-passado' }}">
                        {{ $futuro ? '✓ Confirmado' : '✓ Realizado' }}
                    </span>
                    @if($futuro)
                    <form method="POST" action="{{ route('cliente.bilhetes.cancelar', $bilhete->num_bilhete) }}">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-cancelar"
                            onclick="return confirm('Tens a certeza que queres cancelar este bilhete?')">
                            Cancelar
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="pagination-wrap">{{ $bilhetes->links() }}</div>

    @else
    <div class="empty-state">
        <div class="icon">🎟️</div>
        <h3>Ainda não tens bilhetes</h3>
        <p>Compra o teu primeiro bilhete e vem ao cinema!</p>
        <a href="{{ route('cliente.sessoes') }}" class="btn-submit" style="display:inline-block;margin-top:20px;text-decoration:none">
            Ver Sessões Disponíveis
        </a>
    </div>
    @endif
</div>

@push('scripts')
<script>
function filterBilhetes(tipo, btn) {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.bilhete-card').forEach(card => {
        if (tipo === 'todos') {
            card.style.display = '';
        } else {
            card.style.display = card.dataset.tipo === tipo ? '' : 'none';
        }
    });
}
</script>
@endpush
@endsection
