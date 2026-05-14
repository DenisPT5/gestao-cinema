<x-app-layout>
    <div class="topbar">
        <h1>📅 Sessões</h1>
        <a href="{{ route('sessoes.create') }}" class="btn btn-primary">+ Nova Sessão</a>
    </div>
    <div class="card" style="padding:16px 24px">
        <form method="GET" style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap">
            <div class="form-group" style="margin:0;min-width:160px">
                <label>Filtrar por Filme</label>
                <select name="filme" class="form-control">
                    <option value="">Todos</option>
                    @foreach($filmes as $f)
                        <option value="{{ $f->id_filme }}" {{ request('filme') == $f->id_filme ? 'selected' : '' }}>{{ $f->titulo }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin:0;min-width:140px">
                <label>Filtrar por Sala</label>
                <select name="sala" class="form-control">
                    <option value="">Todas</option>
                    @foreach($salas as $s)
                        <option value="{{ $s->id_sala }}" {{ request('sala') == $s->id_sala ? 'selected' : '' }}>{{ $s->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin:0">
                <label>Data</label>
                <input type="date" name="data" class="form-control" value="{{ request('data') }}">
            </div>
            <button type="submit" class="btn btn-primary">🔍 Filtrar</button>
            <a href="{{ route('sessoes.index') }}" class="btn btn-secondary">✕ Limpar</a>
        </form>
    </div>
    <div class="card">
        <table>
            <thead>
                <tr><th>Filme</th><th>Sala</th><th>Data/Hora</th><th>Preço Base</th><th>Responsável</th><th>Ações</th></tr>
            </thead>
            <tbody>
                @forelse($sessoes as $sessao)
                <tr>
                    <td><strong>{{ $sessao->filme->titulo }}</strong></td>
                    <td>{{ $sessao->sala->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($sessao->data_hora)->format('d/m/Y H:i') }}</td>
                    <td>{{ number_format($sessao->preco_base, 2) }}€</td>
                    <td>{{ $sessao->funcionario->nome ?? '—' }}</td>
                    <td style="display:flex;gap:6px">
                        <a href="{{ route('sessoes.show', $sessao->id_sessao) }}" class="btn btn-secondary btn-sm">👁️</a>
                        <a href="{{ route('sessoes.edit', $sessao->id_sessao) }}" class="btn btn-warning btn-sm">✏️</a>
                        <form method="POST" action="{{ route('sessoes.destroy', $sessao->id_sessao) }}" onsubmit="return confirm('Eliminar esta sessão?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </td>
                </tr>
                @empty
                    <tr><td colspan="6" style="text-align:center;color:#666">Nenhuma sessão encontrada.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">{{ $sessoes->links() }}</div>
    </div>
</x-app-layout>