@extends('cliente.layouts.app')
@section('title', 'Dashboard')

@section('content')
{{-- HERO --}}
<div class="hero">
    <div class="hero-bg"></div>
    <div class="container hero-content">
        <h1>Olá, <span>{{ explode(' ', $cliente->nome)[0] }}</span> 👋</h1>
        <p>Bem-vindo de volta ao CineMax. Descobre os filmes em cartaz e compra os teus bilhetes.</p>
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="number">{{ $totalBilhetes }}</div>
                <div class="label">Bilhetes Comprados</div>
            </div>
            <div class="hero-stat">
                <div class="number">{{ number_format($totalGasto, 2) }}€</div>
                <div class="label">Total Gasto</div>
            </div>
            <div class="hero-stat">
                <div class="number">{{ $proximosBilhetes->count() }}</div>
                <div class="label">Próximas Sessões</div>
            </div>
        </div>
    </div>
</div>

<div class="container page-content">

    {{-- PRÓXIMOS BILHETES --}}
    @if($proximosBilhetes->count() > 0)
    <div class="section">
        <div class="section-header">
            <div class="section-title">🎟️ Os Teus Próximos Bilhetes</div>
            <a href="{{ route('cliente.bilhetes') }}" class="section-link">Ver todos →</a>
        </div>
        <div class="bilhetes-grid">
            @foreach($proximosBilhetes as $bilhete)
            <div class="bilhete-card">
                <div class="bilhete-card-top">
                    <div class="bilhete-icon">🎬</div>
                    <div class="bilhete-info">
                        <h3>{{ $bilhete->sessao->filme->titulo }}</h3>
                        <p>📅 {{ \Carbon\Carbon::parse($bilhete->sessao->data_hora)->format('d/m/Y \à\s H:i') }}</p>
                        <p>🏛️ {{ $bilhete->sessao->sala->nome }}</p>
                    </div>
                </div>
                <div class="bilhete-card-bottom">
                    <div>
                        <div class="bilhete-price">{{ number_format($bilhete->preco, 2) }}€</div>
                        <div class="bilhete-num">#{{ $bilhete->num_bilhete }}</div>
                    </div>
                    <span class="bilhete-status status-futuro">✓ Confirmado</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- FILMES EM DESTAQUE --}}
    <div class="section">
        <div class="section-header">
            <div class="section-title">🎬 Filmes em Cartaz</div>
            <a href="{{ route('cliente.sessoes') }}" class="section-link">Ver todas as sessões →</a>
        </div>

        @if($filmesDestaque->count() > 0)
        <div class="cards-grid" id="films-grid">
            @foreach($filmesDestaque as $filme)
            <div class="film-card">
                <div class="film-card-poster">
                    🎥
                    <span class="film-card-badge">{{ $filme->duracao_minutos }}min</span>
                </div>
                <div class="film-card-body">
                    <div class="film-card-title" title="{{ $filme->titulo }}">{{ $filme->titulo }}</div>
                    <div class="film-card-meta">
                        @if($filme->ano_lancamento)
                            <span>{{ $filme->ano_lancamento }}</span>
                        @endif
                        @if($filme->realizador)
                            <span>·</span>
                            <span>{{ $filme->realizador }}</span>
                        @endif
                    </div>
                    <div class="film-card-genres">
                        @foreach($filme->generos->take(2) as $genero)
                            <span class="genre-tag">{{ $genero->nome }}</span>
                        @endforeach
                    </div>
                    <div class="film-card-sessions">
                        <strong>{{ $filme->sessoes->count() }}</strong>
                        {{ $filme->sessoes->count() == 1 ? 'sessão disponível' : 'sessões disponíveis' }}
                    </div>
                    @if($filme->sessoes->first())
                    <a href="{{ route('cliente.sessoes') }}" class="btn-comprar">
                        Comprar Bilhete
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <div class="icon">🎭</div>
            <h3>Sem sessões disponíveis</h3>
            <p>De momento não há sessões agendadas. Volta em breve!</p>
        </div>
        @endif
    </div>
</div>
@endsection
