<x-app-layout>
    <div class="topbar">
        <h1>🎬 {{ $filme->titulo }}</h1>
        <div style="display:flex;gap:8px">
            <a href="{{ route('filmes.edit', $filme->id_filme) }}" class="btn btn-warning">✏️ Editar</a>
            <a href="{{ route('filmes.index') }}" class="btn btn-secondary">← Voltar</a>
        </div>
    </div>
    <div class="grid-2">
        <div class="card">
            <div class="card-title">ℹ️ Informações</div>
            <p><strong style="color:#888">Realizador:</strong> {{ $filme->realizador ?? '—' }}</p>
            <p><strong style="color:#888">Ano:</strong> {{ $filme->ano_lancamento ?? '—' }}</p>
            <p><strong style="color:#888">Duração:</strong> {{ $filme->duracao_minutos }} minutos</p>
            <p><strong style="color:#888">Géneros:</strong>
                @foreach($filme->generos as $g)
                    <span class="badge badge-blue">{{ $g->nome }}</span>
                @endforeach
            </p>
        </div>
        <div class="card">
            <div class="card-title">📅 Sessões deste Filme</div>
            @forelse($filme->sessoes as $sessao)
                <div style="padding:8px 0;border-bottom:1px solid #222">
                    <strong>{{ \Carbon\Carbon::parse($sessao->data_hora)->format('d/m/Y H:i') }}</strong>
                    <span style="color:#888"> — {{ $sessao->sala->nome }}</span>
                    <a href="{{ route('sessoes.show', $sessao->id_sessao) }}" class="btn btn-secondary btn-sm" style="float:right">Ver</a>
                </div>
            @empty
                <p style="color:#666">Sem sessões agendadas.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>