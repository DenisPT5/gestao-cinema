<x-app-layout>
    <div class="topbar">
        <h1>🎬 Filmes</h1>
        <a href="{{ route('filmes.create') }}" class="btn btn-primary">+ Novo Filme</a>
    </div>
    <div class="card">
        <table>
            <thead>
                <tr><th>Título</th><th>Realizador</th><th>Ano</th><th>Duração</th><th>Géneros</th><th>Ações</th></tr>
            </thead>
            <tbody>
                @forelse($filmes as $filme)
                <tr>
                    <td><strong>{{ $filme->titulo }}</strong></td>
                    <td>{{ $filme->realizador ?? '—' }}</td>
                    <td>{{ $filme->ano_lancamento ?? '—' }}</td>
                    <td>{{ $filme->duracao_minutos }} min</td>
                    <td>
                        @foreach($filme->generos as $genero)
                            <span class="badge badge-blue">{{ $genero->nome }}</span>
                        @endforeach
                    </td>
                    <td style="display:flex;gap:6px">
                        <a href="{{ route('filmes.show', $filme->id_filme) }}" class="btn btn-secondary btn-sm">👁️</a>
                        <a href="{{ route('filmes.edit', $filme->id_filme) }}" class="btn btn-warning btn-sm">✏️</a>
                        <form method="POST" action="{{ route('filmes.destroy', $filme->id_filme) }}" onsubmit="return confirm('Eliminar este filme?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;color:#666">Nenhum filme encontrado.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $filmes->links() }}</div>
    </div>
</x-app-layout>